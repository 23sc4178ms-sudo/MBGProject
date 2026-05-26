<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected function adminAjaxResponse(Request $request, string $message, string $redirect, array $data = [], int $status = 200)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(array_merge([
                'message' => $message,
                'redirect' => $redirect,
            ], $data), $status);
        }

        return redirect($redirect)->with('success', $message);
    }

    protected function adminAjaxError(Request $request, string $message, string $redirect, int $status = 400)
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => $message,
                'redirect' => $redirect,
            ], $status);
        }

        return redirect($redirect)->with('error', $message);
    }
}
// HOW TO MAKE CONTROLLER PROMPT
//php artisan make:controller PagesController
// extend its like inherit 
