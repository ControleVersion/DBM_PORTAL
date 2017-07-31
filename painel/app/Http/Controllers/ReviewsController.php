<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Review;
use App\Http\Requests;
use Session;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::selectRaw('*, reviews.id as review_id')
        			->leftJoin('users', 'users.id','=', 'reviews.user_id')
        			->orderBy('reviews.id', 'DESC')
        			->paginate(20);
        return view('adm.reviews.list', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $resposta = ['return'=>null];
        
        if(is_numeric($id)){

          $userID = (isset(Auth::user()->id))? Auth::user()->id : '';
          $videoID = (int)$_POST['video_id'];
          if($userID != ""  && is_numeric($videoID)){
            //verificar se jah foi avaliado
            $avalidado = DB::table("reviews")
                          ->where("user_id", '=', $userID)
                          ->where("videoaula_id", '=', $videoID)
                          ->get();

            if(count($avalidado) < 1){
                //["valor"]=> string(1) "5" ["comment"]=> string(16) "Excelente curso!" ["video_id"]
                $review = Review::create([
                  'review'=>$id,
                  'coment'=> $_POST['comment'],
                  'user_id'=>$userID,
                  'videoaula_id'=> $_POST['video_id'],
                  'status'=>'Inativo'
                ]);
                  if($review){
                    $resposta = ['return'=>"OK"];
                    echo json_encode($resposta);
                  } else{
                    $resposta = ['return'=>"ERRO"];
                    echo json_encode($resposta);
                  }
            } else {
              $resposta = ['return'=>"REPEAT"];
              echo json_encode($resposta);
            }
          } else {

            $resposta = ['return'=>"FAIL_LOGIN"];
            echo json_encode($resposta);
          }

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

      $review = Review::selectRaw('*, reviews.id as review_id')->leftJoin('users', 'users.id','=', 'reviews.user_id')->find($id);
      return view('adm.reviews.edit', compact('review'));
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
        //salvando os dados do banner
         $review = Review::findOrFail($id);

         $input = $request->all();
         $review->fill($input)->save();
         //var_dump($input); exit();

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
