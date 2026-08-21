<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcademicController extends Controller
{
    public function courses(Request $request)
    {


        logger('AcademicController ejecutado', [
            'trace_id' => $request->attributes->get('trace_id'),
        ]);

        return response()->json([
            'message' => 'Consulta de cursos realizada correctamente',
            'courses' => [
                'Programación Web 2',
                'Arquitectura de Software',
                'Bases de Datos',
            ],
        ], 200);
    }
}