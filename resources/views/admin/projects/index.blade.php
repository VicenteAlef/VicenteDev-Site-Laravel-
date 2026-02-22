@extends('admin.layouts.app')

@section('title', 'Projetos')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <h1 class="text-3xl font-bold">Gestão de Projetos</h1>
    <a href="{{ route('admin.projetos.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-5 rounded-xl transition-colors flex items-center gap-2 shadow-lg shadow-blue-500/20">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
        </svg>
        Novo Projeto
    </a>
</div>

@if(session('success'))
<div class="bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6 flex items-center gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-gray-900 rounded-xl border border-gray-800 shadow-xl overflow-hidden">

    <div class="p-4 border-b border-gray-800 bg-gray-900/50">
        <form action="{{ route('admin.projetos.index') }}" method="GET" class="flex gap-3 max-w-md">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Pesquisar projetos..."
                    class="block w-full p-2.5 pl-10 text-sm bg-gray-800 border border-gray-700 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
            </div>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                Buscar
            </button>
            @if(!empty($search))
            <a href="{{ route('admin.projetos.index') }}" class="text-gray-400 hover:text-white bg-gray-800 hover:bg-gray-700 border border-gray-700 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                Limpar
            </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs text-gray-300 uppercase bg-gray-800/50 border-b border-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-4 rounded-tl-lg">Projeto</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Criado em</th>
                    <th scope="col" class="px-6 py-4 text-right rounded-tr-lg">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr class="border-b border-gray-800 hover:bg-gray-800/25 transition-colors">
                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap flex items-center gap-4">
                        <div class="w-16 h-12 rounded bg-gray-800 overflow-hidden flex-shrink-0 border border-gray-700">
                            @if($project->cover_image)
                            <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-600">Sem foto</div>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('admin.projetos.edit', $project->id) }}" class="text-base font-semibold">{{ $project->title }}</a>
                            <div class="text-xs text-gray-500 font-normal">/{{ $project->slug }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1 items-start">
                            @if($project->is_active)
                            <span class="bg-green-500/10 text-green-400 text-xs font-medium px-2.5 py-0.5 rounded border border-green-500/20">Ativo</span>
                            @else
                            <span class="bg-red-500/10 text-red-400 text-xs font-medium px-2.5 py-0.5 rounded border border-red-500/20">Inativo</span>
                            @endif

                            @if($project->is_featured)
                            <span class="bg-yellow-500/10 text-yellow-500 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-500/20 flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                Destaque Home
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $project->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.projetos.edit', $project->id) }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">Editar</a>

                            <form action="{{ route('admin.projetos.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este projeto? Esta ação não pode ser desfeita e apagará as imagens.');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium transition-colors">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-folder-x mb-4 text-gray-700" viewBox="0 0 16 16">
                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zm6.339-1.576A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z" />
                                <path d="M11.854 10.146a.5.5 0 0 0-.707.708L12.293 12l-1.146 1.146a.5.5 0 0 0 .707.708L13 12.707l1.146 1.146a.5.5 0 0 0 .708-.708L13.707 12l1.146-1.146a.5.5 0 0 0-.708-.708L13 11.293l-1.146-1.147z" />
                            </svg>
                            <p class="text-lg font-medium text-gray-400">Nenhum projeto encontrado</p>
                            @if(!empty($search))
                            <p class="text-sm mt-1 text-gray-500">Tente buscar por termos diferentes.</p>
                            @else
                            <p class="text-sm mt-1 text-gray-500">Clique em "Novo Projeto" para começar.</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($projects->hasPages())
    <div class="p-4 border-t border-gray-800 bg-gray-900/50">
        {{ $projects->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection