@if(Auth::user()->user_type == 'admin' || in_array('1100', json_decode(Auth::user()->staff->role->permissions ?? "[]")))


@php
    $shipments  = App\Shipment::orderBy('id','desc');
    $all        = $shipments->count();
    $pending    = $shipments->where('id', 2)->count();
@endphp

<div class="row">
    <div class="col-xl-3">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$all}}</span>
                <span class="font-weight-bold text-white font-size-sm">{{translate('Total Shipments')}}</span>
            </div>
            
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
    <div class="col-xl-3">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block">{{$pending}}</span>
                <span class="font-weight-bold text-white font-size-sm">{{translate('Pending Shipments')}}</span>
            </div>
            
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 30-->
    </div>
</div>
@endif