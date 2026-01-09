import { useState, useEffect, useCallback } from "react";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Link } from "react-router-dom";
import { ArrowLeft, Shield, Lock, CheckCircle2, Loader2 } from "lucide-react";
import { useToast } from "@/hooks/use-toast";
import { supabase } from "@/integrations/supabase/client";
import { z } from "zod";

// Replace with your reCAPTCHA site key
const RECAPTCHA_SITE_KEY = "6LcPg6krAAAAAGyRjP33b2rXGpYlCCBL-Rz4_HFV";

declare global {
  interface Window {
    grecaptcha: {
      ready: (callback: () => void) => void;
      execute: (siteKey: string, options: { action: string }) => Promise<string>;
      render: (container: string | HTMLElement, options: { 
        sitekey: string; 
        callback: (token: string) => void; 
        "expired-callback": () => void;
        "error-callback"?: () => void;
      }) => number;
      reset: (widgetId?: number) => void;
    };
    onRecaptchaLoaded?: () => void;
  }
}

const demoRequestSchema = z.object({
  name: z.string().trim().min(1, "Name is required").max(100, "Name must be less than 100 characters"),
  organization: z.string().trim().min(1, "Organization is required").max(200, "Organization must be less than 200 characters"),
  role: z.string().trim().min(1, "Role is required").max(100, "Role must be less than 100 characters"),
  industry: z.string().trim().min(1, "Industry is required"),
  email: z.string().trim().email("Invalid email address").max(255, "Email must be less than 255 characters"),
  message: z.string().trim().max(1000, "Message must be less than 1000 characters").optional(),
});

const industries = [
  "Banking",
  "FinTech",
  "Insurance",
  "Healthcare",
  "Other",
];

export const DemoPage = () => {
  const { toast } = useToast();
  const [isSubmitted, setIsSubmitted] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    organization: "",
    role: "",
    industry: "",
    email: "",
    message: "",
  });
  const [honeypot, setHoneypot] = useState("");
  const [recaptchaToken, setRecaptchaToken] = useState<string | null>(null);
  const [recaptchaWidgetId, setRecaptchaWidgetId] = useState<number | null>(null);
  const [recaptchaLoaded, setRecaptchaLoaded] = useState(false);
  const [recaptchaError, setRecaptchaError] = useState<string | null>(null);

  // Load reCAPTCHA script
  useEffect(() => {
    if (document.querySelector('script[src*="recaptcha"]')) {
      if (window.grecaptcha) {
        setRecaptchaLoaded(true);
      }
      return;
    }

    window.onRecaptchaLoaded = () => {
      setRecaptchaLoaded(true);
    };

    const script = document.createElement("script");
    script.src = `https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoaded&render=explicit`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);

    return () => {
      window.onRecaptchaLoaded = undefined;
    };
  }, []);

  // Render reCAPTCHA widget
  const recaptchaCallback = useCallback(() => {
    if (!recaptchaLoaded || recaptchaWidgetId !== null || isSubmitted) return;
    
    const container = document.getElementById("recaptcha-container");
    if (!container || !window.grecaptcha) {
      console.error("reCAPTCHA: Container or grecaptcha not found");
      return;
    }

    try {
      console.log("Rendering reCAPTCHA with site key:", RECAPTCHA_SITE_KEY);
      const widgetId = window.grecaptcha.render("recaptcha-container", {
        sitekey: RECAPTCHA_SITE_KEY,
        callback: (token: string) => {
          console.log("reCAPTCHA token received");
          setRecaptchaToken(token);
          setRecaptchaError(null);
        },
        "expired-callback": () => {
          console.log("reCAPTCHA token expired");
          setRecaptchaToken(null);
        },
        "error-callback": () => {
          console.error("reCAPTCHA encountered an error");
          setRecaptchaError("reCAPTCHA failed to load. Please refresh the page.");
        },
      });
      setRecaptchaWidgetId(widgetId);
      console.log("reCAPTCHA widget rendered successfully, widgetId:", widgetId);
    } catch (error) {
      console.error("Error rendering reCAPTCHA:", error);
      setRecaptchaError("Failed to initialize reCAPTCHA. Please refresh the page.");
    }
  }, [recaptchaLoaded, recaptchaWidgetId, isSubmitted]);

  useEffect(() => {
    recaptchaCallback();
  }, [recaptchaCallback]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    // Check reCAPTCHA
    if (!recaptchaToken) {
      toast({
        title: "Verification Required",
        description: "Please complete the reCAPTCHA verification.",
        variant: "destructive",
      });
      return;
    }

    setIsSubmitting(true);

    try {
      // Validate form data
      const validatedData = demoRequestSchema.parse(formData);

      // Save to database
      const { error } = await supabase.from("demo_requests").insert({
        name: validatedData.name,
        organization: validatedData.organization,
        role: validatedData.role,
        industry: validatedData.industry,
        email: validatedData.email,
        message: validatedData.message || null,
      });

      if (error) throw error;

      // Send email notification with reCAPTCHA token
      const { error: functionError } = await supabase.functions.invoke("send-demo-notification", {
        body: {
          name: validatedData.name,
          organization: validatedData.organization,
          role: validatedData.role,
          industry: validatedData.industry,
          email: validatedData.email,
          message: validatedData.message || "",
          _hp: honeypot,
          recaptchaToken,
        },
      });

      if (functionError) {
        console.error("Email notification failed:", functionError);
      }

      setIsSubmitted(true);
      toast({
        title: "Demo Request Received",
        description: "We'll be in touch within 24 hours.",
      });
    } catch (error) {
      if (error instanceof z.ZodError) {
        toast({
          title: "Validation Error",
          description: error.errors[0].message,
          variant: "destructive",
        });
      } else {
        toast({
          title: "Submission Failed",
          description: "Please try again later.",
          variant: "destructive",
        });
      }
    } finally {
      setIsSubmitting(false);
      // Reset reCAPTCHA on error
      if (recaptchaWidgetId !== null && window.grecaptcha) {
        window.grecaptcha.reset(recaptchaWidgetId);
        setRecaptchaToken(null);
      }
    }
  };

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData((prev) => ({
      ...prev,
      [e.target.name]: e.target.value,
    }));
  };

  return (
    <div className="min-h-screen bg-background grain-overlay">
      {/* Background Effects */}
      <div className="fixed inset-0 bg-gradient-to-br from-[hsl(210,55%,7%)] via-[hsl(210,45%,10%)] to-[hsl(206,40%,12%)]" />
      <div className="fixed top-1/4 left-1/4 w-[600px] h-[600px] bg-primary/10 rounded-full blur-3xl animate-glow-pulse" />
      <div className="fixed bottom-1/4 right-1/4 w-[400px] h-[400px] bg-accent/5 rounded-full blur-3xl" />

      <div className="relative z-10 container mx-auto px-4 py-12">
        {/* Back Link */}
        <motion.div
          initial={{ opacity: 0, x: -20 }}
          animate={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.4 }}
        >
          <Link
            to="/"
            className="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-foreground transition-colors mb-12"
          >
            <ArrowLeft className="w-4 h-4" />
            Back to Home
          </Link>
        </motion.div>

        <div className="max-w-4xl mx-auto">
          <div className="grid lg:grid-cols-2 gap-12 lg:gap-16">
            {/* Left Column - Info */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
            >
              {/* Logo */}
              <Link to="/" className="flex items-center gap-3 mb-8">
                <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-accent flex items-center justify-center shadow-button">
                  <span className="text-xl font-bold text-primary-foreground">V</span>
                </div>
                <span className="text-2xl font-bold text-foreground">
                  Vraust<span className="text-primary">.ai</span>
                </span>
              </Link>

              <h1 className="text-4xl md:text-5xl font-bold text-foreground mb-6 leading-tight">
                Request a <span className="text-primary">Demo</span>
              </h1>

              <p className="text-lg text-muted-foreground mb-8 leading-relaxed">
                Discover how Vraust.ai can help your organization fight fraud collaboratively 
                while maintaining complete data privacy. Our team will walk you through the platform 
                and answer all your questions.
              </p>

              {/* Trust Indicators */}
              <div className="space-y-4 mb-8">
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <Shield className="w-4 h-4 text-primary" />
                  </div>
                  <div>
                    <h3 className="text-sm font-semibold text-foreground">Enterprise Security</h3>
                    <p className="text-xs text-muted-foreground">Your information is encrypted and protected</p>
                  </div>
                </div>
                <div className="flex items-start gap-3">
                  <div className="w-8 h-8 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <Lock className="w-4 h-4 text-accent" />
                  </div>
                  <div>
                    <h3 className="text-sm font-semibold text-foreground">Confidential</h3>
                    <p className="text-xs text-muted-foreground">We never share your data with third parties</p>
                  </div>
                </div>
              </div>

              {/* Quote */}
              <div className="glass-card p-6 rounded-xl">
                <p className="text-sm text-muted-foreground italic mb-4">
                  "The demo helped us understand how federated learning could transform 
                  our fraud detection capabilities without compromising customer privacy."
                </p>
                <div className="text-xs text-foreground font-medium">— Financial Institution Partner</div>
              </div>
            </motion.div>

            {/* Right Column - Form */}
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6, delay: 0.1 }}
            >
              {isSubmitted ? (
                /* Success State */
                <div className="glass-card p-8 md:p-12 rounded-2xl text-center">
                  <div className="w-20 h-20 mx-auto mb-6 rounded-full bg-accent/20 flex items-center justify-center">
                    <CheckCircle2 className="w-10 h-10 text-accent" />
                  </div>
                  <h2 className="text-2xl font-bold text-foreground mb-4">
                    Thank You!
                  </h2>
                  <p className="text-muted-foreground mb-8">
                    Your demo request has been received. Our team will contact you within 24 hours 
                    to schedule a personalized walkthrough of Vraust.ai.
                  </p>
                  <Link to="/">
                    <Button variant="heroOutline">
                      Return to Homepage
                    </Button>
                  </Link>
                </div>
              ) : (
                /* Form */
                <form onSubmit={handleSubmit} className="glass-card p-8 md:p-10 rounded-2xl">
                  <h2 className="text-xl font-semibold text-foreground mb-6">
                    Tell us about yourself
                  </h2>

                  <div className="space-y-5">
                    {/* Name */}
                    <div>
                      <label htmlFor="name" className="block text-sm font-medium text-foreground mb-2">
                        Full Name *
                      </label>
                      <Input
                        id="name"
                        name="name"
                        type="text"
                        required
                        placeholder="John Smith"
                        value={formData.name}
                        onChange={handleChange}
                      />
                    </div>

                    {/* Organization */}
                    <div>
                      <label htmlFor="organization" className="block text-sm font-medium text-foreground mb-2">
                        Organization *
                      </label>
                      <Input
                        id="organization"
                        name="organization"
                        type="text"
                        required
                        placeholder="Your company name"
                        value={formData.organization}
                        onChange={handleChange}
                      />
                    </div>

                    {/* Role */}
                    <div>
                      <label htmlFor="role" className="block text-sm font-medium text-foreground mb-2">
                        Role *
                      </label>
                      <Input
                        id="role"
                        name="role"
                        type="text"
                        required
                        placeholder="e.g., VP of Data Science"
                        value={formData.role}
                        onChange={handleChange}
                      />
                    </div>

                    {/* Industry */}
                    <div>
                      <label htmlFor="industry" className="block text-sm font-medium text-foreground mb-2">
                        Industry *
                      </label>
                      <select
                        id="industry"
                        name="industry"
                        required
                        value={formData.industry}
                        onChange={handleChange}
                        className="flex h-12 w-full rounded-lg border border-border bg-muted/50 px-4 py-3 text-base text-foreground ring-offset-background transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:border-primary/50"
                      >
                        <option value="" disabled>Select your industry</option>
                        {industries.map((industry) => (
                          <option key={industry} value={industry} className="bg-background text-foreground">
                            {industry}
                          </option>
                        ))}
                      </select>
                    </div>

                    {/* Email */}
                    <div>
                      <label htmlFor="email" className="block text-sm font-medium text-foreground mb-2">
                        Work Email *
                      </label>
                      <Input
                        id="email"
                        name="email"
                        type="email"
                        required
                        placeholder="john@company.com"
                        value={formData.email}
                        onChange={handleChange}
                      />
                    </div>

                    {/* Message */}
                    <div>
                      <label htmlFor="message" className="block text-sm font-medium text-foreground mb-2">
                        How can we help? (optional)
                      </label>
                      <textarea
                        id="message"
                        name="message"
                        rows={3}
                        placeholder="Tell us about your use case or any specific questions..."
                        value={formData.message}
                        onChange={handleChange}
                        className="flex w-full rounded-lg border border-border bg-muted/50 px-4 py-3 text-base text-foreground ring-offset-background transition-all duration-200 placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50 focus-visible:border-primary/50 resize-none"
                      />
                    </div>

                    {/* Honeypot field - hidden from real users, bots will fill it */}
                    <div aria-hidden="true" style={{ position: 'absolute', left: '-9999px', top: '-9999px' }}>
                      <label htmlFor="website">Website</label>
                      <input
                        type="text"
                        id="website"
                        name="website"
                        tabIndex={-1}
                        autoComplete="off"
                        value={honeypot}
                        onChange={(e) => setHoneypot(e.target.value)}
                      />
                    </div>

                    {/* reCAPTCHA */}
                    <div className="mt-4">
                      <div id="recaptcha-container" className="flex justify-center"></div>
                      {recaptchaError && (
                        <p className="text-sm text-destructive text-center mt-2">{recaptchaError}</p>
                      )}
                      {!recaptchaLoaded && !recaptchaError && (
                        <p className="text-sm text-muted-foreground text-center mt-2">Loading verification...</p>
                      )}
                    </div>
                  </div>

                  {/* Submit Button */}
                  <Button type="submit" variant="cta" size="lg" className="w-full mt-8" disabled={isSubmitting || !recaptchaToken}>
                    {isSubmitting ? <><Loader2 className="w-4 h-4 mr-2 animate-spin" /> Submitting...</> : "Request Demo"}
                  </Button>

                  {/* Security Note */}
                  <p className="text-xs text-muted-foreground text-center mt-6">
                    <Lock className="w-3 h-3 inline mr-1" />
                    Your information is secure and will never be shared.
                  </p>
                </form>
              )}
            </motion.div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default DemoPage;
