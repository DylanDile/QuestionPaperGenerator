<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/scheduled_tests', 'TradeTestsController@index')->name('scheduled_tests');

Route::prefix('admin')->group(function(){
	//get methods
	Route::get('/addQuestion', 'QuestionsController@addMultipleChoiceQuestion')->name('admin.addMutlipleChoiceQuestion');
	Route::get('/addStructuredQuestion', 'QuestionsController@addStructuredQuestion')->name('admin.addStructuredQuestion');
	Route::get('/multipleChoicePapers', 'QuestionsController@addStructuredQuestion')->name('admin.multipleChoice.papers');
	Route::get('/structuredPapers', 'QuestionsController@addStructuredQuestion')->name('admin.structured.papers');
	Route::get('/allQuestions', 'QuestionsController@index')->name('admin.allQuestions');
	

	//post methods
	Route::post('/addQuestionStore', 'QuestionsController@addQuestionStore')->name('admin.addQuestion.submit');
	Route::post('/addStructuredStore', 'QuestionsController@addQuestionStore')->name('admin.addStructured.submit');
	Route::post('/searchQuestions', 'QuestionsController@searchQuestions')->name('admin.searchQuestion');

	//get answer
	Route::get('/answer/{q_number}', 'QManagerController@questionAnswer')->name('admin.questionAnswer.show');
	Route::get('/manage/{q_number}', 'QManagerController@questionManage')->name('admin.questionManage');
	Route::get('/import', 'QManagerController@ImportFromExcel')->name('admin.import');

	//generate question papers
	Route::get('/generate/multipleChoice', 'QManagerController@genMultipleChoice')->name('admin.genMultipleChoice');
	Route::post('/generate/multipleChoice', 'QManagerController@genMultipleChoiceSubmit')->name('admin.genMultipleChoice.submit');

	Route::post('/generate/questionPaper', 'QManagerController@generatePaper')->name('admin.genPaper.submit');
	Route::post('/trade_test/schedule', 'TradeTestsController@schedule')->name('admin.test_schedule.submit');


	Route::get('/generated/questionPapers', 'QManagerController@viewGeneratedPapers')->name('admin.viewGeneratedPapers');

	Route::get('/viewPaper/{qp_number}', 'QManagerController@viewPaper')->name('admin.viewPaper');
	Route::get('/schedule/{qp_number}', 'TradeTestsController@show')->name('admin.schedule_paper');
	Route::get('/delete/{id}/test', 'TradeTestsController@delete')->name('admin.delete.test');	

});


Route::prefix('student')->group(function(){
	Route::get('/skills/test', 'SkillsController@test')->name('student.skills.test');
	Route::post('/skills/test/submit', 'SkillsController@testSubmit')->name('student.skillsTest.submit');
	Route::get('/test/results', 'SkillsController@testResults')->name('student.test.results');
	Route::get('/test/answers/{test_id}', 'SkillsController@getResults')->name('student.results.show');
	Route::get('/take/{test_id}/test', 'TradeTestsController@takeTest')->name('student.take.test');
	Route::post('/submit/test', 'TradeTestsController@submitTest')->name('student.trade_test.submit');
});

Route::prefix('questions')->group(function(){
	Route::get('/multipleChoice', 'HomeController@multipleChoice')->name('questions.multipleChoice');
	Route::get('/structured', 'HomeController@structured')->name('questions.structured');
	Route::post('/search/structured', 'HomeController@searchStructured')->name('questions.searchStructured');
	Route::post('/search/multipleChoice', 'HomeController@searchMultipeChoice')->name('questions.searchMultipeChoice');
	
});
