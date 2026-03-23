"use client";

import { motion } from "framer-motion";
import { siteContent } from "@/lib/content";

export default function HowItWorks() {
  const { howItWorks } = siteContent;

  return (
    <section id="como-funciona" className="py-24 bg-white">
      <div className="max-w-[1200px] mx-auto px-4 sm:px-6">
        {/* Header */}
        <motion.div
          initial={{ opacity: 0, y: 24 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.5 }}
          className="text-center mb-20"
        >
          <span className="text-[#2563EB] text-xs font-semibold tracking-widest uppercase mb-4 block">
            {howItWorks.sectionLabel}
          </span>
          <h2 className="text-4xl md:text-5xl font-bold text-[#0F172A] leading-tight">
            {howItWorks.headline[0]}
            <br />
            <span className="text-[#38BDF8]">{howItWorks.headline[1]}</span>
          </h2>
        </motion.div>

        {/* Steps */}
        <div className="relative">
          {/* Connector line */}
          <div className="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-[#2563EB] via-[#38BDF8] to-[#2563EB] opacity-20" />

          <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
            {howItWorks.steps.map((step, i) => (
              <motion.div
                key={step.number}
                initial={{ opacity: 0, y: 24 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true }}
                transition={{ duration: 0.5, delay: i * 0.15 }}
                className="flex flex-col items-center text-center"
              >
                <div className="relative mb-6">
                  <div className="w-24 h-24 rounded-2xl bg-gradient-to-br from-[#2563EB] to-[#1D4ED8] flex items-center justify-center shadow-lg shadow-blue-500/25">
                    <span className="text-white font-extrabold text-2xl">{step.number}</span>
                  </div>
                </div>
                <h3 className="text-[#0F172A] font-bold text-xl mb-3">{step.title}</h3>
                <p className="text-[#64748B] text-base leading-relaxed">{step.description}</p>
              </motion.div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
}
