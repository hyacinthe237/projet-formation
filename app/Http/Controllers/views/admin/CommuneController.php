<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Departement;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CommuneController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $departement = $request->departement;
      $communes = Commune::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->when($departement, function($query) use ($departement) {
          return $query->where('departement_id', $departement);
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);
      $departements = Departement::get();

      return view('admin.settings.communes.index-create', compact('communes', 'departements'));
  }

    public function edit ($id)
    {
        $commune  = Commune::find($id);
        $departements = Departement::get();
        if (!$commune)
            return redirect()->route('communes.index');

        return view('admin.settings.communes.edit', compact('commune', 'departements'));
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
                  ->withErrors(['validator' => 'Le champ Nom est obligatoire']);

        $existing = Commune::whereName($request->name)->first();
        if (!$existing) {
            Commune::create([
              'departement_id' => $request->departement_id,
              'name'      => $request->name,
              'lon'      => $request->lon,
              'lat'      => $request->lat
            ]);

            return redirect()->back()->with('message', 'Commune ajoutée avec succès');
        }

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['existing' => 'Une Commune sur ce nom a déjà été crée']);
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
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Le champ Nom est obligatoire']);

        $commune = Commune::find($id);
        if (!$commune)
            return redirect()->back()->withErrors(['category' => 'Commune inconnue']);

        $commune->departement_id = $request->has('departement_id') ? $request->departement_id : $commune->departement_id;
        $commune->name = $request->has('name') ? $request->name : $commune->name;
        $commune->lon = $request->has('lon') ? $request->lon : $commune->lon;
        $commune->lat = $request->has('lat') ? $request->lat : $commune->lat;
        $commune->update();

        return redirect()->back()->with('message', 'Commune mise à jour avec succès');
    }

}
