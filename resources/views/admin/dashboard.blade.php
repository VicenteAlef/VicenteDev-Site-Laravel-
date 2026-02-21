@extends('admin.layouts.app')

@section('title', 'Projetos')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Gestão de Projetos</h1>
        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl transition-colors flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg>
            Novo Projeto
        </a>
    </div>

    <div class="bg-gray-900 rounded-lg p-6 border border-gray-800 shadow-xl">
        <p class="text-gray-400 mb-4">Bem-vindo(a), {{ Auth::user()->name ?? 'Administrador' }}. A lista de projetos aparecerá aqui em breve.</p>
        
        <div class="h-64 border-2 border-dashed border-gray-700 rounded-lg flex items-center justify-center text-gray-500">
            A aguardar implementação da listagem de projetos...
        </div>
    </div>
@endsection