import { motion } from "framer-motion";
import { Shield, Lock, Eye, FileCheck } from "lucide-react";

const pillars = [
  {
    icon: Shield,
    title: "Privacy by Design",
    description: "Data never leaves your infrastructure. Models train locally, only encrypted gradients are shared.",
  },
  {
    icon: Lock,
    title: "Enterprise Security",
    description: "End-to-end encryption, secure aggregation protocols, and zero-trust architecture.",
  },
  {
    icon: Eye,
    title: "Full Explainability",
    description: "Transparent AI decisions with audit trails and interpretable model outputs.",
  },
  {
    icon: FileCheck,
    title: "AMF Compliance",
    description: "Built to meet Canadian regulatory requirements for financial AI applications.",
  },
];

export const SolutionSection = () => {
  return (
    <section className="relative py-24 md:py-32 overflow-hidden grain-overlay">
      {/* Background Glow */}
      <div className="absolute inset-0 bg-gradient-to-b from-background via-muted/20 to-background" />
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-primary/5 rounded-full blur-3xl" />

      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-primary bg-primary/10 rounded-full border border-primary/20">
            The Solution
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            The Vault of <span className="text-primary">Trust</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-3xl mx-auto leading-relaxed">
            Vraust.ai provides a secure federated learning infrastructure designed specifically 
            for regulated environments. Unlock collective intelligence without compromising privacy.
          </p>
        </motion.div>

        {/* Pillars Grid */}
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {pillars.map((pillar, index) => (
            <motion.div
              key={pillar.title}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group relative"
            >
              <div className="glass-card-glow p-8 h-full hover:border-primary/40 transition-all duration-300 hover:-translate-y-1">
                {/* Icon */}
                <div className="w-14 h-14 mb-6 rounded-xl bg-gradient-to-br from-primary/20 to-accent/10 flex items-center justify-center group-hover:from-primary/30 group-hover:to-accent/20 transition-all duration-300">
                  <pillar.icon className="w-7 h-7 text-primary" />
                </div>

                <h3 className="text-xl font-semibold text-foreground mb-3">
                  {pillar.title}
                </h3>
                <p className="text-muted-foreground text-sm leading-relaxed">
                  {pillar.description}
                </p>
              </div>
            </motion.div>
          ))}
        </div>

        {/* Vault Visual */}
        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.3 }}
          className="mt-20 relative"
        >
          <div className="absolute inset-0 bg-gradient-to-r from-primary/10 via-accent/5 to-primary/10 rounded-3xl blur-2xl" />
          <div className="relative glass-card p-8 md:p-12 rounded-3xl border-primary/20">
            <div className="flex flex-col lg:flex-row items-center gap-8 lg:gap-16">
              {/* Vault Icon */}
              <div className="flex-shrink-0">
                <div className="w-32 h-32 md:w-40 md:h-40 rounded-2xl bg-gradient-to-br from-primary/30 to-accent/20 flex items-center justify-center relative">
                  <div className="absolute inset-2 rounded-xl border-2 border-dashed border-primary/30 animate-spin-slow" />
                  <Lock className="w-16 h-16 md:w-20 md:h-20 text-primary" />
                </div>
              </div>

              {/* Content */}
              <div className="flex-1 text-center lg:text-left">
                <h3 className="text-2xl md:text-3xl font-bold text-foreground mb-4">
                  Your Data. Your Control. Shared Intelligence.
                </h3>
                <p className="text-muted-foreground leading-relaxed mb-6">
                  With Vraust.ai, participating institutions maintain complete sovereignty over their data 
                  while contributing to a collectively smarter AI. The vault metaphor isn't just branding—it's 
                  our architecture: impenetrable protection with selective, secure collaboration.
                </p>
                <div className="flex flex-wrap justify-center lg:justify-start gap-4">
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <div className="w-2 h-2 rounded-full bg-accent animate-pulse" />
                    <span>Zero data movement</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <div className="w-2 h-2 rounded-full bg-primary animate-pulse" />
                    <span>Encrypted aggregation</span>
                  </div>
                  <div className="flex items-center gap-2 text-sm text-muted-foreground">
                    <div className="w-2 h-2 rounded-full bg-accent animate-pulse" />
                    <span>Regulatory ready</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </motion.div>
      </div>
    </section>
  );
};
