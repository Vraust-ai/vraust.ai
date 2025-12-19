import { motion } from "framer-motion";
import { GraduationCap, Microscope, Building2, Award } from "lucide-react";

const credentials = [
  {
    icon: GraduationCap,
    value: "10+",
    label: "Years of Research",
    description: "In privacy-preserving machine learning",
  },
  {
    icon: Microscope,
    value: "15+",
    label: "Research Partners",
    description: "Including top Canadian universities",
  },
  {
    icon: Building2,
    value: "Healthcare",
    label: "Clinical Collaborations",
    description: "With leading medical institutions",
  },
  {
    icon: Award,
    value: "AMF",
    label: "Regulatory Expertise",
    description: "Built for Canadian compliance",
  },
];

export const TrustSection = () => {
  return (
    <section className="relative py-24 md:py-32 overflow-hidden">
      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-primary bg-primary/10 rounded-full border border-primary/20">
            Research Foundation
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            Built on <span className="text-primary">Rigorous Science</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-3xl mx-auto">
            Vraust.ai is founded on years of academic research in privacy-preserving AI, 
            with deep expertise in both financial and healthcare domains.
          </p>
        </motion.div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
          {credentials.map((cred, index) => (
            <motion.div
              key={cred.label}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="text-center group"
            >
              <div className="relative glass-card p-6 md:p-8 h-full hover:border-primary/40 transition-all duration-300">
                {/* Icon */}
                <div className="w-12 h-12 mx-auto mb-4 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-all duration-300">
                  <cred.icon className="w-6 h-6 text-primary" />
                </div>

                {/* Value */}
                <div className="text-3xl md:text-4xl font-bold text-primary mb-2">
                  {cred.value}
                </div>

                {/* Label */}
                <div className="text-sm font-semibold text-foreground mb-1">
                  {cred.label}
                </div>

                {/* Description */}
                <div className="text-xs text-muted-foreground">
                  {cred.description}
                </div>
              </div>
            </motion.div>
          ))}
        </div>

        {/* Research Statement */}
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6, delay: 0.3 }}
          className="mt-16 max-w-3xl mx-auto"
        >
          <div className="glass-card p-8 md:p-10 rounded-2xl text-center">
            <blockquote className="text-lg md:text-xl text-foreground italic leading-relaxed">
              "Our mission is to unlock collective intelligence across data-sensitive ecosystems 
              while maintaining strict confidentiality, regulatory compliance, and operational control."
            </blockquote>
            <div className="mt-6 flex items-center justify-center gap-3">
              <div className="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                <span className="text-primary font-bold">V</span>
              </div>
              <div className="text-left">
                <div className="text-sm font-semibold text-foreground">Vraust.ai</div>
                <div className="text-xs text-muted-foreground">Research Team</div>
              </div>
            </div>
          </div>
        </motion.div>
      </div>
    </section>
  );
};
