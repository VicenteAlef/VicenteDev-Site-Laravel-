<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VicenteDev Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-4">

    <div class="bg-gray-900 p-8 rounded-lg shadow-2xl w-full max-w-md border border-gray-800">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">VicenteDev</h1>
            <p class="text-gray-400 mt-2">Painel Administrativo</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/admin/login') }}" class="flex flex-col gap-5">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Senha</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>

            <button type="submit" 
                class="w-full mt-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded transition-colors">
                Entrar
            </button>
        </form>
    </div>

</body>
</html>