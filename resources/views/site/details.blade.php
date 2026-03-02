@extends('site.layouts.app')

@section('title', $project->title . ' - VicenteDev')

@section('content')
<div class="bg-gray-950 min-h-screen pt-24 pb-20 px-4 md:px-[10%] xl:px-[15%]">

    <div class="mb-8 reveal">
        <a href="{{ route('site.projects') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg>
            Voltar para Projetos
        </a>
    </div>

    <div class="mb-12 reveal">
        <div class="w-full h-[40vh] md:h-[60vh] rounded-3xl overflow-hidden border border-gray-800 shadow-2xl relative mb-8">
            @if($project->cover_image)
            <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gray-900 flex items-center justify-center text-gray-500">Sem Imagem de Capa</div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-900/40 to-transparent"></div>

            <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg">{{ $project->title }}</h1>
                <p class="text-xl md:text-2xl text-gray-300 font-light max-w-3xl drop-shadow-md">
                    {{ $project->summary }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-gray-900 rounded-3xl p-8 md:p-12 border border-gray-800 shadow-xl mb-12 reveal">
        <div class="prose prose-invert prose-lg prose-blue max-w-none prose-img:rounded-xl prose-a:text-blue-400 hover:prose-a:text-blue-300">
            {!! Str::markdown($project->content) !!}
        </div>
    </div>

    @if($project->images->count() > 0)
    <div class="reveal">
        <h2 class="text-3xl font-bold mb-8 text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="text-blue-500" viewBox="0 0 16 16">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
            </svg>
            Galeria
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($project->images as $image)
            <div class="rounded-2xl overflow-hidden border border-gray-800 shadow-lg hover:shadow-blue-500/20 transition-all duration-300 group cursor-pointer">
                <a href="{{ Storage::url($image->image_path) }}" target="_blank">
                    <img src="{{ Storage::url($image->image_path) }}" alt="Galeria {{ $project->title }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection