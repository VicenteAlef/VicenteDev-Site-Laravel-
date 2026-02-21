<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel') - VicenteDev Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-950 text-white min-h-screen flex flex-col">

    <header class="bg-[#0a0d11] border-b border-gray-800 fixed w-full z-50 h-16 flex items-center justify-between px-4 lg:px-6">
        <div class="text-xl font-bold tracking-wider">
            <a href="{{ route('admin.projetos.index') }}">VicenteDev <span class="text-blue-500">- Admin</span></a>
        </div>

        <div class="flex items-center gap-4">
            
            <div class="relative">
                <button id="userMenuBtn" class="flex items-center gap-2 hover:text-blue-400 transition-colors focus:outline-none">
                    <span class="font-medium">{{ Auth::user()->name ?? 'Administrador' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down mt-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>

                <div id="userDropdown" class="hidden absolute right-0 mt-3 w-48 bg-gray-900 border border-gray-700 rounded shadow-lg overflow-hidden z-50">
                    <a href="{{ route('admin.perfil.edit') }}" class="block px-4 py-2 hover:bg-gray-800 transition-colors">Meu Perfil</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-gray-800 transition-colors">
                            Sair
                        </button>
                    </form>
                </div>
            </div>

            <button id="sidebarToggle" class="text-gray-300 hover:text-white focus:outline-none p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
    </header>

    <div class="flex flex-1 pt-16">
        
        <aside id="sidebar" class="bg-gray-900 border-r border-gray-800 w-64 fixed h-full transition-transform duration-300 transform translate-x-full right-0 z-40 flex flex-col pt-6">
            <nav class="flex-1 px-4 space-y-2 font-medium">
                <a href="{{ route('admin.projetos.index') }}" class="block px-4 py-2.5 rounded-md bg-blue-600/20 text-blue-400">
                    Projetos
                </a>
                
                @if(Auth::check() && (Auth::user()->role === 'root' || Auth::user()->role === 'admin'))
                <a href="{{ route('admin.usuarios.index') }}" class="block px-4 py-2.5 rounded-md hover:bg-gray-800 text-gray-300 hover:text-white transition-colors">
                    Utilizadores
                </a>
                @endif
            </nav>
        </aside>

        <main class="flex-1 p-6 md:p-8 lg:px-12 w-full transition-all duration-300">
            @yield('content')
        </main>
        
        <div id="sidebarOverlay" class="hidden fixed inset-0 bg-black/50 z-30 lg:hidden"></div>
    </div>

    <script>
        // Lógica do Dropdown de Utilizador
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userDropdown = document.getElementById('userDropdown');

        userMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle('hidden');
        });

        // Fechar dropdown ao clicar fora
        document.addEventListener('click', () => {
            if (!userDropdown.classList.contains('hidden')) {
                userDropdown.classList.add('hidden');
            }
        });

        // Lógica da Sidebar
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        let sidebarOpen = false;

        function toggleSidebar() {
            sidebarOpen = !sidebarOpen;
            if (sidebarOpen) {
                sidebar.classList.remove('translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
    </script>
</body>
</html>