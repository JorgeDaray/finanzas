<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransaccionNotificacion;
use App\Models\Transaccion;

class UserController extends Controller
{
    public function index()
    {
        // Obtén todos los usuarios
        $users = User::all();
        
        // Pasa los usuarios a la vista
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        // Encuentra al usuario con el ID proporcionado, si no se encuentra, redirige con un mensaje de error
        $user = User::find($id);

        // Si el usuario no existe, redirige con un mensaje de error
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado');
        }

        // Obtiene los roles asociados a ese usuario
        $roles = $user->roles;

        // Pasa los datos a la vista
        return view('user.show', compact('user', 'roles'));
    }
}


