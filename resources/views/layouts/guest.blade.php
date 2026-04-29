    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Marital System') }} - Connexion</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
      
        
        <style>
            .bg-gradient-custom {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
            
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            .card-hover {
                transition: all 0.3s ease;
            }
            
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
            }
            
            .input-focus:focus {
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                border-color: #667eea;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gradient-custom bg-pattern">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            
            <!-- Logo et titre animé -->
            <div class="text-center mb-8 animate-float">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl shadow-lg mb-4">
                    <a href="/" class="flex items-center justify-center w-full h-full">
                        <x-application-logo class="w-12 h-12 fill-current text-white" />
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-white">{{ config('app.name', 'Marital System') }}</h1>
                <p class="text-white text-opacity-90 mt-1 text-sm">Gestion d'État Civil</p>
            </div>

            <!-- Carte principale -->
            <div class="w-full sm:max-w-md">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden card-hover">
                    <div class="px-6 py-8">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="text-center mt-8">
                    <p class="text-white text-opacity-75 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Marital System') }} - Tous droits réservés
                    </p>
                </div>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>