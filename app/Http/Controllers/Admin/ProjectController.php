<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // 1. Lista os projetos no Dashboard
    public function index(Request $request)
    {
        // Pega a busca se houver, se não, traz tudo ordenado pelo mais recente
        $search = $request->input('search');

        $projects = Project::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 itens por página

        return view('admin.projects.index', compact('projects', 'search'));
    }

    // 2. Mostra a tela do formulário
    public function create()
    {
        return view('admin.projects.create');
    }

    // 3. Recebe os dados, faz upload e salva no banco
    public function store(Request $request)
    {
        // Validação de segurança
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required',
            'content' => 'required', // O nosso Markdown
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 2MB
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Imagens da galeria
        ]);

        // Cria um slug seguro para a URL (Ex: "Royal Enfield" vira "royal-enfield")
        $slug = Str::slug($request->title);

        // Garante que o slug seja único
        if (Project::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        // Upload da Imagem de Capa
        $coverPath = $request->file('cover_image')->store('projects/covers', 'public');

        // Cria o projeto no banco
        $project = Project::create([
            'title' => $request->title,
            'slug' => $slug,
            'summary' => $request->summary,
            'content' => $request->content,
            'cover_image' => $coverPath,
            'is_featured' => $request->has('is_featured'), // true se o checkbox foi marcado
            'is_active' => true,
        ]);

        // Upload das imagens da Galeria (se houver)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('projects/gallery', 'public');

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.projetos.index')
            ->with('success', 'Projeto criado com sucesso!');
    }

    // 4. Mostra a tela de edição
    public function edit($id)
    {
        $project = Project::with('images')->findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    // 5. Recebe os dados da edição e atualiza
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Nullable na edição
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'delete_gallery.*' => 'nullable|exists:project_images,id' // IDs das imagens para excluir
        ]);

        // Atualiza slug se o título mudou
        if ($project->title !== $request->title) {
            $slug = Str::slug($request->title);
            if (Project::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug .= '-' . time();
            }
            $project->slug = $slug;
        }

        $project->title = $request->title;
        $project->summary = $request->summary;
        $project->content = $request->content;
        $project->is_featured = $request->has('is_featured');
        $project->is_active = $request->has('is_active');

        // Se enviou uma nova capa, exclui a antiga e salva a nova
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $project->cover_image = $request->file('cover_image')->store('projects/covers', 'public');
        }

        $project->save();

        // Excluir imagens da galeria selecionadas
        if ($request->has('delete_gallery')) {
            $imagesToDelete = ProjectImage::whereIn('id', $request->delete_gallery)->get();
            foreach ($imagesToDelete as $image) {
                Storage::disk('public')->delete($image->image_path); // Apaga arquivo físico
                $image->delete(); // Apaga do banco
            }
        }

        // Adicionar novas imagens à galeria
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.projetos.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    // 6. Exclui o projeto e todas as suas imagens
    public function destroy($id)
    {
        $project = Project::with('images')->findOrFail($id);

        // Exclui a imagem de capa física
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }

        // Exclui as imagens da galeria físicas
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        // A exclusão no banco (cascata) já cuida dos registros na tabela project_images
        $project->delete();

        return redirect()->route('admin.projetos.index')->with('success', 'Projeto excluído com sucesso!');
    }
}
