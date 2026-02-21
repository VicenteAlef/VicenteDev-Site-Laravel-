@extends('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Editar Usuário</h1>
    <a href="{{ route('admin.usuarios.index') }}" class="text-gray-400 hover:text-white transition-colors">&larr; Voltar</a>
</div>

<div class="bg-gray-900 rounded-lg p-6 md:p-8 border border-gray-800 shadow-xl w-full max-w-2xl">
    <form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nome Completo</label>
            <input type="text" name="name" id="name" required value="{{ old('name', $user->name) }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">E-mail de Login</label>
            <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Redefinir Senha (Opcional)</label>
            <input type="password" name="password" id="password" minlength="8" placeholder="Deixe em branco para manter a atual"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-300 mb-1">Nível de Permissão</label>
            @if($user->role === 'root')
                <input type="hidden" name="role" value="root">
                <input type="text" disabled value="Root (Imutável)" class="w-full bg-gray-950 border border-gray-800 rounded px-4 py-2 text-purple-400 font-bold cursor-not-allowed">
            @else
                <select name="role" id="role" required class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                    <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            @endif
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('admin.usuarios.index') }}" class="px-6 py-2.5 rounded text-gray-300 hover:bg-gray-800 transition-colors">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-8 rounded transition-colors">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection