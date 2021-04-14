@php
    $user_type = Auth::user()->user_type;
@endphp

@if($user_type == 'admin' || in_array('1100', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || in_array('1008', json_decode(Auth::user()->staff->role->permissions)) || in_array('1009', json_decode(Auth::user()->staff->role->permissions)) )
    @php
        $all_shipments       = App\Shipment::count();
        $pending_shipments   = App\Shipment::where('status_id', App\Shipment::PENDING_STATUS)->count();
        $delivered_shipments = App\Shipment::where('status_id', App\Shipment::DELIVERED_STATUS)->count();

        $all_missions        = App\Mission::count();
        $pending_missions    = App\Mission::whereIn('status_id',[ App\Mission::REQUESTED_STATUS, App\Mission::APPROVED_STATUS, App\Mission::RECIVED_STATUS])->count();
        $pickup_missions     = App\Mission::where('type', App\Mission::PICKUP_TYPE )->count();
        $delivery_missions   = App\Mission::where('type', App\Mission::DELIVERY_TYPE )->count();
        $transfer_missions   = App\Mission::where('type', App\Mission::TRANSFER_TYPE )->count();
    @endphp

    
    @if($user_type == 'admin' || in_array('1100', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || in_array('1009', json_decode(Auth::user()->staff->role->permissions)))
        <div class="row">
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$all_shipments}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Total Shipments')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$pending_shipments}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Pending Shipments')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$delivered_shipments}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Delivered Shipments')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
    @endif
    
    @if($user_type == 'admin' || in_array('1100', json_decode(Auth::user()->staff->role->permissions ?? "[]")) || in_array('1008', json_decode(Auth::user()->staff->role->permissions)))
        <div class="row">
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$all_missions}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Total Missions')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$pending_missions}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Pending Missions')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$pickup_missions}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Pickup Missions')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$delivery_missions}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Delivery Missions')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-4">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$transfer_missions}}</span>
                        <span class="text-white font-weight-bold font-size-sm">{{translate('Transfer Missions')}}</span>
                    </div>

                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
        </div>
    @endif

@elseif($user_type == 'customer')
    @php
        $all_client_shipments          = App\Shipment::where('client_id', Auth::user()->userClient->client_id)->count();
        $saved_client_shipments        = App\Shipment::where('client_id', Auth::user()->userClient->client_id)->where('status_id', App\Shipment::SAVED_STATUS)->count();
        $in_progress_client_shipments  = App\Shipment::where('client_id', Auth::user()->userClient->client_id)->where('client_status', App\Shipment::CLIENT_STATUS_IN_PROCESSING)->count();
        $delivered_client_shipments    = App\Shipment::where('client_id', Auth::user()->userClient->client_id)->where('client_status', App\Shipment::CLIENT_STATUS_DELIVERED)->count();

        $transactions = App\Transaction::where('client_id', Auth::user()->userClient->client_id)->orderBy('created_at','desc')->sum('value');
    @endphp

    <div class="row">
        <div class="col-xl-6">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$transactions}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('My Wallet')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-6">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$all_client_shipments}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('Total Shipments')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$saved_client_shipments}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('Saved Shipments')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$delivered_client_shipments}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('Delivered Shipments')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$in_progress_client_shipments}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('In Progress Shipments')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>
@elseif($user_type == 'captain')
    @php
        $transactions = App\Transaction::where('captain_id', Auth::user()->userCaptain->captain_id)->orderBy('created_at','desc')->sum('value');
    @endphp

    <div class="row">
        <div class="col-xl-4">
            <!--begin::Stats Widget 30-->
            <div class="card card-custom bg-info card-stretch gutter-b">
                <!--begin::Body-->
                <div class="card-body">
                    <span class="mt-6 mb-0 text-white card-title font-weight-bolder font-size-h2 d-block">{{$transactions}}</span>
                    <span class="text-white font-weight-bold font-size-sm">{{translate('My wallet')}}</span>
                </div>

                <!--end::Body-->
            </div>
            <!--end::Stats Widget 30-->
        </div>
    </div>
@endif
