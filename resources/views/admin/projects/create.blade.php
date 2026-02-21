@extends('admin.layouts.app')

@section('title', 'Novo Projeto')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Adicionar Novo Projeto</h1>
    <a href="{{ route('admin.projetos.index') }}" class="text-gray-400 hover:text-white transition-colors">&larr; Voltar para listagem</a>
</div>

<div class="bg-gray-900 rounded-lg p-6 md:p-8 border border-gray-800 shadow-xl w-full max-w-5xl">
    <form action="{{ route('admin.projetos.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Título do Projeto</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="Ex: Nexus ou Royal Enfield"
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="summary" class="block text-sm font-medium text-gray-300 mb-1">Resumo</label>
            <textarea name="summary" id="summary" rows="3" required placeholder="Um texto curto para aparecer nos cards..."
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('summary') }}</textarea>
            @error('summary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-300 mb-1">Conteúdo Completo (Markdown)</label>
            <textarea name="content" id="content" rows="12" required placeholder="## Sobre o projeto&#10;Este projeto foi desenvolvido com..."
                class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 font-mono text-sm leading-relaxed">{{ old('content') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Utilize a sintaxe Markdown para criar títulos, listas, negrito e inserir links para repositórios ou sites ao vivo.</p>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <hr class="border-gray-800 my-2">

        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-300 mb-1">Imagem de Capa (Obrigatória)</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/jpeg,image/png,image/webp" required
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 cursor-pointer">
                <p class="text-xs text-gray-500 mt-1">Recomendado: 1920x1080px. Max: 2MB.</p>
                @error('cover_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="gallery" class="block text-sm font-medium text-gray-300 mb-1">Galeria de Imagens (Opcional)</label>
                <input type="file" name="gallery[]" id="gallery" accept="image/jpeg,image/png,image/webp" multiple
                    class="w-full bg-gray-800 border border-gray-700 rounded px-4 py-2 text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600 cursor-pointer">
                <p class="text-xs text-gray-500 mt-1">Selecione várias imagens segurando CTRL ou SHIFT.</p>
                @error('gallery') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr class="border-gray-800 my-2">

        <div class="flex items-center gap-3 bg-gray-800/50 p-4 rounded border border-gray-700/50">
            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                class="w-5 h-5 text-blue-500 bg-gray-900 border-gray-600 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer">
            <label for="is_featured" class="text-sm font-medium text-gray-200 cursor-pointer select-none">
                Destacar este projeto na Home
                <span class="block text-xs text-gray-500 font-normal">Marcando esta opção, o projeto aparecerá no carrossel da página inicial.</span>
            </label>
        </div>

        <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('admin.projetos.index') }}" class="px-6 py-2.5 rounded text-gray-300 hover:bg-gray-800 transition-colors">Cancelar</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2.5 px-8 rounded transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                    <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z"/>
                </svg>
                Salvar Projeto
            </button>
        </div>
    </form>
</div>
@endsection