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

    const res = await fetch("https://api.resend.com/emails", {
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

    if (!res.ok) {
      const errorData = await res.text();
      console.error("Resend API error:", errorData);
      throw new Error(`Failed to send email: ${errorData}`);
    }

    const emailResponse = await res.json();
    console.log("Email sent successfully:", emailResponse);

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
