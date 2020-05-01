<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use App\Models\User;
use App\Models\Role;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $role = null;
      if ( $request->has('role') && $request->role != '' ) {
          $role = Role::where('name', $request->role)->first();
      }

      $keywords = $request->keywords;
      $users = User::when($keywords, function($query) use ($keywords) {
          return $query->where('firstname', 'like', '%'.$keywords.'%')
          ->orWhere('lastname', 'like', '%'.$keywords.'%');
      })
      ->when($role, function($query) use ($role) {
          return $query->where('role_id', $role->id);
      })
      ->where('id', '!=', Auth::user()->id)
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      $roles = Role::all();
      return view('admin.users.index', compact('users', 'roles'));
  }

    public function create ()
    {
        $roles = Role::where('id', '!=', 3)->get();

        return view('admin.users.create', compact('roles'));
    }

    public function show ($number)
    {
        $user  = User::whereIsActive(true)->whereNumber($number)->first();

        if (!$user)
            return redirect()->route('users.index');

        $roles = Role::where('id', '!=', 3)->get();
        return view('admin.users.profile', compact('roles', 'user'));
    }

    public function edit ($number)
    {
        $user  = User::whereIsActive(true)->whereNumber($number)->first();

        if (!$user)
            return redirect()->route('users.index');

        $roles = Role::where('id', '!=', 3)->get();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                   ->withInput($request->all())
                   ->withErrors(['validator' => 'Les champs Prénom, Nom & Email sont obligatoires']);

        User::create([
          'role_id'     => $request->role_id,
          'number'      => UserHelper::makeUserNumber(),
          'firstname'   => $request->firstname,
          'lastname'    => $request->lastname,
          'phone'       => $request->phone,
          'email'       => $request->email,
          'password'    => bcrypt($request->password),
          'sex'         => $request->sex,
          'is_active'   => $request->is_active,
          'photo'       => $request->photo,
          'api_token'   => UserHelper::makeApiToken()
        ]);

        return redirect()->back()->with('message', 'Utilisateur ajouté avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Les champs Prénom & Email sont obligatoires']);

        $user = User::find($id);
        if (!$user)
            return redirect()->back()->withErrors(['user' => 'Utilisateur inconnu!']);

        $user->role_id     = $request->has('role_id') ? $request->role_id : $user->role_id;
        $user->firstname   = $request->has('firstname') ? $request->firstname : $user->firstname;
        $user->lastname    = $request->has('lastname') ? $request->lastname : $user->lastname;
        $user->phone       = $request->has('phone') ? $request->phone : $user->phone;
        $user->email       = $request->has('email') ? $request->email : $user->email;
        $user->sex         = $request->has('sex') ? $request->sex : $user->sex;
        $user->is_active   = $request->has('is_active') ? $request->is_active : $user->is_active;
        $user->photo       = $request->has('photo') ? $request->photo : $user->photo;
        $user->update();

        return redirect()->back()->with('message', 'Utilisateur mis à jour avec succès');
    }

    public function desactivateOrActivate (Request $request, $number)
    {
        $user = User::whereNumber($numer)->first();

        if (!$user)
            return redirect()->back()->withErrors(['message' => 'Utilisateur non existant']);

        if ($user->is_active === 1) {
            $user->is_active = false;
            $user->save();

            return redirect()->back()->with('message', 'Utilisateur désactivé');
        }

        if ($user->is_active === 0) {
            $user->is_active = true;
            $user->save();

            return redirect()->back()->with('message', 'Utilisateur activé');
        }
    }

    public function destroy ($id)
    {
        $user = User::whereIsActive(true)->whereId($id)->first();
        if (!$user)
            return redirect()->back()->withErrors(['message' => 'Utilisateur non existant']);

        $user->delete();
        return redirect()->route('users.index')->with('message', 'Utilisateur supprimé');
    }

}
