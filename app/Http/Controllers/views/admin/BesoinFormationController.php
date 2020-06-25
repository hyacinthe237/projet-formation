<?php

namespace App\Http\Controllers\views\admin;

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

  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $besoins = BesoinFormation::with(['commune', 'cible'])
      ->when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%')
                       ->orWhere('email', 'like', '%'.$keywords.'%')
                       ->orWhere('dipl_elev', 'like', '%'.$keywords.'%')
                       ->orWhere('autre_dipl', 'like', '%'.$keywords.'%')
                       ->orWhere('direction_service', 'like', '%'.$keywords.'%')
                       ->orWhere('ancien_poste', 'like', '%'.$keywords.'%')
                       ->orWhere('nouveau_poste', 'like', '%'.$keywords.'%')
                       ->orWhere('question_1', 'like', '%'.$keywords.'%')
                       ->orWhere('question_2', 'like', '%'.$keywords.'%')
                       ->orWhere('question_3', 'like', '%'.$keywords.'%')
                       ->orWhere('question_4', 'like', '%'.$keywords.'%')
                       ->orWhere('question_5', 'like', '%'.$keywords.'%')
                       ->orWhere('question_6', 'like', '%'.$keywords.'%')
                       ->orWhere('question_7', 'like', '%'.$keywords.'%')
                       ->orWhere('question_8', 'like', '%'.$keywords.'%')
                       ->orWhere('question_9', 'like', '%'.$keywords.'%')
                       ->orWhere('question_10', 'like', '%'.$keywords.'%')
                       ->orWhere('question_11', 'like', '%'.$keywords.'%')
                       ->orWhere('question_12', 'like', '%'.$keywords.'%')
                       ->orWhere('question_13', 'like', '%'.$keywords.'%')
                       ->orWhere('question_14', 'like', '%'.$keywords.'%');
      })
      ->when($request->commune, function($query) use ($request) {
          return $query->where('commune_id', $request->commune);
      })
      ->when($request->cible, function($query) use ($request) {
          return $query->where('cible_id', $request->cible);
      })
      ->paginate(self::BACKEND_PAGINATE);

      $communes = Commune::get();
      $cibles = Cible::get();

      return view('admin.besoins.index', compact('besoins', 'cibles', 'communes'));
  }

  public function create () {
    $communes = Commune::get();
    $cibles = Cible::get();

    return view('admin.besoins.create', compact('communes', 'cibles'));
  }

  public function edit ($number) {
    $communes = Commune::get();
    $cibles = Cible::get();
    $besoin = BesoinFormation::whereNumber($number)->firstOrFail();

    return view('admin.besoins.edit', compact('communes', 'cibles', 'besoin'));
  }

  public function show ($number) {
    $besoin = BesoinFormation::with('commune', 'cible')->whereNumber($number)->firstOrFail();

    return view('admin.besoins.show', compact('besoin'));
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

  /**
   * Update Besoin
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $number)
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

      $besoin = BesoinFormation::whereNumber($number)->first();
      if ($besoin) {
            $besoin->commune_id          = $request->has('commune_id') ? $request->commune_id : $besoin->commune_id;
            $besoin->cible_id            = $request->has('cible_id') ? $request->cible_id : $besoin->cible_id;
            $besoin->name                = $request->has('name') ? $request->name : $besoin->name;
            $besoin->email               = $request->has('email') ? $request->email : $besoin->email;
            $besoin->phone               = $request->has('phone') ? $request->phone : $besoin->phone;
            $besoin->dipl_elev           = $request->has('dipl_elev') ? $request->dipl_elev : $besoin->dipl_elev;
            $besoin->autre_dipl          = $request->has('autre_dipl') ? $request->autre_dipl : $besoin->autre_dipl;
            $besoin->dob                 = $request->has('dob') ? $request->dob : $besoin->dob;
            $besoin->date_cud            = $request->has('date_cud') ? $request->date_cud : $besoin->date_cud;
            $besoin->direction_service   = $request->has('direction_service') ? $request->direction_service : $besoin->direction_service;
            $besoin->ancien_poste        = $request->has('ancien_poste') ? $request->ancien_poste : $besoin->ancien_poste;
            $besoin->duree_ancien_poste  = $request->has('duree_ancien_poste') ? $request->duree_ancien_poste : $besoin->duree_ancien_poste;
            $besoin->nouveau_poste       = $request->has('nouveau_poste') ? $request->nouveau_poste : $besoin->nouveau_poste;
            $besoin->duree_nouveau_poste = $request->has('duree_nouveau_poste') ? $request->duree_nouveau_poste : $besoin->duree_nouveau_poste;
            $besoin->question_1          = $request->has('question_1') ? $request->question_1 : $besoin->question_1;
            $besoin->question_2          = $request->has('question_2') ? $request->question_2 : $besoin->question_2;
            $besoin->question_3          = $request->has('question_3') ? $request->question_3 : $besoin->question_3;
            $besoin->question_4          = $request->has('question_4') ? $request->question_4 : $besoin->question_4;
            $besoin->question_5          = $request->has('question_5') ? $request->question_5 : $besoin->question_5;
            $besoin->question_6          = $request->has('question_6') ? $request->question_6 : $besoin->question_6;
            $besoin->question_7          = $request->has('question_7') ? $request->question_7 : $besoin->question_7;
            $besoin->question_8          = $request->has('question_8') ? $request->question_8 : $besoin->question_8;
            $besoin->question_9          = $request->has('question_9') ? $request->question_9 : $besoin->question_9;
            $besoin->question_10         = $request->has('question_10') ? $request->question_10 : $besoin->question_10;
            $besoin->question_11         = $request->has('question_11') ? $request->question_11 : $besoin->question_11;
            $besoin->question_12         = $request->has('question_12') ? $request->question_12 : $besoin->question_12;
            $besoin->question_13         = $request->has('question_13') ? $request->question_13 : $besoin->question_13;
            $besoin->question_14         = $request->has('question_14') ? $request->question_14 : $besoin->question_14;
            $besoin->update();

              return redirect()->back()->with('message', "Merci d'avoir rempli votre questionnaire des besoins en formation");
      } else {
        return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Formulaire inexistant']);
      }

  }
}
