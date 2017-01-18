<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Evaluation;

class EvaluationRESTController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		echo "hello";
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

	public function store(Request $request)
	{
		dd($request->genero);
		$ev = new Evaluation;
        
        // $ev->que_busca = $this->getParam($params,'que_busca');
        // $ev->le_dieron = $this->getParam($params,'le_dieron');
        // $ev->info_ok = $this->getParam($params,'info_ok');
        // $ev->privacidad_ok = $this->getParam($params,'privacidad_ok');
        // $ev->edad = $this->getParam($params,'edad');
        // $ev->genero = $this->getParam($params,'genero');
        // $ev->comentario = $this->getParam($params,'comentario');
        // $ev->voto = $this->getParam($params,'voto');
        // $ev->aprobado = 0;

        $ev->que_busca = $request->que_busca;
        $ev->le_dieron = $request->le_dieron;
        $ev->info_ok = $request->info_ok;
        $ev->privacidad_ok = $request->privacidad_ok;
        $ev->edad = $request->edad;
        $ev->genero = $request->genero;
        $ev->comentario = $request->comentario;
        $ev->voto = $request->voto;
        $ev->aprobado = 0;
		
		$ev->save();

		return $ev;
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
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

}
