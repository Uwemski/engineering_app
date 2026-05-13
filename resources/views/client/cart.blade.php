<x-donpas-layout title="Your Cart">

  <x-slot name="styles">
  <style>
  /* ── LIGHT BODY OVERRIDE for cart page ── */
  body { background:#f5f4f0 !important; color:#1a1a1a !important; }

  .cart-section { background:#f5f4f0; padding:4rem 5rem 6rem; }
  .cart-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1fr 360px; gap:2rem; align-items:start; }

  .alert-warning { background:rgba(245,158,11,.1); border:1px solid rgba(245,158,11,.4); border-left:3px solid var(--amber); padding:1rem 1.25rem; font-family:'Share Tech Mono',monospace; font-size:.7rem; letter-spacing:.08em; color:#92600a; max-width:1400px; margin:0 auto 2rem; }

  /* Cart table */
  .cart-table-wrap { background:#fff; border:1px solid #e5e2d9; position:relative; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.06); }
  .cart-table-wrap::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }
  .cart-table-header { padding:1.5rem 2rem 1rem; border-bottom:1px solid #e5e2d9; }
  .cart-table-label { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.75rem; }
  .cart-table-label::before { content:''; display:block; width:32px; height:1px; background:var(--amber); }

  table.cart-tbl { width:100%; border-collapse:collapse; }
  table.cart-tbl thead tr { border-bottom:1px solid #e5e2d9; }
  table.cart-tbl th { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.15em; text-transform:uppercase; color:#888; padding:1rem 1.5rem; text-align:left; font-weight:400; background:#fafaf8; }
  table.cart-tbl tbody tr { border-bottom:1px solid #ece9e0; transition:background .2s; }
  table.cart-tbl tbody tr:hover { background:#fafaf8; }
  table.cart-tbl td { padding:1.25rem 1.5rem; vertical-align:middle; }

  .cart-prod-img { width:64px; height:64px; object-fit:cover; border:1px solid #e5e2d9; display:block; }
  .cart-prod-img-placeholder { width:64px; height:64px; background:#f5f4f0; border:1px solid #e5e2d9; display:grid; place-items:center; color:#bbb; }
  .cart-prod-name { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:#1a1a1a; letter-spacing:.02em; }
  .cart-price { font-family:'Share Tech Mono',monospace; font-size:.75rem; color:var(--amber-dim); letter-spacing:.05em; }

  .qty-input { width:72px; padding:.5rem .75rem; background:#f5f4f0; border:1.5px solid #e5e2d9; color:#1a1a1a; font-family:'Share Tech Mono',monospace; font-size:.75rem; outline:none; text-align:center; transition:border-color .2s; -moz-appearance:textfield; }
  .qty-input::-webkit-outer-spin-button, .qty-input::-webkit-inner-spin-button { -webkit-appearance:none; }
  .qty-input:focus { border-color:var(--amber); }

  .cart-subtotal { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:#1a1a1a; }

  .btn-delete { background:none; border:1px solid #e5e2d9; width:34px; height:34px; display:grid; place-items:center; cursor:pointer; color:#bbb; transition:border-color .2s, color .2s, background .2s; }
  .btn-delete:hover { border-color:#ef4444; color:#ef4444; background:rgba(239,68,68,.06); }

  .cart-empty { padding:5rem 2rem; text-align:center; }
  .cart-empty-icon { width:64px; height:64px; border:2px dashed #d4cfc4; display:grid; place-items:center; margin:0 auto 1.5rem; color:#bbb; }
  .cart-empty h3 { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.5rem; color:#888; margin-bottom:.5rem; }
  .cart-empty p { font-size:.85rem; color:#aaa; margin-bottom:1.5rem; }
  .btn-shop { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; background:var(--amber); color:var(--iron-900); padding:.7rem 1.75rem; text-decoration:none; display:inline-block; transition:background .2s; }
  .btn-shop:hover { background:#d97706; }

  /* Order summary */
  .order-summary { background:#fff; border:1px solid #e5e2d9; position:sticky; top:108px; box-shadow:0 4px 24px rgba(0,0,0,.06); overflow:hidden; }
  .order-summary::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }
  .summary-header { padding:1.5rem 1.75rem 1rem; border-bottom:1px solid #e5e2d9; }
  .summary-label { font-family:'Share Tech Mono',monospace; font-size:.65rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.75rem; }
  .summary-label::before { content:''; display:block; width:24px; height:1px; background:var(--amber); }
  .summary-body { padding:1.5rem 1.75rem; }
  .summary-row { display:flex; justify-content:space-between; align-items:baseline; padding:.6rem 0; border-bottom:1px solid #ece9e0; }
  .summary-row:last-of-type { border-bottom:none; }
  .summary-row-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; letter-spacing:.1em; text-transform:uppercase; color:#888; }
  .summary-row-val { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:#1a1a1a; }
  .summary-total { display:flex; justify-content:space-between; align-items:baseline; padding:1.25rem 1.75rem; border-top:1px solid #e5e2d9; background:#fafaf8; }
  .summary-total-label { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1.1rem; color:#1a1a1a; text-transform:uppercase; letter-spacing:.05em; }
  .summary-total-val { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:1.75rem; color:var(--amber-dim); }
  .summary-actions { padding:1.25rem 1.75rem; display:flex; flex-direction:column; gap:.75rem; }
  .btn-checkout { width:100%; padding:.9rem; background:#2d6a4f; color:#fff; font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.95rem; letter-spacing:.12em; text-transform:uppercase; border:none; cursor:pointer; transition:background .2s, transform .15s; text-decoration:none; display:block; text-align:center; }
  .btn-checkout:hover { background:#1b4332; transform:translateY(-1px); }
  .btn-login { width:100%; padding:.9rem; background:#e5e2d9; color:#555; font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.95rem; letter-spacing:.12em; text-transform:uppercase; border:none; cursor:pointer; transition:background .2s; text-decoration:none; display:block; text-align:center; }
  .btn-login:hover { background:#d4cfc4; }
  .btn-continue { width:100%; padding:.8rem; background:none; border:1.5px solid #d4cfc4; color:#888; font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.85rem; letter-spacing:.12em; text-transform:uppercase; cursor:pointer; transition:all .2s; text-decoration:none; display:block; text-align:center; }
  .btn-continue:hover { border-color:var(--amber); color:var(--amber-dim); }
  .summary-note { font-family:'Share Tech Mono',monospace; font-size:.58rem; color:#aaa; letter-spacing:.08em; text-align:center; padding:0 1.75rem 1.25rem; line-height:1.6; }

  @media(max-width:1024px) { .cart-inner{grid-template-columns:1fr;} .order-summary{position:static;} .cart-section{padding:3rem 1.5rem 4rem;} }
  @media(max-width:900px)  { table.cart-tbl th:nth-child(5), table.cart-tbl td:nth-child(5){display:none;} }
  @media(max-width:600px)  { table.cart-tbl th:nth-child(3), table.cart-tbl td:nth-child(3){display:none;} }
  </style>
  </x-slot>

  <x-donpas-header
    eyebrow="Your Order"
    title="YOUR"
    highlight="CART"
    :breadcrumbs="[
      ['label'=>'Home','url'=>'/home'],
      ['label'=>'Products','url'=>'/guest'],
      ['label'=>'Cart'],
    ]"
  />

  <section class="cart-section">

    @if(session('error'))
      <div class="alert-warning">⚠ {{ session('error') }}</div>
    @endif

    <div class="cart-inner">

      {{-- Cart Table --}}
      <div class="cart-table-wrap">
        <div class="cart-table-header">
          <div class="cart-table-label">Order Items</div>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
          <table class="cart-tbl">
            <thead>
              <tr>
                <th>Item</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($cart as $key => $data)
                <tr data-id="{{ $key }}">
                  <td>
                    @if(!empty($data['image']))
                      <img src="{{ asset('storage/' . $data['image']) }}" alt="{{ $data['name'] }}" class="cart-prod-img">
                    @else
                      <div class="cart-prod-img-placeholder">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
                      </div>
                    @endif
                  </td>
                  <td><div class="cart-prod-name">{{ $data['name'] }}</div></td>
                  <td><div class="cart-price">₦{{ number_format($data['price'], 2) }}</div></td>
                  <td><input type="number" class="qty-input quantity" value="{{ $count }}" min="1"></td>
                  <td><div class="cart-subtotal">₦{{ number_format($subtotal, 2) }}</div></td>
                  <td>
                    <form action="{{ route('cart.delete', $key) }}" method="POST">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn-delete" title="Remove">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        @else
          <div class="cart-empty">
            <div class="cart-empty-icon">
              <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/></svg>
            </div>
            <h3>Your cart is empty</h3>
            <p>Browse our catalogue and add products to get started.</p>
            <a href="/guest" class="btn-shop">Browse Products</a>
          </div>
        @endif
      </div>

      {{-- Order Summary --}}
      @if($cart && count($cart) > 0)
        @php
          foreach($cart as $item)
        @endphp
        <div class="order-summary">
          <div class="summary-header">
            <div class="summary-label">Order Summary</div>
          </div>
          <div class="summary-body">
            <div class="summary-row">
              <span class="summary-row-label">Items</span>
              <span class="summary-row-val">{{ $count }}</span>
            </div>
            <div class="summary-row">
              <span class="summary-row-label">Subtotal</span>
              <span class="summary-row-val">₦{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-row">
              <span class="summary-row-label">Shipping</span>
              <span class="summary-row-val" style="font-size:.85rem;color:#aaa;">At checkout</span>
            </div>
          </div>
          <div class="summary-total">
            <span class="summary-total-label">Total</span>
            <span class="summary-total-val">₦{{ number_format($subtotal, 2) }}</span>
          </div>
          <div class="summary-actions">
            @auth
              <a href="{{ route('cart.checkout') }}" class="btn-checkout">Proceed to Checkout</a>
            @else
              <a href="/login" class="btn-login">Login to Checkout</a>
            @endauth
            <a href="/guest" class="btn-continue">Continue Shopping</a>
          </div>
          <p class="summary-note">All prices in Nigerian Naira (₦).<br>Shipping calculated at checkout.</p>
        </div>
      @endif

    </div>
  </section>

  <x-slot name="scripts">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
  $('body').on('change', '.quantity', function() {
    var elem = $(this);
    $.ajax({
      url: "{{ route('cart.update') }}",
      method: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        product_id: elem.parents('tr').attr('data-id'),
        quantity: elem.val()
      },
      success: function() { location.reload(); }
    });
  });
  </script>
  </x-slot>

</x-donpas-layout>