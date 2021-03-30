

<div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
    <h1 class="display-4 font-weight-boldest mb-10">{{translate('Manifest Shipments')}}</h1>
    
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
                    </tr>
                </thead>
                <tbody>
                   
                @foreach(\App\ShipmentMission::where('mission_id',$data['mission']->id)->get() as $shipment_mission)
                    <tr class="font-weight-boldest @if(in_array($shipment_mission->shipment->status_id ,[\App\Shipment::RETURNED_STATUS,\App\Shipment::RETURNED_STOCK,\App\Shipment::RETURNED_CLIENT_GIVEN])) table-danger @endif">
                        <td class="pl-5 pt-7">D {{$shipment_mission->shipment->code}}</td>
                        <td class="pl-5 pt-7">{{$shipment_mission->shipment->getStatus()}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->type}}</td>
                        <td class="text-right pt-7">{{$shipment_mission->shipment->branch->name}}</td>
                        <td class=" pt-7 text-right">{{$shipment_mission->shipment->client->name}}</td>
                        <td class="text-danger pr-5 pt-7 text-right">
                            @if(in_array($shipment_mission->mission->status_id , [\App\Mission::DONE_STATUS,\App\Mission::APPROVED_STATUS,\App\Mission::RECIVED_STATUS]))
                            <a href="#" class="btn btn-danger  btn-sm confirm-delete" data-href="{{route('admin.shipments.delete-shipment-from-mission', ['shipment'=>$shipment_mission->shipment->id,'mission'=>$shipment_mission->mission_id])}}" title="{{ translate('Remove Shipment From Manifest') }}">
		                        <i class="las la-trash"></i> {{translate('Remove From')}} M {{$shipment_mission->mission_id}}
		                    </a>
                            @else
                            <p class="text-success"><i class="fa fa-check text-success"></i> {{translate('No actions')}}</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</div>