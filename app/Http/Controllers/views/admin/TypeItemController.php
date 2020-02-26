<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\TypeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class TypeItemController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $types = TypeItem::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.budgets.types.index', compact('types'));
  }

    public function create ()
    {
        return view('admin.budgets.types.create');
    }

    public function edit ($id)
    {
        $type  = TypeItem::find($id);
        if (!$type)
            return redirect()->route('types.index');

        return view('admin.budgets.types.edit', compact('type'));
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
                  ->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $existing = TypeItem::whereName($request->name)->first();

        if (!$existing) {
            $type = TypeItem::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Type ajouté avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Type existante']);
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
            return redirect()->back()->withInput($request->all())->withErrors(['validator' => 'Tous les champs sont obligatoires']);

        $type = TypeItem::find($id);
        if (!$type) {
            return redirect()->back()->withErrors(['phase' => 'phase inconnue!']);
        }

        $type->name = $request->has('name') ? $request->name : $type->name;
        $type->update();

        return redirect()->back()->with('message', 'type mis à jour avec succès');
    }

    public function destroy ($id)
    {
        $type = TypeItem::find($id);
        if (!$type)
            return redirect()->back()->withErrors(['message' => 'type non existante']);

        $type->delete();
        return redirect()->back()->with('message', 'type supprimé');
    }

}
