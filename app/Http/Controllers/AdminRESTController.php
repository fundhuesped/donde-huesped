<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Hash;
use Validator;
class AdminRESTController extends Controller
{

  public function userCountries($idUser)
  {
    $response = array();
    $userCountries = DB::table('user_country')->where('id_user',$idUser)->select('id_country')->get();
    foreach ($userCountries as $country) {
      array_push($response, $country->id_country);
    }
    return $response;
  }

  public function saveUserCountries($userId, Request $request)
  {
    $request_params = $request->all();
    $userId = $userId;
    $rowArray = array();
    $queryArray = array();
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('user_country')->where('id_user', $userId)->delete();

    foreach ($request_params as $countryId) {
      $rowArray = array('id_user' => $userId, 'id_country' => $countryId);
      array_push($queryArray,$rowArray);
    }

    DB::table('user_country')->insert($queryArray);
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    return;
  }

  public function changePassword(Request $request){

    $input = $request->all();
    $rules = array(
        'userId'        => 'required|exists:users,id',
        'new_password'  => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'required|min:6'
        );
    $messages = array(
        'required'          => 'Complete los datos requeridos.',
        'exists'            => 'El usuario ingresado no existe.',
        'required_with'     => 'Las contraseñas deben coincidir.',
        'same'              => 'Las contraseñas deben coincidir.',
        'min'               => 'La contraseña debe poseer un mínimo de :min caracteres.'
    );

    $validator = Validator::make($input,$rules,$messages);
    if ($validator->passes()){
        $id = $input['userId'];
        $user = User::where('id', $id)->first();
        $user->password = Hash::make($input['new_password']);
        $user->save();
    }

    return $validator->messages();
}

  public function deleteUser(Request $request){

    $input = $request->all();
    $rules = array(
        'userId'        => 'required|exists:users,id'
        );
    $messages = array(
        'required'          => 'El campo :attribute es requerido.',
        'exists'            => 'El usuario ingresado no existe.'
    );

    $validator = Validator::make($input,$rules,$messages);
    if ($validator->passes()){
        $id = $request['userId'];
        if($id == Auth::id()){//Cannot delete myself
            return -1;
        }
        $user = User::where('id', $id)->first();
        $user->delete();
    }

    return $validator->messages();
  }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function logged(){
      return Auth::user();
    }
}
