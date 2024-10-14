<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class CustomLogoutResponse implements Responsable
{
    public function toResponse($request)
    {
        // Redirigir a la página de inicio de sesión después de cerrar sesión
        return redirect('/login');
    }
}
