"use client";

import { motion } from "framer-motion";
import { Star } from "lucide-react";
import { siteContent } from "@/lib/content";

export default function Testimonials() {
  const { testimonials } = siteContent;

  return (
    <section id="depoimentos" className="py-24 bg-[#F8FAFC]">
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
            {testimonials.sectionLabel}
          </span>
          <h2 className="text-4xl md:text-5xl font-bold text-[#0F172A] leading-tight">
            {testimonials.headline[0]}
            <br />
            <span className="text-[#2563EB]">{testimonials.headline[1]}</span>
          </h2>
        </motion.div>

        {/* Cards */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {testimonials.items.map((item, i) => (
            <motion.div
              key={item.name}
              initial={{ opacity: 0, y: 24 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: i * 0.1 }}
              className="bg-white border border-[#E2E8F0] rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow"
            >
              {/* Stars */}
              <div className="flex gap-1 mb-5">
                {Array.from({ length: 5 }).map((_, j) => (
                  <Star key={j} size={16} fill="#F59E0B" className="text-[#F59E0B]" />
                ))}
              </div>

              {/* Text */}
              <p className="text-[#0F172A] text-base leading-relaxed mb-6 italic">
                &ldquo;{item.text}&rdquo;
              </p>

              {/* Author */}
              <div className="flex items-center gap-3">
                <div className="w-10 h-10 rounded-full bg-gradient-to-br from-[#2563EB] to-[#38BDF8] flex items-center justify-center">
                  <span className="text-white font-bold text-xs">{item.avatar}</span>
                </div>
                <div>
                  <div className="text-[#0F172A] font-semibold text-sm">{item.name}</div>
                  <div className="text-[#64748B] text-xs">{item.role}</div>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
