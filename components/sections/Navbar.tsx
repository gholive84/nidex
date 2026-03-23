"use client";

import { useState, useEffect } from "react";
import { Menu, X } from "lucide-react";
import { siteContent } from "@/lib/content";

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [mobileOpen, setMobileOpen] = useState(false);
  const { brand, nav } = siteContent;

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 ${
        scrolled
          ? "bg-white/95 backdrop-blur-sm shadow-sm border-b border-[#E2E8F0]"
          : "bg-transparent"
      }`}
    >
      <div className="max-w-[1200px] mx-auto px-4 sm:px-6">
        <div className="flex items-center justify-between h-16 md:h-20">
          {/* Logo */}
          <a href="#" className="flex items-center">
            <span
              className={`text-2xl font-bold tracking-tight transition-colors ${
                scrolled ? "text-[#2563EB]" : "text-white"
              }`}
            >
              {brand.name}
            </span>
          </a>

          {/* Desktop Nav */}
          <nav className="hidden md:flex items-center gap-8">
            {nav.links.map((link) => (
              <a
                key={link.href}
                href={link.href}
                className={`text-sm font-medium transition-colors hover:text-[#2563EB] ${
                  scrolled ? "text-[#64748B]" : "text-white/80"
                }`}
              >
                {link.label}
              </a>
            ))}
          </nav>

          {/* CTA */}
          <div className="hidden md:flex items-center gap-3">
            <a
              href="#"
              className={`text-sm font-medium transition-colors ${
                scrolled ? "text-[#64748B] hover:text-[#2563EB]" : "text-white/80 hover:text-white"
              }`}
            >
              Entrar
            </a>
            <a
              href="#"
              className="bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition-all duration-200"
            >
              {nav.cta}
            </a>
          </div>

          {/* Mobile toggle */}
          <button
            className={`md:hidden p-2 rounded-lg transition-colors ${
              scrolled ? "text-[#0F172A]" : "text-white"
            }`}
            onClick={() => setMobileOpen(!mobileOpen)}
            aria-label="Menu"
          >
            {mobileOpen ? <X size={24} /> : <Menu size={24} />}
          </button>
        </div>
      </div>

      {/* Mobile menu */}
      {mobileOpen && (
        <div className="md:hidden bg-white border-t border-[#E2E8F0] px-4 py-6 flex flex-col gap-4">
          {nav.links.map((link) => (
            <a
              key={link.href}
              href={link.href}
              className="text-[#64748B] font-medium hover:text-[#2563EB] transition-colors"
              onClick={() => setMobileOpen(false)}
            >
              {link.label}
            </a>
          ))}
          <div className="pt-4 border-t border-[#E2E8F0] flex flex-col gap-3">
            <a href="#" className="text-center text-[#64748B] font-medium">
              Entrar
            </a>
            <a
              href="#"
              className="bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold px-5 py-3 rounded-lg transition-all text-center"
            >
              {nav.cta}
            </a>
          </div>
        </div>
      )}
    </header>
  );
}
