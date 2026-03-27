    <!-- AI SECTION -->
    <section id="ia" class="ai-section">
      <div class="ai-section__photo"></div>
      <div class="ai-section__overlay"></div>
      <div class="container ai-section__inner">

        <!-- Left: text -->
        <div class="ai-section__content reveal">
          <span class="section-label">Inteligência Artificial nativa</span>
          <h2 class="ai-section__title">
            Diga o que precisa.<br />
            <span class="text-accent">A IA executa.</span>
          </h2>
          <p class="ai-section__desc">
            IA embarcada em todo o sistema. Converse em linguagem natural para executar qualquer ação — sem cliques, sem formulários, sem perder tempo.
          </p>
          <ul class="ai-section__features">
            <li>
              <span class="ai-section__feat-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
              Relatórios gerados com um comando de voz ou texto
            </li>
            <li>
              <span class="ai-section__feat-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
              Movimentações financeiras registradas automaticamente
            </li>
            <li>
              <span class="ai-section__feat-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
              Previsão de fluxo de caixa e alertas de risco
            </li>
            <li>
              <span class="ai-section__feat-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
              Clientes e oportunidades gerenciados por voz
            </li>
            <li>
              <span class="ai-section__feat-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
              </span>
              Respostas rápidas baseadas nos dados do seu negócio
            </li>
          </ul>
          <a href="#contato" class="btn btn--primary open-modal">
            Experimentar a IA
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </div>

        <!-- Right: chat UI animado -->
        <div class="ai-chat reveal reveal--delay">
          <div class="ai-chat__header">
            <div class="ai-chat__avatar">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <div class="ai-chat__head-text">
              <span class="ai-chat__name">nidex IA</span>
              <span class="ai-chat__sub">Assistente do seu negócio</span>
            </div>
            <div class="ai-chat__status">
              <span class="ai-chat__dot"></span>
              Online
            </div>
          </div>
          <div class="ai-chat__messages" id="aiMessages"></div>
          <div class="ai-chat__input">
            <span class="ai-chat__placeholder" id="aiInputText"></span>
            <span class="ai-chat__cursor" id="aiCursor"></span>
            <button class="ai-chat__send" aria-label="Enviar">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </div>
        </div>

      </div>
    </section>
