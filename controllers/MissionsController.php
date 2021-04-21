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
use Auth;
use App\Events\ApproveMission;
use App\Events\AssignMission;
use App\Events\UpdateMission;
use App\Events\MissionAction;

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
        if(Auth::user()->user_type == 'customer'){
            $missions = Mission::where('status_id',$status)->where('client_id',Auth::user()->userClient->client_id);
        }elseif(Auth::user()->user_type == 'captain'){
            $missions = Mission::where('status_id',$status)->where('captain_id',Auth::user()->userCaptain->captain_id);
        // }elseif(Auth::user()->user_type == 'branch'){
        //     $missions = Mission::where('status_id',$status)->where('to_branch_id',Auth::user()->userBranch->branch_id);
        }else{
            $missions = Mission::where('status_id',$status);
        }
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
            $mission = Mission::where('id',$request->checked_ids[0])->first();

            $params = array();
            if($to == Mission::RECIVED_STATUS)
            {
                dd($request);
                if(isset($request->amount) && (in_array(Auth::user()->user_type,['admin']) || in_array('1210', json_decode(Auth::user()->staff->role->permissions ?? "[]"))) )
                {
                    $params['amount'] = $request->amount;
                }
                if(isset($request->signaturePadImg))
                {
                    if($request->signaturePadImg == null || $request->signaturePadImg == " ")
                    {
                        flash(translate("Please Confirm The Signature"))->error();
                        return back();
                    }
                    $params['seg_img'] = $request->signaturePadImg;
                }
                if(isset($request->otp))
                {
                    if($request->otp_confirm == null || $request->otp_confirm == " ")
                    {
                        flash(translate("Please enter OTP of mission"))->error();
                        return back();
                    }
                    elseif($mission->otp != $request->otp_confirm )
                    {
                        flash(translate("Please enter correct OTP"))->error();
                        return back();
                    }
                    $params['otp'] = $request->otp;
                }
            }
            
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,null,$params);
            if($response['success'])
            {
                event(new MissionAction($to,$request->checked_ids));
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
        // return $request;
        try{	
			DB::beginTransaction();
            $params = array();
            $params['due_data'] = $_POST['Mission']['due_date'];
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,$request['Mission']['captain_id'],$params);
            
            event(new AssignMission($request['Mission']['captain_id'],$request->checked_ids));
            event(new ApproveMission($request->checked_ids));
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
        if(Auth::user()->user_type == 'captain'){
            $captain = Captain::find(Auth::user()->userCaptain->captain_id);
            $missions = Mission::where('captain_id',Auth::user()->userCaptain->captain_id)->where('due_date',Carbon::today()->format('Y-m-d'))->get();
            return view('backend.missions.manifest-profile',compact('missions','captain'));
        }
        return view('backend.missions.manifests');
    }
    public function getManifestProfile(Request $request)
    {
        $captain = Captain::find($request->captain_id);
        $missions = Mission::where('captain_id',$request->captain_id)->where('due_date',$request->manifest_date)->get();
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
