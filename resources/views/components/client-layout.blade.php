<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'IronCore Engineering & Fabrication' }}</title>
    <meta name="description" content="{{ $meta ?? 'Precision industrial fabrication and CAD-driven engineering since 1987. Gas heads, AC components, and custom parts to ASME, AWS and AHRI standards.' }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;600;700;800;900&family=Barlow:wght@300;400;500&family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    /* ══════════════════════════════════════════════════════
       BLUEPRINT DESIGN SYSTEM — GLOBAL TOKENS & COMPONENTS
       All pages inherit these. Page-specific styles go in
       the {{ $styles ?? '' }} slot below.
    ══════════════════════════════════════════════════════ */

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
        background: var(--iron-900);
        color: var(--iron-200);
        font-family: 'Barlow', sans-serif;
        overflow-x: hidden;
    }

    /* ── GLOBAL ANIMATIONS ────────────────────────────── */
    @keyframes fadeUp   { from{opacity:0;transform:translateY(32px)} to{opacity:1;transform:translateY(0)} }
    @keyframes fadeLeft { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
    @keyframes ticker   { from{transform:translateX(0)} to{transform:translateX(-50%)} }
    @keyframes counterUp{ from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
    @keyframes scanline { 0%{top:-4px} 100%{top:100%} }
    @keyframes blink    { 0%,100%{opacity:1} 50%{opacity:0} }
    @keyframes barGrow  { from{transform:scaleX(0)} to{transform:scaleX(1)} }
    @keyframes pulseAccent {
        0%,100%{ box-shadow:0 0 0 0 rgba(245,158,11,0.4); }
        50%    { box-shadow:0 0 0 8px rgba(245,158,11,0); }
    }

    .anim-fadeUp   { animation: fadeUp   0.7s ease both; }
    .anim-fadeLeft { animation: fadeLeft 0.6s ease both; }
    .delay-1 { animation-delay:.15s; }
    .delay-2 { animation-delay:.30s; }
    .delay-3 { animation-delay:.45s; }
    .delay-4 { animation-delay:.60s; }
    .delay-5 { animation-delay:.75s; }

    /* ── NAV ──────────────────────────────────────────── */
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
        text-decoration:none;
        transition:background .2s, color .2s;
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
        transition:color .2s;
    }
    .nav-links a::after {
        content:''; position:absolute; bottom:0; left:0; right:0; height:2px;
        background:var(--amber); transform:scaleX(0); transform-origin:left;
        transition:transform .25s ease;
    }
    .nav-links a:hover,
    .nav-links a.active { color:#fff; }
    .nav-links a:hover::after,
    .nav-links a.active::after { transform:scaleX(1); }
    .nav-cta {
        background:var(--amber); color:var(--iron-900) !important;
        font-family:'Barlow Condensed',sans-serif; font-weight:700;
        font-size:.8rem; letter-spacing:.12em; text-transform:uppercase;
        padding:.5rem 1.25rem; text-decoration:none;
        transition:background .2s, transform .15s;
    }
    .nav-cta:hover { background:#d97706 !important; transform:translateY(-1px); }
    .nav-cta::after { display:none !important; }

    /* Mobile nav toggle */
    .nav-hamburger {
        display:none; flex-direction:column; gap:5px;
        background:none; border:none; cursor:pointer; padding:4px;
    }
    .nav-hamburger span {
        display:block; width:22px; height:2px;
        background:var(--iron-300); transition:all .25s;
    }
    .nav-mobile {
        display:none; position:fixed; top:64px; left:0; right:0;
        background:var(--iron-900); border-bottom:1px solid var(--iron-700);
        padding:1.5rem 2rem; z-index:99; flex-direction:column; gap:1rem;
    }
    .nav-mobile.open { display:flex; }
    .nav-mobile a {
        font-family:'Barlow Condensed',sans-serif; font-weight:600;
        font-size:1rem; letter-spacing:.15em; text-transform:uppercase;
        color:var(--iron-300); text-decoration:none; padding:.5rem 0;
        border-bottom:1px solid var(--iron-800);
        transition:color .2s;
    }
    .nav-mobile a:hover, .nav-mobile a.active { color:var(--amber); }
    .nav-mobile .nav-cta { text-align:center; margin-top:.5rem; }

    /* ── TICKER ───────────────────────────────────────── */
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

    /* ── GLOBAL BUTTONS ───────────────────────────────── */
    .btn-a {
        background:var(--amber); color:var(--iron-900);
        font-family:'Barlow Condensed',sans-serif; font-weight:700;
        font-size:.9rem; letter-spacing:.12em; text-transform:uppercase;
        padding:.8rem 2rem; text-decoration:none; display:inline-block;
        transition:background .2s, transform .15s;
    }
    .btn-a:hover { background:#d97706; transform:translateY(-2px); }
    .btn-b {
        border:1.5px solid var(--amber); color:var(--amber);
        font-family:'Barlow Condensed',sans-serif; font-weight:700;
        font-size:.9rem; letter-spacing:.12em; text-transform:uppercase;
        padding:.75rem 2rem; text-decoration:none; display:inline-block;
        transition:all .2s;
    }
    .btn-b:hover { background:var(--amber); color:var(--iron-900); }

    /* ── SHARED SECTION COMPONENTS ────────────────────── */
    .section-label {
        font-family:'Share Tech Mono',monospace; font-size:.65rem;
        color:var(--amber); letter-spacing:.2em; text-transform:uppercase;
        display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem;
    }
    .section-label::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }
    h2.section-title {
        font-family:'Barlow Condensed',sans-serif; font-weight:900;
        font-size:clamp(2.5rem,4vw,4rem); text-transform:uppercase;
        letter-spacing:-.01em; color:#fff; line-height:.95;
    }
    .hero-eyebrow {
        font-family:'Share Tech Mono',monospace; font-size:.65rem;
        color:var(--amber); letter-spacing:.2em; text-transform:uppercase;
        display:flex; align-items:center; gap:.75rem; margin-bottom:1.75rem;
    }
    .hero-eyebrow::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }

    /* ── STATS STRIP (shared across pages) ────────────── */
    .stats-strip {
        background:var(--iron-800);
        border-top:1px solid var(--iron-700); border-bottom:1px solid var(--iron-700);
        display:grid; grid-template-columns:repeat(4,1fr);
        gap:1px; background-color:var(--iron-700);
    }
    .stat-cell {
        background:var(--iron-800); padding:2.5rem 2rem; text-align:center;
        transition:background .2s; animation:counterUp .6s ease both;
    }
    .stat-cell:hover { background:var(--iron-900); }
    .stat-num {
        font-family:'Barlow Condensed',sans-serif; font-weight:900;
        font-size:3.5rem; color:var(--amber); line-height:1; letter-spacing:-.02em;
    }
    .stat-label {
        font-family:'Share Tech Mono',monospace; font-size:.6rem;
        color:var(--iron-400); letter-spacing:.15em; text-transform:uppercase; margin-top:.4rem;
    }

    /* ── DIAGONAL BREAK (shared) ──────────────────────── */
    .diag-break { height:120px; position:relative; overflow:hidden; background:var(--iron-900); }
    .diag-break::before {
        content:''; position:absolute; bottom:0; left:0; right:0; height:100%;
        background:var(--iron-800);
        clip-path:polygon(0 60%, 100% 0, 100% 100%, 0 100%);
    }

    /* ── CTA BAND (shared) ────────────────────────────── */
    .cta-band { background:var(--iron-900); padding:5rem; position:relative; overflow:hidden; }
    .cta-band::before {
        content:''; position:absolute; inset:0;
        background:repeating-linear-gradient(-45deg,transparent,transparent 16px,rgba(245,158,11,.04) 16px,rgba(245,158,11,.04) 18px);
        pointer-events:none;
    }
    .cta-inner {
        max-width:1400px; margin:0 auto;
        display:flex; align-items:center; justify-content:space-between; gap:3rem; position:relative;
    }
    .cta-text h2 {
        font-family:'Barlow Condensed',sans-serif; font-weight:900;
        font-size:clamp(2.5rem,4vw,4.5rem); color:#fff; line-height:.95; text-transform:uppercase;
    }
    .cta-text h2 span { color:var(--amber); }
    .cta-text p { color:var(--iron-400); font-size:.95rem; margin-top:1rem; max-width:400px; font-weight:300; }
    .cta-actions { display:flex; flex-direction:column; gap:1rem; flex-shrink:0; }

    /* ── FOOTER ───────────────────────────────────────── */
    footer {
        background:var(--iron-900); border-top:1px solid var(--iron-700);
        padding:3.5rem 5rem 2rem;
    }
    .footer-inner {
        max-width:1400px; margin:0 auto;
        display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:3rem; margin-bottom:3rem;
    }
    .footer-brand .wordmark {
        font-family:'Barlow Condensed',sans-serif; font-weight:900;
        font-size:1.5rem; color:#fff; text-transform:uppercase; letter-spacing:.1em;
    }
    .footer-brand p { font-size:.85rem; color:var(--iron-400); line-height:1.7; margin-top:1rem; font-weight:300; }
    .footer-col h4 {
        font-family:'Barlow Condensed',sans-serif; font-weight:700;
        font-size:.75rem; letter-spacing:.2em; text-transform:uppercase;
        color:var(--amber); margin-bottom:1.25rem;
    }
    .footer-col a {
        display:block; font-size:.85rem; color:var(--iron-400);
        text-decoration:none; margin-bottom:.6rem; transition:color .2s;
    }
    .footer-col a:hover { color:var(--amber); }
    .footer-bar {
        border-top:1px solid var(--iron-800); padding-top:1.5rem;
        display:flex; justify-content:space-between; align-items:center;
        max-width:1400px; margin:0 auto;
    }
    .footer-bar p { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.1em; }

    /* ── RESPONSIVE ───────────────────────────────────── */
    @media (max-width:900px) {
        .nav-links { display:none; }
        .nav-hamburger { display:flex; }
        .stats-strip { grid-template-columns:1fr 1fr; }
        .cta-band { padding:4rem 1.5rem; }
        .cta-inner { flex-direction:column; }
        footer { padding:3rem 1.5rem 1.5rem; }
        .footer-inner { grid-template-columns:1fr 1fr; }
    }
    @media (max-width:500px) {
        .footer-inner { grid-template-columns:1fr; }
        .stats-strip { grid-template-columns:1fr; }
    }
    </style>

    {{-- Per-page styles injected here --}}
    @stack('styles')
</head>
<body>

{{-- ── NAV ─────────────────────────────────────────────── --}}
<nav>
    <a href="{{ route('home') }}" class="nav-logo" style="text-decoration:none;">
        <div class="nav-logo-mark">IC</div>
        <div>
            <div class="nav-wordmark">IronCore</div>
            <div class="nav-sub">Engineering &amp; Fabrication</div>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}"     class="{{ request()->routeIs('home')    ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}"    class="{{ request()->routeIs('about')   ? 'active' : '' }}">About</a>
        <a href="{{ route('products') }}" class="{{ request()->routeIs('products*') ? 'active' : '' }}">Products</a>
        <a href="{{ route('news.index') }}"  class="{{ request()->routeIs('news*')   ? 'active' : '' }}">News</a>
        @auth
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">My Account</a>
        @endauth
        <a href="{{ route('quotation.index') }}" class="nav-cta">Request Quote</a>
    </div>

    {{-- Mobile hamburger --}}
    <button class="nav-hamburger" id="navToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</nav>

{{-- Mobile nav drawer --}}
<div class="nav-mobile" id="navMobile">
    <a href="{{ route('home') }}"        class="{{ request()->routeIs('home')      ? 'active' : '' }}">Home</a>
    <a href="{{ route('about') }}"       class="{{ request()->routeIs('about')     ? 'active' : '' }}">About</a>
    <a href="{{ route('products') }}"    class="{{ request()->routeIs('products*') ? 'active' : '' }}">Products</a>
    <a href="{{ route('news.index') }}"  class="{{ request()->routeIs('news*')     ? 'active' : '' }}">News</a>
    @auth
        <a href="{{ route('dashboard') }}">My Account</a>
    @endauth
    <a href="{{ route('quotation.index') }}" class="nav-cta">Request Quote</a>
</div>

{{-- ── TICKER ───────────────────────────────────────────── --}}
<div class="ticker-wrap" aria-hidden="true">
    <div class="ticker-track">
        <span class="ticker-item">ISO 9001:2015 Certified <span class="ticker-sep">///</span></span>
        <span class="ticker-item">Gas Heads &amp; Pressure Components <span class="ticker-sep">///</span></span>
        <span class="ticker-item">ASME B31.3 Compliant <span class="ticker-sep">///</span></span>
        <span class="ticker-item">35+ Years in Operation <span class="ticker-sep">///</span></span>
        <span class="ticker-item">Custom CAD-Driven Fabrication <span class="ticker-sep">///</span></span>
        <span class="ticker-item">AWS D1.1 Structural Welding <span class="ticker-sep">///</span></span>
        <span class="ticker-item">CNC Machining to ±0.001" <span class="ticker-sep">///</span></span>
        <span class="ticker-item">HVAC/R &amp; AC Components <span class="ticker-sep">///</span></span>
        {{-- Duplicate for seamless loop --}}
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

{{-- ── PAGE CONTENT ─────────────────────────────────────── --}}
<main>
    {{ $slot }}
</main>

{{-- ── FOOTER ──────────────────────────────────────────── --}}
<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <div class="wordmark">IronCore Engineering</div>
            <p>Industrial-grade manufacturing and precision engineering since 1987. Built to perform under the most demanding conditions.</p>
        </div>
        <div class="footer-col">
            <h4>Navigation</h4>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('products') }}">Products</a>
            <a href="{{ route('news.index') }}">News &amp; Insights</a>
            <a href="{{ route('quotation.index') }}">Request a Quote</a>
        </div>
        <div class="footer-col">
            <h4>Products</h4>
            <a href="{{ route('products', ['category' => 'gas-heads']) }}">Gas Heads</a>
            <a href="{{ route('products', ['category' => 'ac-components']) }}">AC Components</a>
            <a href="{{ route('products', ['category' => 'custom-parts']) }}">Custom Parts</a>
            <a href="{{ route('products', ['category' => 'pressure-vessels']) }}">Pressure Vessels</a>
        </div>
        <div class="footer-col">
            <h4>Contact</h4>
            <a href="https://maps.google.com" target="_blank">14 Industrial Drive, TX 77000</a>
            <a href="tel:+18005550198">+1 (800) 555-0198</a>
            <a href="mailto:info@ironcore-eng.com">info@ironcore-eng.com</a>
            @auth
                <a href="{{ route('dashboard') }}" style="margin-top:.5rem;color:var(--amber);">My Account →</a>
            @else
                <a href="{{ route('login') }}" style="margin-top:.5rem;">Client Login</a>
            @endauth
        </div>
    </div>
    <div class="footer-bar">
        <p>© {{ date('Y') }} IronCore Engineering &amp; Fabrication. All rights reserved.</p>
        <p>ISO 9001:2015 · ASME B31.3 · AWS D1.1 · AHRI 410</p>
    </div>
</footer>

{{-- ── GLOBAL SCRIPTS ───────────────────────────────────── --}}
<script>
// Mobile nav toggle
const navToggle = document.getElementById('navToggle');
const navMobile = document.getElementById('navMobile');
navToggle.addEventListener('click', () => {
    navMobile.classList.toggle('open');
});
// Close mobile nav on outside click
document.addEventListener('click', (e) => {
    if (!navToggle.contains(e.target) && !navMobile.contains(e.target)) {
        navMobile.classList.remove('open');
    }
});
</script>

{{-- Per-page scripts injected here --}}
@stack('scripts')
</body>
</html>