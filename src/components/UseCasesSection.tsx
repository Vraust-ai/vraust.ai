import { motion } from "framer-motion";
import { ShieldAlert, UserCheck, TrendingUp, Fingerprint } from "lucide-react";

const useCases = [
  {
    icon: ShieldAlert,
    title: "Fraud Detection",
    description: "Identify fraudulent patterns across institutions without exposing transaction data. Detect sophisticated schemes invisible to individual organizations.",
  },
  {
    icon: Fingerprint,
    title: "AML & Financial Crime",
    description: "Strengthen anti-money laundering models with cross-institutional signals while maintaining strict data sovereignty.",
  },
  {
    icon: UserCheck,
    title: "Identity Verification",
    description: "Enhance KYC processes with collective intelligence on identity fraud patterns and synthetic identities.",
  },
  {
    icon: TrendingUp,
    title: "Risk Management",
    description: "Build more accurate credit and operational risk models using aggregated insights from multiple data sources.",
  },
];

export const UseCasesSection = () => {
  return (
    <section id="use-cases" className="relative py-24 md:py-32 overflow-hidden">
      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-primary bg-primary/10 rounded-full border border-primary/20">
            Use Cases
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            Built for <span className="text-primary">Critical Applications</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto">
            Privacy-preserving AI infrastructure for the most sensitive financial operations.
          </p>
        </motion.div>

        <div className="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto">
          {useCases.map((useCase, index) => (
            <motion.div
              key={useCase.title}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="group"
            >
              <div className="relative glass-card p-8 h-full hover:border-primary/40 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                {/* Hover Glow */}
                <div className="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300" />

                <div className="relative z-10 flex gap-6">
                  {/* Icon */}
                  <div className="flex-shrink-0">
                    <div className="w-14 h-14 rounded-xl bg-gradient-to-br from-primary/20 to-accent/10 flex items-center justify-center group-hover:from-primary/30 group-hover:to-accent/20 transition-all duration-300">
                      <useCase.icon className="w-7 h-7 text-primary" />
                    </div>
                  </div>

                  {/* Content */}
                  <div>
                    <h3 className="text-xl font-semibold text-foreground mb-3">
                      {useCase.title}
                    </h3>
                    <p className="text-muted-foreground text-sm leading-relaxed">
                      {useCase.description}
                    </p>
                  </div>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};
