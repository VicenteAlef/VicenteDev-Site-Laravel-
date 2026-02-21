@extends('admin.layouts.app')

@section('title', 'Editar Projeto')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Editar Projeto</h1>
    <a href="{{ route('admin.projetos.index') }}" class="text-gray-400 hover:text-white transition-colors">&larr; Voltar</a>
</div>

<div class="bg-gray-900 rounded-lg p-6 md:p-8 border border-gray-800 shadow-xl w-full max-w-5xl">
    <form action="{{ route('admin.projetos.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Título do Projeto</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label for="summary" class="block text-sm font-medium text-gray-300 mb-1">Resumo</label>
            <textarea name="summary" id="summary" rows="3" required
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('summary', $project->summary) }}</textarea>
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-300 mb-1">Conteúdo Completo (Markdown)</label>
            <textarea name="content" id="content" rows="12" required
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 font-mono text-sm leading-relaxed">{{ old('content', $project->content) }}</textarea>
        </div>

        <hr class="border-gray-800 my-2">

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Imagem de Capa Atual</label>
                @if($project->cover_image)
                    <img src="{{ Storage::url($project->cover_image) }}" class="h-32 rounded object-cover border border-gray-700 mb-3">
                @endif
                <label for="cover_image" class="block text-sm font-medium text-gray-300 mb-1">Alterar Capa (Deixe em branco para manter)</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/jpeg,image/png,image/webp"
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-gray-300 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:bg-blue-500 file:text-white hover:file:bg-blue-600 cursor-pointer text-sm">
            </div>

            <div class="flex flex-col gap-4 justify-center">
                <div class="flex items-center gap-3 bg-gray-800/50 p-4 rounded border border-gray-700/50">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                        class="w-5 h-5 text-blue-500 bg-gray-900 border-gray-600 rounded focus:ring-blue-500 cursor-pointer">
                    <label for="is_featured" class="text-sm font-medium text-gray-200 cursor-pointer">Destacar na Home</label>
                </div>

                <div class="flex items-center gap-3 bg-gray-800/50 p-4 rounded border border-gray-700/50">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                        class="w-5 h-5 text-green-500 bg-gray-900 border-gray-600 rounded focus:ring-green-500 cursor-pointer">
                    <label for="is_active" class="text-sm font-medium text-gray-200 cursor-pointer">Projeto Ativo (Visível no site)</label>
                </div>
            </div>
        </div>

        <hr class="border-gray-800 my-2">

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Gerenciar Galeria</label>
            @if($project->images->count() > 0)
                <p class="text-xs text-gray-500 mb-3">Selecione as imagens que deseja <strong>excluir</strong>.</p>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                    @foreach($project->images as $image)
                        <div class="relative group">
                            <img src="{{ Storage::url($image->image_path) }}" class="h-24 w-full object-cover rounded border border-gray-700">
                            <div class="absolute top-1 right-1">
                                <input type="checkbox" name="delete_gallery[]" value="{{ $image->id }}" class="w-5 h-5 text-red-500 bg-gray-900 border-gray-600 rounded focus:ring-red-500 cursor-pointer shadow">
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 mb-4">Nenhuma imagem na galeria.</p>
            @endif

            <label for="gallery" class="block text-sm font-medium text-gray-300 mb-1">Adicionar Novas Imagens</label>
            <input type="file" name="gallery[]" id="gallery" accept="image/jpeg,image/png,image/webp" multiple
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-gray-300 file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:bg-gray-700 file:text-white hover:file:bg-gray-600 cursor-pointer text-sm">
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('admin.projetos.index') }}" class="px-6 py-2.5 rounded text-gray-300 hover:bg-gray-800 transition-colors">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-8 rounded transition-colors flex items-center gap-2">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
@endsection