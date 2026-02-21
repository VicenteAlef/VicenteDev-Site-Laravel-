<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class SiteController extends Controller
{
    // 1. Página Home (Exibe até 5 projetos em destaque)
    public function index()
    {
        $featuredProjects = Project::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();

        return view('site.home', compact('featuredProjects'));
    }

    // 2. Página de Projetos (Busca e Paginação) - Faremos a seguir
    public function projects(Request $request)
    {
        $search = $request->input('search');

        $projects = Project::where('is_active', true)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6); // 6 itens por página para formar um grid bonito (2 ou 3 colunas)

        return view('site.projects', compact('projects', 'search'));
    }

    // 3. Página de Detalhes do Projeto - Faremos a seguir
    public function show($slug)
    {
        // Busca o projeto pelo slug, traz a galeria junto, e garante que está ativo. 
        // Se não achar, o firstOrFail() já retorna uma página 404 bonitona do Laravel.
        $project = Project::with('images')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('site.details', compact('project'));
    }
}
