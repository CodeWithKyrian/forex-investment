<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserResource;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

function getXId()
{
    $xId = 0;
    $tempId = 'XCQ-' . rand(1000000000, 9999999999);
    if (!User::findOrFail($tempId)) {
        $xId = $tempId;
    }
    return $xId;
}


class UserController extends BaseController
{
    public function __construct()
    {
        // $this->middleware(['api.admin'])->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->get();
    }

    /**
     * Return the authenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\UserResource
     */
    public function getUser(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }

    /**
     * Return the authenticated user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\UserResource
     */
    public function confirmPassword(Request $request)
    {
        $password = $request['account_password'];
        $hash = Auth::user()->getAuthPassword();
        password_verify($password, $hash) ? $data = true : $data = false;
        return $this->sendResponse($data, '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'xid' => 'required|unique',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'type' => 'required',
        ]);
        return User::create([
            'xid' => $request['xid'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'type' => $request['type'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $success['name'] =  $user->first_name . ' ' . $user->last_name;

        return $this->sendResponse($success, 'User record updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
}
