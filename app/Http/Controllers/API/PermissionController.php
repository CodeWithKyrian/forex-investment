<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['api.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function role_list()
    {
        $roles = Role::all();
        return response()->json(['roles' => $roles], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function role_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $role = Role::create(['name' => $input['name']]);
        if ($role) {
            $success['role'] =  $role->name;

            return $this->sendResponse($success, 'Role created successfully.');
        }
        return response()->json(['error' => "Unable to create a role"], 401);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission_list()
    {
        $permissions = Permission::all();
        return response()->json(['permissions' => $permissions], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permission_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        $permission = Permission::create(['name' => $input['name']]);
        if ($permission) {
            $success['permission'] =  $permission->name;

            return $this->sendResponse($success, 'Permission created successfully.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function role_has_permissions(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'permission_id' => 'required|exists:permissions,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $permission = Permission::find($request['permission_id'])->firstOrFail();
        if ($role->givePermissionTo($permission)) {
            return response()->json(['success' => $role], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign_user_to_role(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::find($request['user_id'])->firstOrFail();
        if ($user->assignRole($role)) {
            return response()->json(['success' => $user], 200);
        }
    }
}