<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Producto::select(
                [
                    'id',
                    'unidad_codigo',
                    'afectacion_tipo_codigo',
                    'codigo',
                    'nombre',
                    'precio_unitario',
                    'imagen'
                ]
            );

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $editButton = view('components.button-edit', ['id' => $row->id])->render();
                    $deleteButton = view('components.button-delete', ['id' => $row->id])->render();
                    return $editButton . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('productos.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
