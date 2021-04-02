<?php

namespace App\Http\Controllers;

use App\Captain;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MissionActionHelper;
use App\Http\Helpers\MissionStatusManagerHelper;
use App\Http\Helpers\StatusManagerHelper;
use App\Mission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
class MissionsController extends Controller
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

    public function statusIndex($status,$type=null)
    {
        $missions = Mission::where('status_id',$status);
        if($type !=null)
        {
            $missions = $missions->where('type',$type);
        }
        $missions = $missions->paginate(20);
        
        $actions = new MissionActionHelper();
        $actions = $actions->get($status,$type);
        $page_name = Mission::getStatusByStatusId($status)." ".Mission::getType($type);
        
        return view('backend.missions.index',compact('missions','actions','page_name','type','status'));
    }

    public function change(Request $request,$to)
    {
        
        if(isset($request->checked_ids))
        {
            $params = array();
            if($to == Mission::RECIVED_STATUS)
            {
                if(isset($request->amount))
                {
                    $params['amount'] = $request->amount;
                }
                if(isset($request->seg_img))
                {
                    $params['seg_img'] = $request->seg_img;
                }
                if(isset($request->otp))
                {
                    $params['otp'] = $request->otp;
                }
            }
            
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,null,$params);
            if($response['success'])
            {
                flash(translate("Status Changed Successfully!"))->success();
                return back();
            }
            if($response['error_msg'])
            {
                flash(translate("Somthing Wrong!"))->error();
                return back();
            }
            
        }else
        {
            flash(translate("Please select missions"))->error();
            return back();
        }
        
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
        $mission = Mission::find($id);
        return view('backend.missions.show',compact('mission'));
    }

    public function approveAndAssign(Request $request,$to)
    {
        try{	
			DB::beginTransaction();
            $params = array();
            $params['due_data'] = $_POST['Mission']['due_date'];
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,$request['Mission']['captain_id'],$params);
            
            DB::commit();
            flash(translate("Mission created successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    public function getManifests()
    {
        return view('backend.missions.manifests');
    }
    public function getManifestProfile(Request $request)
    {
        $captain = Captain::find($request->captain_id);
        $missions = Mission::where('captain_id',$request->captain_id)->where('due_date',Carbon::today()->format('Y-m-d'))->get();
        return view('backend.missions.manifest-profile',compact('missions','captain'));
    }

    public function getAmountModel($mission_id)
    {
        $mission = Mission::find($mission_id);
        return view('backend.missions.ajaxed-confirm-amount',compact('mission'));
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
