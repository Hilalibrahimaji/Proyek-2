<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHGH - @yield('title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Custom Styles for Profile Form */
        .form-floating {
            position: relative;
        }
        
        .form-floating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem 0.75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity .1s ease-in-out, transform .1s ease-in-out;
            color: #6b7280;
            padding-left: 2.5rem;
        }
        
        .form-floating .fas {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            z-index: 10;
        }
        
        .form-floating input:focus ~ label,
        .form-floating input:not(:placeholder-shown) ~ label,
        .form-floating textarea:focus ~ label,
        .form-floating textarea:not(:placeholder-shown) ~ label,
        .form-floating select:focus ~ label,
        .form-floating select:not([value=""]):valid ~ label {
            opacity: 0.65;
            transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
            background: white;
            padding: 0 0.5rem;
            left: 0.75rem;
        }
        
        .form-floating input:focus ~ .fas,
        .form-floating input:not(:placeholder-shown) ~ .fas,
        .form-floating textarea:focus ~ .fas,
        .form-floating textarea:not(:placeholder-shown) ~ .fas,
        .form-floating select:focus ~ .fas,
        .form-floating select:not([value=""]):valid ~ .fas {
            color: #3b82f6;
        }
        
        /* Custom form input styling */
        .form-input-custom {
            padding-left: 2.5rem;
        }
        
        /* Profile picture styling */
        .profile-picture {
            transition: all 0.3s ease;
            border: 4px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .profile-picture:hover {
            transform: scale(1.05);
        }
        
        /* Form section styling */
        .form-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 0.5rem;
            border-left: 4px solid #3b82f6;
        }
        
        /* Card styling */
        .card {
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        /* Custom animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-floating label {
                padding-left: 2.2rem;
            }
            
            .form-floating .fas {
                left: 0.65rem;
                font-size: 0.875rem;
            }
            
            .form-input-custom {
                padding-left: 2.2rem;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body class="font-sans bg-gray-50">
    @include('layouts.nav')
    
    <main>
        @yield('content')
    </main>
    
    @include('layouts.footer')
    
    @stack('scripts')
</body>
</html>