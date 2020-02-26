<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use Carbon\Carbon;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index(Request $request) {
        $keywords = $request->keywords;
        $sessions = Session::when($keywords, function($query) use ($keywords) {
            return $query->where('name', 'like', '%'.$keywords.'%');
        })
        ->orderBy('name', 'desc')
        ->paginate(self::BACKEND_PAGINATE);

        return view('admin.sessions.index', compact('sessions'));
    }


    public function edit ($id)
    {
        $session  = Session::find($id);
        if (!$session)
            return redirect()->route('sessions.index');

        return view('admin.sessions.edit', compact('session'));
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
            'name'    => 'required',
            'status'  => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
                  ->withInput($request->all())
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = Session::whereName($request->name)->first();

        if (!$existing) {
            $session = Session::create([
              'name'    => $request->name,
              'status'  => $request->status
            ]);

            if ($session->status == 'pending') {
              $sessions = Session::where('id', '!=', $session->id)->get();
              foreach ($sessions as $se) {
                  $se->status = 'passed';
                  $se->update();
              }
            }

            return redirect()->back()->with('message', 'Session ajoutée avec succès');
        }

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['existing' => 'Session existante']);
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
            'name'    => 'required',
            'status'  => 'required'
        ]);

        if ($validator->fails())
            return redirect()->back()
              ->withInput($request->all())
              ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $session = Session::find($id);
        if (!$session) return redirect()->back()->withErrors(['Session' => 'Session inconnue!']);

        $session->name   = $request->has('name') ? $request->name : $phase->name;
        $session->status = $request->has('status') ? $request->status : $phase->status;
        $session->update();

        if ($session->status == 'pending') {
          $sessions = Session::where('id', '!=', $session->id)->get();
          foreach ($sessions as $se) {
              $se->status = 'passed';
              $se->update();
          }
        }

        return redirect()->route('sessions.index')->with('message', 'session mise à jour avec succès');
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pending($id)
    {
        $session = Session::find($id);
        if (!$session) return redirect()->back()->withErrors(['Session' => 'Session inconnue!']);

        $session->status   = 'pending';
        $session->update();

        $sessions = Session::where('id', '!=', $session->id)->get();
        foreach ($sessions as $se) {
            $se->status = 'passed';
            $se->update();
        }

        return redirect()->route('sessions.index')->with('message', 'Session activée');
    }

}
