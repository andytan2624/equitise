<?php

namespace App\Http\Controllers;

use App\RoleUser;
use Illuminate\Http\Request;

class EntityController extends Controller
{

    public $validationRules = [
        'name'          => 'required',
        'number_people' => 'required|integer',
        'rating'        => 'required|in:A,B,C',
        'year_created'  => 'required|date',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $typeModel = config('constants.entities')[$type];

        $records = $typeModel::where('deleted_at', '=', null)->get();

        return view('entities.index', compact('type', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $typeModel = config('constants.entities')[$type];

        $record = new $typeModel();

        // Get user roles associated with the record
        $userRoles = [];

        $otherRoles = RoleUser::get();


        return view('entities.create', compact('type', 'record', 'userRoles', 'otherRoles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        $this->validate($request, $this->validationRules);

        $typeModel = config('constants.entities')[$type];

        $input = $request->all();

        $record = $typeModel::create($input);

        $record->role_users()->sync($input['selectedRole']);

        /**
         * Only save certificate and logo fields if there are values to save
         */
        if (isset($input['certificate'])) {
            $certificateName = $type . $record->id . '.' .
                $request->file('certificate')->getClientOriginalExtension();

            $request->file('certificate')->move(base_path() . '/public/certificate/', $certificateName);
            $record->certificate = $certificateName;
        }

        if (isset($input['logo'])) {

            $logoName = $type . $record->id . '.' .
                $request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->move(base_path() . '/public/logo/', $logoName);

            $record->logo = $logoName;
        }
        $record->save();
        $request->session()->flash('status', 'Creation was successful!');

        return redirect()->route('entity.edit', ['type' => $type, 'id' => $record->id]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $id)
    {
        $typeModel = config('constants.entities')[$type];
        $record = $typeModel::find($id);

        // Get user roles associated with the record
        $userRoles = $record->role_users()->get();
        $userRolesIds = $userRoles->pluck('id')->toArray();

        $otherRoles = RoleUser::whereNotIn('id', $userRolesIds)->get();

        return view('entities.edit', compact('type', 'record', 'userRoles', 'otherRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        $this->validate($request, $this->validationRules);

        $typeModel = config('constants.entities')[$type];

        $input = $request->all();

        $record = $typeModel::find($id);

        $data = [
            'name'          => $input['name'],
            'number_people' => $input['number_people'],
            'rating'        => $input['rating'],
            'year_created'  => $input['year_created'],
        ];

        $record->update($data);

        $record->role_users()->sync($input['selectedRole']);


        /**
         * Only save certificate and logo fields if there are values to save, otherwise don't overwrite existing files
         */
        if (isset($input['certificate']) && $input['certificate'] != '') {
            //Only delete old file if we uploading a new one
            if ($record->certificate) {
                unlink(base_path() . '/public/certificate/' . $record->certificate);
            }
            $certificateName = $type . $record->id . '.' .
                $request->file('certificate')->getClientOriginalExtension();

            $request->file('certificate')->move(base_path() . '/public/certificate/', $certificateName);
            $record->certificate = $certificateName;

        }

        if (isset($input['logo']) && $input['logo'] != '') {
            //Only delete old file if we uploading a new one
            if ($record->logo != '') {
                unlink(base_path() . '/public/logo/' . $record->logo);
            }
            $logoName = $type . $record->id . '.' .
                $request->file('logo')->getClientOriginalExtension();

            $request->file('logo')->move(base_path() . '/public/logo/', $logoName);
            $record->logo = $logoName;

        }

        $record->save();
        $request->session()->flash('status', 'Update was successful!');

        return redirect()->route('entity.edit', ['type' => $type, 'id' => $record->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, $type)
    {
        $typeModel = config('constants.entities')[$type];

        $typeModel::destroy($id);
        $request->session()->flash('status', 'Deletion was successful!');

        return redirect()->route('entity.index', ['type' => $type]);
    }
}
