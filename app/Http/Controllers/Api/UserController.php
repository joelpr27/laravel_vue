<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'name', 'created_at'])) {
            $orderColumn = 'created_at';
        }
        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }
        $users = User::when(request('search_id'), function ($query) {
                $query->where('id', request('search_id'));
            })
            ->when(request('search_title'), function ($query) {
                $query->where('name', 'like', '%' . request('search_title') . '%');
            })
            ->when(request('search_global'), function ($query) {
                $query->where(function ($q) {
                    $q->where('id', request('search_global'))
                        ->orWhere('name', 'like', '%' . request('search_global') . '%');
                });
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(50);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserResource
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthday = date("Y-m-d", strtotime($request->birthday));
        $user->address = $request->address;
        $user->telephone = $request->telephone;

        $roles = explode(",", $request->roles);
        $role = Role::find($roles);

        // Comprobar si tiene imagen y almacenarla
        if ($request->hasFile('imagen')) {
            $user->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-usuarios');
        }

        if ($user->save()) {
                
                if ($role) {
                    $user->assignRole($role);
                }
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show(User $user)
    {
        $user = User::with('roles')->with('media')->find($user->id);
        $user->load('roles');
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UpdateUserRequest $request)
    {
        $usuario = User::with('media')->find($request->id);
        
        $roles = Role::find($request->roles);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->puntos = $request->puntos;
        $usuario->experience = $request->experience;
        $usuario->telephone = $request->telephone;
        $usuario->address = $request->address;
        $usuario->birthday = date("Y-m-d", strtotime($request->birthday));


        if (!empty($request->password)) {
            $usuario->password = Hash::make($request->password) ?? $usuario->password;
        }


        if ($request->hasFile('imagen')) {
            $usuario->media()->delete();
            $usuario->addMediaFromRequest('imagen')->preservingOriginal()->toMediaCollection('images-usuarios');

        }

        if ($usuario->save()) {
            if ($roles) {
                $usuario->syncRoles($roles);
            }
   
            $usuario = User::with('media')->with('roles')->find($request->id);

            return $usuario;
            // return UserResource::collection($usuario);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('user-delete');
        $user->delete();

        return response()->noContent();
    }

    public function getStudents()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('id', 2);
        })->get()->toArray();

        return $users;
    }

    public function updateExp($id, Request $request)
    {
        $usuario = User::find($id);

        $usuario->experience += $request->puntos * 0.15;

        $usuario->save();

        $usuario = User::with('media')->with('niveles')->with('roles')->find($id);

        return $usuario;
    }

    public function updatePts($id, Request $request)
    {
        $usuario = User::find($id);

        $usuario->puntos += $request->puntos;
        $usuario->experience += ($request->puntos * 1.25);

        $usuario->save();

        $usuario = User::with('media')->with('niveles')->with('roles')->find($id);

        return $usuario;
    }

    public function removePts($id, Request $request)
    {
        $usuario = User::find($id);

        $usuario->puntos += $request->puntos;

        $usuario->save();

        $usuario = User::with('media')->with('niveles')->with('roles')->find($id);

        return $usuario;
    }
}
