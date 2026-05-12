<x-admin-layout>
    <x-slot name="header">
        Create Product
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap');

        .product-form-wrap {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: #f5f4f0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1rem;
        }

        .product-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 680px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04), 0 20px 60px rgba(0,0,0,0.08);
            border: 1px solid #ece9e0;
        }

        .form-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }

        .form-subtitle {
            font-size: 0.875rem;
            color: #888;
            margin-bottom: 2.5rem;
        }

        .alert-error {
            background: #fff5f5;
            border-left: 3px solid #e53e3e;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #c53030;
        }

        .alert-success {
            background: #f0fff4;
            border-left: 3px solid #38a169;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            color: #276749;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #555;
        }

        .form-input,
        .form-select {
            padding: 0.75rem 1rem;
            border: 1.5px solid #e5e2d9;
            border-radius: 10px;
            font-size: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            color: #1a1a1a;
            background: #fafaf8;
            transition: all 0.2s ease;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #2d6a4f;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
        }

        .form-input::placeholder {
            color: #bbb;
        }

        /* Image Upload */
        .image-upload-area {
            border: 2px dashed #d4cfc4;
            border-radius: 14px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            background: #fafaf8;
            position: relative;
            overflow: hidden;
        }

        .image-upload-area:hover {
            border-color: #2d6a4f;
            background: #f0faf5;
        }

        .image-upload-area.has-image {
            border-style: solid;
            border-color: #2d6a4f;
            padding: 0;
        }

        .image-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        .upload-placeholder {
            pointer-events: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: #999;
        }

        .upload-icon {
            width: 44px;
            height: 44px;
            background: #e8f5ee;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .upload-icon svg {
            width: 20px;
            height: 20px;
            stroke: #2d6a4f;
        }

        .upload-placeholder p {
            margin: 0;
            font-size: 0.85rem;
        }

        .upload-placeholder span {
            font-size: 0.75rem;
            color: #bbb;
        }

        #imagePreview {
            display: none;
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            max-height: 260px;
            pointer-events: none;
        }

        .image-upload-area.has-image #imagePreview {
            display: block;
        }

        .image-upload-area.has-image .upload-placeholder {
            display: none;
        }

        .image-change-hint {
            display: none;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.55);
            color: white;
            font-size: 0.75rem;
            padding: 0.5rem;
            text-align: center;
            z-index: 3;
            pointer-events: none;
        }

        .image-upload-area.has-image:hover .image-change-hint {
            display: block;
        }

        /* Toggle switch for Active */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1rem;
            background: #fafaf8;
            border: 1.5px solid #e5e2d9;
            border-radius: 10px;
        }

        .toggle-label-text {
            font-size: 0.9rem;
            color: #444;
            font-weight: 500;
        }

        .toggle-switch {
            position: relative;
            width: 44px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: #ddd;
            border-radius: 999px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: transform 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .toggle-switch input:checked + .toggle-slider {
            background: #2d6a4f;
        }

        .toggle-switch input:checked + .toggle-slider::before {
            transform: translateX(20px);
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 0.9rem;
            background: #2d6a4f;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.02em;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background: #1b4332;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .divider {
            height: 1px;
            background: #ece9e0;
            margin: 1.75rem 0;
        }

        @media (max-width: 560px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: 1; }
            .product-card { padding: 2rem 1.5rem; }
        }
    </style>

    <div class="product-form-wrap">
        <div class="product-card">
            <h2 class="form-title">New Product</h2>
            <p class="form-subtitle">Fill in the details below to add a product to your catalogue.</p>

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <ul style="margin:0; padding-left:1.2rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" id="myForm">
                @csrf

                <div class="form-grid">

                    <!-- Name -->
                    <div class="form-group full">
                        <label class="form-label" for="name">Product Name</label>
                        <input type="text" name="name" id="name" required
                            class="form-input"
                            placeholder="e.g. Wireless Headphones"
                            value="{{ old('name') }}">
                    </div>

                    <!-- Description -->
                    <div class="form-group full">
                        <label class="form-label" for="description">Description</label>
                        <input type="text" name="description" id="description" required
                            class="form-input"
                            placeholder="Short product description"
                            value="{{ old('description') }}">
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label class="form-label" for="price">Price (₦)</label>
                        <input type="number" name="price" id="price" required step="0.01"
                            class="form-input"
                            placeholder="0.00"
                            value="{{ old('price') }}">
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label class="form-label" for="stock_quantity">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" required min="1"
                            class="form-input"
                            placeholder="0"
                            value="{{ old('stock_quantity') }}">
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label class="form-label" for="category">Category</label>
                        <select name="categories_id" id="category" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Active Toggle -->
                    <div class="form-group" style="justify-content: flex-end;">
                        <label class="form-label">Status</label>
                        <div class="toggle-row">
                            <span class="toggle-label-text" id="toggleText">Active</span>
                            <label class="toggle-switch">
                                <input type="checkbox" name="is_active" value="1" checked id="activeToggle">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                        <input type="hidden" name="is_active" value="0" id="hiddenActive">
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group full">
                        <label class="form-label">Product Image</label>
                        <div class="image-upload-area" id="uploadArea">
                            <input type="file" name="image" id="image" accept="image/*">
                            <div class="upload-placeholder">
                                <div class="upload-icon">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                                    </svg>
                                </div>
                                <p>Click to upload or drag & drop</p>
                                <span>PNG, JPG, WEBP up to 10MB</span>
                            </div>
                            <img id="imagePreview" src="" alt="Preview">
                            <div class="image-change-hint">Click to change image</div>
                        </div>
                    </div>

                </div>

                <div class="divider"></div>

                <button type="submit" class="btn-submit">Save Product</button>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const uploadArea = document.getElementById('uploadArea');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    uploadArea.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        });

        // Active toggle - handle hidden field
        const activeToggle = document.getElementById('activeToggle');
        const hiddenActive = document.getElementById('hiddenActive');
        const toggleText = document.getElementById('toggleText');

        activeToggle.addEventListener('change', function () {
            if (this.checked) {
                hiddenActive.disabled = true;
                toggleText.textContent = 'Active';
            } else {
                hiddenActive.disabled = false;
                toggleText.textContent = 'Inactive';
            }
        });

        // Init
        hiddenActive.disabled = activeToggle.checked;
    </script>

</x-admin-layout>