export const siteContent = {
  brand: {
    name: "nidex",
    tagline: "O ecossistema inteligente para empreendedores",
    description:
      "CRM, financeiro, cobranças, tarefas, projetos e IA em um único lugar. Feito para quem constrói de verdade.",
  },

  nav: {
    links: [
      { label: "Funcionalidades", href: "#funcionalidades" },
      { label: "Como funciona", href: "#como-funciona" },
      { label: "Depoimentos", href: "#depoimentos" },
      { label: "Preços", href: "#precos" },
    ],
    cta: "Começar grátis",
  },

  hero: {
    badge: "Novo · IA integrada ao seu negócio",
    headline: ["Gerencie tudo.", "Cresça mais", "rápido."],
    highlightWord: "rápido.",
    subtext:
      "A Nidex reúne CRM, financeiro, cobranças e IA em uma plataforma. Pare de usar 7 ferramentas diferentes e foque no que importa: vender.",
    cta: {
      primary: "Começar grátis — 14 dias",
      secondary: "Ver demonstração",
    },
    stats: [
      { value: "3.200+", label: "empreendedores" },
      { value: "R$ 48M+", label: "gerenciados" },
      { value: "98%", label: "satisfação" },
    ],
  },

  features: {
    sectionLabel: "Funcionalidades",
    headline: ["Tudo que seu negócio precisa,", "em um só lugar"],
    highlightWord: "um só lugar",
    subtext:
      "Chega de abas abertas, planilhas perdidas e integrações que não funcionam. A Nidex centraliza tudo.",
    items: [
      {
        icon: "Users",
        title: "CRM Inteligente",
        description:
          "Acompanhe cada cliente e oportunidade. Pipeline visual com automações que nutrem leads no piloto automático.",
        color: "blue",
      },
      {
        icon: "DollarSign",
        title: "Financeiro Completo",
        description:
          "Fluxo de caixa, DRE, contas a pagar e receber. Visão clara do dinheiro do seu negócio em tempo real.",
        color: "green",
      },
      {
        icon: "Zap",
        title: "Cobranças Automáticas",
        description:
          "Gere boletos, links de pagamento e cobranças recorrentes. Reduza a inadimplência com réguas automáticas.",
        color: "yellow",
      },
      {
        icon: "CheckSquare",
        title: "Tarefas e Projetos",
        description:
          "Organize equipes, delegue tarefas e acompanhe prazos. Do Kanban ao Gantt, do jeito que você prefere.",
        color: "purple",
      },
      {
        icon: "Bot",
        title: "IA Integrada",
        description:
          "Assistente inteligente que analisa seus dados, sugere ações e automatiza o que consome seu tempo.",
        color: "cyan",
      },
      {
        icon: "BarChart3",
        title: "Relatórios em tempo real",
        description:
          "Dashboards customizáveis com os KPIs do seu negócio. Tome decisões com dados, não com intuição.",
        color: "orange",
      },
    ],
  },

  howItWorks: {
    sectionLabel: "Como funciona",
    headline: ["Em 3 passos você", "transforma seu negócio"],
    highlightWord: "transforma",
    steps: [
      {
        number: "01",
        title: "Crie sua conta",
        description:
          "Cadastro em menos de 2 minutos. Sem cartão de crédito, sem burocracia. Começa grátis.",
      },
      {
        number: "02",
        title: "Configure seu negócio",
        description:
          "Importe seus clientes, configure seu funil de vendas e personalize a plataforma para a sua realidade.",
      },
      {
        number: "03",
        title: "Cresça com dados",
        description:
          "Acompanhe métricas em tempo real, automatize processos e tome decisões que aceleram seu crescimento.",
      },
    ],
  },

  testimonials: {
    sectionLabel: "Depoimentos",
    headline: ["Empreendedores que", "já transformaram o negócio"],
    highlightWord: "transformaram",
    items: [
      {
        name: "Mariana Costa",
        role: "Fundadora, Studio MC",
        avatar: "MC",
        text: "Antes eu usava WhatsApp, planilha, Trello e mais 3 ferramentas. Hoje tudo está na Nidex. Economizei 3h por dia e aumentei minha receita em 40%.",
      },
      {
        name: "Rafael Nunes",
        role: "CEO, Agência RN Digital",
        avatar: "RN",
        text: "A parte financeira era meu pesadelo. Com a Nidex, sei exatamente quanto entra, quanto sai e qual cliente me dá mais lucro. Mudou minha vida.",
      },
      {
        name: "Camila Ferreira",
        role: "Consultora de RH",
        avatar: "CF",
        text: "O CRM me ajudou a não perder mais nenhuma oportunidade. Aumentei meu fechamento de 30% para 68% em dois meses.",
      },
    ],
  },

  pricing: {
    sectionLabel: "Preços",
    headline: ["Simples, transparente,", "sem surpresas"],
    highlightWord: "sem surpresas",
    subtext: "Teste grátis por 14 dias. Cancele quando quiser.",
    plans: [
      {
        name: "Starter",
        price: "97",
        period: "/mês",
        description: "Para quem está começando e precisa de controle.",
        features: [
          "Até 500 contatos no CRM",
          "Gestão financeira básica",
          "Cobranças (até 50/mês)",
          "Tarefas e projetos",
          "Suporte por email",
        ],
        cta: "Começar grátis",
        highlighted: false,
      },
      {
        name: "Pro",
        price: "197",
        period: "/mês",
        description: "Para negócios em crescimento que precisam de mais poder.",
        features: [
          "Contatos ilimitados",
          "Financeiro completo + DRE",
          "Cobranças ilimitadas",
          "IA integrada",
          "Automações avançadas",
          "Suporte prioritário",
        ],
        cta: "Começar grátis",
        highlighted: true,
        badge: "Mais popular",
      },
      {
        name: "Business",
        price: "397",
        period: "/mês",
        description: "Para empresas com equipes e processos complexos.",
        features: [
          "Tudo do Pro",
          "Múltiplos usuários",
          "Relatórios personalizados",
          "API e integrações",
          "Onboarding dedicado",
          "Suporte 24/7",
        ],
        cta: "Falar com vendas",
        highlighted: false,
      },
    ],
  },

  cta: {
    headline: ["Pronto para simplificar", "seu negócio?"],
    highlightWord: "simplificar",
    subtext:
      "Junte-se a mais de 3.200 empreendedores que já usam a Nidex para crescer com mais controle e menos estresse.",
    primary: "Começar grátis — 14 dias",
    secondary: "Falar com especialista",
    note: "Sem cartão de crédito · Cancele quando quiser · Setup em minutos",
  },

  footer: {
    description:
      "O ecossistema all-in-one para empreendedores que querem crescer com inteligência.",
    columns: [
      {
        title: "Produto",
        links: [
          { label: "Funcionalidades", href: "#funcionalidades" },
          { label: "Preços", href: "#precos" },
          { label: "Integrações", href: "#" },
          { label: "Novidades", href: "#" },
        ],
      },
      {
        title: "Empresa",
        links: [
          { label: "Sobre nós", href: "#" },
          { label: "Blog", href: "#" },
          { label: "Carreiras", href: "#" },
          { label: "Contato", href: "#" },
        ],
      },
      {
        title: "Suporte",
        links: [
          { label: "Central de ajuda", href: "#" },
          { label: "Status", href: "#" },
          { label: "Termos de uso", href: "#" },
          { label: "Privacidade", href: "#" },
        ],
      },
    ],
    copyright: "© 2026 Nidex. Todos os direitos reservados.",
  },
};
