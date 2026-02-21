<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vicente Developer')</title>
    @vite('resources/css/app.css')
    
    <style>
        /* Pequenas animações customizadas que você tinha no React */
        .animate-wiggle { animation: wiggle 2s linear infinite; }
        @keyframes wiggle {
            0%, 7%, 15% { transform: rotate(0); }
            3%, 11% { transform: rotate(-10deg); }
            5%, 13% { transform: rotate(10deg); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#0a0d11] text-white font-sans antialiased overflow-x-hidden">

    <header class="flex items-center justify-between px-4 lg:px-[10%] py-4 bg-[#0a0d11]/95 backdrop-blur-sm text-white fixed z-50 w-full border-b border-gray-800/50">
        <div class="font-bold text-xl tracking-wider">
            <a href="{{ route('site.home') }}">Vicente<span class="text-blue-500">Dev</span></a>
        </div>

        <button id="mobileMenuBtn" class="text-2xl md:hidden focus:outline-none">
            ☰
        </button>

        <nav id="navMenu" class="absolute top-full left-0 w-full bg-[#0c0f13] md:bg-transparent z-50 md:static md:block md:w-auto transition-all duration-300 hidden md:flex border-b md:border-none border-gray-800">
            <ul class="flex flex-col md:flex-row md:gap-6 p-4 md:p-0 font-bold">
                <li>
                    <a href="{{ request()->routeIs('site.home') ? '#home' : route('site.home') }}" class="block py-2 px-4 hover:bg-blue-950/50 rounded md:hover:bg-transparent md:hover:text-blue-400 transition-colors">Home</a>
                </li>
                <li>
                    <a href="{{ request()->routeIs('site.home') ? '#about' : route('site.home').'#about' }}" class="block py-2 px-4 hover:bg-blue-950/50 rounded md:hover:bg-transparent md:hover:text-blue-400 transition-colors">Sobre mim</a>
                </li>
                <li>
                    <a href="{{ route('site.projects') }}" class="block py-2 px-4 hover:bg-blue-950/50 rounded md:hover:bg-transparent md:hover:text-blue-400 transition-colors {{ request()->routeIs('site.projects*') ? 'text-blue-500' : '' }}">Projetos</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="w-full h-24 bg-black text-gray-400 flex items-center justify-center border-t border-gray-900 mt-20">
        <p>Vicente Developer&copy; - {{ date('Y') }}</p>
    </footer>

    <div class="fixed w-[50px] h-[50px] flex items-center justify-center bg-green-500 hover:bg-green-600 hover:scale-110 duration-500 ease-in-out bottom-6 right-5 rounded-full shadow-lg shadow-green-500/30 z-40 animate-wiggle">
        <a href="https://wa.me/+5561982070086" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="white" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
            </svg>
        </a>
    </div>

    <script>
        // Menu Mobile
        const btn = document.getElementById('mobileMenuBtn');
        const menu = document.getElementById('navMenu');
        
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            btn.innerHTML = menu.classList.contains('hidden') ? '☰' : '✖';
        });

        // Fechar menu ao clicar num link
        document.querySelectorAll('#navMenu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                btn.innerHTML = '☰';
            });
        });

        // Intersection Observer (O seu RevealOnScroll do React)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.classList.remove('opacity-0');
                    observer.unobserve(entry.target); // Anima só uma vez
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach((el) => {
            el.classList.add('opacity-0'); // Começa invisível
            observer.observe(el);
        });
    </script>
</body>
</html>