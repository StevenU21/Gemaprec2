<?php

namespace App\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function __construct($message = "No tienes permiso para realizar esta acción.")
    {
        parent::__construct($message);
    }

    public function render($request)
    {
        // Redirige a la página anterior con un mensaje de error
        return redirect()->back()->with('error', $this->getMessage());
    }
}
