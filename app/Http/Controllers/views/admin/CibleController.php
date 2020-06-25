<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Cible;
use App\Models\BesoinFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CibleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $cibles = Cible::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.cibles.index-create', compact('cibles'));
  }

    public function edit ($id)
    {
        $cible  = Cible::find($id);
        if (!$cible)
            return redirect()->route('cibles.index');

        return view('admin.cibles.edit', compact('cible'));
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
            'name'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Cible::whereName($request->name)->first();

        if (!$existing) {
            $cible = Cible::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Cible ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Cible existante']);
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
            'name'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $cible = Cible::find($id);
        if (!$cible) {
            return redirect()->back()->withErrors(['category' => 'Cible inconnue!']);
        }

        $cible->name = $request->has('name') ? $request->name : $cible->name;
        $cible->update();

        return redirect()->back()->with('message', 'Cible mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $cible = Cible::find($id);
        if (!$cible)
            return redirect()->back()->withErrors(['message' => 'Cible non existante']);

        $besoin = BesoinFormation::where('cible_id', $cible->id)->first();
        if ($besoin)
            return redirect()->back()->withErrors(['message' => 'Vous ne pouvez pas supprimer cette cible, car elle est relié à un besoin en formation']);

        $cible->delete();

        return redirect()->route('cibles.index')->with('message', 'Cible supprimée');
    }

}
