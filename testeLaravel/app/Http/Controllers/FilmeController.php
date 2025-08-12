<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filme;
use Illuminate\Support\Facades\Storage;

class FilmeController extends Controller
{
    public function index()
    {
        $filmes = Filme::latest()->get();
        return view('welcome', compact('filmes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $data['imagem'] = $request->file('imagem')->store('filmes', 'public');
        }

        Filme::create($data);
        return redirect()->route('filmes.index')->with('success', 'Filme adicionado com sucesso!');
    }

    public function edit(Filme $filme)
    {
        $filmes = Filme::latest()->get();
        return view('welcome', compact('filmes', 'filme'));
    }

    public function update(Request $request, Filme $filme)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            // Remove imagem antiga
            if ($filme->imagem && Storage::disk('public')->exists($filme->imagem)) {
                Storage::disk('public')->delete($filme->imagem);
            }
            $data['imagem'] = $request->file('imagem')->store('filmes', 'public');
        }

        $filme->update($data);
        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    public function destroy(Filme $filme)
    {
        if ($filme->imagem && Storage::disk('public')->exists($filme->imagem)) {
            Storage::disk('public')->delete($filme->imagem);
        }
        $filme->delete();
        return redirect()->route('filmes.index')->with('success', 'Filme removido com sucesso!');
    }
}
