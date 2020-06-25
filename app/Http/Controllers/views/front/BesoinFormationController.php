<?php

namespace App\Http\Controllers\views\front;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\BesoinFormation;
use App\Models\Commune;
use App\Models\Cible;
use App\Helpers\BesoinFormationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BesoinFormationController extends Controller
{

  public function create () {
    $communes = Commune::get();
    $cibles = Cible::get();

    return view('front.besoins.create', compact('communes', 'cibles'));
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
          'email'      => 'required',
          'name'       => 'required',
          'phone'      => 'required',
          'commune_id' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Les champs Email, Nom et téléphone sont obligatoires']);
      }

      $besoin = BesoinFormation::whereEmail($request->email)->whereCommuneId($request->commune_id)->first();
      if (!$besoin) {
          $bes = BesoinFormation::create([
            'number'              => BesoinFormationHelper::makeBesoinFormationNumber(),
            'commune_id'          => $request->commune_id,
            'cible_id'            => $request->cible_id,
            'name'                => $request->name,
            'email'               => $request->email,
            'phone'               => $request->phone,
            'dipl_elev'           => $request->dipl_elev,
            'autre_dipl'          => $request->autre_dipl,
            'dob'                 => $request->dob,
            'date_cud'            => $request->date_cud,
            'direction_service'   => $request->direction_service,
            'ancien_poste'        => $request->ancien_poste,
            'duree_ancien_poste'  => $request->duree_ancien_poste,
            'nouveau_poste'       => $request->nouveau_poste,
            'duree_nouveau_poste' => $request->duree_nouveau_poste,
            'question_1'          => $request->question_1,
            'question_2'          => $request->question_2,
            'question_3'          => $request->question_3,
            'question_4'          => $request->question_4,
            'question_5'          => $request->question_5,
            'question_6'          => $request->question_6,
            'question_7'          => $request->question_7,
            'question_8'          => $request->question_8,
            'question_9'          => $request->question_9,
            'question_10'         => $request->question_10,
            'question_11'         => $request->question_11,
            'question_12'         => $request->question_12,
            'question_13'         => $request->question_13,
            'question_14'         => $request->question_14,
          ]);

          if ($bes)
              return redirect()->back()->with('message', "Merci d'avoir rempli votre questionnaire des besoins en formation");
      } else {
        return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Vous avez déjà rempli ce formulaire. Impossible de le faire une seconde fois.']);
      }

  }
}
