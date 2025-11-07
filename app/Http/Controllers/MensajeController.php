<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use Illuminate\Http\Response;

class MensajeController extends Controller
{
    public function pendientes()
    {
        // Obtener los registros con estatus = 0
        $mensajes = Message::where('estatus', 0)->get(['id', 'mensaje', 'numero', 'estatus', 'fecha']);

        // Construir texto en formato pipeline
        $salida = '';
        foreach ($mensajes as $m) {
            $salida .= "{$m->id}|{$m->numero}|{$m->mensaje}\n";
        }

        // Devolver texto plano
        return response($salida, 200)
                ->header('Content-Type', 'text/plain');
    }

    public function marcarComoProcesado(int $id)
        {
            // 1. Encontrar el mensaje por su ID
            $mensaje = Message::find($id);
    
            // 2. Verificar si el mensaje existe
            if (!$mensaje) {
                return response()->json([
                    'error' => 'Mensaje no encontrado.'
                ], 404);
            }
    
            // 3. Actualizar el estatus a 1
            $mensaje->estatus = 1;
            $mensaje->save();
    
            // 4. Devolver una respuesta de éxito
            return response()->json([
                'message' => "Mensaje con ID {$id} marcado como procesado."
            ], 200);
        }
}

