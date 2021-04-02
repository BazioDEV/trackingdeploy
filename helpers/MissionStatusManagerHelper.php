<?php

namespace App\Http\Helpers;

use App\ClientShipmentLog;
use App\Mission;
use App\Shipment;
use App\Transaction;
use DB;

class MissionStatusManagerHelper
{


    //Mission Status Manager

    public function change_mission_status($missions, $to, $captain_id = null,$params=array())
    {
        $response = array();
        $response['success'] = 1;
        $response['error_msg'] = '';
        try {
            DB::beginTransaction();
            
            $transaction = new TransactionHelper();
            foreach ($missions as $mission_id) {
                $mission = Mission::find($mission_id);
                if($mission->status_id == $to)
                {
                    throw new \Exception("Out of status changer scope");
                }
                if ($mission != null) {
                    
                    $oldStatus = $mission->status_id;
                    
                    if ($to == Mission::APPROVED_STATUS) {
                       
                        if ($captain_id != null) {
                            $mission->captain_id = $captain_id;
                           
                            if(isset($params['due_data']))
                            {
                                $mission->due_date = $params['due_data'];  
                            }
                        } else {
                            throw new \Exception("Captain is required in this step");
                        }
                        
                    }

                    if ($to == Mission::RECIVED_STATUS) {
                        if(isset($params['amount']))
                        {
                            $mission->amount = $params['amount'];
                            $transaction->create_mission_transaction($mission->id,$params['amount'],Transaction::CAPTAIN,$mission->captain_id,Transaction::DEBIT);
                            if ($mission->getOriginal('type') == Mission::PICKUP_TYPE || $mission->getOriginal('type') == Mission::RETURN_TYPE) {
                                $transaction->create_mission_transaction($mission->id,$params['amount'],Transaction::CLIENT,$mission->client_id,Transaction::DEBIT);
                            }
                            if(isset($params['seg_img']))
                            {
                                $mission->seg_img = $params['seg_img'];
                            }
                            if(isset($params['otp']))
                            {
                                if($params['otp'] != $mission->otp)
                                {
                                    throw new \Exception("Please write the right OTP");
                                }
                            }
                            
                        }
                        if ($mission->getOriginal('type') == Mission::TRANSFER_TYPE) {
                            foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                $shipment = \App\Shipment::find($shipment_id);
                                $oldClientStatus = $shipment->client_status;
                                $shipment->client_status = Shipment::CLIENT_STATUS_RECEIVED_BRANCH;
                                $log = new ClientShipmentLog();
                                $log->from = $oldClientStatus;
                                $log->to = Shipment::CLIENT_STATUS_RECEIVED_BRANCH;
                                $log->shipment_id = $shipment->id;
                                $log->created_by = \Auth::user()->id;
                                $log->save();
                            }
                        }
                        if ($mission->getOriginal('type') == Mission::DELIVERY_TYPE) {
                            if (\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper")) {
                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::RECIVED_STATUS);
                                }
                            }
                        }
                        // $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::DEBIT);
                        
                    }

                    

                    if ($to == Mission::DONE_STATUS) {
                        if (\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper")) {
                            if ($mission->getOriginal('type') == Mission::PICKUP_TYPE) {
                                //Hook shipment backend in Mission status changed

                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::APPROVED_STATUS);
                                }
                                
                            }

                            if ($mission->getOriginal('type') == Mission::DELIVERY_TYPE) {
                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    if($shipment->status_id == \App\Shipment::RETURNED_STATUS){
                                        $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                        $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::RETURNED_STOCK);
                                    }else{
                                        $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                        $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::DELIVERED_STATUS);
                                    }
                                }
                            }

                            if ($mission->getOriginal('type') == Mission::TRANSFER_TYPE) {
                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $oldClientStatus = $shipment->client_status;
                                    $shipment->prev_branch = $shipment->branch_id;
                                    $shipment->branch_id = $mission->to_branch_id;
                                    $shipment->save();
                                    $shipment->client_status = Shipment::CLIENT_STATUS_TRANSFERED;
                                    $log = new ClientShipmentLog();
                                    $log->from = $oldClientStatus;
                                    $log->to = Shipment::CLIENT_STATUS_TRANSFERED;
                                    $log->shipment_id = $shipment->id;
                                    $log->created_by = \Auth::user()->id;
                                    $log->save();
                                }
                            }

                            if ($mission->getOriginal('type') == Mission::RETURN_TYPE) {
                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    if($shipment->status_id == \App\Shipment::RETURNED_STOCK){
                                        $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                        $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::RETURNED_CLIENT_GIVEN);
                                    }
                                }
                            }

                            if ($mission->getOriginal('type') == Mission::SUPPLY_TYPE) {
                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::SUPPLIED_STATUS);
                                }
                            }
                        }
                        if(in_array($mission->getOriginal('type'),[Mission::PICKUP_TYPE,Mission::DELIVERY_TYPE,Mission::RETURN_TYPE,Mission::SUPPLY_TYPE]))
                        {
                            $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CAPTAIN,$mission->captain_id,Transaction::CREDIT);
                            $transaction->create_mission_transaction($mission->id,$mission->amount,Transaction::CLIENT,$mission->client_id,Transaction::CREDIT);
                        }

                        
                        
                        
                    }

                    $mission->status_id = $to;
                    if (!$mission->save()) {
                        throw new \Exception("can't change mission status");
                    }
                    //After change action 
                    if ($to == Mission::APPROVED_STATUS) {
                        if ($mission->getOriginal('type') == Mission::PICKUP_TYPE) {
                            
                        }
                        if ($mission->getOriginal('type') == Mission::DELIVERY_TYPE) {

                            //Hook shipment backend in Mission status changed
                            if (\Schema::hasTable('shipment_mission') && class_exists("\App\ShipmentMission") && class_exists("\App\Shipment") && class_exists("\App\Http\Helpers\StatusManagerHelper")) {

                                foreach (\App\ShipmentMission::where('mission_id', $mission->id)->pluck('shipment_id') as $shipment_id) {
                                    $shipment = \App\Shipment::find($shipment_id);
                                    $change_status_to_be_approved = new \App\Http\Helpers\StatusManagerHelper();
                                    $change_status_to_be_approved->change_shipment_status([$shipment->id], \App\Shipment::CAPTAIN_ASSIGNED_STATUS, $mission->id);
                                }
                            }
                        }
                    }
                } else {
                    throw new \Exception("There is no mission with this Code");
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            //echo $e->getMessage();exit;
            DB::rollback();
            $response['success'] = 0;
            $response['error_msg'] = $e->getMessage();
        }
        return $response;
    }
}
