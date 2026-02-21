@extends('admin.layouts.app')

@section('title', 'Novo Usuário')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Adicionar Usuário</h1>
    <a href="{{ route('admin.usuarios.index') }}" class="text-gray-400 hover:text-white transition-colors">&larr; Voltar</a>
</div>

<div class="bg-gray-900 rounded-lg p-6 md:p-8 border border-gray-800 shadow-xl w-full max-w-2xl">
    <form action="{{ route('admin.usuarios.store') }}" method="POST" class="flex flex-col gap-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nome Completo</label>
            <input type="text" name="name" id="name" required value="{{ old('name') }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail de Login</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Senha Provisória</label>
            <input type="password" name="password" id="password" required minlength="8"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            <p class="text-xs text-gray-500 mt-1">Mínimo de 8 caracteres. O usuário poderá alterar a senha depois no próprio perfil.</p>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Nível de Permissão</label>
            <select name="role" id="role" required class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor (Gerencia apenas projetos)</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador (Acesso total)</option>
            </select>
            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('admin.usuarios.index') }}" class="px-6 py-2.5 rounded text-gray-300 hover:bg-gray-800 transition-colors">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-8 rounded transition-colors">
                Criar Usuário
            </button>
        </div>
    </form>
</div>
@endsection