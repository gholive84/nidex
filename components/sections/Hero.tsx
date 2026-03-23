"use client";

import { motion } from "framer-motion";
import { ArrowRight, Play } from "lucide-react";
import { siteContent } from "@/lib/content";

export default function Hero() {
  const { hero } = siteContent;

  return (
    <section className="relative min-h-screen flex items-center overflow-hidden bg-[#0F172A]">
      {/* Background gradient */}
      <div className="absolute inset-0 gradient-dark opacity-90" />

      {/* Grid pattern overlay */}
      <div
        className="absolute inset-0 opacity-[0.03]"
        style={{
          backgroundImage: `linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px)`,
          backgroundSize: "60px 60px",
        }}
      />

      {/* Glow effects */}
      <div className="absolute top-1/4 left-1/4 w-96 h-96 bg-[#2563EB]/20 rounded-full blur-3xl" />
      <div className="absolute bottom-1/4 right-1/4 w-80 h-80 bg-[#38BDF8]/10 rounded-full blur-3xl" />

      <div className="relative max-w-[1200px] mx-auto px-4 sm:px-6 pt-28 pb-20">
        <div className="flex flex-col items-center text-center">
          {/* Badge */}
          <motion.div
            initial={{ opacity: 0, y: 16 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5 }}
            className="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2 mb-8"
          >
            <span className="w-2 h-2 rounded-full bg-[#38BDF8] animate-pulse" />
            <span className="text-white/80 text-sm font-medium">{hero.badge}</span>
          </motion.div>

          {/* Headline */}
          <motion.h1
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.1 }}
            className="text-5xl sm:text-6xl md:text-7xl font-extrabold text-white leading-[1.08] mb-6 max-w-4xl"
          >
            {hero.headline.map((line, i) =>
              line === hero.highlightWord ? (
                <span key={i} className="text-[#38BDF8]">
                  {line}
                  <br className="hidden" />
                </span>
              ) : (
                <span key={i}>
                  {line}
                  {i < hero.headline.length - 1 && <br />}
                </span>
              )
            )}
          </motion.h1>

          {/* Subtext */}
          <motion.p
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.2 }}
            className="text-white/60 text-lg md:text-xl leading-relaxed max-w-2xl mb-10"
          >
            {hero.subtext}
          </motion.p>

          {/* CTAs */}
          <motion.div
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.3 }}
            className="flex flex-col sm:flex-row items-center gap-4 mb-16"
          >
            <a
              href="#"
              className="flex items-center gap-2 bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-semibold px-7 py-4 rounded-lg transition-all duration-200 text-base group"
            >
              {hero.cta.primary}
              <ArrowRight size={18} className="group-hover:translate-x-1 transition-transform" />
            </a>
            <a
              href="#"
              className="flex items-center gap-2 border border-white/25 hover:border-white/50 text-white font-semibold px-7 py-4 rounded-lg transition-all duration-200 text-base"
            >
              <Play size={16} fill="currentColor" />
              {hero.cta.secondary}
            </a>
          </motion.div>

          {/* Stats */}
          <motion.div
            initial={{ opacity: 0, y: 24 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5, delay: 0.4 }}
            className="flex flex-wrap justify-center gap-8 md:gap-16 mb-16"
          >
            {hero.stats.map((stat, i) => (
              <div key={i} className="text-center">
                <div className="text-3xl md:text-4xl font-bold text-white mb-1">{stat.value}</div>
                <div className="text-white/50 text-sm">{stat.label}</div>
              </div>
            ))}
          </motion.div>

          {/* Dashboard mockup */}
          <motion.div
            initial={{ opacity: 0, y: 40 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.5 }}
            className="w-full max-w-5xl"
          >
            <div className="relative rounded-xl overflow-hidden border border-white/10 shadow-[0_24px_64px_rgba(0,0,0,0.5)]">
              {/* Mock dashboard UI */}
              <div className="bg-[#1E293B] p-0">
                {/* Window bar */}
                <div className="flex items-center gap-2 px-4 py-3 bg-[#0F172A]/80 border-b border-white/5">
                  <div className="w-3 h-3 rounded-full bg-red-500/70" />
                  <div className="w-3 h-3 rounded-full bg-yellow-500/70" />
                  <div className="w-3 h-3 rounded-full bg-green-500/70" />
                  <div className="flex-1 mx-4">
                    <div className="bg-white/5 rounded px-3 py-1 text-white/30 text-xs text-center">
                      app.nidex.com.br/dashboard
                    </div>
                  </div>
                </div>

                {/* Dashboard content */}
                <div className="flex h-[420px] md:h-[500px]">
                  {/* Sidebar */}
                  <div className="hidden md:flex flex-col w-52 bg-[#0F172A] border-r border-white/5 p-4 gap-1">
                    <div className="text-white font-bold text-lg mb-4 px-2">nidex</div>
                    {["Dashboard", "CRM", "Financeiro", "Cobranças", "Projetos", "IA"].map(
                      (item, i) => (
                        <div
                          key={item}
                          className={`flex items-center gap-3 px-3 py-2 rounded-lg text-sm ${
                            i === 0
                              ? "bg-[#2563EB] text-white"
                              : "text-white/40 hover:text-white/70"
                          }`}
                        >
                          <div className="w-4 h-4 rounded bg-current opacity-60" />
                          {item}
                        </div>
                      )
                    )}
                  </div>

                  {/* Main area */}
                  <div className="flex-1 p-6 overflow-hidden">
                    <div className="flex items-center justify-between mb-6">
                      <div>
                        <div className="text-white font-semibold text-lg">Visão geral</div>
                        <div className="text-white/40 text-sm">Março 2026</div>
                      </div>
                      <div className="bg-[#2563EB] text-white text-xs font-semibold px-3 py-1.5 rounded-lg">
                        + Nova venda
                      </div>
                    </div>

                    {/* KPI cards */}
                    <div className="grid grid-cols-2 md:grid-cols-3 gap-3 mb-6">
                      {[
                        { label: "Receita mensal", value: "R$ 48.320", change: "+23%" },
                        { label: "Novos clientes", value: "34", change: "+8%" },
                        { label: "Taxa de conversão", value: "68%", change: "+12%" },
                      ].map((kpi) => (
                        <div
                          key={kpi.label}
                          className="bg-white/5 border border-white/10 rounded-xl p-4"
                        >
                          <div className="text-white/40 text-xs mb-2">{kpi.label}</div>
                          <div className="text-white font-bold text-xl">{kpi.value}</div>
                          <div className="text-green-400 text-xs mt-1">{kpi.change} este mês</div>
                        </div>
                      ))}
                    </div>

                    {/* Chart placeholder */}
                    <div className="bg-white/5 border border-white/10 rounded-xl p-4 h-40 flex flex-col justify-between">
                      <div className="text-white/40 text-xs">Receita — últimos 7 meses</div>
                      <div className="flex items-end gap-2 h-24">
                        {[40, 65, 50, 80, 70, 90, 85].map((h, i) => (
                          <div key={i} className="flex-1 flex items-end">
                            <div
                              className={`w-full rounded-t-sm ${
                                i === 5 ? "bg-[#2563EB]" : "bg-white/15"
                              }`}
                              style={{ height: `${h}%` }}
                            />
                          </div>
                        ))}
                      </div>
                      <div className="flex justify-between">
                        {["Set", "Out", "Nov", "Dez", "Jan", "Fev", "Mar"].map((m) => (
                          <div key={m} className="text-white/25 text-xs">
                            {m}
                          </div>
                        ))}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}
