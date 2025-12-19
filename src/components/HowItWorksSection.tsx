import { motion } from "framer-motion";

export const HowItWorksSection = () => {
  return (
    <section id="how-it-works" className="relative py-24 md:py-32 overflow-hidden grain-overlay">
      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-primary bg-primary/10 rounded-full border border-primary/20">
            How It Works
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            Federated Learning <span className="text-primary">Explained</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-3xl mx-auto">
            Train AI models collaboratively without ever moving sensitive data. 
            Your data stays secure while collective intelligence grows.
          </p>
        </motion.div>

        {/* Animated Diagram */}
        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          className="relative max-w-5xl mx-auto"
        >
          <div className="absolute inset-0 bg-gradient-to-r from-primary/5 via-accent/10 to-primary/5 rounded-3xl blur-3xl" />
          
          <div className="relative glass-card p-8 md:p-12 rounded-3xl">
            {/* SVG Diagram */}
            <svg
              viewBox="0 0 800 400"
              className="w-full h-auto"
              xmlns="http://www.w3.org/2000/svg"
            >
              {/* Background Grid */}
              <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                  <path d="M 40 0 L 0 0 0 40" fill="none" stroke="hsl(210, 30%, 20%)" strokeWidth="0.5" opacity="0.3" />
                </pattern>
                <linearGradient id="primaryGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stopColor="hsl(206, 88%, 40%)" />
                  <stop offset="100%" stopColor="hsl(185, 75%, 50%)" />
                </linearGradient>
                <filter id="glow">
                  <feGaussianBlur stdDeviation="3" result="coloredBlur" />
                  <feMerge>
                    <feMergeNode in="coloredBlur" />
                    <feMergeNode in="SourceGraphic" />
                  </feMerge>
                </filter>
              </defs>
              
              <rect width="800" height="400" fill="url(#grid)" />

              {/* Institution Nodes */}
              {/* Bank 1 */}
              <g className="node-pulse" style={{ animationDelay: '0s' }}>
                <circle cx="120" cy="100" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" strokeWidth="2" />
                <text x="120" y="95" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="11" fontWeight="600">Bank A</text>
                <text x="120" y="112" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Local Training</text>
              </g>

              {/* Bank 2 */}
              <g className="node-pulse" style={{ animationDelay: '0.3s' }}>
                <circle cx="120" cy="300" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" strokeWidth="2" />
                <text x="120" y="295" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="11" fontWeight="600">Bank B</text>
                <text x="120" y="312" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Local Training</text>
              </g>

              {/* Insurance */}
              <g className="node-pulse" style={{ animationDelay: '0.6s' }}>
                <circle cx="120" cy="200" r="45" fill="hsl(210, 40%, 15%)" stroke="url(#primaryGradient)" strokeWidth="2" />
                <text x="120" y="195" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="11" fontWeight="600">Insurer</text>
                <text x="120" y="212" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Local Training</text>
              </g>

              {/* Flow Lines to Aggregator */}
              <path d="M165 100 Q 280 100 400 200" fill="none" stroke="url(#primaryGradient)" strokeWidth="2" className="flow-line" filter="url(#glow)" />
              <path d="M165 200 L 350 200" fill="none" stroke="url(#primaryGradient)" strokeWidth="2" className="flow-line" filter="url(#glow)" />
              <path d="M165 300 Q 280 300 400 200" fill="none" stroke="url(#primaryGradient)" strokeWidth="2" className="flow-line" filter="url(#glow)" />

              {/* Secure Aggregator (Vault) */}
              <g filter="url(#glow)">
                <rect x="350" y="140" width="100" height="120" rx="12" fill="hsl(210, 40%, 12%)" stroke="url(#primaryGradient)" strokeWidth="3" />
                <text x="400" y="185" textAnchor="middle" fill="hsl(206, 88%, 50%)" fontSize="24">🔐</text>
                <text x="400" y="210" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="10" fontWeight="600">Secure</text>
                <text x="400" y="225" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="10" fontWeight="600">Aggregation</text>
                <text x="400" y="245" textAnchor="middle" fill="hsl(185, 75%, 50%)" fontSize="8">No raw data</text>
              </g>

              {/* Flow Lines to Global Model */}
              <path d="M450 200 L 580 200" fill="none" stroke="url(#primaryGradient)" strokeWidth="2" className="flow-line" filter="url(#glow)" />

              {/* Global Model */}
              <g className="node-pulse" style={{ animationDelay: '0.9s' }}>
                <circle cx="680" cy="200" r="60" fill="hsl(210, 40%, 12%)" stroke="url(#primaryGradient)" strokeWidth="3" filter="url(#glow)" />
                <text x="680" y="185" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="12" fontWeight="700">Global</text>
                <text x="680" y="205" textAnchor="middle" fill="hsl(210, 20%, 90%)" fontSize="12" fontWeight="700">Model</text>
                <text x="680" y="225" textAnchor="middle" fill="hsl(185, 75%, 50%)" fontSize="9">Shared Intelligence</text>
              </g>

              {/* Return arrows (improved model back to institutions) */}
              <path d="M620 170 Q 400 50 170 95" fill="none" stroke="hsl(185, 75%, 50%)" strokeWidth="1.5" strokeDasharray="6 3" opacity="0.6" />
              <path d="M620 200 L 170 200" fill="none" stroke="hsl(185, 75%, 50%)" strokeWidth="1.5" strokeDasharray="6 3" opacity="0.6" />
              <path d="M620 230 Q 400 350 170 305" fill="none" stroke="hsl(185, 75%, 50%)" strokeWidth="1.5" strokeDasharray="6 3" opacity="0.6" />

              {/* Labels */}
              <text x="255" y="145" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Encrypted</text>
              <text x="255" y="158" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Gradients</text>

              <text x="520" y="185" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Improved</text>
              <text x="520" y="198" textAnchor="middle" fill="hsl(210, 15%, 60%)" fontSize="9">Model</text>

              <text x="400" y="380" textAnchor="middle" fill="hsl(185, 75%, 50%)" fontSize="11" fontWeight="600">
                ← Model updates flow back to each institution →
              </text>
            </svg>

            {/* Key Message */}
            <div className="mt-8 text-center">
              <div className="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-primary/10 border border-primary/20">
                <div className="w-3 h-3 rounded-full bg-accent animate-pulse" />
                <span className="text-foreground font-semibold">
                  Data never leaves your environment
                </span>
              </div>
            </div>
          </div>
        </motion.div>

        {/* Steps */}
        <div className="grid md:grid-cols-3 gap-8 mt-16 max-w-4xl mx-auto">
          {[
            { step: "01", title: "Local Training", desc: "Each institution trains models on their own data within their secure environment." },
            { step: "02", title: "Secure Aggregation", desc: "Only encrypted model updates—never raw data—are shared with the central aggregator." },
            { step: "03", title: "Collective Intelligence", desc: "The improved global model is distributed back, benefiting all participants." },
          ].map((item, index) => (
            <motion.div
              key={item.step}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="text-center"
            >
              <div className="text-5xl font-bold text-primary/20 mb-3">{item.step}</div>
              <h3 className="text-lg font-semibold text-foreground mb-2">{item.title}</h3>
              <p className="text-sm text-muted-foreground">{item.desc}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};
