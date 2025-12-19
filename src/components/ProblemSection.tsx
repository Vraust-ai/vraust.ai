import { motion } from "framer-motion";
import { Database, Building2, AlertTriangle } from "lucide-react";

const problems = [
  {
    icon: Database,
    title: "Data Silos",
    description: "Critical fraud patterns remain invisible when institutions can't share insights across organizational boundaries.",
  },
  {
    icon: AlertTriangle,
    title: "Regulatory Constraints",
    description: "Privacy regulations and competitive concerns prevent the data sharing needed for effective AI models.",
  },
  {
    icon: Building2,
    title: "Inability to Collaborate",
    description: "Without a secure framework, financial institutions fight fraud alone—missing the collective intelligence advantage.",
  },
];

export const ProblemSection = () => {
  return (
    <section id="problem" className="relative py-24 md:py-32 overflow-hidden">
      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-accent bg-accent/10 rounded-full border border-accent/20">
            The Challenge
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            Fraud Thrives in <span className="text-accent">Isolation</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto">
            Financial criminals exploit institutional silos. Current approaches leave billions in losses undetected.
          </p>
        </motion.div>

        <div className="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
          {problems.map((problem, index) => (
            <motion.div
              key={problem.title}
              initial={{ opacity: 0, y: 40 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.15 }}
              className="relative group"
            >
              {/* Connecting Lines (visible on desktop) */}
              {index < problems.length - 1 && (
                <div className="hidden md:block absolute top-1/2 -right-4 w-8 h-px bg-gradient-to-r from-border to-transparent" />
              )}

              <div className="relative p-8 rounded-2xl border border-border/50 bg-gradient-to-b from-muted/30 to-transparent hover:border-accent/30 transition-all duration-300 h-full">
                {/* Glow on hover */}
                <div className="absolute inset-0 rounded-2xl bg-accent/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300" />

                <div className="relative z-10">
                  {/* Icon */}
                  <div className="w-14 h-14 mb-6 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center">
                    <problem.icon className="w-7 h-7 text-accent" />
                  </div>

                  <h3 className="text-xl font-semibold text-foreground mb-3">
                    {problem.title}
                  </h3>
                  <p className="text-muted-foreground text-sm leading-relaxed">
                    {problem.description}
                  </p>
                </div>
              </div>
            </motion.div>
          ))}
        </div>

        {/* Visual Separator */}
        <motion.div
          initial={{ opacity: 0, scaleX: 0 }}
          whileInView={{ opacity: 1, scaleX: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.3 }}
          className="mt-20 h-px bg-gradient-to-r from-transparent via-border to-transparent max-w-2xl mx-auto"
        />
      </div>
    </section>
  );
};
