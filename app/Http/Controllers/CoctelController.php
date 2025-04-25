<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CoctelFavorito;

class CoctelController extends Controller
{
    /**
     * Obtener detalle de un cóctel desde la API.
     */
    public function detalle($id)
    {
        $response = Http::get("https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i={$id}");

        if ($response->successful()) {
            $drink = $response->json()['drinks'][0];

            $ingredientes = [];
            for ($i = 1; $i <= 15; $i++) {
                $nombre = $drink["strIngredient{$i}"];
                $medida = $drink["strMeasure{$i}"];
                if ($nombre) {
                    $ingredientes[] = [
                        'nombre' => $nombre,
                        'medida' => $medida
                    ];
                }
            }

            return response()->json([
                'idDrink' => $drink['idDrink'],
                'strDrink' => $drink['strDrink'],
                'strInstructions' => $drink['strInstructions'],
                'ingredientes' => $ingredientes
            ]);
        }

        return response()->json(['error' => 'Cóctel no encontrado'], 404);
    }

    /**
     * Guardar un cóctel favorito en la base de datos.
     */
    public function guardar($id)
    {
        // Verificar si ya está guardado
        if (CoctelFavorito::where('idDrink', $id)->exists()) {
            return response()->json(['estado' => 1, 'message' => 'Este cóctel ya está en tus favoritos.']);
        }

        $response = Http::get("https://www.thecocktaildb.com/api/json/v1/1/lookup.php?i={$id}");

        if ($response->successful()) {
            $drink = $response->json()['drinks'][0];

            $ingredientes = [];
            for ($i = 1; $i <= 15; $i++) {
                $nombre = $drink["strIngredient{$i}"];
                $medida = $drink["strMeasure{$i}"];
                if ($nombre) {
                    $ingredientes[] = [
                        'nombre' => $nombre,
                        'medida' => $medida
                    ];
                }
            }

            CoctelFavorito::create([
                'nombre' => $drink['strDrink'],
                'idDrink' => $drink['idDrink'],
                'instrucciones' => $drink['strInstructions'],
                'ingredientes' => json_encode($ingredientes)
            ]);

            return response()->json(['estado' => 0, 'message' => 'Cóctel guardado correctamente']);
        }

        return response()->json(['error' => 'No se pudo obtener el cóctel'], 404);
    }

    public function viewFavoritos(){
        return view('favoritos');
    }

    public function obtenerFavoritos()
    {
        $favoritos = CoctelFavorito::all();
        
        return response()->json($favoritos);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'instrucciones' => 'required|string',
            'ingredientes' => 'required|array',
        ]);

        $coctel = CoctelFavorito::findOrFail($id);

        $coctel->nombre = $request->input('nombre');
        $coctel->instrucciones = $request->input('instrucciones');
        $coctel->ingredientes = json_encode($request->input('ingredientes'));

        $coctel->save();

        return response()->json([
            'message' => 'Coctel actualizado correctamente',
            'coctel' => $coctel
        ]);
    }

    public function destroy($id)
    {
        $coctel = CoctelFavorito::findOrFail($id);
        $coctel->delete();
    
        return response()->json([
            'message' => 'Coctel eliminado correctamente'
        ]);
    }
}
