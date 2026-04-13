<?php
$page_title       = 'Nidex.Cowork — Ecossistema all-in-one para PMEs brasileiras';
$page_description = 'CRM, financeiro, cobranças recorrentes, pedidos, NF-e, tarefas, agenda, documentos e Agentes de IA — tudo integrado. Substitua 5-8 ferramentas e economize 60h/mês.';
require_once dirname(dirname(__DIR__)) . '/site/includes/head-page.php';
require_once dirname(dirname(__DIR__)) . '/site/includes/header.php';

function mock_screen(string $color, bool $dark = false): string {
  $cls = $dark ? ' mock-screen--dark' : '';
  return <<<HTML
<div class="mock-screen{$cls}" style="--mock-color:{$color}">
  <div class="mock-screen__chrome">
    <div class="mock-screen__dots"><span></span><span></span><span></span></div>
    <div class="mock-screen__urlbar"></div>
  </div>
  <div class="mock-screen__body">
    <div class="mock-screen__sidebar">
      <div class="mock-screen__sidebar-logo"></div>
      <div class="mock-screen__sidebar-item mock-screen__sidebar-item--active"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
      <div class="mock-screen__sidebar-item"></div>
    </div>
    <div class="mock-screen__main">
      <div class="mock-screen__topbar">
        <div class="mock-screen__topbar-title"></div>
        <div class="mock-screen__topbar-btn"></div>
      </div>
      <div class="mock-screen__cards">
        <div class="mock-screen__card"><div class="mock-screen__card-label"></div><div class="mock-screen__card-value mock-screen__card-value--accent"></div></div>
        <div class="mock-screen__card"><div class="mock-screen__card-label"></div><div class="mock-screen__card-value"></div></div>
        <div class="mock-screen__card"><div class="mock-screen__card-label"></div><div class="mock-screen__card-value"></div></div>
      </div>
      <div class="mock-screen__rows">
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
        <div class="mock-screen__row"><div class="mock-screen__row-dot"></div><div class="mock-screen__row-line"></div><div class="mock-screen__row-line mock-screen__row-line--short"></div><div class="mock-screen__row-tag"></div></div>
      </div>
    </div>
  </div>
</div>
HTML;
}
?>

<!-- HERO -->
<section class="suite-hero">
  <div class="suite-hero__grid"></div>
  <div class="suite-hero__glow suite-hero__glow--1"></div>
  <div class="suite-hero__glow suite-hero__glow--2"></div>
  <div class="container suite-hero__inner">
    <span class="suite-hero__label">Nidex.Cowork</span>
    <h1 class="suite-hero__title">
      O ecossistema completo.<br />
      <span class="text-gradient">Com Agentes de IA trabalhando por você.</span>
    </h1>
    <p class="suite-hero__desc">CRM, financeiro, cobranças, pedidos, NF-e, tarefas, agenda e <strong>Agentes de IA embarcados em cada módulo</strong>. Substitua 5–8 ferramentas, economize 60h/mês — tudo integrado, sem complexidade.</p>
    <div class="suite-hero__pills">
      <a href="#crm"         class="suite-pill"><span class="suite-pill__dot" style="background:#2563EB"></span>CRM</a>
      <a href="#rh"          class="suite-pill"><span class="suite-pill__dot" style="background:#7C3AED"></span>RH</a>
      <a href="#pdv"         class="suite-pill"><span class="suite-pill__dot" style="background:#EA580C"></span>PDV & NF-e</a>
      <a href="#agenda"      class="suite-pill"><span class="suite-pill__dot" style="background:#E11D48"></span>Agenda</a>
      <a href="#chat"        class="suite-pill"><span class="suite-pill__dot" style="background:#0891B2"></span>Chat</a>
      <a href="#documentos"  class="suite-pill"><span class="suite-pill__dot" style="background:#D97706"></span>Documentos</a>
      <a href="#tarefas"     class="suite-pill"><span class="suite-pill__dot" style="background:#9333EA"></span>Tarefas</a>
      <a href="#financeiro"  class="suite-pill"><span class="suite-pill__dot" style="background:#16A34A"></span>Financeiro</a>
      <a href="#assinaturas" class="suite-pill"><span class="suite-pill__dot" style="background:#0284C7"></span>Assinaturas</a>
      <a href="#ceo"         class="suite-pill"><span class="suite-pill__dot" style="background:#38BDF8"></span>CEO & IA</a>
    </div>
  </div>
</section>

<!-- 01 CRM -->
<div id="crm" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#2563EB') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#EFF6FF;color:#2563EB;border:1px solid #DBEAFE">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          CRM & Pipeline de Vendas
        </div>
        <h2 class="suite-block__title">Do primeiro contato ao fechamento.<br /><span class="text-primary">Sem nada escapar.</span></h2>
        <p class="suite-block__desc">Pipeline Kanban drag-and-drop com stages 100% configuráveis. Cada negociação carrega histórico completo — comentários, atividades, documentos. Quando fecha, vira pedido. O pedido vira cobrança. Automático.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Stages 100% configuráveis e campos customizáveis por deal</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Comentários e atividades por negociação com menções de equipe</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Negociação → Pedido → Cobrança sem redigitação</span></li>
          <li><div class="run-feat__icon" style="background:#2563EB"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>CNPJ auto-preenchido e impressão de etiquetas</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 02 RH -->
<div id="rh" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#7C3AED') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#F5F3FF;color:#7C3AED;border:1px solid #DDD6FE">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
          Recursos Humanos
        </div>
        <h2 class="suite-block__title">Sua equipe.<br /><span style="color:#7C3AED">Organizada desde o primeiro dia.</span></h2>
        <p class="suite-block__desc">Gerencie colaboradores, monte o organograma e conduza onboarding passo a passo. Permissões granulares garantem que cada pessoa acessa exatamente o que precisa — nem mais, nem menos.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#7C3AED"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Cadastro de colaboradores e organograma visual</span></li>
          <li><div class="run-feat__icon" style="background:#7C3AED"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Onboarding guiado: empresa → sócios → colaboradores → banco</span></li>
          <li><div class="run-feat__icon" style="background:#7C3AED"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>20+ permissões individuais por membro (cobranças, estoque, pipeline…)</span></li>
          <li><div class="run-feat__icon" style="background:#7C3AED"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Convites por e-mail com role pré-definido</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 03 PDV -->
<div id="pdv" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#EA580C') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#FFF7ED;color:#EA580C;border:1px solid #FED7AA">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          PDV & Notas Fiscais
        </div>
        <h2 class="suite-block__title">Do pedido à nota fiscal.<br /><span style="color:#EA580C">Fluxo contínuo.</span></h2>
        <p class="suite-block__desc">Crie pedidos, gere cobranças e emita NF-e direto do sistema — sem abrir site de prefeitura, sem copiar dados. Cada pedido confirmado gera automaticamente um deal no CRM e uma tarefa para a equipe.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Ciclo completo: rascunho → confirmado → cancelado</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Pedido gera cobrança, deal no CRM e tarefa automaticamente</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Emissão de NF-e (ICMS, IPI, PIS, COFINS) via FocusNFe</span></li>
          <li><div class="run-feat__icon" style="background:#EA580C"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Estoque: compras, recebimentos, receitas de produção e ajustes</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 04 AGENDA -->
<div id="agenda" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#E11D48') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#FFF1F2;color:#E11D48;border:1px solid #FECDD3">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Agenda & Eventos
        </div>
        <h2 class="suite-block__title">Reuniões que<br /><span style="color:#E11D48">geram resultado.</span></h2>
        <p class="suite-block__desc">Calendário com eventos, participantes e confirmações. Cada reunião pode gerar tarefas e follow-ups — porque compromisso sem próximo passo é tempo perdido.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Eventos com participantes e confirmação de presença</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Comentários e discussões vinculados ao evento</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Integração direta com Tarefas e Operações</span></li>
          <li><div class="run-feat__icon" style="background:#E11D48"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Edição inline de campos sem recarregar a página</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 05 CHAT -->
<div id="chat" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#0891B2') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#ECFEFF;color:#0891B2;border:1px solid #A5F3FC">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
          Canais de Mensagens
        </div>
        <h2 class="suite-block__title">Comunicação da equipe.<br /><span style="color:#0891B2">Dentro do negócio.</span></h2>
        <p class="suite-block__desc">Chega de trabalho misturado com conversa pessoal. O Chat do Nidex organiza a comunicação em canais temáticos — com o contexto de negócio junto à conversa.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#0891B2"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Canais temáticos (#financeiro, #vendas, #produção)</span></li>
          <li><div class="run-feat__icon" style="background:#0891B2"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Convite de membros por canal com permissões</span></li>
          <li><div class="run-feat__icon" style="background:#0891B2"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Mensagens em tempo real</span></li>
          <li><div class="run-feat__icon" style="background:#0891B2"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Separado do WhatsApp pessoal — contexto de trabalho preservado</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 06 DOCUMENTOS -->
<div id="documentos" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#D97706') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#FFFBEB;color:#D97706;border:1px solid #FDE68A">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          Documentos & Cofre de Senhas
        </div>
        <h2 class="suite-block__title">Tudo da empresa.<br /><span style="color:#D97706">Em um lugar seguro.</span></h2>
        <p class="suite-block__desc">GED integrado com pastas, tags e busca — sem Google Drive separado. Mais um cofre de senhas criptografado para credenciais da equipe. Sem post-it, sem senha no grupo de WhatsApp.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Pastas, tags, busca e upload em massa</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Download direto — sem depender de ferramentas externas</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Cofre de senhas com revelação sob demanda (click-to-reveal)</span></li>
          <li><div class="run-feat__icon" style="background:#D97706"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Compartilhamento por equipe com controle de acesso</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 07 TAREFAS -->
<div id="tarefas" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#9333EA') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#FDF4FF;color:#9333EA;border:1px solid #E9D5FF">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
          Tarefas & Operações
        </div>
        <h2 class="suite-block__title">Sua equipe sabe<br /><span style="color:#9333EA">o que fazer. Agora.</span></h2>
        <p class="suite-block__desc">Tarefas com workflow de status, prioridades e responsáveis. Work items são gerados automaticamente de pedidos confirmados — produção e entrega acompanham o comercial sem e-mail de repasse.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Workflow de status: avançar, reverter, atualizar</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Work items gerados automaticamente de pedidos confirmados</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Comentários com menções, campos customizáveis e flag de urgência</span></li>
          <li><div class="run-feat__icon" style="background:#9333EA"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Contagem de atrasados visível no sidebar</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 08 FINANCEIRO -->
<div id="financeiro" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--alt suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#16A34A') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#F0FDF4;color:#16A34A;border:1px solid #BBF7D0">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
          Financeiro & Despesas
        </div>
        <h2 class="suite-block__title">Cada centavo rastreado.<br /><span style="color:#16A34A">Cada decisão com dados.</span></h2>
        <p class="suite-block__desc">Conecte sua conta bancária e tenha visão completa em tempo real. Conciliação automática, DRE com EBITDA e extração de notas fiscais por IA — fotografe a nota, a IA extrai fornecedor, valor, CNPJ e vencimento.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Conciliação bancária automática (CNPJ + valor ±2% + data ±3 dias)</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>DRE com EBITDA, margem bruta/líquida e comparativo YoY</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Dashboard com 15+ métricas: MRR, ARR, cashflow, top clientes</span></li>
          <li><div class="run-feat__icon" style="background:#16A34A"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Extração de NF por IA + workflow de aprovação pelo gestor</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 09 ASSINATURAS -->
<div id="assinaturas" style="position:relative;top:-72px"></div>
<section class="suite-block">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#0284C7') ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:#F0F9FF;color:#0284C7;border:1px solid #BAE6FD">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>
          Cobranças & Recorrência
        </div>
        <h2 class="suite-block__title">Receba em dia.<br /><span style="color:#0284C7">O sistema cobra por você.</span></h2>
        <p class="suite-block__desc">Configure assinaturas recorrentes e o Nidex gera cobranças com boleto, PIX e código de barras — e notifica o cliente automaticamente. Carnês com parcelas, juros, multa e desconto. No piloto automático.</p>
        <ul class="suite-block__features">
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Geração automática de boleto + PIX por assinatura recorrente</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Carnê com parcelas e vencimentos flexíveis</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Juros, multa por atraso e desconto por antecipação configuráveis</span></li>
          <li><div class="run-feat__icon" style="background:#0284C7"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Tracking de MRR e ARR em tempo real</span></li>
        </ul>
        <div class="suite-block__ctas"><a href="#contato" class="btn btn--primary open-modal">Testar grátis</a></div>
      </div>
    </div>
  </div>
</section>

<!-- 10 CEO & IA -->
<div id="ceo" style="position:relative;top:-72px"></div>
<section class="suite-block suite-block--dark suite-block--reverse">
  <div class="suite-block__container">
    <div class="suite-block__screenshot-col"><?= mock_screen('#38BDF8', true) ?></div>
    <div class="suite-block__content-col">
      <div class="suite-block__content">
        <div class="suite-block__tag" style="background:rgba(56,189,248,0.1);color:#38BDF8;border:1px solid rgba(56,189,248,0.2)">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
          CEO & Agentes de IA
        </div>
        <h2 class="suite-block__title suite-block--dark">Agentes que trabalham.<br /><span class="text-accent">Não apenas respondem.</span></h2>
        <p class="suite-block__desc suite-block--dark">Não é um chatbot. São Agentes de IA embarcados que executam tarefas reais no WhatsApp — criam contatos, registram pedidos, consultam clientes — 24/7. E um dashboard executivo com os números que realmente importam.</p>
        <ul class="suite-block__features suite-block--dark">
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>WhatsApp AI Agent: cria contatos, tarefas, produtos e consulta pedidos</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Extração fiscal por IA — OCR multi-modelo: PDF → Mistral → Claude</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>Dashboard com MRR, ARR, EBITDA, top clientes e cashflow</span></li>
          <li><div class="run-feat__icon run-feat__icon--cyan"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg></div><span>AI Chat interno + tracking de uso e custos de IA por conversa</span></li>
        </ul>
        <div class="suite-block__ctas">
          <a href="#contato" class="btn btn--primary open-modal">Testar grátis</a>
          <a href="/#ia" class="btn btn--ghost-dark">Ver Agentes na homepage</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="run-cta">
  <div class="run-cta__glow"></div>
  <div class="container run-cta__inner reveal">
    <span class="section-label section-label--accent">Comece hoje</span>
    <h2 class="run-cta__title">Tudo isso em<br /><span class="text-accent">um único lugar.</span></h2>
    <p class="run-cta__desc">Experimente o Nidex.Cowork gratuitamente. 14 dias grátis, sem cartão, setup em minutos — e Agentes de IA trabalhando por você desde o primeiro dia.</p>
    <div class="run-cta__actions">
      <a href="#contato" class="btn btn--primary open-modal">Começar grátis</a>
      <a href="/run" class="btn btn--ghost-dark">Conhecer o Nidex.Run</a>
    </div>
  </div>
</section>

<?php require_once dirname(dirname(__DIR__)) . '/site/includes/footer.php'; ?>
