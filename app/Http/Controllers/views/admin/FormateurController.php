<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Formateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class FormateurController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $formateurs = Formateur::when($keywords, function($query) use ($keywords) {
          return $query->where('firstname', 'like', '%'.$keywords.'%')
          ->orWhere('lastname', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      return view('admin.formateurs.index', compact('formateurs'));
  }

    public function create ()
    {
        return view('admin.formateurs.create');
    }

    public function edit ($id)
    {
        $formateur  = Formateur::find($id);
        if (!$formateur)
            return redirect()->route('formateurs.index');

        return view('admin.formateurs.edit', compact('formateur'));
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
            'firstname'     => 'required',
            'lastname'      => 'required',
            'qualification' => 'required',
            'type'          => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existingFormateur = Formateur::whereFirstname($request->firstname)->whereLastname($request->lastname)->first();

        if (!$existingFormateur) {
            $formateur = Formateur::create([
              'firstname'      => $request->firstname,
              'lastname'       => $request->lastname,
              'qualification'  => $request->qualification,
              'type'           => $request->type
            ]);

            return redirect()->back()->with('message', 'Formateur ajouté avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Ce formateur existe déjà']);
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
            'firstname'     => 'required',
            'lastname'      => 'required',
            'qualification' => 'required',
            'type'          => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $formateur = Formateur::find($id);
        if (!$formateur)
            return redirect()->back()->withErrors(['formateur' => 'Formateur inconnu!']);

        $formateur->firstname      = $request->has('firstname') ? $request->firstname : $formateur->firstname;
        $formateur->lastname       = $request->has('lastname') ? $request->lastname : $formateur->lastname;
        $formateur->qualification  = $request->has('qualification') ? $request->qualification : $formateur->qualification;
        $formateur->type           = $request->has('type') ? $request->type : $formateur->type;
        $formateur->update();

        return redirect()->back()->with('message', 'Formateur mis à jour avec succès');
    }

    public function destroy ($id)
    {
        $formateur = Formateur::find($id);
        if (!$formateur)
            return redirect()->back()->withErrors(['message' => 'formateur non existant']);

        $formateur->delete();
        return redirect()->back()->with('message', 'Formateur supprimé');
    }

}
