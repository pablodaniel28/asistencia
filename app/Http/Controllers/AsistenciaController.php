<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Horarios;
use App\Models\User;
use App\Models\UsuarioHorario;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias= Asistencia::all();
        return view('asistencias.index', compact('asistencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        return view('asistencias.marcar', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $horario = Horarios::all();
        $request->validate([
            'dia' => 'required|string|max:255',
            'hora' => 'required|date_format:H:i',
            'huella' => 'required|string|max:255', // Asumiendo que 'huella' es el campo de la huella
        ]);


        // Buscar al usuario por la huella proporcionada
        $usuario = User::where('huella', $request->huella)->first();
        if (!$usuario) {
             return redirect()->back()->with('error', 'Error de Huella de Usuario');
         }


        $usuariohorarios = UsuarioHorario::all();
        $dia = $request->dia;
        $hora = $request->hora;

        // Obtener los horarios del usuario que coinciden con el día especificado y verificar si la hora está entre hora_inicio y hora_fin
        $horarios = $usuario->horarios()
                            ->where('dia', $dia)
                            ->where('hora_inicio', '<=', $hora)
                            ->where('hora_fin', '>=', $hora)
                            ->get();

        if ($horarios->isNotEmpty()) {
            // Crear un registro de asistencia
            $asistencia = new Asistencia();
            $asistencia->nombre = 'presente';
            $asistencia->dia = $dia;
            $asistencia->hora = $hora;
            $asistencia->usuario_id = $usuario->id;
            $asistencia->save();

            return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente');
        } else {
            // No hay horarios para este día y hora
            return redirect()->route('asistencias.create')->with('error', 'No hay horarios disponibles para el día y hora especificados');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia ->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminado correctamente');
    }
}
