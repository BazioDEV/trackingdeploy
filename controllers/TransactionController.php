<?php

namespace App\Http\Controllers;

use App\Captain;
use App\Client;
use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;
use DB;
class TransactionController extends Controller
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

    public function getClientTransaction($client_id)
    {
        $transactions = Transaction::where('client_id',$client_id)->orderBy('created_at','desc')->get();
        $client = Client::find($client_id);
        // $transactions_by_month = Transaction::select([
        //     DB::raw("DATE_FORMAT(created_at, '%m') month"),
        //     DB::raw("SUM(value) sum_value")
        // ])->whereRaw("DATE_FORMAT(created_at, '%y') = DATE_FORMAT(NOW(), '%y')")->where('client_id',$client_id)->groupBy('month')->get();
        $chart_categories = array();
        $chart_values = array();
        // foreach($transactions_by_month as $trans)
        // {
        //     array_push($chart_categories,$trans->month);
        //     array_push($chart_values,$trans->sum_value);
        // }
        return view('backend.transactions.show-client-transactions')
        ->with('transactions',$transactions)
        ->with('client',$client)
        ->with('chart_categories',$chart_categories)
        ->with('chart_values',$chart_values);
    }

    public function getCaptainTransaction($captain_id)
    {
        $transactions = Transaction::where('captain_id',$captain_id)->orderBy('created_at','desc')->get();
        $captain = Captain::find($captain_id);
       
        $chart_categories = array();
        $chart_values = array();
        
        return view('backend.transactions.show-captain-transactions')
        ->with('transactions',$transactions)
        ->with('captain',$captain)
        ->with('chart_categories',$chart_categories)
        ->with('chart_values',$chart_values);
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
        //
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
        //
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
