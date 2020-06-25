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
}
