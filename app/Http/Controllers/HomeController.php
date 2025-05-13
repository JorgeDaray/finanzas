<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransaccionNotificacion;
use App\Models\User;
use App\Models\Transaccion;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Verifica si el usuario tiene el rol de 'admin'
        $isAdmin = auth()->user()->roles->contains('name', 'admin');

        return view('home', compact('isAdmin'));
    }

}
