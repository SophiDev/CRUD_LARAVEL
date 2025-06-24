<?php

namespace App\Http\Controllers;

use App\Http\Requests\MascotasRequest;
use App\Models\Mascotas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MascotasController extends Controller
{
    // Obtener y paginado
    public function index(Request $request) {
        /* 
        $perPage = $request->query("per_page", 10);
        $page = $request->query("page", 0);
        $offset = $page * $perPage;

        $mascotas = Mascotas::skip($offset)->take($perPage)->get();
        */

        // skip - IIgnora los primeros $offset registros de la consulta. (s como decirle: "Salta los primeros X registros y empieza desde ahí.")
        // take - Toma (o limita) la cantidad de registros que quieres recuperar, después del skip. (Es como decirle: "Dame sólo X registros a partir de donde te pedí.")

        return response()->json(Mascotas::all());
    }

    // Crear y validars
    public function store(Request $request) {
        try {
            $validarDatos = $request->validate([
                'name' => 'required|string',
                'breed' => 'required|string',
                'description' => 'required|string',
                'categoria_id' => 'required|exists:categorias,id',
            ], [
                'name.required' => 'El nombre de la mascota es requerido.',
            ]);

            $mascotas = Mascotas::create($request->all());
            return response()->json($mascotas);
        } catch (ValidationException $e) {
            return response()->json([
                "error" => $e->errors()],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    // Actulizar y Form Request
    public function update(MascotasRequest $request, Mascotas $mascota) {
        try {
            $validarDatos = $request->validated();
            $mascota->update($validarDatos);

            return response()->json([
                "message" => "La informacion de la mascota fue actualizado con exito",
                "mascota" => $mascota
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    // Eliminar
    public function destroy(Mascotas $mascota) {
        $mascota->delete();
        return response()->json([
            "message" => "Mascota eliminada"
        ]);
    }
}
