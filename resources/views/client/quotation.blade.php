<x-client-layout>

    <x-slot name="title">Request a Quote — IronCore Engineering &amp; Fabrication</x-slot>
    <x-slot name="meta">Submit a quote request for gas heads, AC components, or custom fabricated parts. No account required. Response within one business day.</x-slot>

    @push('styles')
    <style>
    /* ── QUOTE PAGE ───────────────────────────────────── */
    .quote-hero {
        background:var(--iron-900); padding-top:92px; position:relative; overflow:hidden;
    }
    .quote-hero::before {
        content:''; position:absolute; inset:0; pointer-events:none;
        background:
            repeating-linear-gradient(90deg,transparent,transparent 59px,rgba(245,158,11,.04) 59px,rgba(245,158,11,.04) 60px),
            repeating-linear-gradient(0deg,transparent,transparent 59px,rgba(245,158,11,.04) 59px,rgba(245,158,11,.04) 60px);
    }
    .quote-hero-inner { max-width:1400px; margin:0 auto; padding:4rem 5rem 0; position:relative; z-index:2; }
    h1.quote-title {
        font-family:'Barlow Condensed',sans-serif; font-weight:900;
        font-size:clamp(2.5rem,5vw,5rem); line-height:.92;
        text-transform:uppercase; letter-spacing:-.02em; color:#fff; margin-bottom:1rem;
    }
    h1.quote-title span { color:var(--amber); }
    .quote-subtitle { font-size:.95rem; color:var(--iron-400); font-weight:300; max-width:560px; line-height:1.7; padding-bottom:2.5rem; }
    .quote-hero-rule { height:3px; background:var(--amber); max-width:100%; }

    /* ── BODY LAYOUT ──────────────────────────────────── */
    .quote-body { background:var(--iron-900); padding:4rem 5rem 6rem; }
    .quote-body-inner { max-width:1400px; margin:0 auto; display:grid; grid-template-columns:1fr 340px; gap:4rem; align-items:start; }

    /* ── FORM CARD ────────────────────────────────────── */
    .quote-form-card { background:var(--iron-800); border:1px solid var(--iron-700); position:relative; overflow:hidden; }
    .quote-form-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--amber); }

    .form-section { padding:2.5rem; border-bottom:1px solid var(--iron-700); }
    .form-section:last-of-type { border-bottom:none; }
    .form-section-label {
        font-family:'Share Tech Mono',monospace; font-size:.62rem; color:var(--amber);
        letter-spacing:.2em; text-transform:uppercase;
        display:flex; align-items:center; gap:.75rem; margin-bottom:1.75rem;
    }
    .form-section-label::before { content:''; display:block; width:24px; height:1px; background:var(--amber); }

    /* Fields */
    .field-row { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; margin-bottom:1.25rem; }
    .field-row.full { grid-template-columns:1fr; }
    .field-group { display:flex; flex-direction:column; gap:.4rem; }
    label.field-label { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-400); letter-spacing:.14em; text-transform:uppercase; }
    label.field-label .req { color:var(--amber); margin-left:2px; }

    .field-input, .field-select, .field-textarea {
        background:var(--iron-900); border:1px solid var(--iron-600);
        color:#fff; font-family:'Barlow',sans-serif; font-size:.9rem;
        padding:.75rem 1rem; outline:none; width:100%; appearance:none;
        transition:border-color .2s, background .2s;
    }
    .field-input::placeholder, .field-textarea::placeholder { color:var(--iron-600); }
    .field-input:focus, .field-select:focus, .field-textarea:focus { border-color:var(--amber); background:var(--iron-800); }
    .field-input.is-error, .field-select.is-error, .field-textarea.is-error { border-color:#ef4444; }
    .field-textarea { resize:vertical; min-height:120px; line-height:1.6; }

    .select-wrap { position:relative; }
    .select-wrap::after {
        content:''; position:absolute; right:1rem; top:50%; transform:translateY(-50%);
        width:0; height:0; border-left:5px solid transparent; border-right:5px solid transparent;
        border-top:5px solid var(--iron-400); pointer-events:none;
    }
    .field-select { padding-right:2.5rem; cursor:pointer; }
    .field-select option { background:var(--iron-800); color:#fff; }

    .field-error { font-family:'Share Tech Mono',monospace; font-size:.58rem; color:#ef4444; letter-spacing:.08em; margin-top:.25rem; }

    /* File drop zone */
    .file-drop-zone {
        border:1.5px dashed var(--iron-600); background:var(--iron-900);
        padding:2rem; text-align:center; cursor:pointer; position:relative;
        transition:border-color .2s, background .2s;
    }
    .file-drop-zone:hover, .file-drop-zone.drag-over { border-color:var(--amber); background:rgba(245,158,11,.04); }
    .file-drop-zone input[type="file"] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
    .file-drop-icon { color:var(--iron-600); margin-bottom:.75rem; transition:color .2s; }
    .file-drop-zone:hover .file-drop-icon { color:var(--amber); }
    .file-drop-text { font-family:'Barlow Condensed',sans-serif; font-weight:600; font-size:.85rem; color:var(--iron-300); letter-spacing:.06em; }
    .file-drop-hint { font-family:'Share Tech Mono',monospace; font-size:.58rem; color:var(--iron-600); letter-spacing:.1em; text-transform:uppercase; margin-top:.35rem; }
    .file-list { margin-top:1rem; display:flex; flex-direction:column; gap:.4rem; }
    .file-item { display:flex; align-items:center; justify-content:space-between; background:var(--iron-700); padding:.5rem .75rem; font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-300); }
    .file-item-remove { background:none; border:none; color:#ef4444; cursor:pointer; font-size:.75rem; padding:0; line-height:1; transition:color .15s; }
    .file-item-remove:hover { color:#fff; }

    /* Submit area */
    .form-submit-area { padding:2rem 2.5rem; background:var(--iron-900); display:flex; align-items:center; gap:1.5rem; flex-wrap:wrap; }
    .btn-submit {
        background:var(--amber); color:var(--iron-900);
        font-family:'Barlow Condensed',sans-serif; font-weight:700;
        font-size:.9rem; letter-spacing:.12em; text-transform:uppercase;
        padding:.9rem 2.5rem; border:none; cursor:pointer;
        display:inline-flex; align-items:center; gap:.75rem;
        transition:background .2s, transform .15s;
    }
    .btn-submit:hover:not(:disabled) { background:#d97706; transform:translateY(-1px); }
    .btn-submit:disabled { opacity:.5; cursor:not-allowed; transform:none; }
    .btn-submit .spinner { display:none; width:16px; height:16px; border:2px solid rgba(9,9,11,.3); border-top-color:var(--iron-900); border-radius:50%; animation:spin .7s linear infinite; }
    .btn-submit.loading .spinner { display:block; }
    .btn-submit.loading .btn-text { opacity:.6; }
    @keyframes spin { to { transform:rotate(360deg); } }
    .submit-note { font-family:'Share Tech Mono',monospace; font-size:.58rem; color:var(--iron-600); letter-spacing:.1em; text-transform:uppercase; line-height:1.6; }

    /* Alert */
    .form-alert { display:none; margin:0 2.5rem 1.5rem; padding:1rem 1.25rem; background:rgba(239,68,68,.08); border:1px solid rgba(239,68,68,.3); font-family:'Share Tech Mono',monospace; font-size:.62rem; color:#ef4444; letter-spacing:.08em; line-height:1.6; }
    .form-alert.show { display:block; }

    /* Success state */
    .quote-success { display:none; background:var(--iron-800); border:1px solid var(--iron-700); padding:3.5rem 2.5rem; text-align:center; position:relative; overflow:hidden; }
    .quote-success::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--amber); }
    .success-icon { width:56px; height:56px; border:2px solid var(--amber); display:grid; place-items:center; margin:0 auto 1.5rem; color:var(--amber); animation:pulseAccent 3s ease infinite; }
    .success-ref { font-family:'Share Tech Mono',monospace; font-size:.7rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.75rem; }
    .success-title { font-family:'Barlow Condensed',sans-serif; font-weight:900; font-size:2rem; color:#fff; text-transform:uppercase; margin-bottom:.75rem; }
    .success-body { font-size:.9rem; color:var(--iron-400); line-height:1.7; max-width:420px; margin:0 auto 2rem; }

    /* Optional register offer */
    .success-register-offer { background:var(--iron-900); border:1px solid var(--iron-700); padding:1.5rem; margin-top:1.5rem; text-align:left; }
    .register-offer-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:1rem; color:#fff; margin-bottom:.5rem; }
    .register-offer-body { font-size:.82rem; color:var(--iron-400); margin-bottom:1rem; line-height:1.6; }
    .register-offer-list { list-style:none; display:flex; flex-direction:column; gap:.3rem; margin-bottom:1.25rem; }
    .register-offer-list li { font-family:'Share Tech Mono',monospace; font-size:.62rem; color:var(--iron-300); letter-spacing:.08em; display:flex; align-items:center; gap:.5rem; }
    .register-offer-list li::before { content:'▸'; color:var(--amber); }
    .register-offer-actions { display:flex; gap:.75rem; flex-wrap:wrap; }

    /* ── SIDEBAR ──────────────────────────────────────── */
    .quote-sidebar { display:flex; flex-direction:column; gap:1.5rem; }
    .sidebar-card { background:var(--iron-800); border:1px solid var(--iron-700); position:relative; overflow:hidden; }
    .sidebar-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:var(--amber); }
    .sidebar-card-head { padding:1.25rem 1.5rem 0; font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--amber); letter-spacing:.2em; text-transform:uppercase; display:flex; align-items:center; gap:.6rem; }
    .sidebar-card-head::before { content:''; width:20px; height:1px; background:var(--amber); }
    .sidebar-card-body { padding:1rem 1.5rem 1.5rem; }

    .process-mini { display:flex; flex-direction:column; }
    .process-mini-step { display:grid; grid-template-columns:32px 1fr; gap:.75rem; padding:.75rem 0; border-bottom:1px solid var(--iron-700); align-items:start; }
    .process-mini-step:last-child { border-bottom:none; }
    .mini-num { width:32px; height:32px; border:1.5px solid var(--amber); display:grid; place-items:center; font-family:'Share Tech Mono',monospace; font-size:.62rem; color:var(--amber); flex-shrink:0; }
    .mini-title { font-family:'Barlow Condensed',sans-serif; font-weight:700; font-size:.9rem; color:#fff; }
    .mini-desc { font-size:.78rem; color:var(--iron-400); margin-top:.15rem; }

    .contact-list { display:flex; flex-direction:column; gap:.85rem; }
    .contact-item { display:flex; align-items:flex-start; gap:.75rem; }
    .contact-icon { width:28px; height:28px; border:1px solid var(--iron-600); display:grid; place-items:center; flex-shrink:0; color:var(--iron-400); transition:all .2s; }
    .contact-item:hover .contact-icon { border-color:var(--amber); color:var(--amber); }
    .contact-label { font-family:'Share Tech Mono',monospace; font-size:.55rem; color:var(--iron-600); letter-spacing:.12em; text-transform:uppercase; }
    .contact-val { font-size:.85rem; color:var(--iron-300); line-height:1.4; }
    .contact-val a { color:var(--iron-300); text-decoration:none; transition:color .2s; }
    .contact-val a:hover { color:var(--amber); }

    .spec-accept-list { display:flex; flex-direction:column; gap:.3rem; }
    .spec-accept-item { font-family:'Share Tech Mono',monospace; font-size:.6rem; color:var(--iron-400); letter-spacing:.08em; display:flex; align-items:center; gap:.5rem; }
    .spec-accept-item::before { content:'▸'; color:var(--amber); }

    /* ── RESPONSIVE ───────────────────────────────────── */
    @media (max-width:900px) {
        .quote-hero-inner { padding:3rem 1.5rem 0; }
        .quote-body { padding:3rem 1.5rem 4rem; }
        .quote-body-inner { grid-template-columns:1fr; }
        .field-row { grid-template-columns:1fr; }
        .form-section { padding:1.75rem; }
        .form-submit-area { padding:1.5rem; }
    }
    </style>
    @endpush

    {{-- ── HERO ──────────────────────────────────────── --}}
    <section class="quote-hero">
        <div class="quote-hero-inner">
            <div class="hero-eyebrow anim-fadeLeft">No Account Required</div>
            <h1 class="quote-title anim-fadeUp delay-1">REQUEST A<br><span>QUOTATION.</span></h1>
            <p class="quote-subtitle anim-fadeUp delay-2">
                Describe your requirement or upload a drawing. An engineer will review and respond
                within one business day with a price and confirmed lead time.
            </p>
        </div>
        <div class="quote-hero-rule"></div>
    </section>

    {{-- ── FORM BODY ─────────────────────────────────── --}}
    <div class="quote-body">
        <div class="quote-body-inner">

            <div>
                {{-- Server-side validation errors (on redirect back) --}}
                @if($errors->any())
                <div class="form-alert show">
                    @foreach($errors->all() as $error)▸ {{ $error }}<br>@endforeach
                </div>
                @endif

                {{-- Success panel — shown by JS after fetch succeeds --}}
                <div class="quote-success" id="quoteSuccess">
                    <div class="success-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    </div>
                    <div class="success-ref" id="successRef">RFQ SUBMITTED</div>
                    <div class="success-title">Quote Request Received</div>
                    <p class="success-body">We've received your request and sent a confirmation to your email. An engineer will respond within one business day.</p>
                    <div class="success-register-offer">
                        <div class="register-offer-title">Want to track this quote online?</div>
                        <p class="register-offer-body">Create a free account to check status, reorder parts, and access your documentation — no obligation.</p>
                        <ul class="register-offer-list">
                            <li>Track quote status in real time</li>
                            <li>Reorder past parts in one click</li>
                            <li>Download certificates and invoices</li>
                        </ul>
                        <div class="register-offer-actions">
                            <a href="{{ route('register') }}" id="registerLink" class="btn-a" style="font-size:.8rem;padding:.65rem 1.5rem;">Create Account</a>
                            <a href="{{ route('home') }}" class="btn-b" style="font-size:.8rem;padding:.6rem 1.5rem;">No Thanks</a>
                        </div>
                    </div>
                </div>

                {{-- The form --}}
                <form id="quoteForm" method="POST" action="{{ route('quotation.store') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-alert" id="formAlert"></div>

                    <div class="quote-form-card">

                        {{-- 01 Contact --}}
                        <div class="form-section">
                            <div class="form-section-label">01 — Contact Details</div>
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="contact_name">Full Name <span class="req">*</span></label>
                                    <input type="text" name="contact_name" id="contact_name" class="field-input @error('contact_name') is-error @enderror" value="{{ old('contact_name') }}" placeholder="e.g. John Smith" required>
                                    @error('contact_name')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="company_name">Company Name <span class="req">*</span></label>
                                    <input type="text" name="company_name" id="company_name" class="field-input @error('company_name') is-error @enderror" value="{{ old('company_name') }}" placeholder="e.g. Acme Industries Ltd" required>
                                    @error('company_name')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="email">Work Email <span class="req">*</span></label>
                                    <input type="email" name="email" id="email" class="field-input @error('email') is-error @enderror" value="{{ old('email') }}" placeholder="you@company.com" required>
                                    @error('email')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="phone">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" class="field-input @error('phone') is-error @enderror" value="{{ old('phone') }}" placeholder="+1 (800) 000-0000">
                                    @error('phone')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- 02 Project Details --}}
                        <div class="form-section">
                            <div class="form-section-label">02 — Project Details</div>
                            <div class="field-row full">
                                <div class="field-group">
                                    <label class="field-label" for="subject">Subject / Part Name <span class="req">*</span></label>
                                    <input type="text" name="subject" id="subject" class="field-input @error('subject') is-error @enderror" value="{{ old('subject') }}" placeholder="e.g. GH-400 High Pressure Gas Head, 316L SS, 4000 PSI" required>
                                    @error('subject')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="product_category">Product Category</label>
                                    <div class="select-wrap">
                                        <select name="product_category" id="product_category" class="field-input field-select">
                                            <option value="" disabled {{ old('product_category') ? '' : 'selected' }}>Select category…</option>
                                            <option value="gas_heads"        {{ old('product_category') == 'gas_heads'        ? 'selected' : '' }}>Gas Heads &amp; Pressure Components</option>
                                            <option value="ac_components"    {{ old('product_category') == 'ac_components'    ? 'selected' : '' }}>AC Equipment / HVAC-R Components</option>
                                            <option value="custom_machined"  {{ old('product_category') == 'custom_machined'  ? 'selected' : '' }}>Custom CNC Machined Parts</option>
                                            <option value="pressure_vessels" {{ old('product_category') == 'pressure_vessels' ? 'selected' : '' }}>Pressure Vessels &amp; Receivers</option>
                                            <option value="sheet_metal"      {{ old('product_category') == 'sheet_metal'      ? 'selected' : '' }}>Sheet Metal &amp; Structural Fabrication</option>
                                            <option value="other"            {{ old('product_category') == 'other'            ? 'selected' : '' }}>Other / Not Sure</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="quantity">Quantity Required</label>
                                    <input type="number" name="quantity" id="quantity" class="field-input @error('quantity') is-error @enderror" value="{{ old('quantity') }}" placeholder="e.g. 50" min="1">
                                    @error('quantity')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="material">Material / Grade</label>
                                    <input type="text" name="material" id="material" class="field-input" value="{{ old('material') }}" placeholder="e.g. 316L SS, ASTM A105, Copper C122">
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="required_date">Required By Date</label>
                                    <input type="date" name="required_date" id="required_date" class="field-input @error('required_date') is-error @enderror" value="{{ old('required_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                    @error('required_date')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="field-row full">
                                <div class="field-group">
                                    <label class="field-label" for="description">Description / Technical Requirements <span class="req">*</span></label>
                                    <textarea name="description" id="description" class="field-textarea @error('description') is-error @enderror" placeholder="Describe the part, application, operating conditions, certifications required (ASME, AHRI, AWS), tolerances, finish, or anything else relevant." required>{{ old('description') }}</textarea>
                                    @error('description')<span class="field-error">▸ {{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- 03 Attachments --}}
                        <div class="form-section">
                            <div class="form-section-label">03 — Drawings &amp; Attachments <span style="color:var(--iron-600);font-size:.55rem;">(Optional)</span></div>
                            <div class="file-drop-zone" id="dropZone">
                                <input type="file" name="drawings[]" id="drawings" multiple accept=".pdf,.dwg,.dxf,.step,.stp,.igs,.iges,.jpg,.jpeg,.png">
                                <div class="file-drop-icon">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                </div>
                                <div class="file-drop-text">Drop files here or click to browse</div>
                                <div class="file-drop-hint">PDF · DWG · DXF · STEP · IGES · JPG · PNG — max 20MB each</div>
                            </div>
                            <div class="file-list" id="fileList"></div>
                        </div>

                        {{-- Submit --}}
                        <div class="form-submit-area">
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <div class="spinner"></div>
                                <span class="btn-text">Submit Quote Request</span>
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </button>
                            <p class="submit-note">No account required.<br>Response within 1 business day.</p>
                        </div>

                    </div>{{-- /quote-form-card --}}
                </form>
            </div>

            {{-- ── SIDEBAR ───────────────────────────── --}}
            <aside class="quote-sidebar">
                <div class="sidebar-card">
                    <div class="sidebar-card-head">What Happens Next</div>
                    <div class="sidebar-card-body">
                        <div class="process-mini">
                            <div class="process-mini-step"><div class="mini-num">01</div><div><div class="mini-title">Engineer Review</div><div class="mini-desc">A senior engineer assesses your requirement against our capabilities and standards.</div></div></div>
                            <div class="process-mini-step"><div class="mini-num">02</div><div><div class="mini-title">Price &amp; Lead Time</div><div class="mini-desc">Formal quote with itemised price and confirmed delivery — within 1 business day.</div></div></div>
                            <div class="process-mini-step"><div class="mini-num">03</div><div><div class="mini-title">Approval &amp; Production</div><div class="mini-desc">On your go-ahead we issue CAD drawings for sign-off, then begin manufacture.</div></div></div>
                            <div class="process-mini-step"><div class="mini-num">04</div><div><div class="mini-title">Test &amp; Dispatch</div><div class="mini-desc">Full pressure test, inspection, and certification documentation before delivery.</div></div></div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-card-head">Prefer to Talk Directly?</div>
                    <div class="sidebar-card-body">
                        <div class="contact-list">
                            <div class="contact-item">
                                <div class="contact-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg></div>
                                <div><div class="contact-label">Phone</div><div class="contact-val"><a href="tel:+18005550198">+1 (800) 555-0198</a></div></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg></div>
                                <div><div class="contact-label">Email</div><div class="contact-val"><a href="mailto:quotes@ironcore-eng.com">quotes@ironcore-eng.com</a></div></div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                                <div><div class="contact-label">Business Hours</div><div class="contact-val">Mon–Fri 7:00am – 5:30pm CST</div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-card-head">Accepted Drawing Formats</div>
                    <div class="sidebar-card-body">
                        <div class="spec-accept-list">
                            <div class="spec-accept-item">PDF — preferred for 2D drawings</div>
                            <div class="spec-accept-item">DWG / DXF — AutoCAD native</div>
                            <div class="spec-accept-item">STEP / STP — 3D solid models</div>
                            <div class="spec-accept-item">IGES / IGS — interchange format</div>
                            <div class="spec-accept-item">JPG / PNG — sketches welcome</div>
                        </div>
                        <p style="font-family:'Share Tech Mono',monospace;font-size:.58rem;color:var(--iron-600);margin-top:1rem;letter-spacing:.08em;line-height:1.6;">Max 20MB per file. No drawing? Describe the part — we'll work from your specification.</p>
                    </div>
                </div>
            </aside>

        </div>
    </div>

    {{-- ── SCRIPTS ────────────────────────────────────── --}}
    @push('scripts')
    <script>
    (function () {
        'use strict';

        const form       = document.getElementById('quoteForm');
        const submitBtn  = document.getElementById('submitBtn');
        const formAlert  = document.getElementById('formAlert');
        const successEl  = document.getElementById('quoteSuccess');
        const successRef = document.getElementById('successRef');
        const registerLink = document.getElementById('registerLink');
        const dropZone   = document.getElementById('dropZone');
        const fileInput  = document.getElementById('drawings');
        const fileList   = document.getElementById('fileList');

        // ── FILE LIST DISPLAY ────────────────────────────
        function renderFileList(files) {
            fileList.innerHTML = '';
            Array.from(files).forEach((file, i) => {
                const kb   = (file.size / 1024).toFixed(0);
                const item = document.createElement('div');
                item.className = 'file-item';
                item.innerHTML = `<span>${file.name} <span style="color:var(--iron-600)">(${kb} KB)</span></span>
                    <button type="button" class="file-item-remove" title="Remove">✕</button>`;
                fileList.appendChild(item);
            });
        }

        fileInput.addEventListener('change', () => renderFileList(fileInput.files));

        // Drag & drop
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('drag-over'); });
        dropZone.addEventListener('dragleave', ()  => dropZone.classList.remove('drag-over'));
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const dt = new DataTransfer();
            Array.from(e.dataTransfer.files).forEach(f => dt.items.add(f));
            fileInput.files = dt.files;
            renderFileList(fileInput.files);
        });

        // ── FORM SUBMIT ──────────────────────────────────
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // prevent full page reload

            formAlert.classList.remove('show');
            formAlert.innerHTML = '';

            // Client-side required check
            let valid = true;
            form.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) { field.classList.add('is-error'); valid = false; }
                else field.classList.remove('is-error');
            });
            if (!valid) { showAlert('Please fill in all required fields marked with ▸'); return; }

            submitBtn.disabled = true;
            submitBtn.classList.add('loading');

            fetch('{{ route("quotation.store") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: new FormData(this)
            })
            .then(response => {
                // Always parse JSON — Laravel sends it for both success and 422
                return response.json().then(data => ({ ok: response.ok, status: response.status, data }));
            })
            .then(({ ok, status, data }) => {
                if (data.success) {
                    form.style.display = 'none';
                    successEl.style.display = 'block';
                    successEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    if (data.reference) successRef.textContent = 'QUOTE REF: ' + data.reference;
                    // Append token to register link so the account ties to this quote
                    if (data.token) registerLink.href += '?token=' + data.token;
                } else if (status === 422 && data.errors) {
                    const msgs = Object.values(data.errors).flat();
                    showAlert(msgs.map(m => '▸ ' + m).join('<br>'));
                } else {
                    showAlert(data.message || 'Something went wrong. Please try again or call us directly.');
                }
            })
            .catch(() => {
                showAlert('A network error occurred. Please check your connection or call +1 (800) 555-0198.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
            });
        });

        function showAlert(msg) {
            formAlert.innerHTML = msg;
            formAlert.classList.add('show');
            formAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // Clear error highlight on input
        form.querySelectorAll('.field-input, .field-textarea, .field-select').forEach(f => {
            f.addEventListener('input', () => f.classList.remove('is-error'));
        });

    })();
    @endpush
    

</x-client-layout>