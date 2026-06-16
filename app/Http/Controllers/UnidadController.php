<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Unidad::select(['codigo', 'descripcion']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('components.button-edit', ['id' => $row->codigo])->render();
                    $deleteButton = view('components.button-delete', ['id' => $row->codigo])->render();
                    return $editButton . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('unidades.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //No lo vamos a usar por que el formulario lo vamos a crear con javasccript
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $request->validate([
        //     'codigo' => 'required|string|max:3|unique:unidades,codigo',
        //     'decripcion' => 'required|string|max:50'
        // ]);
        // $registro = new Unidad();
        // $registro->codigo = $request->input('codigo');
        // $registro->descipcion = $request->input('descripcion');
        // $registro->save();
        $data = $this->validate($request);

        return response()->json([
            'status' => true,
            'message' => 'Registro creado satisfactoriamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            $registro = Unidad::where('codigo', $id)->firstOrFail();
            return response()->json($registro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registro no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // $request->validate([
        //     'codigo' => 'required|string|max:3|unique:uniddes,codigo,' . $id . ',codigo',
        //     'descripcion' => 'required|string|max:50',
        // ]);
        $data = $this->validate($request, $id);
        $registro = Unidad::where('codigo', $id)->firstOrFail();

        // $registro->codigo = $request->codigo;
        // $registro->descripcion = $request->descricion;
        // $registro->save();
        $registro->update($data);

        return response()->json([
            'succes' => true,
            'message' => 'Registro actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try {
            //
            $registro = Unidad::findOrFail($id);
            $registro->delete();

            return response()->json([
                'succes' => true,
                'message' => 'Registro eliminado correctamente'

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el registro'
            ], 500);
        }
    }

    protected function validate(Request $request, $id = null)
    {
        return $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:3',
                Rule::unique('unidades', 'codigo')->ignore($id, 'codigo')
            ],
            'description' => 'required|string|max:50',
        ]);
    }
}
