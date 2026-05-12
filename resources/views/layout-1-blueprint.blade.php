<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IronCore — Layout 1: Blueprint</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;600;700;800;900&family=Barlow:wght@300;400;500&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>
  :root {
    --amber: #f59e0b;
    --amber-dim: #92600a;
    --amber-glow: rgba(245,158,11,0.15);
    --iron-900: #09090b;
    --iron-800: #18181b;
    --iron-700: #27272a;
    --iron-600: #3f3f46;
    --iron-400: #71717a;
    --iron-300: #a1a1aa;
    --iron-200: #d4d4d8;
  }

  * { margin:0; padding:0; box-sizing:border-box; }
  html { scroll-behavior: smooth; }
  body {
    background: var(--iron-900);
    color: var(--iron-200);
    font-family: 'Barlow', sans-serif;
    overflow-x: hidden;
  }

  /* ── ANIMATIONS ─────────────────────── */
  @keyframes fadeUp {
    from { opacity:0; transform:translateY(32px); }
    to   { opacity:1; transform:translateY(0); }
  }
  @keyframes fadeLeft {
    from { opacity:0; transform:translateX(-24px); }
    to   { opacity:1; transform:translateX(0); }
  }
  @keyframes ticker {
    from { transform: translateX(0); }
    to   { transform: translateX(-50%); }
  }
  @keyframes counterUp {
    from { opacity:0; transform:translateY(20px); }
    to   { opacity:1; transform:translateY(0); }
  }
  @keyframes scanline {
    0%  { top: -4px; }
    100%{ top: 100%; }
  }
  @keyframes blink {
    0%,100% { opacity:1; } 50% { opacity:0; }
  }
  @keyframes barGrow {
    from { transform: scaleX(0); }
    to   { transform: scaleX(1); }
  }
  @keyframes pulseAccent {
    0%,100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.4); }
    50%      { box-shadow: 0 0 0 8px rgba(245,158,11,0); }
  }

  .anim-fadeUp  { animation: fadeUp  0.7s ease both; }
  .anim-fadeLeft{ animation: fadeLeft 0.6s ease both; }
  .delay-1 { animation-delay:.15s; }
  .delay-2 { animation-delay:.30s; }
  .delay-3 { animation-delay:.45s; }
  .delay-4 { animation-delay:.60s; }
  .delay-5 { animation-delay:.75s; }

  /* ── NAV ─────────────────────────────── */
  nav {
    position: fixed; top:0; left:0; right:0; z-index:100;
    background: rgba(9,9,11,0.92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--iron-700);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 2.5rem; height: 64px;
  }
  .nav-logo {
    display:flex; align-items:center; gap:.75rem;
    font-family:'Barlow Condensed',sans-serif;
  }
  .nav-logo-mark {
    width:36px; height:36px;
    border:2px solid var(--amber);
    display:grid; place-items:center;
    font-family:'Share Tech Mono',monospace;
    font-size:.65rem; color:var(--amber);
    letter-spacing:.05em;
    transition: background .2s;
  }
  .nav-logo-mark:hover { background:var(--amber); color:var(--iron-900); }
  .nav-wordmark { font-size:1.25rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#fff; }
  .nav-sub { font-size:.5rem; font-family:'Share Tech Mono',monospace; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; }
  .nav-links { display:flex; gap:2rem; align-items:center; }
  .nav-links a {
    font-family:'Barlow Condensed',sans-serif; font-weight:600;
    font-size:.8rem; letter-spacing:.15em; text-transform:uppercase;
    color:var(--iron-300); text-decoration:none;
    position:relative; padding-bottom:2px;
    transition: color .2s;
  }
  .nav-links a::after {
    content:''; position:absolute; bottom:0; left:0; right:0; height:2px;
    background:var(--amber); transform:scaleX(0); transform-origin:left;
    transition:transform .25s ease;
  }
  .nav-links a:hover { color:#fff; }
  .nav-links a:hover::after { transform:scaleX(1); }
  .nav-cta {
    background:var(--amber); color:var(--iron-900);
    font-family:'Barlow Condensed',sans-serif; font-weight:700;
    font-size:.8rem; letter-spacing:.12em; text-transform:uppercase;
    padding:.5rem 1.25rem; text-decoration:none;
    transition: background .2s, transform .15s;
  }
  .nav-cta:hover { background:#d97706; transform:translateY(-1px); }

  /* ── TICKER ──────────────────────────── */
  .ticker-wrap {
    position:fixed; top:64px; left:0; right:0; z-index:99;
    background:var(--amber); height:28px;
    overflow:hidden; display:flex; align-items:center;
  }
  .ticker-track {
    display:flex; gap:0; white-space:nowrap;
    animation: ticker 28s linear infinite;
    will-change: transform;
  }
  .ticker-item {
    font-family:'Share Tech Mono',monospace; font-size:.65rem;
    letter-spacing:.1em; text-transform:uppercase; color:var(--iron-900);
    padding:0 2.5rem;
    display:flex; align-items:center; gap:.75rem;
  }
  .ticker-sep { opacity:.4; }

  /* ── HERO ────────────────────────────── */
  .hero {
    min-height: 100vh;
    padding-top: 92px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    position: relative;
    overflow: hidden;
  }
  .hero::before {
    content:'';
    position:absolute; inset:0;
    background: repeating-linear-gradient(
      90deg, transparent, transparent 59px,
      rgba(245,158,11,0.04) 59px, rgba(245,158,11,0.04) 60px
    ),
    repeating-linear-gradient(
      0deg, transparent, transparent 59px,
      rgba(245,158,11,0.04) 59px, rgba(245,158,11,0.04) 60px
    );
    pointer-events:none;
  }
  /* Diagonal divider */
  .hero::after {
    content:'';
    position:absolute; top:0; bottom:0; right:49%;
    width:120px;
    background: linear-gradient(to right, var(--iron-900) 0%, transparent 100%);
    z-index:2; pointer-events:none;
  }

  .hero-left {
    display:flex; flex-direction:column; justify-content:center;
    padding: 5rem 4rem 5rem 5rem;
    position:relative; z-index:3;
  }
  .hero-eyebrow {
    font-family:'Share Tech Mono',monospace; font-size:.65rem;
    color:var(--amber); letter-spacing:.2em; text-transform:uppercase;
    display:flex; align-items:center; gap:.75rem; margin-bottom:1.75rem;
  }
  .hero-eyebrow::before {
    content:''; display:block; width:32px; height:1px; background:var(--amber);
  }
  h1.hero-title {
    font-family:'Barlow Condensed',sans-serif; font-weight:900;
    font-size: clamp(4rem,7vw,7.5rem); line-height:.92;
    text-transform:uppercase; letter-spacing:-.02em;
    color:#fff; margin-bottom:2rem;
  }
  h1.hero-title span { color:var(--amber); display:block; }
  .hero-body {
    font-size:1rem; line-height:1.7; color:var(--iron-300);
    max-width:420px; margin-bottom:2.5rem; font-weight:300;
  }
  .hero-actions { display:flex; gap:1rem; flex-wrap:wrap; }
  .btn-a {
    background:var(--amber); color:var(--iron-900);
    font-family:'Barlow Condensed',sans-serif; font-weight:700;
    font-size:.9rem; letter-spacing:.12em; text-transform:uppercase;
    padding:.8rem 2rem; text-decoration:none;
    display:inline-block; transition:background .2s, transform .15s;
  }
  .btn-a:hover { background:#d97706; transform:translateY(-2px); }
  .btn-b {
    border:1.5px solid var(--amber); color:var(--amber);
    font-family:'Barlow Condensed',sans-serif; font-weight:700;
    font-size:.9rem; letter-spacing:.12em; text-transform:uppercase;
    padding:.75rem 2rem; text-decoration:none;
    display:inline-block; transition:all .2s;
  }
  .btn-b:hover { background:var(--amber); color:var(--iron-900); }

  .hero-right {
    position:relative; z-index:1;
    background:var(--iron-800);
    clip-path: polygon(8% 0, 100% 0, 100% 100%, 0% 100%);
    display:flex; align-items:center; justify-content:center;
    padding: 5rem 4rem 5rem 6rem;
  }
  /* Scanline overlay on right panel */
  .hero-right::after {
    content:'';
    position:absolute; left:0; right:0; height:3px;
    background:linear-gradient(90deg, transparent, rgba(245,158,11,0.3), transparent);
    animation: scanline 4s linear infinite;
    pointer-events:none;
  }

  .hero-specs {
    width:100%; display:flex; flex-direction:column; gap:1px;
    background:var(--iron-700);
  }
  .spec-row {
    background:var(--iron-800); padding:1.1rem 1.5rem;
    display:flex; justify-content:space-between; align-items:center;
    transition:background .2s;
  }
  .spec-row:hover { background:var(--iron-700); }
  .spec-label { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.12em; text-transform:uppercase; }
  .spec-val { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.1rem; color:#fff; letter-spacing:.05em; }
  .spec-bar {
    height:2px; background:var(--iron-700); margin-top:.5rem; overflow:hidden;
  }
  .spec-bar-fill {
    height:100%; background:var(--amber);
    transform-origin:left; animation:barGrow 1.2s ease both;
  }

  /* ── STATS STRIP ─────────────────────── */
  .stats-strip {
    background:var(--iron-800); border-top:1px solid var(--iron-700); border-bottom:1px solid var(--iron-700);
    display:grid; grid-template-columns:repeat(4,1fr);
    gap:1px; background-color:var(--iron-700);
  }
  .stat-cell {
    background:var(--iron-800); padding:2.5rem 2rem; text-align:center;
    transition:background .2s;
    animation: counterUp .6s ease both;
  }
  .stat-cell:hover { background:var(--iron-900); }
  .stat-num {
    font-family:'Barlow Condensed',sans-serif; font-weight:900;
    font-size:3.5rem; color:var(--amber); line-height:1;
    letter-spacing:-.02em;
  }
  .stat-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-400); letter-spacing:.15em; text-transform:uppercase; margin-top:.4rem; }

  /* ── CAPABILITIES ────────────────────── */
  .capabilities { padding:6rem 5rem; max-width:1400px; margin:0 auto; }
  .section-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:3.5rem; gap:2rem; }
  .section-label {
    font-family:'Share Tech Mono',monospace; font-size:.65rem;
    color:var(--amber); letter-spacing:.2em; text-transform:uppercase;
    display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem;
  }
  .section-label::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }
  h2.section-title {
    font-family:'Barlow Condensed',sans-serif; font-weight:900;
    font-size:clamp(2.5rem,4vw,4rem); text-transform:uppercase; letter-spacing:-.01em;
    color:#fff; line-height:.95;
  }

  /* Asymmetric capability grid */
  .cap-grid {
    display:grid;
    grid-template-columns: 2fr 1fr 1fr;
    grid-template-rows: auto auto;
    gap:1px; background:var(--iron-700);
  }
  .cap-card {
    background:var(--iron-800); padding:2.5rem;
    display:flex; flex-direction:column;
    transition:background .25s;
    position:relative; overflow:hidden;
  }
  .cap-card::before {
    content:''; position:absolute; top:0; left:0; right:0; height:2px;
    background:var(--amber); transform:scaleX(0); transform-origin:left;
    transition:transform .3s ease;
  }
  .cap-card:hover { background:var(--iron-700); }
  .cap-card:hover::before { transform:scaleX(1); }
  .cap-card.large { grid-row:span 2; }
  .cap-num {
    font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--iron-600);
    letter-spacing:.1em; margin-bottom:1.5rem;
  }
  .cap-icon { width:40px; height:40px; border:1px solid var(--iron-600); display:grid; place-items:center; margin-bottom:1.25rem; color:var(--iron-400); transition:all .3s; }
  .cap-card:hover .cap-icon { border-color:var(--amber); color:var(--amber); }
  .cap-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.3rem; color:#fff; margin-bottom:.75rem; letter-spacing:.02em; }
  .cap-desc { font-size:.85rem; line-height:1.7; color:var(--iron-400); flex:1; }
  .cap-card.large .cap-title { font-size:2rem; }
  .cap-card.large .cap-desc { font-size:.95rem; max-width:340px; }

  /* ── DIAGONAL BREAK ──────────────────── */
  .diag-break {
    height:120px; position:relative; overflow:hidden;
    background:var(--iron-900);
  }
  .diag-break::before {
    content:'';
    position:absolute; bottom:0; left:0; right:0; height:100%;
    background:var(--iron-800);
    clip-path:polygon(0 60%, 100% 0, 100% 100%, 0 100%);
  }

  /* ── PRODUCTS ────────────────────────── */
  .products { background:var(--iron-800); padding:6rem 5rem; }
  .products-inner { max-width:1400px; margin:0 auto; }

  .prod-scroll-wrap { overflow:hidden; }
  .prod-grid {
    display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem;
    margin-top:3rem;
  }
  .prod-card {
    background:var(--iron-900); border:1px solid var(--iron-700);
    position:relative; overflow:hidden;
    display:flex; flex-direction:column;
    transition:transform .25s, box-shadow .25s, border-color .25s;
  }
  .prod-card:hover { transform:translateY(-4px); box-shadow:0 16px 40px rgba(0,0,0,.5); border-color:var(--amber-dim); }
  .prod-card-top { height:4px; background:var(--iron-700); transition:background .3s; }
  .prod-card:hover .prod-card-top { background:var(--amber); }
  .prod-card-body { padding:2rem; flex:1; display:flex; flex-direction:column; }
  .prod-cat { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--amber); letter-spacing:.15em; text-transform:uppercase; border:1px solid rgba(245,158,11,.3); background:rgba(245,158,11,.05); padding:.3rem .7rem; display:inline-block; margin-bottom:1.25rem; }
  .prod-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.25rem; color:#fff; margin-bottom:.75rem; }
  .prod-desc { font-size:.85rem; line-height:1.65; color:var(--iron-400); flex:1; margin-bottom:1.5rem; }
  .prod-specs { border-top:1px solid var(--iron-700); padding-top:1.25rem; display:flex; flex-direction:column; gap:.4rem; margin-bottom:1.5rem; }
  .prod-spec { font-family:'Share Tech Mono',monospace; font-size:.62rem; color:var(--iron-400); display:flex; gap:.5rem; }
  .prod-spec::before { content:'▸'; color:var(--amber); flex-shrink:0; }
  .prod-link { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:var(--amber); text-decoration:none; display:flex; align-items:center; gap:.5rem; transition:gap .2s; }
  .prod-link:hover { gap:1rem; }

  /* ── PROCESS ─────────────────────────── */
  .process { padding:6rem 5rem; max-width:1400px; margin:0 auto; }
  .process-steps {
    display:grid; grid-template-columns:repeat(4,1fr);
    position:relative; margin-top:3rem;
  }
  .process-steps::before {
    content:''; position:absolute; top:2.5rem; left:12.5%; right:12.5%; height:1px;
    background:linear-gradient(90deg, var(--amber), var(--iron-600));
    z-index:0;
  }
  .step {
    display:flex; flex-direction:column; align-items:center; text-align:center;
    padding:0 1.5rem; position:relative; z-index:1;
    animation: counterUp .6s ease both;
  }
  .step-dot {
    width:48px; height:48px;
    background:var(--iron-800); border:2px solid var(--amber);
    display:grid; place-items:center; margin-bottom:1.5rem;
    font-family:'Share Tech Mono',monospace; font-size:.75rem; color:var(--amber);
    animation: pulseAccent 3s ease infinite;
    transition:background .2s, color .2s;
  }
  .step:hover .step-dot { background:var(--amber); color:var(--iron-900); }
  .step-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.1rem; color:#fff; margin-bottom:.5rem; }
  .step-desc { font-size:.8rem; line-height:1.6; color:var(--iron-400); }

  /* ── CTA BAND ────────────────────────── */
  .cta-band {
    background:var(--iron-900); padding:5rem;
    position:relative; overflow:hidden;
  }
  .cta-band::before {
    content:'';
    position:absolute; inset:0;
    background: repeating-linear-gradient(-45deg, transparent, transparent 16px, rgba(245,158,11,.04) 16px, rgba(245,158,11,.04) 18px);
    pointer-events:none;
  }
  .cta-inner { max-width:1400px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:3rem; position:relative; }
  .cta-text h2 { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:clamp(2.5rem,4vw,4.5rem); color:#fff; line-height:.95; text-transform:uppercase; }
  .cta-text h2 span { color:var(--amber); }
  .cta-text p { color:var(--iron-400); font-size:.95rem; margin-top:1rem; max-width:400px; font-weight:300; }
  .cta-actions { display:flex; flex-direction:column; gap:1rem; flex-shrink:0; }

  /* ── FOOTER ──────────────────────────── */
  footer {
    background:var(--iron-900); border-top:1px solid var(--iron-700);
    padding:3.5rem 5rem 2rem;
  }
  .footer-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:3rem; margin-bottom:3rem; }
  .footer-brand .wordmark { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:1.5rem; color:#fff; text-transform:uppercase; letter-spacing:.1em; }
  .footer-brand p { font-size:.85rem; color:var(--iron-400); line-height:1.7; margin-top:1rem; font-weight:300; }
  .footer-col h4 { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.75rem; letter-spacing:.2em; text-transform:uppercase; color:var(--amber); margin-bottom:1.25rem; }
  .footer-col a { display:block; font-size:.85rem; color:var(--iron-400); text-decoration:none; margin-bottom:.6rem; transition:color .2s; }
  .footer-col a:hover { color:var(--amber); }
  .footer-bar { border-top:1px solid var(--iron-800); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; max-width:1400px; margin:0 auto; }
  .footer-bar p { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.1em; }

  @media(max-width:900px) {
    .hero { grid-template-columns:1fr; }
    .hero-right { clip-path:none; padding:3rem 2rem; }
    .cap-grid { grid-template-columns:1fr; }
    .cap-card.large { grid-row:span 1; }
    .prod-grid { grid-template-columns:1fr; }
    .process-steps { grid-template-columns:1fr 1fr; }
    .stats-strip { grid-template-columns:1fr 1fr; }
    .hero-left { padding:3rem 2rem; }
    .capabilities,.products,.process,.cta-band,footer { padding:4rem 1.5rem; }
    .cta-inner { flex-direction:column; }
    .footer-inner { grid-template-columns:1fr 1fr; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-logo">
    <div class="nav-logo-mark">DIC</div>
    <div>
      <div class="nav-wordmark">Donpass IronCore</div>
      <div class="nav-sub">Engineering &amp; Fabrication</div>
    </div>
  </div>
  <div class="nav-links">
    <a href="{{route('home')}}">Home</a>
    <a href="#">About</a>
    <a href="{{route('cart.test')}}">Products</a>
    <a href="#">Services</a>
    <a href="{{route('cart.index')}}" class="nav-cta">My Cart</a>
    <a href="/login" class="nav-cta">Login</a>
  </div>
</nav>

<!-- TICKER -->
<div class="ticker-wrap">
  <div class="ticker-track">
    <span class="ticker-item">ISO 9001:2015 Certified <span class="ticker-sep">///</span></span>
    <span class="ticker-item">Gas Heads &amp; Pressure Components <span class="ticker-sep">///</span></span>
    <span class="ticker-item">ASME B31.3 Compliant <span class="ticker-sep">///</span></span>
    <span class="ticker-item">35+ Years in Operation <span class="ticker-sep">///</span></span>
    <span class="ticker-item">Custom CAD-Driven Fabrication <span class="ticker-sep">///</span></span>
    <span class="ticker-item">AWS D1.1 Structural Welding <span class="ticker-sep">///</span></span>
    <span class="ticker-item">CNC Machining to ±0.001" <span class="ticker-sep">///</span></span>
    <span class="ticker-item">HVAC/R &amp; AC Components <span class="ticker-sep">///</span></span>
    <!-- duplicate for seamless loop -->
    <span class="ticker-item">ISO 9001:2015 Certified <span class="ticker-sep">///</span></span>
    <span class="ticker-item">Gas Heads &amp; Pressure Components <span class="ticker-sep">///</span></span>
    <span class="ticker-item">ASME B31.3 Compliant <span class="ticker-sep">///</span></span>
    <span class="ticker-item">35+ Years in Operation <span class="ticker-sep">///</span></span>
    <span class="ticker-item">Custom CAD-Driven Fabrication <span class="ticker-sep">///</span></span>
    <span class="ticker-item">AWS D1.1 Structural Welding <span class="ticker-sep">///</span></span>
    <span class="ticker-item">CNC Machining to ±0.001" <span class="ticker-sep">///</span></span>
    <span class="ticker-item">HVAC/R &amp; AC Components <span class="ticker-sep">///</span></span>
  </div>
</div>

<!-- HERO -->
<section class="hero">
  <div class="hero-left">
    <div class="hero-eyebrow anim-fadeLeft">Ibafo — Ogun State, Nigeria</div>
    <h1 class="hero-title anim-fadeUp delay-1">
      PRECISION<br>
      <span>ENGINEERED</span>
      TO LAST.
    </h1>
    <p class="hero-body anim-fadeUp delay-2">Industrial fabrication and CAD-driven engineering for oil & gas, HVAC/R, and heavy industry. Gas heads, AC components, and custom parts built to the tightest spec.</p>
    <div class="hero-actions anim-fadeUp delay-3">
      <a href="#" class="btn-a">View Products</a>
      <a href="#core-capabilities" class="btn-b">Our Capabilities</a>
    </div>
  </div>
  <div class="hero-right">
    <div class="hero-specs anim-fadeUp delay-2">
      <div class="spec-row">
        <div>
          <div class="spec-label">Max Working Pressure</div>
          <div class="spec-val">4,000 PSI</div>
          <div class="spec-bar"><div class="spec-bar-fill" style="width:85%;animation-delay:.8s"></div></div>
        </div>
      </div>
      <div class="spec-row">
        <div>
          <div class="spec-label">CNC Tolerance</div>
          <div class="spec-val">±0.001"</div>
          <div class="spec-bar"><div class="spec-bar-fill" style="width:98%;animation-delay:.9s"></div></div>
        </div>
      </div>
      <div class="spec-row">
        <div>
          <div class="spec-label">Temp Range</div>
          <div class="spec-val">−320°F to +650°F</div>
          <div class="spec-bar"><div class="spec-bar-fill" style="width:90%;animation-delay:1s"></div></div>
        </div>
      </div>
      <div class="spec-row">
        <div>
          <div class="spec-label">Lead Time</div>
          <div class="spec-val">5 – 15 Working Days</div>
          <div class="spec-bar"><div class="spec-bar-fill" style="width:70%;animation-delay:1.1s"></div></div>
        </div>
      </div>
      <div class="spec-row">
        <div>
          <div class="spec-label">Certifications</div>
          <div class="spec-val">ISO · ASME · AWS · AHRI</div>
          <div class="spec-bar"><div class="spec-bar-fill" style="width:100%;animation-delay:1.2s"></div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-strip">
  <div class="stat-cell delay-1"><div class="stat-num">5+</div><div class="stat-label">Years in Operation</div></div>
  <div class="stat-cell delay-2"><div class="stat-num">200+</div><div class="stat-label">Parts Manufactured</div></div>
  <div class="stat-cell delay-3"><div class="stat-num">4K</div><div class="stat-label">Sq Ft Facility</div></div>
  <div class="stat-cell delay-4"><div class="stat-num">15+</div><div class="stat-label">Certified Engineers</div></div>
</div>

<!-- CAPABILITIES -->
<section class="capabilities" id="core-capabilities">
  <div class="section-header">
    <div>
      <div class="section-label">What We Do</div>
      <h2 class="section-title">Core<br>Capabilities</h2>
    </div>
    <p style="max-width:360px;font-size:.9rem;color:var(--iron-400);line-height:1.7;font-weight:300;">Full production cycle in-house — from CAD design through final pressure-test certification.</p>
  </div>

  <div class="cap-grid">
    <div class="cap-card large">
      <div class="cap-num">01 ////</div>
      <div class="cap-icon">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0H3"/></svg>
      </div>
      <div class="cap-title">CAD Engineering Design</div>
      <div class="cap-desc">Full-service engineering design using AutoCAD, SolidWorks, and Inventor. Every project starts with a detailed drawing reviewed and approved before a single cut is made. 3D models, tolerance stack-up analysis, and full documentation packages supplied.</div>
    </div>
    <div class="cap-card">
      <div class="cap-num">02 ////</div>
      <div class="cap-title">CNC Machining</div>
      <div class="cap-desc">Multi-axis turning &amp; milling to ±0.001"</div>
    </div>
    <div class="cap-card">
      <div class="cap-num">03 ////</div>
      <div class="cap-title">Custom Fabrication</div>
      <div class="cap-desc">MIG, TIG &amp; stick welding to AWS D1.1</div>
    </div>
    <div class="cap-card">
      <div class="cap-num">04 ////</div>
      <div class="cap-title">Gas Head Manufacturing</div>
      <div class="cap-desc">Pressure-rated to ASME B31.3</div>
    </div>
    <div class="cap-card">
      <div class="cap-num">05 ////</div>
      <div class="cap-title">AC Equipment Components</div>
      <div class="cap-desc">AHRI 410 compliant coil parts</div>
    </div>
  </div>
</section>

<!-- DIAGONAL BREAK -->
<div class="diag-break"></div>

<!-- PRODUCTS -->
<section class="products">
  <div class="products-inner">
    <div class="section-header">
      <div>
        <div class="section-label">Catalogue</div>
        <h2 class="section-title">Featured<br>Products</h2>
      </div>
      <a href="#" class="btn-b" style="align-self:flex-end;">View All</a>
    </div>
    <div class="prod-grid">
      <div class="prod-card">
        <div class="prod-card-top"></div>
        <div class="prod-card-body">
          <span class="prod-cat">Gas Heads</span>
          <div class="prod-title">GH-400 Series — High Pressure Gas Head</div>
          <div class="prod-desc">316L stainless steel bar stock. For natural gas, CO₂, and nitrogen distribution service.</div>
          <div class="prod-specs">
            <div class="prod-spec">Max. Working Pressure: 4,000 PSI</div>
            <div class="prod-spec">Temp Range: −20°F to +650°F</div>
            <div class="prod-spec">Thread: NPT 1/4" – 2"</div>
            <div class="prod-spec">Cert: ASME B31.3 · NACE MR0175</div>
          </div>
          <a href="#" class="prod-link">View Spec Sheet →</a>
        </div>
      </div>
      <div class="prod-card">
        <div class="prod-card-top"></div>
        <div class="prod-card-body">
          <span class="prod-cat">AC Components</span>
          <div class="prod-title">Coil Header Manifold — CM-Series</div>
          <div class="prod-desc">Copper-brazed manifold headers for HVAC/R evaporator and condenser coils.</div>
          <div class="prod-specs">
            <div class="prod-spec">Material: Copper C122</div>
            <div class="prod-spec">Design Pressure: 650 PSI</div>
            <div class="prod-spec">Refrigerant: R-32, R-410A, R-22</div>
            <div class="prod-spec">AHRI 410 Compliant</div>
          </div>
          <a href="#" class="prod-link">View Spec Sheet →</a>
        </div>
      </div>
      <div class="prod-card">
        <div class="prod-card-top"></div>
        <div class="prod-card-body">
          <span class="prod-cat">Custom Fabrication</span>
          <div class="prod-title">CNC Precision Machined Parts</div>
          <div class="prod-desc">Low-to-medium volume precision machining to customer drawings with full FAI documentation.</div>
          <div class="prod-specs">
            <div class="prod-spec">Tolerances: ±0.001" standard</div>
            <div class="prod-spec">Materials: Steel, SS, Aluminium, Brass</div>
            <div class="prod-spec">Max Part Size: 24" diameter</div>
            <div class="prod-spec">Volume: 1 – 5,000 pieces</div>
          </div>
          <a href="#" class="prod-link">View Spec Sheet →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROCESS -->
<section class="process">
  <div class="section-label">How It Works</div>
  <h2 class="section-title" style="margin-bottom:0;">From Brief to Delivery</h2>
  <div class="process-steps">
    <div class="step delay-1">
      <div class="step-dot">01</div>
      <div class="step-title">Consultation</div>
      <div class="step-desc">Technical requirements, material specs, compliance review</div>
    </div>
    <div class="step delay-2">
      <div class="step-dot">02</div>
      <div class="step-title">CAD Design</div>
      <div class="step-desc">Drawings and 3D models for client sign-off</div>
    </div>
    <div class="step delay-3">
      <div class="step-dot">03</div>
      <div class="step-title">Manufacture</div>
      <div class="step-desc">In-process CMM inspection throughout</div>
    </div>
    <div class="step delay-4">
      <div class="step-dot">04</div>
      <div class="step-title">Test &amp; Certify</div>
      <div class="step-desc">Pressure test, NDT, full documentation</div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="cta-inner">
    <div class="cta-text">
      <h2>READY TO SPEC<br><span>YOUR PROJECT?</span></h2>
      <p>Send drawings or describe your requirement. Technical response within 24 hours.</p>
    </div>
    <div class="cta-actions">
      <a href="{{route('enquiry.index')}}" class="btn-a">Make an Enquiry? </a>
      <a href="#" class="btn-b">Call +1 (800) 555-0198</a>
    </div>
  </div>
</section>

<!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <div class="footer-brand">
        <div class="wordmark">IronCore Engineering</div>
        <p>Industrial-grade manufacturing and precision engineering since 1987. Built to perform under the most demanding conditions.</p>
      </div>
      <div class="footer-col">
        <h4>Navigation</h4>
        <a href="/home">Home</a>
        <a href="#">About Us</a>
        <a href="/guest">Products</a>
        <a href="{{route('enquiry.index')}}">Contact</a>
      </div>
      <div class="footer-col">
        <h4>Products</h4>
        <a href="#">Gas Heads</a>
        <a href="#">AC Components</a>
        <a href="#">Custom Parts</a>
        <a href="#">Pressure Vessels</a>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <a href="#">34 Papa Sote, Ogun, Nigeria</a>
        <a href="#">+1 (800) 555-0198</a>
        <a href="#">info@ironcore-eng.example</a>
      </div>
    </div>
    <div class="footer-bar">
      <p>© 2026 Donpas Engineering &amp; Fabrication. Built by Uwem Paul All rights reserved.</p>
      <p>ISO 9001:2015 · ASME B31.3 · AWS D1.1</p>
    </div>
  </footer>

</body>
</html>
