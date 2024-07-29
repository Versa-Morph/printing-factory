<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index','show']]);
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Role List';
        $data['roles'] = Role::orderby('id', 'asc')->get();

        return view('roles.index', $data);
    }

    // public function getRoles(Request $request)
    // {
    //     try {
    //         $roles = Role::with('permissions:id,name')
    //             ->orderBy('id', 'asc')
    //             ->select('id', 'name')
    //             ->get();

    //         $permissions = Permission::orderBy('id', 'asc')
    //             ->select('id', 'name')
    //             ->get();

    //         return response()->json([
    //             'roles' => $roles,
    //             'permissions' => $permissions
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function getPermissions($roleId)
    // {
    //     try {
    //         $role = Role::findOrFail($roleId);
    //         $permissions = $role->permissions()->select('id', 'name')->get();

    //         return response()->json(['permissions' => $permissions]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function getAllPermissions()
    // {
    //     try {
    //         $permissions = Permission::orderBy('id', 'asc')
    //             ->select('id', 'name')
    //             ->get();

    //         return response()->json(['permissions' => $permissions]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function getRoles(Request $request)
    // {
    //     try {
    //         $data['roles'] = Role::with('permissions:id,name')->orderBy('id', 'asc')->select('id', 'name')->get();
    //         $data['permissions'] = Permission::orderBy('id', 'asc')->select('id', 'name')->get();

    //         return response()->json($data);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function getRoles(Request $request)
    {

        try {
            $data['roles'] = Role::with('permissions:id,name')->orderBy('id', 'asc')->select('id', 'name')->get();
            $data['permissions'] = Permission::orderBy('id', 'asc')->select('id', 'name')->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getModalAdd()
    {
        return View::make('roles.modal-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $dataRole = $request->validated();

        try {
            $role = new Role();
            $role->name = $dataRole['name'];
            $role->guard_name = 'web';
            $role->save();

            session()->flash('success', "Create data role successfully!");
            return redirect(route('roles.index'));
        } catch (\Throwable $th) {
            session()->flash('failed', "Failed to create data role!");
            return redirect(route('roles.index'));
        }
    }

    public function getModalEdit($roleId)
    {
        $role = Role::findOrFail($roleId);
        return View::make('roles.modal-edit')->with('role', $role);
    }

    public function update(UpdateRoleRequest $request, $roleId)
    {
        $dataRole = $request->validated();
        try {
            $role = Role::find($roleId);

            // Check if role doesn't exists
            if (!$role) {
                session()->flash('failed', "Role not found!");
                return redirect()->back();
            }

            $role->name = $dataRole['name'];
            $role->save();

            session()->flash('success', "Update data role successfully!");
            return redirect(route('roles-index'));
        } catch (\Throwable $th) {
            session()->flash('failed', "Failed to update data role!");
            return redirect(route('roles-index'));
        }
    }

    public function getModalDelete($roleId)
    {
        $role = Role::findOrFail($roleId);
        return View::make('roles.modal-delete')->with('role', $role);
    }

    public function destroy(Request $request, $roleId)
    {
        try {
            $role = Role::findOrFail($roleId);
            $role->delete();

            session()->flash('success', "Delete data role successfully!");
        } catch (ModelNotFoundException $e) {
            session()->flash('failed', "Role not found!");
        } catch (QueryException $e) {
            session()->flash('failed', "Failed to delete data role!");
        }

        return redirect(route('roles-index'));
    }

    public function updatePermissionByID(Request $request)
    {
        try {
            // Get data from AJAX Post
            $roleId = $request->input('roleId');
            $permissionId = $request->input('permissionId');
            $isChecked = $request->input('isChecked');

            // Find role and permission by Id
            $role = Role::findOrFail($roleId);
            $permission = Permission::findOrFail($permissionId);

            // Update relation role and permission by checkbox
            if ($isChecked == "true") {
                $role->permissions()->attach($permission);
            } else {
                $role->permissions()->detach($permission);
            }

            // Kirim respons ke klien (jika diperlukan)
            return response()->json(['message' => 'Permission updated successfully']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Permission updated failed', 'error' => $th->getMessage()]);
        }
    }

    public function updateAllPermissions(Request $request)
    {
        // Validation Data
        $request->validate([
            'roleId' => 'required|exists:roles,id',
            'status' => 'required',
        ]);

        try {
            // Get Role By ID
            $role = Role::findOrFail($request->roleId);

            if ($request->status == 'true') {
                // Check status True add all permission
                $role->givePermissionTo(Permission::all());
            } else {
                // Check status False delete all permission
                $role->revokePermissionTo(Permission::all());
            }

            return response()->json(['message' => 'Permissions updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update permissions'], 500);
        }
    }
}
