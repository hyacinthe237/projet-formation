<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use App\Models\Permission;
use App\Helpers\PermissionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * list permissions
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        try
        {
            $keywords = $request->keywords;

            $permissions = Permission::when($keywords, function($query) use ($keywords) {
                return $query->where('name', 'like', '%'.$keywords.'%');
            })
            ->paginate(self::BACKEND_PAGINATE);

            return view('admin.users.permissions.index', ['permissions' => $permissions]);
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }


    /**
     * Create new permission
     *
     * @return view()
     */
    public function create()
    {
        return view('admin.users.permissions.create');
    }

    /**
     * Store a new permission
     *
     * @param  Request $request
     *
     * @return redirect()
     */
    public function store(Request $request)
    {
        $existing = Permission::where('name', str_replace(' ', '_', PermissionHelper::deleteAccents($request->name)))->first();

        if ($existing) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['exists' => 'Cette permission existe déjà']);
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:permissions'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Unique Name are required']);

        $permission = Permission::create([
            'name' => str_replace(' ', '_', PermissionHelper::deleteAccents($request->name))
        ]);

        return redirect()->route('permissions.edit', ['id' => $permission->id])
        ->with('message', 'Permission successfully saved');
    }

    /**
     * Display permission for editing
     *
     * @param  integer $id page's id
     *
     * @return view()
     */
    public function edit($id)
    {
        $permission = Permission::where('id', $id)->with('roles')->first();

        if ( !$permission )
            return redirect()->route('permissions.index');

        return view('admin.users.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update a permission
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        try
        {

            $permission = Permission::find($id);

            if ( !$permission )
                return redirect()->back();

            $validator = Validator::make($request->all(), [
                'name'      => 'unique:permissions,name,'.$permission->id
            ]);

            if($validator->fails())
                return redirect()->back()->withErrors(['validator' => 'Permission name must be unique']);

            $permision->name = str_replace(' ', '_', PermissionHelper::deleteAccents($request->name));
            $permision->update();

            return redirect()->back()->with('message', 'Permission successfully update!');


        }
        catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }


    /**
     * Delete a permission
     */
    public function destroy($id)
    {
        try {
            $permission = Permission::find($id);

            if ( !$permission )
                return redirect()->back();

            $permission->roles()->detach();

            $permission->delete();

            return redirect()->route('permissions.index')->with('message', 'Permission successfully deleted');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e);
        }
    }
}
