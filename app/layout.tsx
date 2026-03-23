import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";

const inter = Inter({
  subsets: ["latin"],
  variable: "--font-inter",
  display: "swap",
});

export const metadata: Metadata = {
  title: "Nidex — O ecossistema inteligente para empreendedores",
  description:
    "CRM, financeiro, cobranças, tarefas, projetos e IA em um único lugar. Feito para empreendedores que querem crescer com mais controle e menos estresse.",
  keywords: ["CRM", "gestão", "empreendedor", "financeiro", "cobranças", "IA", "SaaS"],
  openGraph: {
    title: "Nidex — Gerencie tudo. Cresça mais rápido.",
    description: "O ecossistema all-in-one para empreendedores brasileiros.",
    locale: "pt_BR",
    type: "website",
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="pt-BR" className={inter.variable}>
      <body>{children}</body>
    </html>
  );
}
