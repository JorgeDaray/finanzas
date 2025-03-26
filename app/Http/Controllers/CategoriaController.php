<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    // Mostrar el formulario para agregar una categoría
    public function create()
    {
        return view('categorias.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        // Validación de la categoría
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear y guardar la nueva categoría
        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        // Redirigir a la vista de categorías
        return redirect()->route('categorias.index');
    }

    // Mostrar los detalles de una categoría (si es necesario)
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    // Mostrar el formulario para editar una categoría (si es necesario)
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    // Actualizar una categoría (si es necesario)
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categorias.index');
    }

    // Eliminar una categoría (si es necesario)
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
