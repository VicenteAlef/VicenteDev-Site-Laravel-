@extends('admin.layouts.app')

@section('title', 'Gestão de Usuários')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold">Gestão de Usuários</h1>
        <a href="{{ route('admin.usuarios.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-5 rounded-xl transition-colors flex items-center gap-2 shadow-lg shadow-blue-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            Novo Usuário
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="bg-gray-900 rounded-xl border border-gray-800 shadow-xl overflow-hidden">
        
        <div class="p-4 border-b border-gray-800 bg-gray-900/50">
            <form action="{{ route('admin.usuarios.index') }}" method="GET" class="flex gap-3 max-w-md">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nome ou e-mail..." 
                        class="block w-full p-2.5 text-sm bg-gray-800 border border-gray-700 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-300 uppercase bg-gray-800/50 border-b border-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-4">Usuário</th>
                        <th scope="col" class="px-6 py-4">Nível de Acesso</th>
                        <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-800 hover:bg-gray-800/25">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-base">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'root')
                                    <span class="bg-purple-500/10 text-purple-400 text-xs font-bold px-2.5 py-1 rounded border border-purple-500/20">Root</span>
                                @elseif($user->role === 'admin')
                                    <span class="bg-blue-500/10 text-blue-400 text-xs font-bold px-2.5 py-1 rounded border border-blue-500/20">Admin</span>
                                @else
                                    <span class="bg-gray-700/50 text-gray-300 text-xs font-bold px-2.5 py-1 rounded border border-gray-600/50">Editor</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="text-green-400 font-medium flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Ativo</span>
                                @else
                                    <span class="text-red-400 font-medium flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-500"></span> Inativo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3 items-center">
                                    @if($user->role !== 'root' || auth()->user()->role === 'root')
                                        <a href="{{ route('admin.usuarios.edit', $user->id) }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Editar</a>
                                    @endif
                                    
                                    @if($user->role !== 'root' && $user->id !== auth()->id())
                                        <form action="{{ route('admin.usuarios.toggleStatus', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="{{ $user->is_active ? 'text-red-400 hover:text-red-300' : 'text-green-400 hover:text-green-300' }} font-medium transition-colors">
                                                {{ $user->is_active ? 'Desativar' : 'Reativar' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
            <div class="p-4 border-t border-gray-800 bg-gray-900/50">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection