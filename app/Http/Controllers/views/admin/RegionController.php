<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $regions = Region::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->where('id', '!=', 11)
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.settings.regions.index-create', compact('regions'));
  }

    public function edit ($id)
    {
        $region  = Region::find($id);
        if (!$region)
            return redirect()->route('regions.index');

        return view('admin.settings.regions.edit', compact('region'));
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

        $existing = Region::whereName($request->name)->first();
        if (!$existing) {
            Region::create([
              'name'      => $request->name,
              'lon'      => $request->lon,
              'lat'      => $request->lat,
              'image_region' => $request->image_region,
            ]);

            return redirect()->back()->with('message', 'Région ajoutée avec succès');
        }

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['existing' => 'Une Région sur ce nom a déjà été crée']);
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

        $region = Region::find($id);
        if (!$region)
            return redirect()->back()->withErrors(['category' => 'Région inconnue']);

        $region->name = $request->has('name') ? $request->name : $region->name;
        $region->lon = $request->has('lon') ? $request->lon : $region->lon;
        $region->lat = $request->has('lat') ? $request->lat : $region->lat;
        $region->image_region = $request->has('image_region') ? $request->image_region : $region->image_region;
        $region->update();

        return redirect()->back()->with('message', 'Region mise à jour avec succès');
    }

}
