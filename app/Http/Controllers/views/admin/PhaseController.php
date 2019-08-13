<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class PhaseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $phases = Phase::when($keywords, function($query) use ($keywords) {
          return $query->where('title', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.phases.index', compact('phases'));
  }

    public function create ()
    {
        return view('admin.phases.create');
    }

    public function edit ($id)
    {
        $phase  = Phase::find($id);
        if (!$phase)
            return redirect()->route('phases.index');

        return view('admin.phases.edit', compact('phase'));
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
            'title'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Phase::whereTitle($request->title)->first();

        if (!$existing) {
            $phase = Phase::create([
              'title'      => $request->title
            ]);

            return redirect()->back()->with('message', 'Phase ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Phase existante']);
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
            'title'     => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $phase = phase::find($id);
        if (!$phase) {
            return redirect()->back()->withErrors(['phase' => 'phase inconnue!']);
        }

        $phase->title = $request->has('title') ? $request->title : $phase->title;
        $phase->update();

        return redirect()->back()->with('message', 'phase mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $phase = Phase::find($id);
        if (!$phase)
            return redirect()->back()->withErrors(['message' => 'phase non existante']);

        $phase->delete();
        return redirect()->back()->with('message', 'phase supprimé');
    }

}
