<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class FinanzasPersonalesController extends Controller
{
    /**
     * Mostrar todas las transacciones.
     */
    public function index()
    {
        // Obtener todas las transacciones de todos los usuarios
        $transacciones = Transaccion::all();

        // Retornar a la vista con las transacciones
        return view('transacciones.index', compact('transacciones'));
    }

    /**
     * Mostrar el formulario para crear una nueva transacción.
     */
    public function create()
    {
        // Obtener las categorías y los usuarios
        $categorias = Categoria::all();
        $usuarios = User::all();

        // Retornar a la vista con los datos necesarios
        return view('transacciones.create', compact('categorias', 'usuarios'));
    }

    /**
     * Almacenar una nueva transacción en la base de datos.
     */
    public function store(Request $request)
    {
    // Validar los datos recibidos
    $request->validate([
        'usuario_id' => 'required|exists:users,id',
        'categoria_id' => 'required|exists:categorias,id',
        'tipo' => 'required|in:ingreso,gasto',
        'monto' => 'required|numeric',
        'descripcion' => 'nullable|string',
        'fecha' => 'required|date',
    ]);

    // Crear una nueva transacción
    Transaccion::create([
        'usuario_id' => $request->usuario_id,
        'categoria_id' => $request->categoria_id,
        'tipo' => $request->tipo,
        'monto' => $request->monto,
        'descripcion' => $request->descripcion,
        'fecha' => $request->fecha,
    ]);

        // Redirigir a la vista de transacciones con un mensaje de éxito
        return redirect()->route('transacciones.index')->with('success', 'Transacción guardada correctamente.');
    }

    /**
     * Mostrar una transacción específica.
     */
    public function show($id)
    {
        // Obtener la transacción por su ID
        $transaccion = Transaccion::findOrFail($id);

        // Retornar a la vista con la transacción
        return view('transacciones.show', compact('transaccion'));
    }

    /**
     * Mostrar el formulario para editar una transacción.
     */
    public function edit($id)
    {
        // Obtener la transacción por su ID
        $transaccion = Transaccion::findOrFail($id);

        // Obtener las categorías y los usuarios
        $categorias = Categoria::all();
        $usuarios = User::all();

        // Retornar a la vista con los datos para editar
        return view('transacciones.edit', compact('transaccion', 'categorias', 'usuarios'));
    }

    /**
     * Actualizar una transacción en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Buscar la transacción por ID
        $transaccion = Transaccion::findOrFail($id);

        // Validar los datos de entrada
        $request->validate([
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ]);

        // Actualizar los datos de la transacción
        $transaccion->update([
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('transacciones.index')->with('success', 'Transacción actualizada con éxito');
    }

    /**
     * Eliminar una transacción de la base de datos.
     */
    public function destroy($id)
    {
        // Buscar la transacción por ID
        $transaccion = Transaccion::findOrFail($id);

        // Eliminar la transacción
        $transaccion->delete();

        return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada con éxito');
    }
}

