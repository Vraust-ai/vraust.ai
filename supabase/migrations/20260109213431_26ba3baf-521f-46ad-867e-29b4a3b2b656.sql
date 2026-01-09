-- Fix: Remove public SELECT access from demo_rate_limits
-- Only edge functions (with service role) should access this table
DROP POLICY IF EXISTS "Allow public read access to rate limits" ON public.demo_rate_limits;

-- Create restrictive SELECT policy - no public access
CREATE POLICY "Deny public select on rate limits"
ON public.demo_rate_limits
FOR SELECT
USING (false);

-- Fix: Add restrictive SELECT policy for demo_requests
-- Only authenticated admins should be able to view submissions
-- For now, deny all public SELECT access (edge functions use service role)
CREATE POLICY "Deny public select on demo requests"
ON public.demo_requests
FOR SELECT
USING (false);