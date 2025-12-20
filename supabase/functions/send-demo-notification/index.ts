import { serve } from "https://deno.land/std@0.190.0/http/server.ts";

const RESEND_API_KEY = Deno.env.get("RESEND_API_KEY");

// Allowed origins for CORS
const ALLOWED_ORIGINS = [
  "https://vraust.ai",
  "https://www.vraust.ai",
  "http://localhost:5173",
  "http://localhost:8080",
];

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "authorization, x-client-info, apikey, content-type",
};

// HTML escape function to prevent XSS
function escapeHtml(unsafe: string): string {
  return unsafe
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

// Server-side validation schema
function validateDemoRequest(data: unknown): { valid: boolean; error?: string; data?: DemoRequest } {
  if (!data || typeof data !== 'object') {
    return { valid: false, error: "Invalid request body" };
  }
  
  const { name, organization, role, industry, email, message } = data as Record<string, unknown>;
  
  // Name validation
  if (typeof name !== 'string' || name.trim().length === 0) {
    return { valid: false, error: "Name is required" };
  }
  if (name.length > 100) {
    return { valid: false, error: "Name must be less than 100 characters" };
  }
  
  // Organization validation
  if (typeof organization !== 'string' || organization.trim().length === 0) {
    return { valid: false, error: "Organization is required" };
  }
  if (organization.length > 200) {
    return { valid: false, error: "Organization must be less than 200 characters" };
  }
  
  // Role validation
  if (typeof role !== 'string' || role.trim().length === 0) {
    return { valid: false, error: "Role is required" };
  }
  if (role.length > 100) {
    return { valid: false, error: "Role must be less than 100 characters" };
  }
  
  // Industry validation
  const validIndustries = ["Banking", "FinTech", "Insurance", "Healthcare", "Other"];
  if (typeof industry !== 'string' || !validIndustries.includes(industry)) {
    return { valid: false, error: "Invalid industry selection" };
  }
  
  // Email validation
  if (typeof email !== 'string' || email.trim().length === 0) {
    return { valid: false, error: "Email is required" };
  }
  if (email.length > 255) {
    return { valid: false, error: "Email must be less than 255 characters" };
  }
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    return { valid: false, error: "Invalid email format" };
  }
  
  // Message validation (optional)
  if (message !== undefined && message !== null) {
    if (typeof message !== 'string') {
      return { valid: false, error: "Message must be a string" };
    }
    if (message.length > 1000) {
      return { valid: false, error: "Message must be less than 1000 characters" };
    }
  }
  
  return {
    valid: true,
    data: {
      name: name.trim(),
      organization: organization.trim(),
      role: role.trim(),
      industry,
      email: email.trim().toLowerCase(),
      message: typeof message === 'string' ? message.trim() : undefined,
    },
  };
}

interface DemoRequest {
  name: string;
  organization: string;
  role: string;
  industry: string;
  email: string;
  message?: string;
}

const handler = async (req: Request): Promise<Response> => {
  // Handle CORS preflight requests
  if (req.method === "OPTIONS") {
    return new Response(null, { headers: corsHeaders });
  }

  // Validate origin (optional but recommended for production)
  const origin = req.headers.get("origin");
  if (origin && !ALLOWED_ORIGINS.some(allowed => origin.startsWith(allowed.replace(/:\d+$/, '')))) {
    console.warn("Request from unauthorized origin:", origin);
    // We still allow it but log for monitoring - in production you might want to block
  }

  try {
    const rawBody = await req.json();
    
    // Check honeypot field - if filled, it's likely a bot
    if (rawBody._hp && rawBody._hp.length > 0) {
      console.warn("Bot detected via honeypot field");
      // Return success to not reveal detection
      return new Response(
        JSON.stringify({ success: true }),
        {
          status: 200,
          headers: { "Content-Type": "application/json", ...corsHeaders },
        }
      );
    }
    
    // Server-side validation
    const validation = validateDemoRequest(rawBody);
    if (!validation.valid || !validation.data) {
      console.error("Validation failed:", validation.error);
      return new Response(
        JSON.stringify({ error: validation.error }),
        {
          status: 400,
          headers: { "Content-Type": "application/json", ...corsHeaders },
        }
      );
    }
    
    const { name, organization, role, industry, email, message } = validation.data;

    console.log("Sending demo notification for:", { name, organization, email });

    // Escape all user inputs for HTML
    const safeName = escapeHtml(name);
    const safeOrg = escapeHtml(organization);
    const safeRole = escapeHtml(role);
    const safeIndustry = escapeHtml(industry);
    const safeEmail = escapeHtml(email);
    const safeMessage = message ? escapeHtml(message) : "";

    // Send notification to Vraust team
    const notificationRes = await fetch("https://api.resend.com/emails", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${RESEND_API_KEY}`,
      },
      body: JSON.stringify({
        from: "Vraust.ai <demo@vraust.ai>",
        to: ["demo@vraust.ai"],
        subject: `New Demo Request from ${safeName} at ${safeOrg}`,
        html: `
          <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
            <h1 style="color: #0ea5e9; margin-bottom: 24px;">New Demo Request</h1>
            
            <div style="background: #f8fafc; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
              <h2 style="margin: 0 0 16px 0; color: #334155; font-size: 18px;">Contact Information</h2>
              <table style="width: 100%; border-collapse: collapse;">
                <tr>
                  <td style="padding: 8px 0; color: #64748b; width: 120px;"><strong>Name:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${safeName}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Email:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;"><a href="mailto:${safeEmail}" style="color: #0ea5e9;">${safeEmail}</a></td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Organization:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${safeOrg}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Role:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${safeRole}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Industry:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${safeIndustry}</td>
                </tr>
              </table>
            </div>
            
            ${safeMessage ? `
            <div style="background: #f8fafc; border-radius: 8px; padding: 20px;">
              <h2 style="margin: 0 0 12px 0; color: #334155; font-size: 18px;">Message</h2>
              <p style="margin: 0; color: #475569; line-height: 1.6;">${safeMessage}</p>
            </div>
            ` : ""}
            
            <p style="margin-top: 24px; color: #94a3b8; font-size: 14px;">
              This notification was sent automatically from the Vraust.ai website.
            </p>
          </div>
        `,
      }),
    });

    if (!notificationRes.ok) {
      const errorData = await notificationRes.text();
      console.error("Resend API error (notification):", errorData);
      throw new Error(`Failed to send notification email: ${errorData}`);
    }

    console.log("Notification email sent successfully");

    // Send confirmation email to the requester
    const confirmationRes = await fetch("https://api.resend.com/emails", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: `Bearer ${RESEND_API_KEY}`,
      },
      body: JSON.stringify({
        from: "Vraust.ai <demo@vraust.ai>",
        to: [email], // Use original email for actual delivery
        subject: `Thanks for your interest in Vraust.ai, ${safeName}!`,
        html: `
          <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: #ffffff;">
            <div style="text-align: center; margin-bottom: 32px;">
              <h1 style="color: #0f172a; margin: 0 0 8px 0; font-size: 28px;">We've received your demo request!</h1>
              <p style="color: #64748b; margin: 0; font-size: 16px;">Thanks for reaching out, ${safeName}</p>
            </div>
            
            <div style="background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%); border-radius: 12px; padding: 24px; margin-bottom: 24px; color: white;">
              <p style="margin: 0; font-size: 16px; line-height: 1.6;">
                We're excited that <strong>${safeOrg}</strong> is interested in exploring how Vraust.ai can transform your ${safeIndustry.toLowerCase()} workflows with AI-powered automation.
              </p>
            </div>
            
            <div style="background: #f8fafc; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
              <h2 style="margin: 0 0 16px 0; color: #334155; font-size: 18px;">What happens next?</h2>
              <ul style="margin: 0; padding-left: 20px; color: #475569; line-height: 1.8;">
                <li>Our team will review your request within <strong>24 hours</strong></li>
                <li>We'll reach out to schedule a personalized demo tailored to your ${safeRole.toLowerCase()} needs</li>
                <li>You'll see firsthand how Vraust.ai can streamline your operations</li>
              </ul>
            </div>
            
            <div style="background: #fef3c7; border-radius: 12px; padding: 20px; margin-bottom: 24px; border-left: 4px solid #f59e0b;">
              <p style="margin: 0; color: #92400e; font-size: 14px;">
                <strong>In the meantime:</strong> Have questions or want to fast-track your demo? Simply reply to this email — we'd love to hear from you!
              </p>
            </div>
            
            <div style="text-align: center; padding-top: 24px; border-top: 1px solid #e2e8f0;">
              <p style="margin: 0 0 8px 0; color: #334155; font-weight: 600;">The Vraust.ai Team</p>
              <p style="margin: 0; color: #94a3b8; font-size: 14px;">Empowering businesses with intelligent automation</p>
            </div>
          </div>
        `,
      }),
    });

    if (!confirmationRes.ok) {
      const errorData = await confirmationRes.text();
      console.error("Resend API error (confirmation):", errorData);
      // Don't throw here - notification was sent, just log the confirmation failure
    } else {
      console.log("Confirmation email sent successfully to:", email);
    }

    const emailResponse = { success: true, notificationSent: true, confirmationSent: confirmationRes.ok };

    return new Response(JSON.stringify(emailResponse), {
      status: 200,
      headers: { "Content-Type": "application/json", ...corsHeaders },
    });
  } catch (error: any) {
    console.error("Error in send-demo-notification function:", error);
    return new Response(
      JSON.stringify({ error: error.message }),
      {
        status: 500,
        headers: { "Content-Type": "application/json", ...corsHeaders },
      }
    );
  }
};

serve(handler);
