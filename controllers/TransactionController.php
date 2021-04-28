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
        $transactions = Transaction::with('client','branch','captain','mission','shipment')->orderByDesc('id')->paginate(20);
        
        $transaction_owner[Transaction::CAPTAIN]['text'] = translate("Captain");
        $transaction_owner[Transaction::CAPTAIN]['key'] = "captain";
        $transaction_owner[Transaction::CAPTAIN]['id'] = "captain_id";
        $transaction_owner[Transaction::CLIENT]['text'] = translate("Client");
        $transaction_owner[Transaction::CLIENT]['key'] = "client";
        $transaction_owner[Transaction::CLIENT]['id'] = "client_id";
        $transaction_owner[Transaction::BRANCH]['text'] = translate("Branch");
        $transaction_owner[Transaction::BRANCH]['key'] = "branch";
        $transaction_owner[Transaction::BRANCH]['id'] = "branch_id";

        $transaction_type[Transaction::MESSION_TYPE] = "mission";
        $transaction_type[Transaction::SHIPMENT_TYPE] = "shipment";
        $transaction_type[Transaction::MANUAL_TYPE] = "manual";

        $page_name = translate('All Transactions');
        // return $transactions;
        return view('backend.transactions.index', compact('transactions', 'page_name', 'transaction_owner','transaction_type'));
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
        $branchs = Branch::where('is_archived', 0)->get();
        $clients = Client::where('is_archived', 0)->get();
        $captains = Captain::where('is_archived', 0)->get();
        return view('backend.shipments.create', compact('branchs', 'clients','captains'));
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
