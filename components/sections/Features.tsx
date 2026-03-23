"use client";

import { motion } from "framer-motion";
import { Users, DollarSign, Zap, CheckSquare, Bot, BarChart3 } from "lucide-react";
import { siteContent } from "@/lib/content";

const iconMap: Record<string, React.ComponentType<{ size?: number; className?: string }>> = {
  Users,
  DollarSign,
  Zap,
  CheckSquare,
  Bot,
  BarChart3,
};

const colorMap: Record<string, string> = {
  blue: "bg-blue-50 text-[#2563EB]",
  green: "bg-green-50 text-green-600",
  yellow: "bg-yellow-50 text-yellow-600",
  purple: "bg-purple-50 text-purple-600",
  cyan: "bg-cyan-50 text-[#38BDF8]",
  orange: "bg-orange-50 text-orange-600",
};

const containerVariants = {
  hidden: {},
  visible: {
    transition: { staggerChildren: 0.1 },
  },
};

const itemVariants = {
  hidden: { opacity: 0, y: 24 },
  visible: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } },
};

export default function Features() {
  const { features } = siteContent;

  return (
    <section id="funcionalidades" className="py-24 bg-[#F8FAFC]">
      <div className="max-w-[1200px] mx-auto px-4 sm:px-6">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
          className="text-center mb-16"
        >
          <span className="text-[#2563EB] text-xs font-semibold tracking-widest uppercase mb-4 block">
            {features.sectionLabel}
          </span>
          <h2 className="text-4xl md:text-5xl font-bold text-[#0F172A] leading-tight mb-4">
            {features.headline[0]}
            <br />
            <span className="text-[#2563EB]">{features.headline[1]}</span>
          </h2>
          <p className="text-[#64748B] text-lg max-w-2xl mx-auto leading-relaxed">
            {features.subtext}
          </p>
        </motion.div>

        {/* Grid */}
        <motion.div
          variants={containerVariants}
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, margin: "-100px" }}
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          {features.items.map((feature) => {
            const Icon = iconMap[feature.icon];
            const colorClass = colorMap[feature.color];

            return (
              <motion.div
                key={feature.title}
                variants={itemVariants}
                className="bg-white border border-[#E2E8F0] rounded-2xl p-8 hover:shadow-lg hover:border-[#2563EB]/20 transition-all duration-300 group"
              >
                <div
                  className={`w-12 h-12 rounded-xl flex items-center justify-center mb-5 ${colorClass}`}
                >
                  <Icon size={22} />
                </div>
                <h3 className="text-[#0F172A] font-bold text-xl mb-3 group-hover:text-[#2563EB] transition-colors">
                  {feature.title}
                </h3>
                <p className="text-[#64748B] text-base leading-relaxed">{feature.description}</p>
              </motion.div>
            );
          })}
        </motion.div>
      </div>
    </section>
  );
}
