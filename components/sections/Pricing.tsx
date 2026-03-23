"use client";

import { motion } from "framer-motion";
import { Check } from "lucide-react";
import { siteContent } from "@/lib/content";

export default function Pricing() {
  const { pricing } = siteContent;

  return (
    <section id="precos" className="py-24 bg-white">
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
            {pricing.sectionLabel}
          </span>
          <h2 className="text-4xl md:text-5xl font-bold text-[#0F172A] leading-tight mb-4">
            {pricing.headline[0]}
            <br />
            <span className="text-[#2563EB]">{pricing.headline[1]}</span>
          </h2>
          <p className="text-[#64748B] text-lg">{pricing.subtext}</p>
        </motion.div>

        {/* Plans */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
          {pricing.plans.map((plan, i) => (
            <motion.div
              key={plan.name}
              initial={{ opacity: 0, y: 24 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: i * 0.1 }}
              className={`relative rounded-2xl p-8 ${
                plan.highlighted
                  ? "bg-gradient-to-br from-[#2563EB] to-[#1D4ED8] text-white shadow-2xl shadow-blue-500/30 scale-105"
                  : "bg-white border border-[#E2E8F0]"
              }`}
            >
              {plan.badge && (
                <div className="absolute -top-4 left-1/2 -translate-x-1/2">
                  <span className="bg-[#38BDF8] text-[#0F172A] text-xs font-bold px-4 py-1.5 rounded-full">
                    {plan.badge}
                  </span>
                </div>
              )}

              <div className="mb-6">
                <div
                  className={`font-bold text-lg mb-1 ${plan.highlighted ? "text-white" : "text-[#0F172A]"}`}
                >
                  {plan.name}
                </div>
                <div
                  className={`text-sm leading-relaxed ${plan.highlighted ? "text-white/70" : "text-[#64748B]"}`}
                >
                  {plan.description}
                </div>
              </div>

              <div className="mb-8">
                <span
                  className={`text-4xl font-extrabold ${plan.highlighted ? "text-white" : "text-[#0F172A]"}`}
                >
                  R$ {plan.price}
                </span>
                <span
                  className={`text-sm ml-1 ${plan.highlighted ? "text-white/60" : "text-[#64748B]"}`}
                >
                  {plan.period}
                </span>
              </div>

              <ul className="flex flex-col gap-3 mb-8">
                {plan.features.map((feature) => (
                  <li key={feature} className="flex items-center gap-3">
                    <div
                      className={`w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0 ${
                        plan.highlighted ? "bg-white/20" : "bg-[#EFF6FF]"
                      }`}
                    >
                      <Check
                        size={12}
                        className={plan.highlighted ? "text-white" : "text-[#2563EB]"}
                      />
                    </div>
                    <span
                      className={`text-sm ${plan.highlighted ? "text-white/80" : "text-[#64748B]"}`}
                    >
                      {feature}
                    </span>
                  </li>
                ))}
              </ul>

              <a
                href="#"
                className={`block text-center font-semibold py-3.5 px-6 rounded-xl transition-all duration-200 ${
                  plan.highlighted
                    ? "bg-white text-[#2563EB] hover:bg-white/90"
                    : "bg-[#2563EB] text-white hover:bg-[#1D4ED8]"
                }`}
              >
                {plan.cta}
              </a>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
