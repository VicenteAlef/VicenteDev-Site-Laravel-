<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação 2FA - VicenteDev Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-950 text-white min-h-screen flex items-center justify-center p-4">

    <div class="bg-gray-900 p-8 rounded-lg shadow-2xl w-full max-w-md border border-gray-800 text-center">
        <h2 class="text-2xl font-bold mb-2">Verificação em 2 Passos</h2>
        <p class="text-gray-400 text-sm mb-6">
            Enviamos um código de 6 dígitos para o seu e-mail. Insira-o abaixo para continuar.
        </p>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-6 text-left">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.2fa') }}" class="flex flex-col gap-5">
            @csrf
            
            <div>
                <input type="text" name="code" id="code" required autofocus maxlength="6" placeholder="000000"
                    class="w-full text-center tracking-[0.5em] text-2xl font-bold bg-gray-800 border border-gray-700 rounded px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
            </div>

            <button type="submit" 
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded transition-colors">
                Verificar Código
            </button>
        </form>

        <div class="mt-6 text-sm">
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                &larr; Voltar para o Login
            </a>
        </div>
    </div>

</body>
</html>