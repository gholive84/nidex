import type { Config } from "tailwindcss";

const config: Config = {
  content: [
    "./pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./components/**/*.{js,ts,jsx,tsx,mdx}",
    "./app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#2563EB",
        "primary-dark": "#1D4ED8",
        accent: "#38BDF8",
        "bg-dark": "#0F172A",
        "bg-light": "#F8FAFC",
        "bg-white": "#FFFFFF",
        "text-primary": "#0F172A",
        "text-muted": "#64748B",
        border: "#E2E8F0",
      },
      fontFamily: {
        inter: ["var(--font-inter)", "sans-serif"],
      },
    },
  },
  plugins: [],
};

export default config;
