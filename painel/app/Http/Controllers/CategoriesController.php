<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listar()
    {
      //LISTAR NA ADMINISTACAO AS GALERIAS
      $categories = Category::all();
      return view('adm.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $req = $request->all();

           $category = new Category($req);

           $category->save();

           Session::flash('success', '<div class="alert alert-success">
                                       Cadastrado conteúdo com sucesso!
                                     </div>');
           //return view('clientes.add');
           return redirect('adm/categories');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $category = Category::find($id);
      return view('adm.categories.edit', compact('category'));
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
       $input = $request->all();
       $category = Category::find($id);
       $category->fill($input)->save();

       Session::flash('success', '<div class="alert alert-success">
                                   Atualizado com sucesso!
                                 </div>');

      return redirect('adm/categories');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       Category::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Conteúdo apagado com sucesso!
                                 </div>');

       return redirect('adm/categories');
     }
}
