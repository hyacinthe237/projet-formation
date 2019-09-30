<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Etudiant;
use App\Models\Formation;
use App\Models\Thematique;
use App\Models\FormationEtudiant;
use App\Models\Location;
use App\Helpers\EtudiantHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EtudiantController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $etudiants = Etudiant::with(['location', 'formations'])
      ->when($keywords, function($query) use ($keywords) {
          return $query->where('firstname', 'like', '%'.$keywords.'%')
          ->orWhere('lastname', 'like', '%'.$keywords.'%');
      })
      ->when($request->location_id, function($query) use ($request) {
          return $query->where('location_id', $request->location_id);
      })
      ->when($request->formation_id, function ($q) use ($request) {
          return $q->whereHas('formations', function($sql) use ($request) {
              return $sql->where('formations.id', $request->formation_id);
          });
      })
      ->orderBy('id', 'desc')
      ->paginate(50);

      $formations = Formation::orderBy('id', 'desc')->with('phases')->get();
      $locations = Location::get();
      return view('admin.etudiants.index', compact('etudiants', 'formations', 'locations'));
  }

    public function create ()
    {
        $formations = Formation::orderBy('id', 'desc')->get();
        $locations = Location::orderBy('departement', 'asc')->get();
        return view('admin.etudiants.create', compact('formations', 'locations'));
    }

    public function edit ($number)
    {
        $etudiant  = Etudiant::whereNumber($number)->first();
        if (!$etudiant)
            return redirect()->route('etudiants.index');

            $formations = Formation::orderBy('id', 'desc')->get();
            $locations = Location::orderBy('id', 'desc')->get();
        return view('admin.etudiants.edit', compact('formations', 'locations', 'etudiant'));
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
            'email' => 'required',
            'formation_id' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Prénom & Email sont obligatoires']);

        $existing = Etudiant::whereFirstname($request->firstname)->whereLastname($request->lastname)->first();
        if (!$existing) {
            $etudiant = Etudiant::create([
              'location_id'     => $request->location_id,
              'number'          => EtudiantHelper::makeEtudiantNumber(),
              'firstname'       => $request->firstname,
              'lastname'        => $request->lastname,
              'phone'           => $request->phone,
              'email'           => $request->email,
              'sex'             => $request->sex,
              'dob'             => $request->dob,
              'structure'       => $request->structure,
              'fonction'        => $request->fonction,
              'desc_fonction'   => $request->desc_fonction,
              'form_souhaitee'  => $request->form_souhaitee,
              'diplome_elev'    => $request->diplome_elev,
              'form_compl'      => $request->form_compl,
              'an_exp'          => $request->an_exp,
              'is_active'       => $request->is_active,
              'signature_url'   => $request->signature_url,
              'photo'           => $request->photo,
            ]);

            if ($etudiant) {
                $form_etud = FormationEtudiant::whereEtudiantId($etudiant->id)
                             ->whereFormationId($request->formation_id)
                             ->whereEtat('inscris')
                             ->first();

                $formation = Formation::findOrFail($request->formation_id);
                $count = FormationEtudiant::whereFormationId($request->formation_id)->whereEtat('inscris')->count();

                if (!$form_etud) {
                    if ($count <= $formation->qte_requis) {
                      $etudiant->formations()->create([
                          'formation_id'  => $request->formation_id,
                          'etat'          => 'inscris',
                          'created_at'    => Carbon::now(),
                          'updated_at'    => Carbon::now()
                      ]);

                      return redirect()->back()->with('message', 'Etudiant ajouté avec succès');
                    } else {
                      return redirect()->back()
                              ->withInput($request->all())
                              ->withErrors(['existing' => 'Le nombre de place requis de la formation est atteint.']);
                    }
                } else {
                  return redirect()->back()
                         ->withInput($request->all())
                         ->withErrors(['existing' => 'Cet Etudiant a déjà été inscris à cette formation']);
                }
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $number)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors(['validator' => 'Les champs Prénom & Email sont obligatoires']);

        $etudiant = Etudiant::whereNumber($number)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['user' => 'Etudiant inconnu!']);

        $etudiant->location_id       = $request->has('location_id') ? $request->location_id : $etudiant->location_id;
        $etudiant->firstname         = $request->has('firstname') ? $request->firstname : $etudiant->firstname;
        $etudiant->lastname          = $request->has('lastname') ? $request->lastname : $etudiant->lastname;
        $etudiant->phone             = $request->has('phone') ? $request->phone : $etudiant->phone;
        $etudiant->email             = $request->has('email') ? $request->email : $etudiant->email;
        $etudiant->sex               = $request->has('sex') ? $request->sex : $etudiant->sex;
        $etudiant->dob               = $request->has('dob') ? $request->dob : $etudiant->dob;
        $etudiant->structure         = $request->has('structure') ? $request->structure : $etudiant->structure;
        $etudiant->desc_fonction     = $request->has('desc_fonction') ? $request->desc_fonction : $etudiant->desc_fonction;
        $etudiant->form_souhaitee    = $request->has('form_souhaitee') ? $request->form_souhaitee : $etudiant->form_souhaitee;
        $etudiant->form_initiale     = $request->has('form_initiale') ? $request->form_initiale : $etudiant->form_initiale;
        $etudiant->diplome_elev      = $request->has('diplome_elev') ? $request->diplome_elev : $etudiant->diplome_elev;
        $etudiant->form_compl        = $request->has('form_compl') ? $request->form_compl : $etudiant->form_compl;
        $etudiant->an_exp            = $request->has('an_exp') ? $request->an_exp : $etudiant->an_exp;
        $etudiant->is_active         = $request->has('is_active') ? $request->is_active : $etudiant->is_active;
        $etudiant->signature_url     = $request->has('signature_url') ? $request->signature_url : $etudiant->signature_url;
        $etudiant->photo             = $request->has('photo') ? $request->photo : $etudiant->photo;
        $etudiant->update();

        return redirect()->back()->with('message', 'Etudiant mis à jour avec succès');
    }

    public function desactivateOrActivate (Request $request, $number)
    {
        $etudiant = Etudiant::whereNumber($numer)->first();

        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Etudiant non existant']);

        if ($etudiant->is_active === 1) {
            $etudiant->is_active = false;
            $etudiant->save();

            return redirect()->back()->with('message', 'Etudiant désactivé');
        }

        if ($etudiant->is_active === 0) {
            $etudiant->is_active = true;
            $etudiant->save();

            return redirect()->back()->with('message', 'Etudiant activé');
        }
    }

    public function destroy ($id)
    {
        $etudiant = Etudiant::whereIsActive(true)->whereId($id)->first();
        if (!$etudiant)
            return redirect()->back()->withErrors(['message' => 'Etudiant non existant']);

        $etudiant->delete();
        return redirect()->back()->with('message', 'Etudiant supprimé');
    }

}
