<x-admin-layout>

    <x-slot name="header">
        <div>Create Category</div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap');

        .category-form-wrap {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: #f5f4f0;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1rem;
        }

        .category-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 520px;
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

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #555;
        }

        .form-input {
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

        .form-input:focus {
            border-color: #2d6a4f;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
        }

        .form-input::placeholder {
            color: #bbb;
        }

        .divider {
            height: 1px;
            background: #ece9e0;
            margin: 1.75rem 0;
        }

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
        }

        .btn-submit:hover {
            background: #1b4332;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(45, 106, 79, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        @media (max-width: 560px) {
            .category-card { padding: 2rem 1.5rem; }
        }
    </style>

    <div class="category-form-wrap">
        <div class="category-card">
            <h2 class="form-title">New Category</h2>
            <p class="form-subtitle">Add a new category to organise your products.</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
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

            <form action="{{ route('category.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Category Name</label>
                    <input type="text" name="name" id="name"
                        class="form-input"
                        placeholder="e.g. Electronics"
                        value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <input type="text" name="description" id="description"
                        class="form-input"
                        placeholder="Brief description of this category"
                        value="{{ old('description') }}">
                </div>

                <div class="divider"></div>

                <button type="submit" class="btn-submit">Create Category</button>
            </form>
        </div>
    </div>

</x-admin-layout>