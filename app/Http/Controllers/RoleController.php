<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public $validationRules = [
        'name' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRepository $repository)
    {
        $roles = $repository->findWhere(['deleted_at', '=', null]);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = new Role();

        return view('roles.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRepository $repository, Request $request)
    {
        $this->validate($request, $this->validationRules);
        $input = $request->all();
        $repository->create($input);

        $request->session()->flash('status', 'Role Creation was successful!');

        return redirect()->route('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleRepository $repository, $id)
    {
        $role = $repository->find($id);
        if (!$role) {
            return redirect()->route('role.index');
        }

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRepository $repository, Request $request, $id)
    {
        $this->validate($request, $this->validationRules);

        $input = $request->all();

        $repository->update($id, $input);

        $request->session()->flash('status', 'Role Edit was successful!');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleRepository $repository, Request $request, $id)
    {
        $repository->delete($id);
        $request->session()->flash('status', 'Role Deletion was successful!');
        return redirect()->route('role.index');
    }
}
