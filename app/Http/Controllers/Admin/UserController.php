<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,editor',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Impede que um admin edite o root
        if ($user->role === 'root' && auth()->user()->role !== 'root') {
            return redirect()->route('admin.usuarios.index')->withErrors(['Você não pode editar o usuário Root.']);
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'root' && auth()->user()->role !== 'root') {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,editor,root',
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Root não pode perder o cargo de root
        if ($user->role !== 'root') {
            $user->role = $request->role;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado!');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Regra de ouro: Root não pode ser desativado, e ninguém desativa a si mesmo
        if ($user->role === 'root') {
            return back()->withErrors(['O usuário Root não pode ser desativado.']);
        }
        if ($user->id === auth()->id()) {
            return back()->withErrors(['Você não pode desativar a si mesmo.']);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'ativado' : 'desativado';
        return back()->with('success', "Usuário {$status} com sucesso!");
    }
}
