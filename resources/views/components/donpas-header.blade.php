@props([
    'eyebrow'     => '',
    'title'       => '',
    'highlight'   => '',
    'description' => '',
    'breadcrumbs' => [],
    'panel'       => null,
])

<style>
@keyframes fadeUp    { from{opacity:0;transform:translateY(32px)}  to{opacity:1;transform:translateY(0)} }
@keyframes fadeLeft  { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
@keyframes fadeRight { from{opacity:0;transform:translateX(24px)}  to{opacity:1;transform:translateX(0)} }
@keyframes glowPulse { 0%,100%{opacity:.3} 50%{opacity:.7} }

.page-header {
  padding-top:92px; min-height:280px;
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
.breadcrumb { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.15em; text-transform:uppercase; color:var(--iron-600); margin-bottom:1.25rem; display:flex; align-items:center; gap:.6rem; }
.breadcrumb a { color:var(--iron-600); text-decoration:none; transition:color .2s; }
.breadcrumb a:hover { color:var(--amber); }
.breadcrumb-sep { color:var(--iron-700); }
.breadcrumb-current { color:var(--amber); }
.page-header-eyebrow { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.75rem; margin-bottom:1rem; animation:fadeLeft .6s ease both; }
.page-header-eyebrow::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }
h1.page-title { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:clamp(3rem,5.5vw,5.5rem); line-height:.92; text-transform:uppercase; letter-spacing:-.02em; color:#fff; margin-bottom:1.25rem; animation:fadeUp .7s ease both .1s; }
h1.page-title span { color:var(--amber); }
.page-header-desc { font-size:.95rem; line-height:1.7; color:var(--iron-400); max-width:480px; font-weight:300; animation:fadeUp .7s ease both .2s; }
.page-header-panel { background:var(--iron-800); border:1px solid var(--iron-700); padding:1.75rem 2rem; min-width:260px; position:relative; overflow:hidden; animation:fadeRight .6s ease both .2s; }
.page-header-panel::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }
.panel-row { display:flex; justify-content:space-between; align-items:baseline; padding:.55rem 0; border-bottom:1px solid var(--iron-700); }
.panel-row:last-child { border-bottom:none; }
.panel-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-400); letter-spacing:.12em; text-transform:uppercase; }
.panel-val { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:var(--amber); }

@media(max-width:900px) {
  .page-header-inner { grid-template-columns:1fr; padding:3rem 1.5rem; }
  .page-header-panel { display:none; }
}
</style>

<section class="page-header">
  <div class="page-header-inner">
    <div>
      {{-- Breadcrumbs --}}
      @if(count($breadcrumbs))
        <div class="breadcrumb">
          @foreach($breadcrumbs as $i => $crumb)
            @if(isset($crumb['url']))
              <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
            @else
              <span class="breadcrumb-current">{{ $crumb['label'] }}</span>
            @endif
            @if($i < count($breadcrumbs) - 1)
              <span class="breadcrumb-sep">/</span>
            @endif
          @endforeach
        </div>
      @endif

      {{-- Eyebrow --}}
      @if($eyebrow)
        <div class="page-header-eyebrow">{{ $eyebrow }}</div>
      @endif

      {{-- Title --}}
      <h1 class="page-title">
        {{ $title }}<br>
        @if($highlight)<span>{{ $highlight }}</span>@endif
      </h1>

      {{-- Description --}}
      @if($description)
        <p class="page-header-desc">{{ $description }}</p>
      @endif
    </div>

    {{-- Optional panel slot --}}
    @if($panel)
      <div class="page-header-panel">
        {{ $panel }}
      </div>
    @endif
  </div>
</section>
