<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Validator;
use Redirect;
use File;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\User;
use App\Professor;

class ProfessorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $professores = Professor::all();
        return view('adm.professors.index', compact('users', 'professores'));
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
      $file = array('image' => Input::file('foto_perfil'));

        //var_dump($banner->url_imagem);exit();
      $req = $request->all();
      $Professor = new Professor($req);

        if(Input::file('foto_perfil') != null){


          // setting up rules
          $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
          // doing the validation, passing post data, rules and the messages
          $validator = Validator::make($file, $rules);
          if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('adm/professors')->withInput()->withErrors($validator);
          }
          else {
            // checking file is valid.
            if (Input::file('foto_perfil')->isValid()) {
              //apagando imagem anterior cadastrada
               if(isset($banner->url_imagem)){
                   //apagar arquvivo pelo caminho
                   File::delete( $banner->url_imagem);
               }

              $destinationPath = 'uploads'; // upload path
              $extension = Input::file('foto_perfil')->getClientOriginalExtension(); // getting image extension
              //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
              $nameonly=preg_replace('/\..+$/', '', Input::file('foto_perfil')->getClientOriginalName());

              $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image
             

              Input::file('foto_perfil')->move($destinationPath, $fileName); // uploading file to given path
            }
          }
        }

        //salvando os dados do banner
        if(Input::file('foto_perfil') != null){
            $Professor->foto_perfil = $destinationPath."/".$fileName;

        }
        
      //var_dump($user); exit();

      $Professor->save();

      Session::flash('success', '<div class="alert alert-success">
                                  Cadastrado com sucesso!
                                </div>');
      //return view('clientes.add');
      return redirect('adm/professors');
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
        $users = User::all();
         $professor = Professor::find($id);
         return view('adm.professors.edit', compact('professor', 'users'));
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
         $professor = Professor::findOrFail($id);        

         //===================================================================
          $file = array('image' => Input::file('foto_perfil'));

          if(Input::file('foto_perfil') != null){

            // setting up rules
            $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
            // doing the validation, passing post data, rules and the messages
            $validator = Validator::make($file, $rules);
            if ($validator->fails()) {
              // send back to the page with the input data and errors
              return Redirect::to('adm/professors/edit/'.$id)->withInput()->withErrors($validator);
            }
            else {
              // checking file is valid.
              if (Input::file('foto_perfil')->isValid()) {
                //apagando imagem anterior cadastrada
                 if(isset($professor->url_imagem)){
                     //apagar arquvivo pelo caminho
                     File::delete( $banner->url_imagem);
                 }

                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('foto_perfil')->getClientOriginalExtension(); // getting image extension
                //TESTANDO TRATAMENTO DO NOME DO ARQUIVO
                $nameonly=preg_replace('/\..+$/', '', Input::file('foto_perfil')->getClientOriginalName());

                $fileName = $this->tirarAcento($nameonly).rand(11111,99999).'.'.$extension; // renameing image

                Input::file('foto_perfil')->move($destinationPath, $fileName); // uploading file to given path
              }
            }
          }
          $input = $request->all();
          $professor->fill($input)->save();
          //salvando os dados do banner
          if(Input::file('foto_perfil') != null){
              $professor->foto_perfil = $destinationPath."/".$fileName;
              $professor->save(); 
          }
          
          //dd($professor->foto_perfil);
                    
         //===================================================================

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
       Professor::findOrFail($id)->delete();

       Session::flash('success', '<div class="alert alert-success">
                                   Conteúdo apagado com sucesso!
                                 </div>');

       return redirect('adm/professors');
     }
}
