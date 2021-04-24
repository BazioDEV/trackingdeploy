

<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
    <div class="col-9 row">
        <div class="col-6">
            <h1 class="display-4 font-weight-boldest mb-10">{{translate('Mission Shipments')}}</h1>
        </div>
        @isset($data['reasons'])
            <div class="col-6 text-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary px-3" data-toggle="modal" data-target="#exampleModalCenter" id="modal_open">
                    {{translate('Reschedule')}}
                </button>
            
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{translate('Reschedule')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('admin.missions.reschedule') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$data['mission']->id}}">
                                <div class="modal-body text-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{translate('Reason')}}:</label>
                                                
                                                <select name="reason" class="form-control captain_id kt-select2">
                                                    @foreach ($data['reasons'] as $reason)
                                                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>{{translate('Due Date')}}:</label>
                                                <input type="text" id="kt_datepicker_3" autocomplete="off" class="form-control"  name="due_date"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
                                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pl-0 font-weight-bold text-muted text-uppercase">{{translate('Code')}}</th>
                        <th class=" font-weight-bold text-muted text-uppercase">{{translate('Status')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Type')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Branch')}}</th>
                        <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Client')}}</th>
                        <th class="text-center font-weight-bold text-muted text-uppercase">{{translate('Actions')}}</th>
                        <th class="text-center font-weight-bold text-muted text-uppercase print-only">{{translate('Check')}}</th>
                    </tr>
                </thead>
                <tbody>
                   
                @foreach(\App\ShipmentMission::where('mission_id',$data['mission']->id)->get() as $shipment_mission)
                    <tr class="font-weight-boldest @if(in_array($shipment_mission->shipment->status_id ,[\App\Shipment::RETURNED_STATUS,\App\Shipment::RETURNED_STOCK,\App\Shipment::RETURNED_CLIENT_GIVEN])) table-danger @endif">
                        <td class="pl-5 pt-7"><a href="{{route('admin.shipments.show', ['shipment'=>$shipment_mission->shipment->id])}}">{{$shipment_mission->shipment->code}}</a></td>
                        <td class="pl-5 pt-7">{{$shipment_mission->shipment->getStatus()}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->type}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->branch->name}}</td>
                        <td class=" pt-7 text-right">{{$shipment_mission->shipment->client->name}}</td>
                        <td class="text-danger pr-5 pt-7 text-right">
                            @if(in_array($shipment_mission->mission->status_id , [\App\Mission::DONE_STATUS,\App\Mission::APPROVED_STATUS,\App\Mission::RECIVED_STATUS]))
                            <a href="#" class="btn btn-danger  btn-sm confirm-delete" data-href="{{route('admin.shipments.delete-shipment-from-mission', ['shipment'=>$shipment_mission->shipment->id,'mission'=>$shipment_mission->mission_id])}}" title="{{ translate('Remove Shipment From Mission') }}">
		                        <i class="las la-trash"></i> {{translate('Remove From')}} {{$data['mission']->code}}
		                    </a>
                            @else
                            {{translate('No actions')}}
                            @endif
                        </td>
                        <td class="text-center print-only"><input type="checkbox" class="form-control" /></td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>