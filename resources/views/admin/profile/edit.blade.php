@extends('admin.layouts.app')

@section('title', 'Meu Perfil')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Meu Perfil</h1>
</div>

@if(session('success'))
    <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-gray-900 rounded-lg p-6 md:p-8 border border-gray-800 shadow-xl w-full max-w-2xl">
    <form action="{{ route('admin.perfil.update') }}" method="POST" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">E-mail (Login)</label>
            <input type="email" value="{{ $user->email }}" disabled
                class="w-full bg-gray-950 border border-gray-800 rounded px-4 py-2 text-gray-500 cursor-not-allowed">
            <p class="text-xs text-gray-500 mt-1">O e-mail só pode ser alterado por um Administrador na gestão de usuários.</p>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nome de Exibição</label>
            <input type="text" name="name" id="name" required value="{{ old('name', $user->name) }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <hr class="border-gray-800 my-2">
        <h3 class="text-lg font-semibold text-gray-300">Alterar Senha</h3>
        <p class="text-sm text-gray-500 mb-2">Deixe em branco se não quiser alterar a senha atual.</p>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Nova Senha</label>
            <input type="password" name="password" id="password"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirmar Nova Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-8 rounded transition-colors">
                Salvar Perfil
            </button>
        </div>
    </form>
</div>
@endsection