<x-donpas-layout title="{{ $product->name }}">

  <x-slot name="styles">
  <style>
  @keyframes fadeUp    { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
  @keyframes fadeLeft  { from{opacity:0;transform:translateX(-24px)} to{opacity:1;transform:translateX(0)} }
  @keyframes fadeRight { from{opacity:0;transform:translateX(24px)}  to{opacity:1;transform:translateX(0)} }
  @keyframes glowPulse { 0%,100%{opacity:.3} 50%{opacity:.7} }
  @keyframes scanline  { 0%{top:-4px} 100%{top:100%} }

  /* ── PAGE HEADER (slim) ── */
  .page-header {
    padding-top:92px; min-height:180px;
    background:var(--iron-900); position:relative; overflow:hidden; display:flex; align-items:center;
  }
  .page-header::before {
    content:''; position:absolute; inset:0;
    background:
      repeating-linear-gradient(90deg,transparent,transparent 59px,rgba(245,158,11,.04) 59px,rgba(245,158,11,.04) 60px),
      repeating-linear-gradient(0deg,transparent,transparent 59px,rgba(245,158,11,.04) 59px,rgba(245,158,11,.04) 60px);
    pointer-events:none;
  }
  .page-header::after { content:''; position:absolute; top:-120px; right:-80px; width:400px; height:400px; background:radial-gradient(circle,rgba(245,158,11,.07) 0%,transparent 70%); pointer-events:none; animation:glowPulse 5s ease infinite; }
  .page-header-inner { max-width:1400px; margin:0 auto; padding:2.5rem 5rem; position:relative; z-index:2; width:100%; }
  .breadcrumb { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.15em; text-transform:uppercase; color:var(--iron-600); margin-bottom:1rem; display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; }
  .breadcrumb a { color:var(--iron-600); text-decoration:none; transition:color .2s; }
  .breadcrumb a:hover { color:var(--amber); }
  .breadcrumb-sep { color:var(--iron-700); }
  .breadcrumb-current { color:var(--amber); }
  .page-eyebrow { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.75rem; animation:fadeLeft .5s ease both; }
  .page-eyebrow::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }

  /* ── PRODUCT SECTION ── */
  .product-section { background:var(--iron-800); padding:4rem 5rem 6rem; }
  .product-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:start; }

  /* ── IMAGE PANEL ── */
  .product-image-panel { position:sticky; top:108px; }
  .product-image-wrap {
    background:var(--iron-900); border:1px solid var(--iron-700);
    position:relative; overflow:hidden;
    aspect-ratio:4/3; display:flex; align-items:center; justify-content:center;
    animation:fadeLeft .6s ease both;
  }
  .product-image-wrap::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }

  /* Scanline hover on image */
  .product-image-wrap::after {
    content:''; position:absolute; left:0; right:0; height:2px;
    background:linear-gradient(90deg,transparent,rgba(245,158,11,.3),transparent);
    top:-4px; opacity:0; transition:opacity .3s; pointer-events:none;
  }
  .product-image-wrap:hover::after { opacity:1; animation:scanline 3s linear infinite; }

  .product-image-wrap img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .5s ease; }
  .product-image-wrap:hover img { transform:scale(1.03); }

  /* Corner crosshairs */
  .crosshair { position:absolute; width:20px; height:20px; z-index:2; transition:width .3s, height .3s; }
  .crosshair.tl { top:12px; left:12px; border-top:1px solid var(--iron-600); border-left:1px solid var(--iron-600); }
  .crosshair.br { bottom:12px; right:12px; border-bottom:1px solid var(--iron-600); border-right:1px solid var(--iron-600); }
  .product-image-wrap:hover .crosshair { width:28px; height:28px; }
  .product-image-wrap:hover .crosshair.tl, .product-image-wrap:hover .crosshair.br { border-color:var(--amber); }

  /* No image fallback */
  .product-no-image { display:flex; flex-direction:column; align-items:center; gap:1rem; color:var(--iron-600); }
  .product-no-image svg { transition:color .3s; }
  .product-no-image span { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.2em; text-transform:uppercase; }

  /* Badges row */
  .product-badges { display:flex; gap:.75rem; margin-top:1.25rem; flex-wrap:wrap; animation:fadeUp .6s ease both .1s; }
  .badge { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.12em; text-transform:uppercase; padding:.35rem .85rem; }
  .badge-stock-in  { background:rgba(34,197,94,.1); color:#4ade80; border:1px solid rgba(34,197,94,.3); }
  .badge-stock-low { background:rgba(245,158,11,.1); color:var(--amber); border:1px solid rgba(245,158,11,.3); }
  .badge-stock-out { background:rgba(239,68,68,.1); color:#f87171; border:1px solid rgba(239,68,68,.3); }
  .badge-active    { background:rgba(34,197,94,.08); color:#4ade80; border:1px solid rgba(34,197,94,.2); }
  .badge-inactive  { background:rgba(239,68,68,.08); color:#f87171; border:1px solid rgba(239,68,68,.2); }
  .badge-cat       { background:rgba(245,158,11,.06); color:var(--amber); border:1px solid rgba(245,158,11,.2); }

  /* ── INFO PANEL ── */
  .product-info { animation:fadeRight .6s ease both .1s; }

  .product-cat-tag { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--amber); letter-spacing:.15em; text-transform:uppercase; border:1px solid rgba(245,158,11,.3); background:rgba(245,158,11,.05); padding:.3rem .8rem; display:inline-block; margin-bottom:1.25rem; }

  h1.product-name { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:clamp(2rem,4vw,3.5rem); line-height:.95; text-transform:uppercase; letter-spacing:-.01em; color:#fff; margin-bottom:1.5rem; }

  .product-desc { font-size:.95rem; line-height:1.75; color:var(--iron-400); font-weight:300; margin-bottom:2rem; padding-bottom:2rem; border-bottom:1px solid var(--iron-700); }

  /* Price block */
  .product-price-block { display:flex; align-items:baseline; gap:1rem; margin-bottom:2rem; }
  .product-price { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:2.75rem; color:var(--amber); line-height:1; }
  .product-price-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.12em; text-transform:uppercase; }

  /* Spec table */
  .spec-table { width:100%; border-collapse:collapse; margin-bottom:2rem; }
  .spec-table tr { border-bottom:1px solid var(--iron-700); }
  .spec-table tr:first-child { border-top:1px solid var(--iron-700); }
  .spec-table td { padding:.85rem 0; font-size:.875rem; vertical-align:top; }
  .spec-table .spec-key { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.12em; text-transform:uppercase; color:var(--iron-600); width:40%; padding-right:1rem; }
  .spec-table .spec-val { color:var(--iron-200); font-weight:500; }
  .spec-table .spec-val::before { content:'▸'; color:var(--amber); margin-right:.5rem; font-size:.7rem; }

  /* Quantity + CTA */
  .product-actions { display:flex; flex-direction:column; gap:1rem; }
  .qty-row { display:flex; align-items:center; gap:1rem; }
  .qty-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-600); letter-spacing:.12em; text-transform:uppercase; }
  .qty-control { display:flex; align-items:center; border:1.5px solid var(--iron-700); }
  .qty-btn { width:36px; height:36px; background:none; border:none; color:var(--iron-400); font-size:1.1rem; cursor:pointer; transition:background .2s, color .2s; display:grid; place-items:center; }
  .qty-btn:hover { background:var(--iron-700); color:var(--amber); }
  .qty-display { width:52px; height:36px; background:none; border:none; border-left:1.5px solid var(--iron-700); border-right:1.5px solid var(--iron-700); color:var(--iron-200); font-family:'Share Tech Mono',monospace; font-size:.8rem; text-align:center; outline:none; -moz-appearance:textfield; }
  .qty-display::-webkit-outer-spin-button, .qty-display::-webkit-inner-spin-button { -webkit-appearance:none; }

  .btn-add-cart { width:100%; padding:1rem; background:var(--amber); color:var(--iron-900); font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; letter-spacing:.12em; text-transform:uppercase; border:none; cursor:pointer; transition:background .2s, transform .15s; text-decoration:none; display:block; text-align:center; }
  .btn-add-cart:hover { background:#d97706; transform:translateY(-2px); }
  .btn-add-cart:disabled { background:var(--iron-700); color:var(--iron-600); cursor:not-allowed; transform:none; }
  .btn-enquire { width:100%; padding:.9rem; background:none; border:1.5px solid var(--iron-700); color:var(--iron-400); font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.9rem; letter-spacing:.12em; text-transform:uppercase; cursor:pointer; transition:all .2s; text-decoration:none; display:block; text-align:center; }
  .btn-enquire:hover { border-color:var(--amber); color:var(--amber); }

  /* ── RELATED / BOTTOM SECTION ── */
  .product-meta-band {
    background:var(--iron-900); border-top:1px solid var(--iron-700);
    padding:3rem 5rem;
  }
  .product-meta-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:repeat(3,1fr); gap:1px; background:var(--iron-700); }
  .meta-cell { background:var(--iron-900); padding:2rem; }
  .meta-cell-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--amber); letter-spacing:.15em; text-transform:uppercase; margin-bottom:.75rem; display:flex; align-items:center; gap:.5rem; }
  .meta-cell-label::before { content:''; display:block; width:16px; height:1px; background:var(--amber); }
  .meta-cell-val { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.1rem; color:#fff; }
  .meta-cell-sub { font-size:.8rem; color:var(--iron-400); margin-top:.25rem; font-weight:300; }

  @media(max-width:1024px) {
    .product-inner { grid-template-columns:1fr; gap:2.5rem; }
    .product-image-panel { position:static; }
    .product-section { padding:3rem 1.5rem 4rem; }
    .product-meta-band { padding:2rem 1.5rem; }
    .product-meta-inner { grid-template-columns:1fr; }
    .page-header-inner { padding:2.5rem 1.5rem; }
  }
  @media(max-width:600px) {
    h1.product-name { font-size:2rem; }
    .product-price { font-size:2rem; }
  }
  </style>
  </x-slot>

  {{-- ── PAGE HEADER ── --}}
  <section class="page-header">
    <div class="page-header-inner">
      <div class="breadcrumb">
        <a href="/home">Home</a>
        <span class="breadcrumb-sep">/</span>
        <a href="/guest">Products</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">{{ $product->name }}</span>
      </div>
      <div class="page-eyebrow">{{ $product->category->name ?? 'Product Detail' }}</div>
    </div>
  </section>

  {{-- ── PRODUCT SECTION ── --}}
  <section class="product-section">
    <div class="product-inner">

      {{-- ── IMAGE PANEL ── --}}
      <div class="product-image-panel">
        <div class="product-image-wrap">
          <div class="crosshair tl"></div>
          <div class="crosshair br"></div>

          @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
          @else
            <div class="product-no-image">
              <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z"/>
              </svg>
              <span>No image available</span>
            </div>
          @endif
        </div>

        {{-- Badges --}}
        <div class="product-badges">
          @if($product->quantity > 10)
            <span class="badge badge-stock-in">In Stock</span>
            <!-- 11>0  bad logic might break-->
          @elseif($product->quantity > 0)
            <span class="badge badge-stock-low">Low Stock · {{ $product->quantity }} left</span>
          @else
            <span class="badge badge-stock-out">Out of Stock</span>
          @endif

          @if($product->is_active)
            <span class="badge badge-active">Active</span>
          @else
            <span class="badge badge-inactive">Unavailable</span>
          @endif

          @if($product->category)
            <span class="badge badge-cat">{{ $product->category->name }}</span>
          @endif
        </div>
      </div>

      {{-- ── INFO PANEL ── --}}
      <div class="product-info">

        <span class="product-cat-tag">{{ $product->category->name ?? 'General' }}</span>

        <h1 class="product-name">{{ $product->name }}</h1>

        <p class="product-desc">{{ $product->description }}</p>

        {{-- Price --}}
        <div class="product-price-block">
          <div class="product-price">₦{{ number_format($product->price, 2) }}</div>
          <div class="product-price-label">Nigerian Naira<br>Excl. shipping</div>
        </div>

        {{-- Spec table --}}
        <table class="spec-table">
          <tr>
            <td class="spec-key">SKU / ID</td>
            <td class="spec-val">{{ $product->slug ?? 'PRD-' . str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</td>
          </tr>
          <tr>
            <td class="spec-key">Category</td>
            <td class="spec-val">{{ $product->category->name ?? '—' }}</td>
          </tr>
          <tr>
            <td class="spec-key">Stock Qty</td>
            <td class="spec-val">{{ $product->quantity }} units</td>
          </tr>
          <tr>
            <td class="spec-key">Status</td>
            <td class="spec-val">{{ $product->is_active ? 'Available' : 'Unavailable' }}</td>
          </tr>
          <tr>
            <td class="spec-key">Added</td>
            <td class="spec-val">{{ $product->created_at->format('d M Y') }}</td>
          </tr>
        </table>

        {{-- Actions --}}
        <div class="product-actions">
          <div class="qty-row">
            <span class="qty-label">Quantity</span>
            <div class="qty-control">
              <button class="qty-btn" id="qtyMinus" type="button">−</button>
              <input type="number" class="qty-display" id="qtyInput" value="1" min="1" max="{{ $product->quantity }}">
              <button class="qty-btn" id="qtyPlus" type="button">+</button>
            </div>
          </div>

          @if($product->is_active && $product->quantity > 0)
            <a href="{{ route('cart.add', $product->id) }}" class="btn-add-cart" id="addToCartBtn">
              Add to Cart
            </a>
          @else
            <button class="btn-add-cart" disabled>
              {{ $product->quantity == 0 ? 'Out of Stock' : 'Unavailable' }}
            </button>
          @endif

          <a href="{{ route('enquiry.index') }}" class="btn-enquire">Send an Enquiry</a>
        </div>

      </div>
    </div>
  </section>

  {{-- ── META BAND ── --}}
  <div class="product-meta-band">
    <div class="product-meta-inner">
      <div class="meta-cell">
        <div class="meta-cell-label">Lead Time</div>
        <div class="meta-cell-val">5 – 15 Days</div>
        <div class="meta-cell-sub">Standard production schedule</div>
      </div>
      <div class="meta-cell">
        <div class="meta-cell-label">Standards</div>
        <div class="meta-cell-val">ISO · ASME · AWS</div>
        <div class="meta-cell-sub">Every unit tested and certified</div>
      </div>
      <div class="meta-cell">
        <div class="meta-cell-label">Support</div>
        <div class="meta-cell-val">24hr Response</div>
        <div class="meta-cell-sub">Technical team available</div>
      </div>
    </div>
  </div>

  <x-slot name="scripts">
  <script>
  // Quantity stepper
  const qtyInput = document.getElementById('qtyInput');
  const max      = {{ $product->quantity }};

  document.getElementById('qtyMinus').addEventListener('click', () => {
    if (parseInt(qtyInput.value) > 1) qtyInput.value = parseInt(qtyInput.value) - 1;
  });
  document.getElementById('qtyPlus').addEventListener('click', () => {
    if (parseInt(qtyInput.value) < max) qtyInput.value = parseInt(qtyInput.value) + 1;
  });

  // Wire quantity into cart link
  const cartBtn = document.getElementById('addToCartBtn');
  if (cartBtn) {
    const baseUrl = cartBtn.getAttribute('href');
    qtyInput.addEventListener('change', () => {
      cartBtn.setAttribute('href', baseUrl + '?qty=' + qtyInput.value);
    });
  }
  </script>
  </x-slot>

</x-donpas-layout>