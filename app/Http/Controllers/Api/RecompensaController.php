<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Recompensa;
use Illuminate\Http\Request;

class RecompensaController extends Controller
{
    public function index(){
        
        $this->authorize('recompensa-list');
        $recompensas = Recompensa::with('categorias')->get();
        return $recompensas;
    }

    public function store(Request $request){

        $this->authorize('recompensa-create');
        $request->validate([
            'nombre' => 'required|max:15',
            'descripcion' => 'required|max:150',
            'precio' => 'required',
            'imagen' => 'nullable',
            'nivel_desbloqueo' => 'required',
            'categorias' => 'required',
        ]);

        $recompensa = $request->all();
       
        $data = Recompensa::create($recompensa);

        $categorias = Categoria::findMany($request->categoria);

        $data->categorias()->attach($categorias);

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function update($id, Request $request){

        $this->authorize('recompensa-edit');
        $recompensa = Recompensa::find($id);

        $request->validate([
            'nombre' => 'required|max:15',
            'descripcion' => 'required|max:150',
            'precio' => 'required',
            'imagen' => 'nullable',
            'nivel_desbloqueo' => 'required',
            'categorias' => 'required'
        ]);

        $dataToUpdate = $request->all();

        $recompensa->update($dataToUpdate);

        $categorias = Categoria::findMany($request->categorias);

        $recompensa->categorias()->sync($categorias);

        return response()->json(['success' => true, 'data' => $recompensa]);

    }

    public function destroy($id){
        
        $this->authorize('recompensa-delete');
        $recompensa = Recompensa::find($id);

        $recompensa->delete();

        return response()->json(['success' => true, 'data' => 'Recompensa eliminada correctamente']);

    }

    public function edit($id){
        $recompensa = Recompensa::find($id);

        $recompensa->categorias;

        return response()->json(['success' => true, 'data' => $recompensa]);

    }
}
