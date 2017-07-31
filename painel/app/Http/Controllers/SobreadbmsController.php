<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sobreadbm;
use Session;

class SobreadbmsController extends Controller
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

            $sobre = new Sobreadbm($req);
            //var_dump($user); exit();

            $sobre->save();

            Session::flash('success', '<div class="alert alert-success">
                                        Cadastrado com sucesso!
                                      </div>');
            //return view('clientes.add');
            return redirect('adm/list');
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
         $sobre = Sobreadbm::find($id);
         return view('adm.sobre.edit', compact('sobre'));
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update($id, Request $request){


         //salvando os dados do banner
         $sobre = Sobreadbm::findOrFail($id);

         $input = $request->all();
         $sobre->fill($input)->save();

         Session::flash('success', '<div class="alert alert-success">
                                     Atualizado com sucesso!
                                   </div>');


         //return view('adm.banner.edit', compact('banner'));
         return redirect()->back();
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
