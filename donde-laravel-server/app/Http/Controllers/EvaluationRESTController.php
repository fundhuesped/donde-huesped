<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Evaluation;
use DB;

class EvaluationRESTController extends Controller {


	public function block($id){
		// $request_params = $request->all();

		$evaluation = Evaluation::find($id);

		$evaluation->aprobado = -1;

		$evaluation->updated_at = date("Y-m-d H:i:s");
		$evaluation->save();

		return $evaluation;
	}

	public function approve($id){

		// $request_params = $request->all();

		$evaluation = Evaluation::find($id);
		
		$evaluation->aprobado = 1;

		$evaluation->updated_at = date("Y-m-d H:i:s");
		$evaluation->save();

		return $evaluation;
	}

	public function showEvaluations(){ //def toma 5
		return DB::table('evaluation')->take(5)->get();
	}


	public function getPlaceAverageVote($id){
		return Evaluation::where('aprobado', '=', '1')
			->where('idPlace',$id)
		    // ->select(array('evaluation.*', DB::raw('AVG(voto) as promedio') ))
		    ->select(DB::raw('AVG(voto) as promedio'))
		    ->orderBy('promedio', 'DESC')
		    ->get('promedio');
	}

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
		return view('tmp');
	}

	public function store(Request $request)
	{
		dd($request);
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
		$evaluation = Evaluation::find($id);
		return $evaluation;
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
