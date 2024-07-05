<?php

namespace App\Http\Controllers;

use App\Models\Horarios;
use App\Models\User;
use App\Models\UsuarioHorario;
use Illuminate\Http\Request;

class UsuarioHorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horarios::all();
        $usuarios = User::all();
        $usuariohorarios = UsuarioHorario::all();
        return view('horario.usuariohorario', compact('usuariohorarios', 'horarios', 'usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario' => 'required|exists:users,id',
            'horarios' => 'required|array',
            'horarios.*' => 'exists:horarios,id'
        ]);

        try {
            // Obtener el usuario
            $usuario = User::findOrFail($request->input('usuario'));

            // Sincronizar los horarios con el usuario sin eliminar los existentes
            $usuario->horarios()->syncWithoutDetaching($request->input('horarios'));

            // Redireccionar a una página de éxito o realizar otra acción
            return redirect()->route('usuariohorarios.index')->with('success', 'Horarios asignados correctamente');
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir, por ejemplo:
            return redirect()->back()->with('error', 'Error al asignar horarios: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(UsuarioHorario $usuarioHorario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsuarioHorario $usuarioHorario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UsuarioHorario $usuarioHorario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $horario = UsuarioHorario::findOrFail($id);
        $horario->delete();

        return redirect()->route('usuariohorarios.index')->with('success', 'Usuario eliminado correctamente');

    }
}
