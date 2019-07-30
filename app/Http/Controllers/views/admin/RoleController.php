<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * list models
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        try
        {
            $keywords = $request->keywords;

            $roles = Role::when($keywords, function($query) use ($keywords) {
                return $query->where('name', 'like', '%'.$keywords.'%');
            })
            ->paginate(50);

            return view('admin.users.roles.index', ['roles' => $roles]);
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }


    /**
     * Create new model
     *
     * @return view()
     */
    public function create()
    {
        $permissions = Permission::orderBy('id', 'asc')->get();

        return view('admin.users.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a new Model
     *
     * @param  Request $request
     *
     * @return redirect()
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:roles'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Unique Name are required']);

        $role = Role::create([
            'name'        => $request->name,
            'level'       => $request->level,
            'description' => $request->description
        ]);

        if ($role) {
            $role->permissions()->attach($request->permissions);
        }

        return redirect()->route('roles.edit', ['id' => $role->id])
        ->with('message', 'Role successfully saved');
    }

    /**
     * Display Model for editing
     *
     * @param  integer $id page's id
     *
     * @return view()
     */
    public function edit($id)
    {
        $tab = [];

        $role = Role::where('id', $id)->with('permissions')->first();

        if ( !$role )
            return redirect()->route('roles.index');

        foreach ($role->permissions as $item) {
            $tab[] = $item->id;
        }

        $permissions = Permission::orderBy('id', 'asc')->get();

        return view('admin.users.roles.edit', ['role' => $role, 'permissions' => $permissions, 'tab' => $tab]);
    }

    /**
     * Update a role
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        try
        {

            $role = Role::find($id);

            if ( !$role )
                return redirect()->back();

            $validator = Validator::make($request->all(), [
                'name'      => 'unique:roles,name,'.$role->id
            ]);

            if($validator->fails())
                return redirect()->back()->withErrors(['validator' => 'Role name must be unique']);

            $role->name        = $request->name;
            $role->level       = $request->level;
            $role->description = $request->description;
            $role->update();

            $role->permissions()->attach($request->permissions);

            return redirect()->back()->with('message', 'Role successfully update!');


        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }


    /**
     * Delete a model
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);

            if ( !$role )
                return redirect()->back();

            $role->permissions()->detach();

            $role->delete();

            return redirect()->route('roles.index')->with('message', 'Role successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }
}
