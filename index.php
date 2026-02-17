<?php
define('APP_LOADED', true);
require_once __DIR__ . '/includes/security.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO Meta Tags -->
  <title>ST Motors Araraquara | Motos Usadas e Seminovas com Procedência Garantida</title>
  <meta name="description"
    content="Encontre a moto ideal em Araraquara. Motos usadas e seminovas com procedência garantida, financiamento facilitado e atendimento personalizado. Confira nosso estoque!">
  <meta name="author" content="ST Motors">
  <meta name="robots" content="index, follow">
  <meta name="theme-color" content="#0F0F0F">
  <link rel="canonical" href="https://stmotorsara.com.br">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="ST Motors Araraquara | Motos Usadas e Seminovas">
  <meta property="og:description"
    content="Encontre a moto ideal em Araraquara. Procedência garantida e atendimento personalizado.">
  <meta property="og:url" content="https://stmotorsara.com.br">
  <meta property="og:image" content="https://stmotorsara.com.br/assets/images/st-og.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:site_name" content="ST Motors Araraquara">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="ST Motors Araraquara | Motos Usadas e Seminovas">
  <meta name="twitter:description" content="Encontre a moto ideal em Araraquara. Procedência garantida.">
  <meta name="twitter:image" content="https://stmotorsara.com.br/assets/images/st-og.jpg">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon.svg" />
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="manifest" href="site.webmanifest" />

  <!-- DNS Prefetch -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Preload Critical Resources -->
  <link rel="preload" href="/assets/styles/components/styles-header.css" as="style">
  <link rel="preload" href="/assets/styles/components/styles-footer.css" as="style">
  <link rel="preload" href="assets/styles/home-styles.css" as="style">
  <link rel="preload" as="image" href="assets/images/home/hero-bg.jpg" fetchpriority="high">
  <link rel="preload"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700&display=swap"
      as="style"
      crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="/assets/styles/components/styles-header.css">
  <link rel="stylesheet" href="/assets/styles/components/styles-footer.css">
  <link rel="stylesheet" href="assets/styles/home-styles.css">

  <!-- Schema.org - Local Business -->
  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "MotorcycleDealer",
  "name": "ST Motors",
  "description": "Loja especializada em motos usadas, seminovas e novas em Araraquara-SP. Procedência garantida, financiamento facilitado e atendimento personalizado.",
  "image": [
    "https://stmotorsara.com.br/assets/images/st-og.jpg",
    "https://stmotorsara.com.br/assets/images/logo-header.svg"
  ],
  "url": "https://stmotorsara.com.br",
  "telephone": "+551630147386",
  "priceRange": "R$ 5.000 - R$ 50.000",
  "paymentAccepted": "Dinheiro, Cartão de Crédito, Cartão de Débito, Financiamento",
  "currenciesAccepted": "BRL",
  "contactPoint": {
  "@type": "ContactPoint",
  "telephone": "+5516997305602",
  "contactType": "sales",
  "areaServed": "BR",
  "availableLanguage": ["Portuguese"]
},
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "R. Maurício Galli, 47",
    "addressLocality": "Araraquara",
    "addressRegion": "SP",
    "postalCode": "14806-155",
    "addressCountry": "BR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -21.767900187638183,
    "longitude": -48.164309978264384
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday"
      ],
      "opens": "08:30",
      "closes": "18:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "08:30",
      "closes": "13:00"
    }
  ],
  "sameAs": [
    "https://www.instagram.com/stmotors_ara/",
    "https://www.facebook.com/St.Motors.Araraquara"
  ]
}
</script>

  <!-- Schema.org - WebSite with SearchAction -->
  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "ST Motors Araraquara",
  "url": "https://stmotorsara.com.br",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://stmotorsara.com.br/estoque?q={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
</head>

<body>
  <!-- ================================
       Skip and Header - php
       ================================ -->
  <?php include __DIR__ . '/includes/skip-header.php'; ?>

  <!-- ================================
       MAIN CONTENT
       ================================ -->
  <main id="main-content">
    <!-- ================================
         HERO SECTION
         ================================ -->
    <section id="home" class="hero" role="region" aria-label="Busca de motos">

      <!-- Background -->
      <div class="hero__background">
        <picture class="hero__background-image">
          <source srcset="assets/images/home/hero-bg.jpg" type="image/jpeg">
          <img src="assets/images/home/hero-bg.jpg"
            alt="Motociclista parado apoiado em moto esportiva vermelha em estrada nas montanhas sob céu nublado"
            loading="eager" width="1920" height="1080">
        </picture>

        <div class="hero__overlay" aria-hidden="true"></div>
      </div>

      <!-- Badge de Localização (Glass Effect) -->
      <a href="https://www.google.com/maps/place/R.+Maur%C3%ADcio+Galli,+47+-+Jardim+Pinheiros,+Araraquara+-+SP,+14806-155"
        target="_blank" rel="noopener noreferrer" class="hero__location-badge"
        aria-label="Ver localização da ST Motors no Google Maps">
        <svg class="hero__location-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
          aria-hidden="true">
          <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
          <circle cx="12" cy="10" r="3" />
        </svg>
        <div class="hero__location-text">
          <span class="hero__location-city">Araraquara-SP</span>
          <span class="hero__location-cta">Pesquisando motos?<br>Venha nos visitar</span>
        </div>
      </a>

      <!-- Campo de Busca com Eyebrow -->
      <div class="hero__content">
        <!-- Eyebrow -->
        <span class="hero__eyebrow">Comece Sua Jornada</span>

        <form class="hero__search" role="search" aria-label="Formulário de busca de motos no estoque" method="GET"
          action="/estoque">

          <div class="hero__search-wrapper">

            <label for="search-input" class="visually-hidden">
              Qual moto você procura?
            </label>

            <input type="search" id="search-input" name="q" class="hero__search-input" placeholder="Pesquisar"
              aria-label="Campo de busca de motos por modelo, marca ou ano" aria-autocomplete="list"
              aria-controls="search-suggestions" aria-expanded="false" autocomplete="off" spellcheck="false" required>

            <button type="submit" class="hero__search-button" aria-label="Executar busca de motos">
              <svg class="hero__search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
              </svg>
              <span class="visually-hidden">Buscar</span>
            </button>
          </div>

          <div class="hero__search-suggestions" id="search-suggestions" role="listbox" aria-label="Sugestões de busca"
            hidden>
            <!-- Sugestões dinâmicas via JavaScript -->
          </div>
        </form>
      </div>

    </section>

    <!-- ================================
         SOCIAL LINKS SECTION
         ================================ -->
    <section class="social-links" aria-label="Links de redes sociais">
      <div class="social-links__container">

        <a href="https://wa.me/5516997305602" target="_blank" rel="noopener noreferrer"
          class="social-links__item social-links__item--whatsapp" aria-label="Fale conosco pelo WhatsApp">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
          </svg>
        </a>

        <a href="https://www.facebook.com/stmotorsara" target="_blank" rel="noopener noreferrer"
          class="social-links__item social-links__item--facebook" aria-label="Siga-nos no Facebook">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
          </svg>
        </a>

        <a href="https://www.instagram.com/stmotorsara" target="_blank" rel="noopener noreferrer"
          class="social-links__item social-links__item--instagram" aria-label="Siga-nos no Instagram">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
              d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
          </svg>
        </a>

        <a href="https://www.google.com/maps/place/R.+Maur%C3%ADcio+Galli,+47+-+Jardim+Pinheiros,+Araraquara+-+SP,+14806-155"
          target="_blank" rel="noopener noreferrer" class="social-links__item social-links__item--maps"
          aria-label="Veja nossa localização no Google Maps">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
            <circle cx="12" cy="10" r="3" />
          </svg>
        </a>

      </div>
    </section>

    <!-- ================================
     VALUE SECTION (Dark Theme)
     H1 SEO + Trust Signals
     ================================ -->
    <section class="value-section" role="region" aria-labelledby="value-heading">
      <div class="value-section__container">

        <!-- H1 - Título Principal SEO Otimizado -->
        <h1 id="value-heading" class="value-section__title">
          Encontre a Moto Ideal em Araraquara com Condições Facilitadas
        </h1>

        <!-- H2 - Subtítulo Semântico -->
        <h2 class="value-section__subtitle">
          Realize o sonho da sua moto com parceiros de confiança
        </h2>

        <!-- Trust Cards - 3 Pilares (Design Premium) -->
        <div class="trust-grid">

          <!-- Card 1: Financiamento Facilitado -->
          <article class="trust-card">
            <div class="trust-card__icon-wrapper">
              <div class="trust-card__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="12" y1="1" x2="12" y2="23" />
                  <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                </svg>
              </div>
            </div>
            <div class="trust-card__content">
              <h3 class="trust-card__title">Financiamento Acessível</h3>
              <p class="trust-card__description">Parcelas que cabem no seu bolso com taxas competitivas e aprovação
                rápida</p>
            </div>
          </article>

          <!-- Card 2: Negociação Segura -->
          <article class="trust-card">
            <div class="trust-card__icon-wrapper">
              <div class="trust-card__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                  <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
              </div>
            </div>
            <div class="trust-card__content">
              <h3 class="trust-card__title">Negociação Segura</h3>
              <p class="trust-card__description">Documentação verificada em cada moto para você comprar com
                tranquilidade e evitar golpes</p>
            </div>
          </article>

          <!-- Card 3: Garantia -->
          <article class="trust-card">
            <div class="trust-card__icon-wrapper">
              <div class="trust-card__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                  <path d="m9 12 2 2 4-4" />
                </svg>
              </div>
            </div>
            <div class="trust-card__content">
              <h3 class="trust-card__title">Garantia</h3>
              <p class="trust-card__description">Sem dor de cabeça: motos revisadas com garantia mecânica e
                documentação
                regularizada</p>
            </div>
          </article>

        </div><!-- /trust-grid -->

      </div><!-- /value-section__container -->
    </section>

    <!-- ================================
         FEATURED BIKES SECTION
         ================================ -->
    <section id="estoque" class="featured" role="region" aria-labelledby="featured-heading">
      <div class="featured__container">

        <header class="featured__header">
          <div class="featured__title-wrapper">
            <span class="featured__line featured__line--top" aria-hidden="true"></span>
            <h2 id="featured-heading" class="featured__title">Destaques</h2>
            <span class="featured__line featured__line--bottom" aria-hidden="true"></span>
          </div>
          <p class="featured__subtitle">Qualidade e confiança em cada modelo, para quem valoriza boas escolhas</p>
        </header>

        <!-- Grid de Motos -->
        <div class="featured__grid">

          <!-- Card 1 -->
          <article class="bike-card">
            <a href="moto-detalhes.html?id=cb-500f" class="bike-card__link"
              aria-label="Ver detalhes da Honda CB 500F 2022">
              <div class="bike-card__image-wrapper">
                <img src="assets/images/home/Z100-2012-Preta-280-1-1.jpeg" alt="Honda CB 500F 2022"
                  class="bike-card__image" loading="lazy" width="400" height="300">
              </div>
              <div class="bike-card__content">
                <h5 class="bike-card__brand">HONDA</h5>
                <h3 class="bike-card__name">CB 500F</h3>
                <div class="bike-card__specs">
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <!-- Cabeça do pistão -->
  <path d="M7 3h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
  <!-- Ranhuras (anéis) -->
  <path d="M5 7h14" />
  <path d="M5 10h14" />
  <!-- Biela (braço de conexão) -->
  <path d="M12 14v4" />
  <circle cx="12" cy="20" r="2" />
</svg>
                    471cc
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                      <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                    Naked
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    2022
                  </span>
                </div>
                <div class="bike-card__footer">
                  <p class="bike-card__price">
                    <span class="bike-card__price-label">A partir de</span>
                    <span class="bike-card__price-value">R$ 28.900</span>
                  </p>
                </div>
              </div>
            </a>
          </article>

          <!-- Card 2 -->
          <article class="bike-card">
            <a href="moto-detalhes.html?id=cb-500f" class="bike-card__link"
              aria-label="Ver detalhes da Honda CB 500F 2022">
              <div class="bike-card__image-wrapper">
                <img src="assets/images/home/Z100-2012-Preta-280-1-1.jpeg" alt="Honda CB 500F 2022"
                  class="bike-card__image" loading="lazy" width="400" height="300">
              </div>
              <div class="bike-card__content">
                <h5 class="bike-card__brand">HONDA</h5>
                <h3 class="bike-card__name">CB 500F</h3>
                <div class="bike-card__specs">
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <!-- Cabeça do pistão -->
  <path d="M7 3h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
  <!-- Ranhuras (anéis) -->
  <path d="M5 7h14" />
  <path d="M5 10h14" />
  <!-- Biela (braço de conexão) -->
  <path d="M12 14v4" />
  <circle cx="12" cy="20" r="2" />
</svg>
                    471cc
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                      <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                    Naked
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    2022
                  </span>
                </div>
                <div class="bike-card__footer">
                  <p class="bike-card__price">
                    <span class="bike-card__price-label">A partir de</span>
                    <span class="bike-card__price-value">R$ 28.900</span>
                  </p>
                </div>
              </div>
            </a>
          </article>

          <!-- Card 3 -->
          <article class="bike-card">
            <a href="moto-detalhes.html?id=cb-500f" class="bike-card__link"
              aria-label="Ver detalhes da Honda CB 500F 2022">
              <div class="bike-card__image-wrapper">
                <img src="assets/images/home/Z100-2012-Preta-280-1-1.jpeg" alt="Honda CB 500F 2022"
                  class="bike-card__image" loading="lazy" width="400" height="300">
              </div>
              <div class="bike-card__content">
                <h5 class="bike-card__brand">HONDA</h5>
                <h3 class="bike-card__name">CB 500F</h3>
                <div class="bike-card__specs">
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <!-- Cabeça do pistão -->
  <path d="M7 3h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
  <!-- Ranhuras (anéis) -->
  <path d="M5 7h14" />
  <path d="M5 10h14" />
  <!-- Biela (braço de conexão) -->
  <path d="M12 14v4" />
  <circle cx="12" cy="20" r="2" />
</svg>
                    471cc
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                      <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                    </svg>
                    Naked
                  </span>
                  <span class="bike-card__spec">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    2022
                  </span>
                </div>
                <div class="bike-card__footer">
                  <p class="bike-card__price">
                    <span class="bike-card__price-label">A partir de</span>
                    <span class="bike-card__price-value">R$ 28.900</span>
                  </p>
                </div>
              </div>
            </a>
          </article>
        </div><!-- /featured__grid -->

        <div class="featured__arrows">

          <svg width="40" height="60" viewBox="0 0 24 40" xmlns="http://www.w3.org/2000/svg">
            <path class="arrow arrow-1" d="M6 10L12 16L18 10" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" fill="none" />
            <path class="arrow arrow-2" d="M6 22L12 28L18 22" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" fill="none" />
          </svg>
        </div>

        <!-- CTA para Estoque Completo -->
        <div class="featured__cta-wrapper">
          <a href="/estoque" class="featured__cta">Ver estoque completo</a>
          <div class="featured__cta-subtext">
            <svg class="check-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round"
              stroke-linejoin="round" role="img" aria-hidden="true">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Mais de 50 modelos à sua espera</span>
          </div>
        </div><!-- /featured__cta-wrapper -->

      </div><!-- /featured__container -->
    </section>

    <!-- ================================
     TESTIMONIALS SECTION (Social Proof Slider)
     ================================ -->
    <section class="testimonials" aria-labelledby="testimonials-title">
      <div class="testimonials__container">

        <!-- Header -->
        <header class="testimonials__header">
          <h2 class="testimonials__title">Avaliações</h2>
          <h2 id="testimonials-title-st" class="testimonials__title">ST Motors</h2>
          <img src="assets/images/home/google-img.png" id="img-google"
            alt="imagem das estrelas e do logo-texto de avaliações google">
          <p class="testimonials__subtitle">Avaliações reais de clientes que conquistaram sua moto com a ST Motors</p>
        </header>

        <!-- Slider Wrapper -->
        <div class="testimonials__slider-wrapper">

          <!-- Slider Container -->
          <div class="testimonials__slider" id="testimonials-slider" role="region"
            aria-label="Carrossel de depoimentos">

            <!-- Card 1 -->
            <article class="testimonial-card">
              <div class="testimonial-card__image-wrapper">
                <img src="assets/images/avaliacoes"
                  alt="Avaliação 5 estrelas no Google - Cliente satisfeito com atendimento e qualidade da moto"
                  class="testimonial-card__image" loading="lazy" width="600" height="400">
              </div>
              <div class="testimonial-card__content">
                <div class="testimonial-card__rating" aria-label="Avaliação: 5 de 5 estrelas">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                </div>
                <blockquote class="testimonial-card__text">
                  <p>Excelente atendimento! Comprei minha CG 160 e o pessoal foi muito atencioso desde o primeiro
                    contato. A moto estava impecável, procedência garantida e o financiamento saiu super rápido.
                    Recomendo demais!</p>
                </blockquote>
                <footer class="testimonial-card__author">
                  <span class="testimonial-card__author-name">João Silva</span>
                  <span class="testimonial-card__source">Google Reviews</span>
                </footer>
              </div>
            </article>

            <!-- Card 2 -->
            <article class="testimonial-card">
              <div class="testimonial-card__image-wrapper">
                <img src="assets/images/avaliacoes"
                  alt="Avaliação 5 estrelas no Google - Cliente elogia procedência e transparência da loja"
                  class="testimonial-card__image" loading="lazy" width="600" height="400">
              </div>
              <div class="testimonial-card__content">
                <div class="testimonial-card__rating" aria-label="Avaliação: 5 de 5 estrelas">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                      d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                  </svg>
                </div>
                <blockquote class="testimonial-card__text">
                  <p>Melhor experiência que já tive comprando moto usada. Tudo muito transparente, sem enrolação.
                    Comprei uma Fazer 250 seminova que parecia zero km. Preço justo e equipe super profissional.
                    Voltarei com certeza!</p>
                </blockquote>
                <footer class="testimonial-card__author">
                  <span class="testimonial-card__author-name">Maria Santos</span>
                  <span class="testimonial-card__source">Google Reviews</span>
                </footer>
              </div>
            </article>

          </div>

          <!-- Navigation Arrows -->
          <button type="button" class="testimonials__nav testimonials__nav--prev" id="testimonials-prev"
            aria-label="Ver depoimento anterior">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 18l-6-6 6-6" />
            </svg>
          </button>

          <button type="button" class="testimonials__nav testimonials__nav--next" id="testimonials-next"
            aria-label="Ver próximo depoimento">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 18l6-6-6-6" />
            </svg>
          </button>

        </div>

        <!-- Dots Indicator -->
        <div class="testimonials__dots" id="testimonials-dots" role="tablist" aria-label="Navegação de depoimentos">
        </div>

      </div><!-- /testimonials__container -->

      <!-- CTA de Avaliação (Clean & Simple) -->
      <div class="testimonials__review-cta">

        <a href="https://www.google.com/search?sca_esv=115b03ba0a724772&sxsrf=ANbL-n4wfM3aG9kGpypdeVizF2-hBK9gxg:1771303882663&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOUO8VjqmEBoBKNXBuW6QGfImwIwOVv-p25voj4U3R28V2cQfzDgPTON-d2BFxH889v22sFMzWNwFOnZsJ-bPOxKLhk6-&q=ST+Motors+Coment%C3%A1rios&sa=X&ved=2ahUKEwiwqtyV3d-SAxXerpUCHR2WLukQ0bkNegQIHhAH&biw=1366&bih=607&dpr=1"
          target="_blank" rel="noopener noreferrer" class="testimonials__review-link" aria-label="Avaliar no Google →">
          Avaliar no Google →
        </a>
        <p class="testimonials__review-text">
          Avalie o atendimento e ajude a gente a evoluir
        </p>

      </div><!-- /testimonials__review-cta -->

    </section>
    <!-- ================================
     SELL BIKE SECTION — CONVERSÃO OTIMIZADA
     ================================ -->
    <section id="vender-moto" class="sell-bike" role="region" aria-labelledby="sell-bike-title">
      <!-- Overlay com gradiente estratégico -->
      <div class="sell-bike__overlay"></div>

      <div class="sell-bike__container">

        <!-- Glass Card Minimalista -->
        <article class="sell-bike__glass">

          <!-- Micro-Eyebrow (Prova Social) -->
          <span class="sell-bike__eyebrow">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
              aria-hidden="true">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
              <path d="m9 12 2 2 4-4" />
            </svg>
            Evite golpes
          </span>

          <!-- Título Benefício-Driven (H2 Semântico) -->
          <h2 id="sell-bike-title" class="sell-bike__title">
            Venda sua moto<br>de forma segura e rápida
          </h2>

          <!-- Micro-Copy Focado (1 benefício claro) -->
          <p class="sell-bike__description">
            Avaliação justa + Pagamento à vista + Zero burocracia
          </p>

          <!-- CTA com Urgência Sutil -->
          <a href="https://wa.me/5516997305602?text=Quero%20vender%20minha%20moto%20e%20receber%20avalia%C3%A7%C3%A3o"
            class="sell-bike__cta" aria-label="Solicitar avaliação gratuita agora via WhatsApp" target="_blank"
            rel="noopener noreferrer">
            <span class="sell-bike__cta-text">Avaliação no WhatsApp</span>
            <svg class="sell-bike__cta-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg>
          </a>

        </article>

      </div>
    </section>
  </main>

  <!-- ================================
     Footer and Whats - php
     ================================ -->
     
  <?php include __DIR__ . '/includes/footer-whats.php'; ?>

  <!-- ================================
       COOKIE CONSENT BANNER (LGPD)
       ================================ -->
  <div id="cookie-consent" class="cookie-consent" role="dialog" aria-modal="true"
    aria-label="Aviso de cookies" aria-live="polite" hidden>
    <div class="cookie-consent__container">

      <div class="cookie-consent__content">
        <h2 class="cookie-consent__title">🍪 Usamos cookies</h2>
        <p class="cookie-consent__description">
          Utilizamos cookies para melhorar sua experiência de navegação e analisar o tráfego do site.
          Ao clicar em "Aceitar todos", você concorda com nosso uso de cookies conforme nossa
          <a href="/politica-privacidade" class="cookie-consent__link">Política de Privacidade</a>.
        </p>
      </div>

      <div class="cookie-consent__actions">
        <button id="cookie-accept-all" type="button"
          class="cookie-consent__button cookie-consent__button--primary">
          Aceitar todos
        </button>
        <button id="cookie-accept-essential" type="button"
          class="cookie-consent__button cookie-consent__button--secondary">
          Apenas essenciais
        </button>
      </div>

    </div>
  </div>

  <!-- JavaScript -->
  <script src="assets/scripts/home-script.js" defer></script>
  <script src="assets/scripts/components/script-header.js" defer></script>
</body>

</html>