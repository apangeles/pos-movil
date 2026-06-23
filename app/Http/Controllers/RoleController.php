<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::with('permissions')->select('id', 'name');

            return DataTables::of($roles)
                ->addColumn('permissions', function ($role) {
                    return $role->permissions->map(function ($perm) {
                        return '<span class="badge bg-secondary me-1">' . $perm->name . '</span>';
                    })->implode(' ');
                })
                ->addColumn('action', function ($role) {
                    $editButton = view('components.button-edit', ['id' => $role->id])->render();
                    $deleteButton = view('components.button-delete', ['id' => $role->id])->render();
                    return $editButton . $deleteButton;
                })
                ->rawColumns(['permissions', 'action'])
                ->make(true);
        }

        return view('roles.index');
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
        $data = $this->validateData($request);

        $role = Role::crate(['name' => $data['name']]);

        if (isset($data['permissions'])) {
            $role->syncPermissons($data['permissions']);
        }

        return response()->json([
            'status' => true,
            'message' => 'Registro creado satisfactoriamente.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $registro = Role::with('permissions')->findOrFail($id);
            return response($registro)->json($registro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registro no encontrado'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateData($request, $id);

        $role = Role::findOrFail($id);
        $role->update(['name' => $data['name']]);
        $role->synsPermissions($data['permissions'] ?? []);

        return response()->json([
            'succes' => true,
            'message' => 'Registro actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return response()->json([
                'succes' => true,
                'message' => 'Registro eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el registro'], 500);
        }
    }

    public function validateData(Request $request, $id = null)
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'name')->ignore($id)
            ],
            'permissions' => 'nullable|array',
            'permissions.' => 'string|exists:permissions,name',
        ]);
    }
}
