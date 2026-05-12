<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IronCore — {{ $title ?? 'Donpass IronCore' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;600;700;800;900&family=Barlow:wght@300;400;500&family=Share+Tech+Mono&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
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
  body { background:var(--iron-900); color:var(--iron-200); font-family:'Barlow',sans-serif; overflow-x:hidden; }

  @keyframes ticker { from{transform:translateX(0)} to{transform:translateX(-50%)} }

  /* ── NAV ── */
  nav {
    position:fixed; top:0; left:0; right:0; z-index:100;
    background:rgba(9,9,11,0.92); backdrop-filter:blur(12px);
    border-bottom:1px solid var(--iron-700);
    display:flex; align-items:center; justify-content:space-between;
    padding:0 2.5rem; height:64px;
  }
  .nav-logo { display:flex; align-items:center; gap:.75rem; }
  .nav-logo-mark { width:36px; height:36px; border:2px solid var(--amber); display:grid; place-items:center; font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.05em; transition:background .2s; text-decoration:none; }
  .nav-logo-mark:hover { background:var(--amber); color:var(--iron-900); }
  .nav-wordmark { font-family:'Barlow Condensed',sans-serif; font-size:1.25rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:#fff; }
  .nav-sub { font-size:.5rem; font-family:'Share Tech Mono',monospace; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; }
  .nav-links { display:flex; gap:2rem; align-items:center; }
  .nav-links a { font-family:'Barlow Condensed',sans-serif; font-weight:600; font-size:.8rem; letter-spacing:.15em; text-transform:uppercase; color:var(--iron-300); text-decoration:none; position:relative; padding-bottom:2px; transition:color .2s; }
  .nav-links a::after { content:''; position:absolute; bottom:0; left:0; right:0; height:2px; background:var(--amber); transform:scaleX(0); transform-origin:left; transition:transform .25s ease; }
  .nav-links a:hover { color:#fff; }
  .nav-links a:hover::after, .nav-links a.active::after { transform:scaleX(1); }
  .nav-links a.active { color:#fff; }
  .nav-cta { background:var(--amber) !important; color:var(--iron-900) !important; font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; padding:.5rem 1.25rem; text-decoration:none; transition:background .2s, transform .15s; }
  .nav-cta:hover { background:#d97706 !important; transform:translateY(-1px); }
  .nav-links .nav-cta::after { display:none !important; }
  .nav-toggle { display:none; flex-direction:column; gap:5px; cursor:pointer; background:none; border:none; padding:4px; }
  .nav-toggle span { display:block; width:24px; height:2px; background:var(--iron-300); transition:all .3s; }

  /* ── TICKER ── */
  .ticker-wrap { position:fixed; top:64px; left:0; right:0; z-index:99; background:var(--amber); height:28px; overflow:hidden; display:flex; align-items:center; }
  .ticker-track { display:flex; white-space:nowrap; animation:ticker 28s linear infinite; will-change:transform; }
  .ticker-item { font-family:'Share Tech Mono',monospace; font-size:.65rem; letter-spacing:.1em; text-transform:uppercase; color:var(--iron-900); padding:0 2.5rem; display:flex; align-items:center; gap:.75rem; }
  .ticker-sep { opacity:.4; }

  /* ── FOOTER ── */
  footer { background:var(--iron-900); border-top:1px solid var(--iron-700); padding:3.5rem 5rem 2rem; }
  .footer-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:3rem; margin-bottom:3rem; }
  .footer-brand .wordmark { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:1.5rem; color:#fff; text-transform:uppercase; letter-spacing:.1em; }
  .footer-brand p { font-size:.85rem; color:var(--iron-400); line-height:1.7; margin-top:1rem; font-weight:300; }
  .footer-col h4 { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.75rem; letter-spacing:.2em; text-transform:uppercase; color:var(--amber); margin-bottom:1.25rem; }
  .footer-col a { display:block; font-size:.85rem; color:var(--iron-400); text-decoration:none; margin-bottom:.6rem; transition:color .2s; }
  .footer-col a:hover { color:var(--amber); }
  .footer-bar { border-top:1px solid var(--iron-800); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; max-width:1400px; margin:0 auto; }
  .footer-bar p { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.1em; }

  /* ── RESPONSIVE ── */
  @media(max-width:900px) {
    nav { padding:0 1.5rem; }
    .nav-links { display:none; }
    .nav-toggle { display:flex; }
    footer { padding:3rem 1.5rem 1.5rem; }
    .footer-inner { grid-template-columns:1fr 1fr; }
  }
  @media(max-width:600px) {
    .footer-inner { grid-template-columns:1fr; }
  }
  .nav-links.open { display:flex; flex-direction:column; gap:0; position:fixed; top:92px; left:0; right:0; bottom:0; background:rgba(9,9,11,.97); backdrop-filter:blur(12px); padding:2rem; z-index:90; align-items:flex-start; }
  .nav-links.open a { padding:.75rem 0; border-bottom:1px solid var(--iron-800); width:100%; font-size:1.1rem; }
  </style>

  {{ $styles ?? '' }}

</head>
<body>

  <!-- NAV -->
  <nav>
    <div class="nav-logo">
      <a href="/home" class="nav-logo-mark">DIC</a>
      <div>
        <div class="nav-wordmark">Donpass IronCore</div>
        <div class="nav-sub">Engineering &amp; Fabrication</div>
      </div>
    </div>
    <div class="nav-links" id="navLinks">
      <a href="/home" {{ request()->is('home') ? 'class=active' : '' }}>Home</a>
      <a href="#">About</a>
      <a href="/guest" {{ request()->is('guest') ? 'class=active' : '' }}>Products</a>
      <a href="#">Services</a>
      <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.*') ? 'active nav-cta' : 'nav-cta' }}">My Cart</a>
      <a href="/login" class="nav-cta">Login</a>
    </div>
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
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

  <!-- PAGE CONTENT -->
  {{ $slot }}

  <!-- FOOTER -->
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
  </script>

{{ $scripts ?? '' }}

</body>
</html>
