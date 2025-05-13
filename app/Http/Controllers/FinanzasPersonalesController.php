<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransaccionNotificacion;



class FinanzasPersonalesController extends Controller
{
    /**
     * Mostrar todas las transacciones.
     */
    public function index()
    {
        // Obtener todas las transacciones de todos los usuarios con sus relaciones (usuario, categoria)
        $transacciones = Transaccion::with(['usuario', 'categoria'])->get();

        // Retornar a la vista con las transacciones
        return view('transacciones.index', compact('transacciones'));

        // Recuperar todas las transacciones, incluidas las eliminadas
        $transacciones = Transaccion::withTrashed()->get();

        // Recuperar solo las transacciones eliminadas
        $transaccionesEliminadas = Transaccion::onlyTrashed()->get();

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
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo' => 'required|in:ingreso,gasto',
            'monto' => 'required|numeric|min:0.01',
            'descripcion' => 'nullable|string|max:255',
            'fecha' => 'required|date|before_or_equal:today',
            'files' => 'nullable|array',  // Acepta un arreglo de archivos
            'files.*' => 'file|mimes:jpeg,png,pdf,docx,txt|max:2048', // Validación de los archivos
        ]);

        try {
            // Crear la nueva transacción
            $transaccion = Transaccion::create([
                'usuario_id' => auth()->id(),
                'categoria_id' => $validatedData['categoria_id'],
                'tipo' => $validatedData['tipo'],
                'monto' => $validatedData['monto'],
                'descripcion' => $validatedData['descripcion'],
                'fecha' => $validatedData['fecha'],
            ]);

            // Manejo de archivos, si los hay
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    // Almacenar cada archivo en el directorio 'uploads'
                    $path = $file->store('uploads', 'public');
                    
                    // Aquí puedes guardar la relación de archivo con la transacción si tienes un modelo de relación
                    // Si tienes una tabla de archivos, asociarla con la transacción
                    $transaccion->archivos()->create([
                        'path' => $path
                    ]);
                }
            }

        // Enviar correo de notificación
        //Mail::to('destinatario@correo.com')->send(new TransaccionNotificacion($transaccion));
        Mail::to(auth()->user()->email)->send(new TransaccionNotificacion($transaccion));

            return redirect()->route('transacciones.index')->with('success', 'Transacción guardada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('transacciones.index')->with('error', 'Hubo un problema al guardar la transacción: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar una transacción específica.
     */
    public function show($id)
    {
        // Obtener la transacción por su ID
        $transaccion = Transaccion::with(['usuario', 'categoria'])->findOrFail($id);

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
        $validatedData = $request->validate([
            'monto' => 'required|numeric|min:0.01',  // El monto debe ser un número mayor que 0
            'descripcion' => 'nullable|string|max:255',  // Descripción opcional, con un máximo de 255 caracteres
        ]);

        try {
            // Actualizar los datos de la transacción
            $transaccion->update([
                'monto' => $validatedData['monto'],
                'descripcion' => $validatedData['descripcion'],
            ]);

            return redirect()->route('transacciones.index')->with('success', 'Transacción actualizada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('transacciones.index')->with('error', 'Hubo un problema al actualizar la transacción: ' . $e->getMessage());
        }
    }


    /**
     * Eliminar una transacción de la base de datos (borrado físico).
     */
    public function destroy($id)
    {
        // Buscar la transacción por ID
        $transaccion = Transaccion::findOrFail($id);

        try {
            // Eliminar la transacción (borrado físico)
            $transaccion->delete();

            return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada con éxito');
        } catch (\Exception $e) {
            return redirect()->route('transacciones.index')->with('error', 'Hubo un problema al eliminar la transacción.');
        }
    }
}
