<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IronCore — Products Catalogue</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;600;700;800;900&family=Barlow:wght@300;400;500&family=Share+Tech+Mono&display=swap" rel="stylesheet">
<style>

:root {
  --amber:      #f59e0b;
  --amber-dim:  #92600a;
  --amber-glow: rgba(245,158,11,0.15);
  --iron-900:   #09090b;
  --iron-800:   #18181b;
  --iron-700:   #27272a;
  --iron-600:   #3f3f46;
  --iron-400:   #71717a;
  --iron-300:   #a1a1aa;
  --iron-200:   #d4d4d8;
}

* { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior:smooth; }
body {
  background:var(--iron-900);
  color:var(--iron-200);
  font-family:'Barlow',sans-serif;
  overflow-x:hidden;
}

@keyframes fadeUp    { from{opacity:0;transform:translateY(32px)}  to{opacity:1;transform:translateY(0)} }
@keyframes fadeLeft  { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
@keyframes fadeRight { from{opacity:0;transform:translateX(24px)}  to{opacity:1;transform:translateX(0)} }
@keyframes ticker    { from{transform:translateX(0)} to{transform:translateX(-50%)} }
@keyframes scanline  { 0%{top:-4px} 100%{top:100%} }
@keyframes cardReveal { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
@keyframes glowPulse  { 0%,100%{opacity:.3} 50%{opacity:.7} }

.anim-fadeUp   { animation:fadeUp   0.7s ease both; }
.anim-fadeLeft { animation:fadeLeft 0.6s ease both; }
.anim-fadeRight{ animation:fadeRight 0.6s ease both; }
.delay-1 { animation-delay:.15s; }
.delay-2 { animation-delay:.30s; }
.delay-3 { animation-delay:.45s; }
.delay-4 { animation-delay:.60s; }

nav {
  position:fixed; top:0; left:0; right:0; z-index:100;
  background:rgba(9,9,11,0.92);
  backdrop-filter:blur(12px);
  border-bottom:1px solid var(--iron-700);
  display:flex; align-items:center; justify-content:space-between;
  padding:0 2.5rem; height:64px;
}
.nav-logo { display:flex; align-items:center; gap:.75rem; font-family:'Barlow Condensed',sans-serif; }
.nav-logo-mark {
  width:36px; height:36px;
  border:2px solid var(--amber);
  display:grid; place-items:center;
  font-family:'Share Tech Mono',monospace;
  font-size:.65rem; color:var(--amber); letter-spacing:.05em;
  transition:background .2s;
}
.nav-logo-mark:hover { background:var(--amber); color:var(--iron-900); }
.nav-wordmark { font-size:1.25rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#fff; }
.nav-sub { font-size:.5rem; font-family:'Share Tech Mono',monospace; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; }
.nav-links { display:flex; gap:2rem; align-items:center; }
.nav-links a {
  font-family:'Barlow Condensed',sans-serif; font-weight:600;
  font-size:.8rem; letter-spacing:.15em; text-transform:uppercase;
  color:var(--iron-300); text-decoration:none;
  position:relative; padding-bottom:2px; transition:color .2s;
}
.nav-links a::after {
  content:''; position:absolute; bottom:0; left:0; right:0; height:2px;
  background:var(--amber); transform:scaleX(0); transform-origin:left;
  transition:transform .25s ease;
}
.nav-links a:hover { color:#fff; }
.nav-links a:hover::after, .nav-links a.active::after { transform:scaleX(1); }
.nav-links a.active { color:#fff; }
.nav-cta {
  background:var(--amber); color:var(--iron-900);
  font-family:'Barlow Condensed',sans-serif; font-weight:700;
  font-size:.8rem; letter-spacing:.12em; text-transform:uppercase;
  padding:.5rem 1.25rem; text-decoration:none;
  transition:background .2s, transform .15s;
}
.nav-cta:hover { background:#d97706; transform:translateY(-1px); }
.nav-links .nav-cta::after { display:none; }
.nav-toggle {
  display:none; flex-direction:column; gap:5px; cursor:pointer;
  background:none; border:none; padding:4px;
}
.nav-toggle span { display:block; width:24px; height:2px; background:var(--iron-300); transition:all .3s; }

.ticker-wrap {
  position:fixed; top:64px; left:0; right:0; z-index:99;
  background:var(--amber); height:28px;
  overflow:hidden; display:flex; align-items:center;
}
.ticker-track {
  display:flex; white-space:nowrap;
  animation:ticker 28s linear infinite;
  will-change:transform;
}
.ticker-item {
  font-family:'Share Tech Mono',monospace; font-size:.65rem;
  letter-spacing:.1em; text-transform:uppercase; color:var(--iron-900);
  padding:0 2.5rem; display:flex; align-items:center; gap:.75rem;
}
.ticker-sep { opacity:.4; }

.page-header {
  padding-top:92px;
  min-height:320px;
  background:var(--iron-900);
  position:relative; overflow:hidden;
  display:flex; align-items:center;
}
.page-header::before {
  content:''; position:absolute; inset:0;
  background:
    repeating-linear-gradient(90deg, transparent, transparent 59px, rgba(245,158,11,.04) 59px, rgba(245,158,11,.04) 60px),
    repeating-linear-gradient(0deg,  transparent, transparent 59px, rgba(245,158,11,.04) 59px, rgba(245,158,11,.04) 60px);
  pointer-events:none;
}
.page-header::after {
  content:''; position:absolute; top:-120px; right:-80px;
  width:480px; height:480px;
  background:radial-gradient(circle, rgba(245,158,11,.08) 0%, transparent 70%);
  pointer-events:none; animation:glowPulse 5s ease infinite;
}
.page-header-inner {
  max-width:1400px; margin:0 auto; padding:3.5rem 5rem;
  position:relative; z-index:2; width:100%;
  display:grid; grid-template-columns:1fr auto; align-items:end; gap:3rem;
}
.breadcrumb {
  font-family:'Share Tech Mono',monospace; font-size:.6rem;
  letter-spacing:.15em; text-transform:uppercase;
  color:var(--iron-600); margin-bottom:1.25rem;
  display:flex; align-items:center; gap:.6rem;
}
.breadcrumb a { color:var(--iron-600); text-decoration:none; transition:color .2s; }
.breadcrumb a:hover { color:var(--amber); }
.breadcrumb-sep { color:var(--iron-700); }
.breadcrumb-current { color:var(--amber); }
.page-header-eyebrow {
  font-family:'Share Tech Mono',monospace; font-size:.65rem;
  color:var(--amber); letter-spacing:.2em; text-transform:uppercase;
  display:flex; align-items:center; gap:.75rem; margin-bottom:1rem;
}
.page-header-eyebrow::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }
h1.page-title {
  font-family:'Barlow Condensed',sans-serif; font-weight:900;
  font-size:clamp(3rem,5.5vw,5.5rem); line-height:.92;
  text-transform:uppercase; letter-spacing:-.02em;
  color:#fff; margin-bottom:1.25rem;
}
h1.page-title span { color:var(--amber); }
.page-header-desc { font-size:.95rem; line-height:1.7; color:var(--iron-400); max-width:480px; font-weight:300; }
.page-header-panel {
  background:var(--iron-800); border:1px solid var(--iron-700);
  padding:1.75rem 2rem; min-width:260px;
  position:relative; overflow:hidden;
}
.page-header-panel::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }
.panel-row { display:flex; justify-content:space-between; align-items:baseline; padding:.55rem 0; border-bottom:1px solid var(--iron-700); }
.panel-row:last-child { border-bottom:none; }
.panel-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-400); letter-spacing:.12em; text-transform:uppercase; }
.panel-val { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:var(--amber); }

.diag-break { height:80px; position:relative; overflow:hidden; background:var(--iron-900); }
.diag-break::before { content:''; position:absolute; bottom:0; left:0; right:0; height:100%; background:var(--iron-800); clip-path:polygon(0 60%, 100% 0, 100% 100%, 0 100%); }
.diag-break.inv { background:var(--iron-800); }
.diag-break.inv::before { background:var(--iron-900); clip-path:polygon(0 0, 100% 40%, 100% 100%, 0 100%); }

.filter-bar { background:var(--iron-800); border-bottom:1px solid var(--iron-700); position:sticky; top:92px; z-index:80; }
.filter-bar-inner {
  max-width:1400px; margin:0 auto; padding:0 5rem;
  display:flex; align-items:center; gap:0;
  overflow-x:auto; scrollbar-width:none;
}
.filter-bar-inner::-webkit-scrollbar { display:none; }
.filter-search { display:flex; align-items:center; gap:.6rem; border-right:1px solid var(--iron-700); padding:.85rem 1.5rem .85rem 0; flex-shrink:0; }
.filter-search input { background:none; border:none; outline:none; font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--iron-200); letter-spacing:.08em; width:180px; }
.filter-search input::placeholder { color:var(--iron-600); }
.filter-search svg { color:var(--iron-600); flex-shrink:0; }
.filter-tabs { display:flex; gap:0; }
.filter-tab {
  font-family:'Barlow Condensed',sans-serif; font-weight:700;
  font-size:.75rem; letter-spacing:.12em; text-transform:uppercase;
  color:var(--iron-400); padding:.85rem 1.5rem;
  cursor:pointer; border:none; background:none;
  border-right:1px solid var(--iron-700);
  transition:color .2s, background .2s; white-space:nowrap; position:relative;
}
.filter-tab::after { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:var(--amber); transform:scaleX(0); transform-origin:left; transition:transform .25s ease; }
.filter-tab:hover { color:#fff; background:var(--iron-700); }
.filter-tab.active { color:var(--amber); }
.filter-tab.active::after { transform:scaleX(1); }
.filter-count { margin-left:auto; font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.1em; text-transform:uppercase; padding:.85rem 0 .85rem 1.5rem; border-left:1px solid var(--iron-700); flex-shrink:0; white-space:nowrap; }
.filter-count strong { color:var(--amber); }

.products-page { background:var(--iron-800); padding:4rem 5rem 6rem; }
.products-page-inner { max-width:1400px; margin:0 auto; }
.section-label { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem; }
.section-label::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }
h2.section-title { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:clamp(2.5rem,4vw,4rem); text-transform:uppercase; letter-spacing:-.01em; color:#fff; line-height:.95; }
.products-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:3rem; gap:2rem; flex-wrap:wrap; }

/* ── PRODUCT GRID ── */
.prod-grid {
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1px;
  background:var(--iron-700);
}

/* ── PRODUCT CARD ── */
.prod-card {
  background:var(--iron-900);
  position:relative; overflow:hidden;
  display:flex; flex-direction:column;
  transition:transform .28s cubic-bezier(.4,0,.2,1), box-shadow .28s, background .2s;
  opacity:0; transform:translateY(24px);
}
.prod-card.visible { animation:cardReveal .55s ease both; }
.prod-card:hover { transform:translateY(-5px); box-shadow:0 20px 50px rgba(0,0,0,.6), 0 0 0 1px var(--amber-dim); z-index:2; }
.prod-card-top { height:3px; background:var(--iron-700); transition:background .3s; }
.prod-card:hover .prod-card-top { background:var(--amber); }
.prod-card::after {
  content:''; position:absolute; left:0; right:0; height:2px;
  background:linear-gradient(90deg,transparent,rgba(245,158,11,.25),transparent);
  top:-4px; opacity:0; transition:opacity .2s; pointer-events:none;
}
.prod-card:hover::after { opacity:1; animation:scanline 2.5s linear infinite; }

/* Image area */
.prod-card-img {
  height:200px; background:var(--iron-800);
  display:flex; align-items:center; justify-content:center;
  position:relative; overflow:hidden;
  border-bottom:1px solid var(--iron-700);
}
.prod-card-img img {
  width:100%; height:100%; object-fit:cover;
  transition:transform .4s ease, opacity .3s;
}
.prod-card:hover .prod-card-img img { transform:scale(1.05); }

/* Fallback icon when no image */
.prod-card-img-inner {
  display:flex; flex-direction:column; align-items:center; gap:.75rem;
}
.prod-card-img svg { color:var(--iron-600); transition:color .3s, transform .4s; }
.prod-card:hover .prod-card-img svg { color:var(--amber); transform:scale(1.08) rotate(3deg); }
.prod-card-img-label { font-family:'Share Tech Mono',monospace; font-size:.55rem; letter-spacing:.2em; text-transform:uppercase; color:var(--iron-600); transition:color .3s; }
.prod-card:hover .prod-card-img-label { color:var(--amber-dim); }

/* Corner crosshairs */
.prod-card-img::before {
  content:''; position:absolute; top:10px; left:10px;
  width:16px; height:16px;
  border-top:1px solid var(--iron-600); border-left:1px solid var(--iron-600);
  transition:border-color .3s, width .3s, height .3s; z-index:2;
}
.prod-card:hover .prod-card-img::before { border-color:var(--amber); width:22px; height:22px; }

/* Price badge */
.prod-price-badge {
  position:absolute; top:10px; right:10px;
  background:var(--amber); color:var(--iron-900);
  font-family:'Barlow Condensed',sans-serif; font-weight:700;
  font-size:.75rem; letter-spacing:.08em;
  padding:.3rem .65rem; z-index:2;
}

/* Stock badge */
.prod-stock-badge {
  position:absolute; bottom:10px; left:10px;
  font-family:'Share Tech Mono',monospace; font-size:.55rem;
  letter-spacing:.1em; text-transform:uppercase;
  padding:.25rem .6rem; z-index:2;
}
.prod-stock-badge.in-stock { background:rgba(34,197,94,.15); color:#4ade80; border:1px solid rgba(34,197,94,.3); }
.prod-stock-badge.low-stock { background:rgba(245,158,11,.15); color:var(--amber); border:1px solid rgba(245,158,11,.3); }
.prod-stock-badge.out-stock { background:rgba(239,68,68,.15); color:#f87171; border:1px solid rgba(239,68,68,.3); }

.prod-card-body { padding:1.75rem 2rem; flex:1; display:flex; flex-direction:column; }
.prod-cat {
  font-family:'Share Tech Mono',monospace; font-size:.6rem;
  color:var(--amber); letter-spacing:.15em; text-transform:uppercase;
  border:1px solid rgba(245,158,11,.3); background:rgba(245,158,11,.05);
  padding:.3rem .7rem; display:inline-block; margin-bottom:1.25rem;
}
.prod-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.25rem; color:#fff; margin-bottom:.6rem; letter-spacing:.02em; transition:color .2s; }
.prod-card:hover .prod-title { color:var(--amber); }
.prod-desc { font-size:.85rem; line-height:1.65; color:var(--iron-400); flex:1; margin-bottom:1.5rem; font-weight:300; }

.prod-card-footer {
  padding:1.25rem 2rem;
  border-top:1px solid var(--iron-700);
  display:flex; align-items:center; justify-content:space-between; gap:1rem;
  background:var(--iron-800); transition:background .2s;
}
.prod-card:hover .prod-card-footer { background:var(--iron-700); }
.prod-link { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:var(--amber); text-decoration:none; display:flex; align-items:center; gap:.5rem; transition:gap .2s; }
.prod-link:hover { gap:1rem; }
.btn-quote-sm { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; color:var(--iron-900); background:var(--amber); border:none; padding:.45rem 1rem; cursor:pointer; transition:background .2s, transform .15s; text-decoration:none; display:inline-block; }
.btn-quote-sm:hover { background:#d97706; transform:translateY(-1px); }

/* Empty state */
.empty-state { grid-column:1 / -1; background:var(--iron-900); padding:5rem 2rem; text-align:center; }
.empty-state-icon { width:64px; height:64px; border:2px dashed var(--iron-700); display:grid; place-items:center; margin:0 auto 1.5rem; color:var(--iron-600); }
.empty-state h3 { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.5rem; color:var(--iron-400); margin-bottom:.5rem; }
.empty-state p { font-size:.85rem; color:var(--iron-600); }

.specs-band { background:var(--iron-900); border-top:1px solid var(--iron-700); border-bottom:1px solid var(--iron-700); display:grid; grid-template-columns:repeat(4,1fr); gap:1px; background-color:var(--iron-700); }
.spec-cell { background:var(--iron-900); padding:2rem 2rem; display:flex; align-items:center; gap:1.25rem; transition:background .2s; animation:fadeUp .6s ease both; }
.spec-cell:hover { background:var(--iron-800); }
.spec-cell-icon { width:40px; height:40px; border:1px solid var(--iron-700); display:grid; place-items:center; flex-shrink:0; color:var(--amber); transition:all .3s; }
.spec-cell:hover .spec-cell-icon { border-color:var(--amber); background:var(--amber-glow); }
.spec-cell-val { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:1.5rem; color:var(--amber); line-height:1; }
.spec-cell-label { font-family:'Share Tech Mono',monospace; font-size:.58rem; color:var(--iron-600); letter-spacing:.12em; text-transform:uppercase; margin-top:.2rem; }

.cta-band { background:var(--iron-900); padding:5rem; position:relative; overflow:hidden; }
.cta-band::before { content:''; position:absolute; inset:0; background:repeating-linear-gradient(-45deg,transparent,transparent 16px,rgba(245,158,11,.04) 16px,rgba(245,158,11,.04) 18px); pointer-events:none; }
.cta-inner { max-width:1400px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:3rem; position:relative; }
.cta-text h2 { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:clamp(2.5rem,4vw,4.5rem); color:#fff; line-height:.95; text-transform:uppercase; }
.cta-text h2 span { color:var(--amber); }
.cta-text p { color:var(--iron-400); font-size:.95rem; margin-top:1rem; max-width:400px; font-weight:300; }
.cta-actions { display:flex; flex-direction:column; gap:1rem; flex-shrink:0; }
.btn-a { background:var(--amber); color:var(--iron-900); font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.9rem; letter-spacing:.12em; text-transform:uppercase; padding:.8rem 2rem; text-decoration:none; display:inline-block; transition:background .2s, transform .15s; }
.btn-a:hover { background:#d97706; transform:translateY(-2px); }
.btn-b { border:1.5px solid var(--amber); color:var(--amber); font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.9rem; letter-spacing:.12em; text-transform:uppercase; padding:.75rem 2rem; text-decoration:none; display:inline-block; transition:all .2s; }
.btn-b:hover { background:var(--amber); color:var(--iron-900); }

footer { background:var(--iron-900); border-top:1px solid var(--iron-700); padding:3.5rem 5rem 2rem; }
.footer-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:3rem; margin-bottom:3rem; }
.footer-brand .wordmark { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:1.5rem; color:#fff; text-transform:uppercase; letter-spacing:.1em; }
.footer-brand p { font-size:.85rem; color:var(--iron-400); line-height:1.7; margin-top:1rem; font-weight:300; }
.footer-col h4 { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.75rem; letter-spacing:.2em; text-transform:uppercase; color:var(--amber); margin-bottom:1.25rem; }
.footer-col a { display:block; font-size:.85rem; color:var(--iron-400); text-decoration:none; margin-bottom:.6rem; transition:color .2s; }
.footer-col a:hover { color:var(--amber); }
.footer-bar { border-top:1px solid var(--iron-800); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; max-width:1400px; margin:0 auto; }
.footer-bar p { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.1em; }

@media(max-width:1100px) {
  .prod-grid { grid-template-columns:repeat(2,1fr); }
  .specs-band { grid-template-columns:repeat(2,1fr); }
}
@media(max-width:900px) {
  .page-header-inner { grid-template-columns:1fr; padding:3rem 2rem; }
  .page-header-panel { display:none; }
  .filter-bar-inner { padding:0 1.5rem; }
  .products-page { padding:3rem 1.5rem 4rem; }
  .prod-grid { grid-template-columns:1fr; }
  .cta-band { padding:3rem 1.5rem; }
  .cta-inner { flex-direction:column; }
  footer { padding:3rem 1.5rem 1.5rem; }
  .footer-inner { grid-template-columns:1fr 1fr; }
  nav { padding:0 1.5rem; }
  .nav-links { display:none; }
  .nav-toggle { display:flex; }
}
@media(max-width:600px) {
  .specs-band { grid-template-columns:1fr; }
  .footer-inner { grid-template-columns:1fr; }
  h1.page-title { font-size:2.8rem; }
}
.nav-links.open {
  display:flex; flex-direction:column; gap:0;
  position:fixed; top:92px; left:0; right:0; bottom:0;
  background:rgba(9,9,11,.97); backdrop-filter:blur(12px);
  padding:2rem; z-index:90; align-items:flex-start; justify-content:flex-start;
}
.nav-links.open a { padding:.75rem 0; border-bottom:1px solid var(--iron-800); width:100%; font-size:1.1rem; }
</style>
</head>
<body>

<nav>
  <div class="nav-logo">
    <div class="nav-logo-mark">DIC</div>
    <div>
      <div class="nav-wordmark">Donpass IronCore</div>
      <div class="nav-sub">Engineering &amp; Fabrication</div>
    </div>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="/home">Home</a>
    <a href="#">About</a>
    <a href="/guest" class="active">Products</a>
    <a href="#">Services</a>
    <a href="{{ route('cart.index')}}" class="nav-cta">My Cart</a>
    <a href="/login" class="nav-cta">Login</a>
  </div>
  <button class="nav-toggle" id="navToggle" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

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

<section class="page-header">
  <div class="page-header-inner">
    <div>
      <div class="breadcrumb">
        <a href="/home">Home</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">Products</span>
      </div>
      <div class="page-header-eyebrow anim-fadeLeft">Product Catalogue</div>
      <h1 class="page-title anim-fadeUp delay-1">ALL<br><span>PRODUCTS</span></h1>
      <p class="page-header-desc anim-fadeUp delay-2">
        Precision-engineered components for oil &amp; gas, HVAC/R, and heavy industry.
        Built to ASME, ISO, and AWS standards — every part, every time.
      </p>
    </div>
    <div class="page-header-panel anim-fadeRight delay-2">
      <div class="panel-row">
        <span class="panel-label">Total SKUs</span>
        <span class="panel-val">{{ $products->count() }}</span>
      </div>
      <div class="panel-row">
        <span class="panel-label">Categories</span>
        <span class="panel-val">{{ $products->pluck('categories_id')->unique()->count() }}</span>
      </div>
      <div class="panel-row">
        <span class="panel-label">Lead Time</span>
        <span class="panel-val">5–15 Days</span>
      </div>
      <div class="panel-row">
        <span class="panel-label">Standards</span>
        <span class="panel-val">ISO · ASME · AWS</span>
      </div>
    </div>
  </div>
</section>

<div class="filter-bar">
  <div class="filter-bar-inner">
    <div class="filter-search">
      <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
        <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/>
      </svg>
      <input type="text" placeholder="Search products…" id="searchInput" />
    </div>
    <div class="filter-tabs">
      <button class="filter-tab active" data-cat="all">All</button>
      <button class="filter-tab" data-cat="gas-heads">Gas Heads</button>
      <button class="filter-tab" data-cat="ac-components">AC Components</button>
      <button class="filter-tab" data-cat="custom-parts">Custom Parts</button>
      <button class="filter-tab" data-cat="pressure-vessels">Pressure Vessels</button>
      <button class="filter-tab" data-cat="structural">Structural</button>
    </div>
    <div class="filter-count">
      Showing <strong id="visibleCount">{{ $products->count() }}</strong> products
    </div>
  </div>
</div>

<section class="products-page">
  <div class="products-page-inner">

    <div class="products-header">
      <div>
        <div class="section-label">Catalogue</div>
        <h2 class="section-title">Engineered<br>Components</h2>
      </div>
      <a href="{{ route('enquiry.index') }}" class="btn-b" style="align-self:flex-end;">Send an Enquiry</a>
    </div>

    <div class="prod-grid" id="prodGrid">

      @if($products->isEmpty())
        <div class="empty-state">
          <div class="empty-state-icon">
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
          </div>
          <h3>No products found</h3>
          <p>Check back soon or send us an enquiry for custom parts.</p>
        </div>

      @else
        @foreach($products as $product)
          <div class="prod-card" data-cat="{{ Str::slug($product->category->name ?? 'general') }}">
            <div class="prod-card-top"></div>

            {{-- Product Image --}}
            <form action="{{route('cart.add', $product->id) }}" method="POST">
                  @csrf
                  
                  <div class="prod-card-img">
                  @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                  @else
                    <div class="prod-card-img-inner">
                      <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
                      </svg>
                      <span class="prod-card-img-label">{{ $product->name }}</span>
                    </div>
                  @endif

                  {{-- Price badge --}}
                  @if($product->price)
                    <div class="prod-price-badge">₦{{ number_format($product->price, 2) }}</div>
                  @endif

                  {{-- Stock badge --}}
                  @if($product->stock_quantity > 10)
                    <div class="prod-stock-badge in-stock">In Stock</div>
                  @elseif($product->stock_quantity > 0)
                    <div class="prod-stock-badge low-stock">Low Stock · {{ $product->stock_quantity }} left</div>
                  @else
                    <div class="prod-stock-badge out-stock">Out of Stock</div>
                  @endif
                </div>

                <div class="prod-card-body">
                  {{-- Category --}}
                  <span class="prod-cat">{{ $product->category->name ?? 'General' }}</span>

                  {{-- Name --}}
                  <div class="prod-title">{{ $product->name }}</div>

                  {{-- Description --}}
                  <div class="prod-desc">{{ Str::limit($product->description, 120) }}</div>
                </div>

                
                <div class="prod-card-footer">
                  <div>
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" min:1 placeholder="quantity">
                  </div>
                  <a href="{{route('product.show', $product->slug)}}" class="prod-link">View Details →</a>
                  @if($product->is_active)
                      <button class="btn-quote-sm">Add to Cart</button>
                  @else
                    <span style="font-family:'Share Tech Mono',monospace;font-size:.6rem;color:var(--iron-600);letter-spacing:.1em;">UNAVAILABLE</span>
                  @endif
              </div>
            </form>
          </div>
        @endforeach
      @endif

      {{-- JS-controlled empty state for filter --}}
      <div class="empty-state" id="emptyState" style="display:none;">
        <div class="empty-state-icon">
          <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
          </svg>
        </div>
        <h3>No products found</h3>
        <p>Try a different category or clear your search.</p>
      </div>

    </div>
  </div>
</section>

<div class="specs-band">
  <div class="spec-cell delay-1">
    <div class="spec-cell-icon">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
    </div>
    <div class="spec-cell-text">
      <div class="spec-cell-val">ISO 9001</div>
      <div class="spec-cell-label">Quality Management</div>
    </div>
  </div>
  <div class="spec-cell delay-2">
    <div class="spec-cell-icon">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
    </div>
    <div class="spec-cell-text">
      <div class="spec-cell-val">4,000 PSI</div>
      <div class="spec-cell-label">Max Working Pressure</div>
    </div>
  </div>
  <div class="spec-cell delay-3">
    <div class="spec-cell-icon">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
    </div>
    <div class="spec-cell-text">
      <div class="spec-cell-val">5–15 Days</div>
      <div class="spec-cell-label">Standard Lead Time</div>
    </div>
  </div>
  <div class="spec-cell delay-4">
    <div class="spec-cell-icon">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0zm-9 5.25h.008v.008H12v-.008z"/></svg>
    </div>
    <div class="spec-cell-text">
      <div class="spec-cell-val">±0.001"</div>
      <div class="spec-cell-label">CNC Tolerance</div>
    </div>
  </div>
</div>

<div class="diag-break inv"></div>

<section class="cta-band">
  <div class="cta-inner">
    <div class="cta-text">
      <h2>CAN'T FIND<br><span>WHAT YOU NEED?</span></h2>
      <p>Send your drawing or describe your requirement. Our engineers will respond within 24 hours with a technical proposal.</p>
    </div>
    <div class="cta-actions">
      <a href="{{ route('cart.index') }}" class="btn-a">My Cart [ {{count(session()->get('cart', []))}} ]</a>
      <a href="{{ route('enquiry.index') }}" class="btn-b">Send an Enquiry</a>
    </div>
  </div>
</section>

<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="wordmark">IronCore Engineering</div>
      <p>Industrial-grade manufacturing and precision engineering. Built to perform under the most demanding conditions.</p>
    </div>
    <div class="footer-col">
      <h4>Navigation</h4>
      <a href="/home">Home</a>
      <a href="#">About Us</a>
      <a href="/guest">Products</a>
      <a href="{{ route('enquiry.index') }}">Contact</a>
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
      <a href="#">+234 (0) 800 000 0000</a>
      <a href="#">info@donpass-ironcore.example</a>
    </div>
  </div>
  <div class="footer-bar">
    <p>© 2025 IronCore Engineering &amp; Fabrication. Built by Uwem Paul. All rights reserved.</p>
    <p>ISO 9001:2015 · ASME B31.3 · AWS D1.1</p>
  </div>
</footer>

<script>
const navToggle = document.getElementById('navToggle');
const navLinks  = document.getElementById('navLinks');
navToggle.addEventListener('click', () => navLinks.classList.toggle('open'));

const cards = document.querySelectorAll('.prod-card');
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      setTimeout(() => {
        entry.target.classList.add('visible');
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }, (Array.from(cards).indexOf(entry.target) % 3) * 80);
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });
cards.forEach(c => observer.observe(c));

const tabs       = document.querySelectorAll('.filter-tab');
const allCards   = document.querySelectorAll('.prod-card');
const emptyState = document.getElementById('emptyState');
const countEl    = document.getElementById('visibleCount');

function filterProducts(cat, query) {
  let visible = 0;
  allCards.forEach(card => {
    const matchCat   = cat === 'all' || card.dataset.cat === cat;
    const matchQuery = !query || card.innerText.toLowerCase().includes(query.toLowerCase());
    const show = matchCat && matchQuery;
    card.style.display = show ? 'flex' : 'none';
    if (show) visible++;
  });
  emptyState.style.display = visible === 0 ? 'block' : 'none';
  countEl.textContent = visible;
}

let currentCat = 'all';
tabs.forEach(tab => {
  tab.addEventListener('click', () => {
    tabs.forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    currentCat = tab.dataset.cat;
    filterProducts(currentCat, document.getElementById('searchInput').value);
  });
});

document.getElementById('searchInput').addEventListener('input', e => {
  filterProducts(currentCat, e.target.value);
});
</script>

</body>
</html>