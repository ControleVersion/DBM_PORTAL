<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Dbmcurso;

class DbmcursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbmcursos = Dbmcurso::all();
        return view('layouts.site.dbmcurso', compact('dbmcursos'));
    }

    public function listar()
    {
        //LISTAR NA ADMINISTACAO AS GALERIAS
        $dbmcursos = Dbmcurso::all();
        return view('adm.dbmcursos.dbmcurso', compact('dbmcursos'));
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

          $dbmcurso = new Dbmcurso($req);

          $dbmcurso->save();

          Session::flash('success', '<div class="alert alert-success">
                                      Cadastrado conteúdo com sucesso!
                                    </div>');
          //return view('clientes.add');
          return redirect('adm/dbmcurso');
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
       $dbmcurso = Dbmcurso::find($id);
       return view('adm.dbmcursos.edit', compact('dbmcurso'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       Dbmcurso::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Conteúdo apagado com sucesso!
                                 </div>');

       return redirect('adm/dbmcurso');
     }
}
