@if(Auth::user()->user_type == 'admin' || in_array('1101', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{translate('Latest Shipments')}}</h3>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table mb-0 aiz-table">
                        <thead>
                            <tr>
                                
                                <th>{{translate('Code')}}</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('Type')}}</th>
                                <th>{{translate('Client')}}</th>
                                <th>{{translate('Branch')}}</th>

                                <th>{{translate('Shipping Cost')}}</th>
                                <th>{{translate('Payment Method')}}</th>
                                <th>{{translate('Shipping Date')}}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $count      = (App\ShipmentSetting::getVal('latest_shipment_count') ? App\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                                $shipments  = App\Shipment::limit($count)->orderBy('id','desc')->get();
                            @endphp
                            @foreach($shipments as $key=>$shipment)

                            <tr>
                                
                                <td width="5%">D{{$shipment->code}}</td>
                                <td><a href="">{{$shipment->getStatus()}}</a></td>
                                <td>{{$shipment->type}}</td>
                                <td><a href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a></td>
                                <td><a href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>

                                <td>{{$shipment->shipping_cost}}</td>
                                <td>{{$shipment->pay->name}}</td>
                                <td>{{$shipment->shipping_date}}</td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <!--end::Card-->

        </div>
    </div>
@elseif(Auth::user()->user_type == 'customer')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{translate('Latest Shipments')}}</h3>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table mb-0 aiz-table">
                        <thead>
                            <tr>
                                
                                <th>{{translate('Code')}}</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('Type')}}</th>
                                <th>{{translate('Client')}}</th>
                                <th>{{translate('Branch')}}</th>

                                <th>{{translate('Shipping Cost')}}</th>
                                <th>{{translate('Payment Method')}}</th>
                                <th>{{translate('Shipping Date')}}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $count      = (App\ShipmentSetting::getVal('latest_shipment_count') ? App\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                                $shipments  = App\Shipment::limit($count)->orderBy('id','desc')->where('client_id',Auth::user()->userClient->client_id)->get();
                            @endphp
                            @foreach($shipments as $key=>$shipment)

                            <tr>
                                
                                <td width="5%">D{{$shipment->code}}</td>
                                <td><a href="">{{$shipment->getStatus()}}</a></td>
                                <td>{{$shipment->type}}</td>
                                <td><a href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a></td>
                                <td><a href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a></td>

                                <td>{{$shipment->shipping_cost}}</td>
                                <td>{{$shipment->pay->name}}</td>
                                <td>{{$shipment->shipping_date}}</td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <!--end::Card-->

        </div>
    </div>
@elseif(Auth::user()->user_type == 'captain')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{translate('Current Missions')}}</h3>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table mb-0 aiz-table">
                        <thead>
                            <tr>
                                <th>{{translate('Code')}}</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('Type')}}</th>
                                <th>{{translate('Amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $count      = (App\ShipmentSetting::getVal('latest_shipment_count') ? App\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                                $missions = App\Mission::limit($count)->orderBy('id','desc')->where('captain_id',Auth::user()->userCaptain->captain_id)->where('due_date', \Carbon\Carbon::today()->format('Y-m-d'))->get();
                            @endphp
                            @foreach($missions as $key=>$mission)

                            <tr> 
                                <td width="5%">M{{$mission->code}}</td>
                                <td><a href="">{{$mission->getStatus()}}</a></td>
                                <td>{{$mission->type}}</td>
                                <td>{{format_price(convert_price($mission->amount))}}</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <!--end::Card-->

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">{{translate('Latest Missions')}}</h3>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table mb-0 aiz-table">
                        <thead>
                            <tr>
                                <th>{{translate('Code')}}</th>
                                <th>{{translate('Status')}}</th>
                                <th>{{translate('Type')}}</th>
                                <th>{{translate('Amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $count      = (App\ShipmentSetting::getVal('latest_shipment_count') ? App\ShipmentSetting::getVal('latest_shipment_count') : 10 );
                                $missions = App\Mission::limit($count)->orderBy('id','desc')->where('captain_id',Auth::user()->userCaptain->captain_id)->get();
                            @endphp
                            @foreach($missions as $key=>$mission)

                            <tr> 
                                <td width="5%">M{{$mission->code}}</td>
                                <td><a href="">{{$mission->getStatus()}}</a></td>
                                <td>{{$mission->type}}</td>
                                <td>{{format_price(convert_price($mission->amount))}}</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
            <!--end::Card-->

        </div>
    </div>
@endif 