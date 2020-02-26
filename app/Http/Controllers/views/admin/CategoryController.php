<?php

namespace App\Http\Controllers\views\admin;

use Auth;
use DB;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $keywords = $request->keywords;
      $categories = Category::when($keywords, function($query) use ($keywords) {
          return $query->where('name', 'like', '%'.$keywords.'%');
      })
      ->orderBy('id', 'desc')
      ->paginate(self::BACKEND_PAGINATE);

      return view('admin.categories.index', compact('categories'));
  }

    public function create ()
    {
        return view('admin.categories.create');
    }

    public function edit ($id)
    {
        $category  = Category::find($id);
        if (!$category)
            return redirect()->route('categories.index');

        return view('admin.categories.edit', compact('category'));
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

        $existing = Category::whereName($request->name)->first();

        if (!$existing) {
            $category = Category::create([
              'name'      => $request->name
            ]);

            return redirect()->back()->with('message', 'Catégorie ajoutée avec succès');
        }

        return redirect()->back()->withErrors(['existing' => 'Catégorie existante']);
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

        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->withErrors(['category' => 'Catégorie inconnue!']);
        }

        $category->name = $request->has('name') ? $request->name : $category->name;
        $category->update();

        return redirect()->back()->with('message', 'Catégorie mise à jour avec succès');
    }

    public function destroy ($id)
    {
        $category = Category::find($id);
        if (!$category)
            return redirect()->back()->withErrors(['message' => 'Catégorie non existante']);

        $formation = Formation::whereCategoryId($category->id)->first();
        if ($formation)
           return redirect()->back()->withErrors(['category' => 'Nous ne pouvons pas supprimer cette catégorie, car elle est relié à une formation !']);

        $category->delete();

        return redirect()->route('categories.index')->with('message', 'Catégorie supprimé');
    }

}
