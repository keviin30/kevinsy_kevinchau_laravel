<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Un titre est requis.',
            'content.required' => 'Un contenu est requis.',
        ]);

        if(Input::hasFile('image')){

            $newArticle = Article::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'content' => $request->content,
                'image' => str_random(10) . '.jpg',
            ]);

            $file = $request->file('image');
            $filename = $newArticle->image;

            if ($file) {
                Storage::disk('uploads')->put($filename, File::get($file));
            }
        }else{
            $newArticle = Article::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'content' => $request->content,
            ]);

        }



        return redirect()->route('articles.show', $newArticle->id)->with('success', "L'article a bien été crée");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Article::find($id);
        $admin = Auth::user()->isAdmin;
        return view('articles.show', compact('show', 'id', 'admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Article::find($id);
        return view('articles.edit', compact('edit', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Article::where('id', $id)->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);

        return redirect()->route('articles.show', [$id])->with('success', 'Article modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::where('id', $id)->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé');
    }

    public function getImg($filename)
    {
        $file = Storage::disk('uploads')->get($filename);
        return new Response($file, 200);
    }
}
