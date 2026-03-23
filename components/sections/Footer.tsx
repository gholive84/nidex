import { siteContent } from "@/lib/content";

export default function Footer() {
  const { brand, footer } = siteContent;

  return (
    <footer className="bg-[#0F172A] border-t border-white/5">
      <div className="max-w-[1200px] mx-auto px-4 sm:px-6 py-16">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
          {/* Brand */}
          <div className="md:col-span-1">
            <div className="text-white font-bold text-2xl mb-3">{brand.name}</div>
            <p className="text-white/40 text-sm leading-relaxed">{footer.description}</p>
          </div>

          {/* Links */}
          {footer.columns.map((col) => (
            <div key={col.title}>
              <div className="text-white font-semibold text-sm mb-4">{col.title}</div>
              <ul className="flex flex-col gap-3">
                {col.links.map((link) => (
                  <li key={link.label}>
                    <a
                      href={link.href}
                      className="text-white/40 text-sm hover:text-white/80 transition-colors"
                    >
                      {link.label}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>

        <div className="border-t border-white/5 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
          <p className="text-white/30 text-sm">{footer.copyright}</p>
          <div className="flex items-center gap-2">
            <div className="w-2 h-2 rounded-full bg-green-400 animate-pulse" />
            <span className="text-white/30 text-xs">Todos os sistemas operacionais</span>
          </div>
        </div>
      </div>
    </footer>
  );
}
