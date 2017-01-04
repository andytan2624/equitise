<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Role;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $validationRules = [
        'name' => 'required',
        'email' => 'required|email'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $repository)
    {
        $users = $repository->findWhere(['deleted_at', '=', null]);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $userRoles = [];

        $otherRoles = Role::where('deleted_at', '=', null)->get();

        return view('users.create', compact('user', 'userRoles', 'otherRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRepository $repository, Request $request)
    {
        $this->validate($request, $this->validationRules);
        $input = $request->all();
        $user = $repository->create($input);
        $id = $user[1]->id;
        $repository->find($id)->roles()->sync($input['selectedRole']);

        $request->session()->flash('status', 'User Creation was successful!');

        return redirect()->route('user.edit', $id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRepository $repository, $id)
    {
        $user = $repository->find($id);
        if (!$user) {
            return redirect()->route('user.index');
        }

        $userRoles = $user->roles()->get();

        $userRolesIds = $userRoles->pluck('id')->toArray();

        $otherRoles = Role::whereNotIn('id', $userRolesIds)->where('deleted_at', '=', null)->get();

        return view('users.edit', compact('user', 'userRoles', 'otherRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRepository $repository, Request $request, $id)
    {
        $this->validate($request, $this->validationRules);

        $input = $request->all();

        $repository->update($id, $input);

        $repository->find($id)->roles()->sync($input['selectedRole']);

        $request->session()->flash('status', 'User Edit was successful!');

        return redirect()->route('user.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRepository $repository, Request $request, $id)
    {
        $repository->delete($id);
        $request->session()->flash('status', 'User Deletion was successful!');
        return redirect()->route('user.index');
    }
}
