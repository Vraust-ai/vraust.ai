import { motion } from "framer-motion";
import { Building, Landmark, Shield, Heart } from "lucide-react";

const clients = [
  {
    icon: Landmark,
    name: "Banks",
    description: "Major financial institutions protecting customer assets",
  },
  {
    icon: Building,
    name: "FinTechs",
    description: "Innovative payment and lending platforms",
  },
  {
    icon: Shield,
    name: "Insurers",
    description: "Insurance companies preventing fraud and assessing risk",
  },
  {
    icon: Heart,
    name: "Healthcare",
    description: "Public health institutions protecting patient data",
  },
];

export const TargetClientsSection = () => {
  return (
    <section className="relative py-24 md:py-32 overflow-hidden grain-overlay">
      <div className="absolute inset-0 bg-gradient-to-b from-background via-muted/10 to-background" />

      <div className="container relative z-10 mx-auto px-4">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="inline-block px-4 py-1.5 mb-6 text-sm font-medium text-accent bg-accent/10 rounded-full border border-accent/20">
            Who We Serve
          </span>
          <h2 className="text-4xl md:text-5xl lg:text-6xl font-bold text-foreground mb-6">
            Trusted by <span className="text-accent">Regulated Industries</span>
          </h2>
          <p className="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto">
            Enterprise-grade privacy infrastructure for organizations that can't compromise on data protection.
          </p>
        </motion.div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
          {clients.map((client, index) => (
            <motion.div
              key={client.name}
              initial={{ opacity: 0, scale: 0.9 }}
              whileInView={{ opacity: 1, scale: 1 }}
              viewport={{ once: true }}
              transition={{ duration: 0.4, delay: index * 0.1 }}
              className="group"
            >
              <div className="relative p-6 md:p-8 rounded-2xl border border-border/50 bg-card/20 hover:border-accent/30 hover:bg-card/40 transition-all duration-300 text-center h-full">
                {/* Icon */}
                <div className="w-16 h-16 mx-auto mb-4 rounded-xl bg-accent/10 border border-accent/20 flex items-center justify-center group-hover:bg-accent/20 transition-all duration-300">
                  <client.icon className="w-8 h-8 text-accent" />
                </div>

                <h3 className="text-lg font-semibold text-foreground mb-2">
                  {client.name}
                </h3>
                <p className="text-xs text-muted-foreground">
                  {client.description}
                </p>
              </div>
            </motion.div>
          ))}
        </div>

        {/* Client Logos Placeholder */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6, delay: 0.3 }}
          className="mt-16 text-center"
        >
          <p className="text-sm text-muted-foreground mb-6">
            Serving Canada's leading financial and healthcare organizations
          </p>
          <div className="flex flex-wrap justify-center items-center gap-8 md:gap-12 opacity-40">
            {/* Placeholder logos - stylized text */}
            {["Enterprise A", "Financial Corp", "Health Institute", "Bank Group", "Insure Co"].map((name, i) => (
              <div
                key={i}
                className="text-lg font-semibold text-muted-foreground tracking-wider"
              >
                {name}
              </div>
            ))}
          </div>
        </motion.div>
      </div>
    </section>
  );
};
