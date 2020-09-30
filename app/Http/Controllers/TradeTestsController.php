<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TradeTest;
use App\QuestionPaper;
use Auth;

class TradeTestsController extends Controller
{
    //
    	    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin)
        {
            $trade_tests = TradeTest::query()->get();
        }
        elseif (Auth::user()->isAdmin == 2) {
            # code...
            $trade_tests = TradeTest::query()->get();
        }
        else
        {
            $trade_tests = TradeTest::query()->where('class', Auth::user()->class)->get();
        }

        return view('tests.index')->with('trade_tests', $trade_tests);
    }

    public function show($qp_number)
    {
        return view('tests.schedule')->with('qp_number', $qp_number);
    }

    public function schedule(Request $request)
    {
        $this->validate($request, [
        	'exam_date' => 'required|date',
        	'exam_time' => 'required'
        ]);

        $qp = QuestionPaper::query()->where('qp_number', $request->input('qp_number'))->first();

        $checkPaper = TradeTest::query()->where('qp_number', $request->input('qp_number'))->first();
        if($checkPaper)
        {
        	return redirect()->back()->with('error', 'That test has been scheduled already');
        }

        TradeTest::query()->create([
        	'qp_number' => $request->input('qp_number'),
        	'exam_date' => $request->input('exam_date'),
        	'exam_time' => $request->input('exam_time'),
        	'status' => 'on',
        	'class' => $qp->qp_class,
        	'trade' => $qp->qp_title,
            'posted_by' => Auth::user()->id,
        ]);

        return redirect(route('admin.viewGeneratedPapers'))->with('success', 'Trade Test Scheduled');     

    }

    public function delete($id)
    {
        $tt = TradeTest::query()->find($id);
        $tt->delete();
        return redirect(route('scheduled_tests'))->with('success', 'Trade Test Deleted'); 
    }
}
