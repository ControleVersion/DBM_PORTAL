<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use File;

use App\Http\Requests;
use App\Profissional;

class ProfissionaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $profissionais = Profissional::all();
      return view('layouts.site.profissionais', compact('profissionais'));
    }

    public function listar()
    {
        //LISTAR NA ADMINISTACAO AS GALERIAS
        $profissionais = Profissional::all();
        return view('adm.profissionais.profissional', compact('profissionais'));
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

          $profissional = new Profissional($req);
          //var_dump($user); exit();

          $file = array('image' => Input::file('image'));

           //var_dump($banner->url_imagem);exit();

           if(Input::file('image') != null){
             // setting up rules
             $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
             // doing the validation, passing post data, rules and the messages
             $validator = Validator::make($file, $rules);
             if ($validator->fails()) {
               // send back to the page with the input data and errors
               return Redirect::to('adm/profissionais')->withInput()->withErrors($validator);
             }
             else {
               // checking file is valid.
               if (Input::file('image')->isValid()) {

                 $destinationPath = 'uploads'; // upload path
                 $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                 //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                 $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());
                 $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
                 Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
               }
             }
           }


           //salvando os dados do banner
           if(Input::file('image') != null){
               $profissional->foto = $destinationPath."/".$fileName;
           }


          $profissional->save();

          Session::flash('success', '<div class="alert alert-success">
                                      Cadastrado profissional com sucesso!
                                    </div>');
          //return view('clientes.add');
          return redirect('adm/profissionais');
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
      $profissional = Profissional::find($id);
      return view('adm.profissionais.edit', compact('profissional'));
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
      $profissional = Profissional::find($id);

      $file = array('image' => Input::file('image'));

       if(Input::file('image') != null){
         // setting up rules
         $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
         // doing the validation, passing post data, rules and the messages
         $validator = Validator::make($file, $rules);
         if ($validator->fails()) {
           // send back to the page with the input data and errors
           return Redirect::to('adm/profissionais')->withInput()->withErrors($validator);
         }
         else {
           // checking file is valid.
           if (Input::file('image')->isValid()) {

             $destinationPath = 'uploads'; // upload path
             $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
             //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
             $nameonly=preg_replace('/\..+$/', '', Input::file('image')->getClientOriginalName());
             $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
             Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
           }
         }
       }

       //salvando os dados do banner
       if(Input::file('image') != null){
           $profissional->foto = $destinationPath."/".$fileName;
       }

      $profissional->fill($input)->save();

      Session::flash('success', '<div class="alert alert-success">
                                  Atualizado com sucesso!
                                </div>');

     return redirect('adm/profissionais');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Profissional::findOrFail($id)->delete();

      Session::flash('success', '<div class="alert alert-success">
                                  Conteúdo apagado com sucesso!
                                </div>');

      return redirect('adm/profissionais');
    }
}
