@extends('site.layouts.app')

@section('title', 'Meus Projetos - VicenteDev')

@section('content')
<div class="bg-gray-950 min-h-screen pt-24 pb-20 px-4 md:px-[10%] xl:px-[15%]">
    
    <div class="mb-12 reveal">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Meus Projetos</h1>
        <p class="text-gray-400 text-lg mb-8 max-w-2xl">
            Explore os meus trabalhos recentes. De interfaces limpas no front-end a arquiteturas robustas no back-end.
        </p>

        <form action="{{ route('site.projects') }}" method="GET" class="w-full max-w-2xl flex gap-3">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por tecnologia (ex: Laravel, React)..." 
                    class="block w-full p-4 pl-12 text-base bg-gray-900 border border-gray-800 rounded-xl text-white focus:ring-blue-500 focus:border-blue-500 transition-colors placeholder-gray-500 shadow-lg">
            </div>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-bold rounded-xl text-base px-6 py-4 transition-colors shadow-lg shadow-blue-500/20">
                Buscar
            </button>
        </form>
        
        @if(!empty($search))
            <div class="mt-4 flex items-center gap-2 text-gray-400">
                <span>Mostrando resultados para: <strong class="text-white">"{{ $search }}"</strong></span>
                <a href="{{ route('site.projects') }}" class="text-blue-500 hover:underline text-sm ml-2">Limpar filtro</a>
            </div>
        @endif
    </div>

    @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 reveal">
            @foreach($projects as $project)
                <div class="bg-gray-900 rounded-2xl border border-gray-800 shadow-xl overflow-hidden flex flex-col hover:-translate-y-2 transition-transform duration-300 group">
                    <div class="h-48 overflow-hidden relative">
                        @if($project->cover_image)
                            <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-500">Sem Imagem</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-80"></div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-2xl font-bold mb-3 text-white">{{ $project->title }}</h3>
                        <p class="text-gray-400 text-sm mb-6 flex-1 line-clamp-3">
                            {{ $project->summary }}
                        </p>
                        
                        <a href="{{ route('site.project.details', $project->slug) }}" class="inline-flex items-center justify-center gap-2 bg-gray-800 hover:bg-blue-600 border border-gray-700 hover:border-blue-600 w-full py-3 rounded-xl transition-all font-semibold text-white group-hover:shadow-lg group-hover:shadow-blue-500/20">
                            Ver Projeto Completo
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="reveal">
            {{ $projects->appends(request()->query())->links() }}
        </div>
    @else
        <div class="reveal py-20 text-center bg-gray-900 rounded-2xl border border-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-search mx-auto text-gray-700 mb-4" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-300 mb-2">Nenhum projeto encontrado</h3>
            <p class="text-gray-500">Não encontramos nenhum projeto correspondente a "{{ $search }}".</p>
            <a href="{{ route('site.projects') }}" class="inline-block mt-4 text-blue-500 hover:text-blue-400 font-medium">Limpar busca e ver todos</a>
        </div>
    @endif

</div>
@endsection