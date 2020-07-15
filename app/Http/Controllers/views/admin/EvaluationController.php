<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Evaluation;
use App\Models\CommuneFormation;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EvaluationController extends Controller
{

  /**
   * Evaluation finale
   *
   * @return \Illuminate\Http\Response
   */
   public function create ()
   {
     $sites = CommuneFormation::with('commune', 'formation')->get();
     $stagiares = Etudiant::get();

     return view('admin.evaluations.create', compact('sites', 'stagiares'));
   }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $evaluations = Evaluation::with(['site', 'site.commune', 'site.formation', 'stagiaire', 'stagiaire.structure', 'stagiaire.fonction'])
      ->when($request->site, function($query) use ($request) {
          return $query->where('commune_formation_id', $request->site);
      })
      ->when($request->stagiare, function($query) use ($request) {
          return $query->where('etudiant_id', $request->stagiare);
      })
      ->paginate(self::BACKEND_PAGINATE);

      $formations = CommuneFormation::with('commune', 'formation')->get();
      $etudiants = Etudiant::get();

      return view('admin.evaluations.index', compact('evaluations', 'formations', 'etudiants'));
  }

  public function show ($number) {
      $evaluation = Evaluation::with(['site', 'site.commune', 'site.formation', 'stagiaire', 'stagiaire.structure', 'stagiaire.fonction'])
            ->whereNumber($number)->firstOrFail();

      return view('admin.evaluations.show', compact('evaluation'));
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
          'email'            => 'required',
          'etudiant_id' => 'required',
          'commune_formation_id' => 'required',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Les champs stagiaire, formation sont obligatoires']);
      }

      // $etudiant = Etudiant::find($request->etudiant_id);
      // if (!$etudiant) {
      //     return redirect()->back()
      //           ->withInput($request->all())
      //           ->withErrors(['validator' => 'L\'adresse Email que vous avez saisi, ne correspond à aucun stagiare. bien vouloir le corriger, Merci !']);
      // }

      $evaluation = Evaluation::whereEtudiantId($request->etudiant_id)->whereCommuneFormationId($request->commune_formation_id)->first();
      if (!$evaluation) {
          $eval = Evaluation::create([
            'number'                => EvaluationHelper::makeEvaluationNumber(),
            'etudiant_id'           => $request->etudiant_id,
            'commune_formation_id'  => $request->commune_formation_id,
            'contenu'               => $request->contenu,
            'desc_contenu'          => $request->desc_contenu,
            'mise_1'                => $request->mise_1,
            'mise_2'                => $request->mise_2,
            'mise_3'                => $request->mise_3,
            'mise_4'                => $request->mise_4,
            'mise_5'                => $request->mise_5,
            'mise_6'                => $request->mise_6,
            'utilite_1'             => $request->utilite_1,
            'utilite_2'             => $request->utilite_2,
            'statisfaction_1'       => $request->statisfaction_1,
            'statisfaction_2'       => $request->statisfaction_2,
            'statisfaction_3'       => $request->statisfaction_3,
            'statisfaction_4'       => $request->statisfaction_4,
            'amelioration'          => $request->amelioration,
            'avant_formation'       => $request->avant_formation,
            'apres_formation'       => $request->apres_formation,
          ]);

          if ($eval)
              return redirect()->back()->with('message', "Merci d'avoir rempli votre évaluation finale pour cette formation");
      } else {
        return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Vous avez déjà rempli, cette évaluation. Impossible de le remplir une seconde fois.']);
      }

  }
}
