-- Create table to track demo form submissions for rate limiting
CREATE TABLE public.demo_rate_limits (
    id UUID NOT NULL DEFAULT gen_random_uuid() PRIMARY KEY,
    ip_address TEXT,
    email TEXT,
    submitted_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT now()
);

-- Enable RLS
ALTER TABLE public.demo_rate_limits ENABLE ROW LEVEL SECURITY;

-- Allow public inserts (for tracking)
CREATE POLICY "Allow public inserts for rate tracking"
ON public.demo_rate_limits
FOR INSERT
WITH CHECK (true);

-- Allow public select for rate checking (edge function needs this)
CREATE POLICY "Allow public select for rate checking"
ON public.demo_rate_limits
FOR SELECT
USING (true);

-- Create index for efficient lookups
CREATE INDEX idx_demo_rate_limits_ip ON public.demo_rate_limits(ip_address, submitted_at);
CREATE INDEX idx_demo_rate_limits_email ON public.demo_rate_limits(email, submitted_at);

-- Auto-cleanup old records (older than 24 hours) using a scheduled function
CREATE OR REPLACE FUNCTION public.cleanup_old_rate_limits()
RETURNS void
LANGUAGE plpgsql
SECURITY DEFINER
SET search_path = public
AS $$
BEGIN
    DELETE FROM public.demo_rate_limits WHERE submitted_at < now() - INTERVAL '24 hours';
END;
$$;