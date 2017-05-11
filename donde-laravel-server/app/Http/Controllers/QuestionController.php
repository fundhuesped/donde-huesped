<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
class QuestionController extends Controller {


	public function getAllQuestionsResponses(){
	return \App\Question::with('options','services')->get();
	/*return DB::table('question')
		->join('question_service', 'question_service.question_id', '=', 'question.id')
		->join('service', 'service.id', '=', 'question_service.service_id')
		->join('answer_option', 'answer_option.question_id', '=', 'question.id')
		->select('question.id as questionId','question.body as questionBody','question.type as questionType','answer_option.id as aoId','answer_option.body as aoBody','answer_option.question_id as aoQuestionId','service.id as serviceId','service.name as serviceName','service.shortname as serviceShortName')
		->get();*/
}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	 * @return Response
	 */
	public function store()
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
