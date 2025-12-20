import { serve } from "https://deno.land/std@0.190.0/http/server.ts";

const RESEND_API_KEY = Deno.env.get("RESEND_API_KEY");

const corsHeaders = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Headers": "authorization, x-client-info, apikey, content-type",
};

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

  try {
    const { name, organization, role, industry, email, message }: DemoRequest = await req.json();

    console.log("Sending demo notification for:", { name, organization, email });

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
        subject: `New Demo Request from ${name} at ${organization}`,
        html: `
          <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
            <h1 style="color: #0ea5e9; margin-bottom: 24px;">New Demo Request</h1>
            
            <div style="background: #f8fafc; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
              <h2 style="margin: 0 0 16px 0; color: #334155; font-size: 18px;">Contact Information</h2>
              <table style="width: 100%; border-collapse: collapse;">
                <tr>
                  <td style="padding: 8px 0; color: #64748b; width: 120px;"><strong>Name:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${name}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Email:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;"><a href="mailto:${email}" style="color: #0ea5e9;">${email}</a></td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Organization:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${organization}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Role:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${role}</td>
                </tr>
                <tr>
                  <td style="padding: 8px 0; color: #64748b;"><strong>Industry:</strong></td>
                  <td style="padding: 8px 0; color: #1e293b;">${industry}</td>
                </tr>
              </table>
            </div>
            
            ${message ? `
            <div style="background: #f8fafc; border-radius: 8px; padding: 20px;">
              <h2 style="margin: 0 0 12px 0; color: #334155; font-size: 18px;">Message</h2>
              <p style="margin: 0; color: #475569; line-height: 1.6;">${message}</p>
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
        to: [email],
        subject: `Thanks for your interest in Vraust.ai, ${name}!`,
        html: `
          <div style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background: #ffffff;">
            <div style="text-align: center; margin-bottom: 32px;">
              <h1 style="color: #0f172a; margin: 0 0 8px 0; font-size: 28px;">We've received your demo request!</h1>
              <p style="color: #64748b; margin: 0; font-size: 16px;">Thanks for reaching out, ${name}</p>
            </div>
            
            <div style="background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%); border-radius: 12px; padding: 24px; margin-bottom: 24px; color: white;">
              <p style="margin: 0; font-size: 16px; line-height: 1.6;">
                We're excited that <strong>${organization}</strong> is interested in exploring how Vraust.ai can transform your ${industry.toLowerCase()} workflows with AI-powered automation.
              </p>
            </div>
            
            <div style="background: #f8fafc; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
              <h2 style="margin: 0 0 16px 0; color: #334155; font-size: 18px;">What happens next?</h2>
              <ul style="margin: 0; padding-left: 20px; color: #475569; line-height: 1.8;">
                <li>Our team will review your request within <strong>24 hours</strong></li>
                <li>We'll reach out to schedule a personalized demo tailored to your ${role.toLowerCase()} needs</li>
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
