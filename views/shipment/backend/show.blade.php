<?php 
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>
@extends('backend.layouts.app')

@section('content')


<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Page Layout-->
        <div class="d-flex flex-row">
            <!--begin::Layout-->
            <div class="flex-row-fluid">
                <!--begin::Section-->
                <div class="row">
                @if(Auth::user()->user_type == 'admin' || in_array('1103', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                    <div class="col-md-7 col-lg-12 col-xxl-7">
                        <!--begin::Engage Widget 14-->
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-body p-15 pb-20">
                                <div class="row mb-17">
                                    <div class="col-xxl-5 mb-11 mb-xxl-0">
                                        <!--begin::Image-->
                                        <div class="card card-custom card-stretch">
                                            <div class="card-body p-0 rounded px-10 py-15 d-flex align-items-center justify-content-center" style="background-color: #FFCC69;">
                                                <h1>D {{$shipment->code}}</h1>

                                            </div>
                                        </div>
                                        <!--end::Image-->
                                    </div>
                                    <div class="col-xxl-7 pl-xxl-11">
                                        <h2 class="font-weight-bolder text-dark mb-7" style="font-size: 32px;">{{translate('Client/Sender')}}: {{$shipment->client->name}}</h2>
                                        <div class="font-size-h2 mb-7 text-dark-50">{{translate('To Receiver')}}
                                            <span class="text-info font-weight-boldest ml-2">{{$shipment->reciver_name}}</span>
                                        </div>
                                        @if($shipment->barcode != null)
                                        <?=$d->getBarcodeHTML($shipment->barcode, "EAN13");?>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    
                                </div>
                                <div class="row mb-6">
                                    <!--begin::Info-->
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Shipment Type')}}</span>
                                            <span class="text-dark font-weight-bolder font-size-lg">{{$shipment->type}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Previous Branch')}}</span>
    
                                            <span class="text-muted font-weight-bolder font-size-lg">@isset(\App\Branch::find($shipment->prev_branch)->name) {{\App\Branch::find($shipment->prev_branch)->name}} @endisset </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Current Branch')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->branch->name}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Code')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">D-{{$shipment->code}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Client Address')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->client_address}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Receiver Address')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->reciver_address}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Shipping Date')}}</span>
                                            <span class="text-dark font-weight-bold font-size-lg">{{$shipment->shipping_date}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Receiver Address')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->reciver_address}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Payment Type')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->getPaymentType()}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Payment Method')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->payment_method}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Total Weight')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->total_weight}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Total Cost')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->tax + $shipment->shipping_cost + $shipment->insurance)) }}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{translate('Included tax & insurance')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Shipping Cost')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->shipping_cost))}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Tax &  Duty:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->tax}}%</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Insurance:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->insurance))}}</span>
                                        </div>
                                    </div>
                                     <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Amount To Collected:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->amount_to_be_collected))}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Return Cost:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->return_cost))}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Captain:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if($shipment->captain_id != null) {{$shipment->captain->name}} @else Not Assigned @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Mission:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if($shipment->mission_id != null) M {{$shipment->current_mission->code}} @else Not Assigned @endif</span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Max Delivery Days:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->delivery_time}} </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('From Country:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_country->name)){{$shipment->from_country->name}} @endif </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('To Country:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_country->name)){{$shipment->to_country->name}} @endif </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('From Ragion:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_state->name)){{$shipment->from_state->name}} @endif </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('To Ragion:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_state->name)){{$shipment->to_state->name}} @endif </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="mb-8 d-flex flex-column">
                                            <span class="text-dark font-weight-bold mb-4">{{translate('Created At:')}}</span>
                                            <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->created_at->format('Y-m-d')}}</span>
                                        </div>
                                    </div>
                                    <!--end::Info-->
                                    
                                </div>
                                <!--begin::Buttons-->
                                <div class="d-flex">


                                </div>
                                <!--end::Buttons-->
                            </div>
                        </div>
                        <!--end::Engage Widget 14-->
                    </div>
                @endif
                    <div class="col-md-5 col-lg-12 col-xxl-5">
                        <!--begin::List Widget 19-->
                        @if(Auth::user()->user_type == 'admin' || in_array('1104', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                        <div class="card card-custom card-stretch card-stretch-half gutter-b"  >
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-6 mb-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">{{translate('Package Info')}}</span>
                                    <span class="text-muted font-weight-bold font-size-sm">{{\App\PackageShipment::where('shipment_id',$shipment->id)->count()}} {{translate('Packages')}}</span>
                                </h3>
                                <div class="card-toolbar">
                                    <a href="{{route('admin.shipments.edit', $shipment->id)}}" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6">{{translate('Edit Shipment')}}</a>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2">
                                <!--begin::Table-->
                                <div class="table-responsive">
                                    <div class='font-size-sm font-weight-bold text-right'>{{translate('length x width x height')}}</div>
                                    <table class="table table-borderless mb-0">
                                        <tbody>

                                            @foreach(\App\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)
                                            <tr>
                                                <td class="w-40px align-middle pb-6 pl-0 pr-2">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-40 symbol-light-success">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-lg svg-icon-success">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24" />
                                                                        <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                        <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                </td>
                                                <td class="font-size-lg font-weight-bolder text-dark-75 align-middle w-100px pb-6">{{$package->description}}</td>

                                                <td class="font-weight-bold text-muted text-right align-middle pb-6">{{translate('Type')}}: @if(isset($package->package->name)){{$package->package->name}} @endif</td>
                                                <td class="font-weight-bold text-muted text-right align-middle pb-6">{{translate('Weight')}}: {{$package->weight}}</td>
                                                <td class="font-weight-bolder font-size-lg text-dark-75 text-right align-middle pb-6">{{$package->length."x".$package->width."x".$package->height}} <br> </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!--end::Table-->
                            </div>
                            <!--end::Body-->
                        </div>
                        @endif
                        <!--end::List Widget 19-->
                        @if(Auth::user()->user_type == 'admin' || in_array('1102', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                        <div class="card card-custom card-stretch card-stretch-half gutter-b">
                            <!--begin::List Widget 19-->

                            <!--begin::Header-->
                            <div class="card-header border-0 pt-6 mb-2">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label font-weight-bold font-size-h4 text-dark-75 mb-3">{{translate('Shipment Status Log')}}</span>

                                </h3>
                                <div class="card-toolbar">

                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-2" style="padding-bottom: 0;overflow:hidden">
                                <div class="timeline timeline-6 mt-3 scroll scroll-pull" style="overflow:hidden" data-scroll="true" data-wheel-propagation="true">
                           
                                @foreach($shipment->logs()->orderBy('id','desc')->get() as $log)    
                                    <!--begin::Item-->
                                    <div class="timeline-item align-items-start">
                                        <!--begin::Label-->
                                        <div class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$log->created_at->diffForHumans()}}</div>
                                        <!--end::Label-->

                                        <!--begin::Badge-->
                                        <div class="timeline-badge">
                                            <i class="fa fa-genderless text-warning icon-xl"></i>
                                        </div>
                                        <!--end::Badge-->

                                        <!--begin::Text-->
                                        <div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                            {{translate('Changed from')}}: "{{\App\Shipment::getStatusByStatusId($log->from)}}" {{translate('To')}}: "{{\App\Shipment::getStatusByStatusId($log->to)}}"
                                        </div>
                                        <!--end::Text-->
                                        
                                    </div>
                                    <!--end::Item-->
                                    
                                @endforeach

                                    
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!--end::Section-->
                <!--begin::Section-->
                <!--begin::Advance Table Widget 10-->
                
                <!--end::Advance Table Widget 10-->
                <!--end::Section-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Page Layout-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


@endsection

@section('modal')
@include('modals.delete_modal')
@endsection