<?php
use \Milon\Barcode\DNS1D;
$d = new DNS1D();
?>
@extends('backend.layouts.app')


@section('sub_title'){{translate('Shipment')}} {{$shipment->code}}@endsection
@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{translate('Shipment')}} {{$shipment->code}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{$shipment->code}}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')


<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-body p-0">
        <!-- begin: Invoice-->
        <!-- begin: Invoice header-->
        <div class="row justify-content-center py-8 px-8 pt-md-27 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                    @php
                        $code = filter_var($shipment->code, FILTER_SANITIZE_NUMBER_INT);
                    @endphp
                    <h1 class="display-4 font-weight-boldest mb-10">{{translate('Shipment')}}: {{$shipment->code}}</h1>
                    <div class="d-flex flex-column align-items-md-end px-0">
                        <span class="d-flex flex-column align-items-md-end opacity-70">
                            @if($shipment->barcode != null)
                                <span class="font-weight-bolder mb-5"><?=$d->getBarcodeHTML($code, "EAN13");?></span>
                            @endif
                            <span><span class="font-weight-bolder">{{translate('FROM')}}:</span> {{$shipment->client_address}}</span>
                            <span><span class="font-weight-bolder">{{translate('TO')}}:</span> {{$shipment->reciver_address}}</span>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between pb-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Client/Sender')}}</span>
                        <a class="text-danger font-weight-boldest font-size-lg" href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->client->name}}</a>
                        <span class="text-muted font-size-md">{{$shipment->client_address}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Receiver')}}</span>
                        <span class="text-danger font-weight-boldest font-size-lg">{{$shipment->reciver_name}}</span>
                        <span class="text-muted font-size-md">{{$shipment->reciver_address}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Status')}}</span>
                        <span class="opacity-70 d-block">{{$shipment->getStatus()}}</span>
                    </div>
                    @if ($shipment->amount_to_be_collected && $shipment->amount_to_be_collected  > 0)
                        <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('Amount To Collected')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->amount_to_be_collected))}}</span>
                        </div>
                    @endif
                </div>
                <div class="border-bottom w-100"></div>
                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{translate('Shipment type')}}</span>
                        <span class="opacity-70">{{$shipment->type}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{translate('Current branch')}}</span>
                        <a class="opacity-70" href="{{route('admin.branchs.show',$shipment->branch_id)}}">{{$shipment->branch->name}}</a>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{translate('Created date')}}</span>
                        <span class="opacity-70">{{$shipment->created_at->format('Y-m-d h:i:s')}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">{{translate('Shipping date')}}</span>
                        <span class="opacity-70">{{$shipment->shipping_date}}</span>
                    </div>
                </div>


                <div class="d-flex justify-content-between pt-6">
                    @if ($shipment->prev_branch)
                        <div class="d-flex flex-column flex-root">
                            <span class="font-weight-bolder mb-2">{{translate('Previous Branch')}}</span>
                            <span class="opacity-70">{{\App\Branch::find($shipment->prev_branch)->name}}</span>
                        </div>
                    @endif
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Total Weight')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->total_weight}} {{translate('KG')}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Shipping Cost')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->shipping_cost))}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Tax &  Duty')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->tax))}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Insurance')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->insurance))}}</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Return Cost')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{format_price(convert_price($shipment->return_cost))}}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('From Country')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_country->name)){{$shipment->from_country->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('To Country')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_country->name)){{$shipment->to_country->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('From Ragion')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->from_state->name)){{$shipment->from_state->name}} @endif </span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('To Ragion')}}</span>
                            <span class="text-muted font-weight-bolder font-size-lg">@if(isset($shipment->to_state->name)){{$shipment->to_state->name}} @endif </span>
                    </div>
                </div>


                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Max Delivery Days')}}</span>
                        <span class="text-muted font-weight-bolder font-size-lg">{{$shipment->delivery_time}}</span>
                    </div>
                    @if($shipment->captain_id != null)
                        <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('Captain')}}</span>
                            <a class="text-danger font-weight-boldest font-size-lg" href="{{route('admin.clients.show',$shipment->client_id)}}">{{$shipment->captain->name}} </a>
                        </div>
                    @endif
                    @if ($shipment->mission_id != null)
                        <div class="d-flex flex-column flex-root">
                            <span class="text-dark font-weight-bold mb-4">{{translate('Mission')}}</span>
                            <a class="text-muted font-weight-bolder font-size-lg" href="{{route('admin.missions.show',$shipment->mission_id)}}">{{$shipment->current_mission->code}}</a>
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="text-dark font-weight-bold mb-4">{{translate('Attachments')}} <span class="text-muted font-size-xs">({{translate('ADDED WHEN SHIPMENT CREATED')}})</span></span>
                        <div class="d-flex justify-content-between pt-6">
                            @foreach(explode(',', $shipment->attachments_before_shipping) as $img)
                                <div class="d-flex flex-column flex-root">
                                    <span class="text-muted font-weight-bolder font-size-lg">
                                        <a href="{{uploaded_asset($img)}}" target="_blank"><img src="{{uploaded_asset($img)}}" alt="image" style="max-width:100px" /></a>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- end: Invoice header-->
        <!-- begin: Invoice body-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="pl-0 font-weight-bold text-muted text-uppercase">{{translate('Package Items')}}</th>
                                <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Qty')}}</th>
                                <th class="text-right font-weight-bold text-muted text-uppercase">{{translate('Type')}}</th>
                                <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">{{translate('Weight x Length x Width x Height')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach(\App\PackageShipment::where('shipment_id',$shipment->id)->get() as $package)

                                <tr class="font-weight-boldest">
                                    <td class="border-0 pl-0 pt-7 d-flex align-items-center">{{$package->description}}</td>
                                    <td class="text-right pt-7 align-middle">{{$package->qty}}</td>
                                    <td class="text-right pt-7 align-middle">@if(isset($package->package->name)){{$package->package->name}} @else - @endif</td>
                                    <td class="text-primary pr-0 pt-7 text-right align-middle">{{$package->weight." ".translate('KG')." x ".$package->length." ".translate('CM')." x ".$package->width." ".translate('CM')." x ".$package->height." ".translate('CM')}}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: Invoice body-->
        <!-- begin: Invoice footer-->
        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 mx-0">
            <div class="col-md-10">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT TYPE')}}</th>
                                <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT STATUS')}}</th>
                                <th class="font-weight-bold text-muted text-uppercase">{{translate('PAYMENT DATE')}}</th>
                                <th class="font-weight-bold text-muted text-uppercase text-right">{{translate('TOTAL COST')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="font-weight-bolder">
                                <td>{{translate($shipment->pay['name'])}} ({{$shipment->getPaymentType()}})</td>
                                <td>@if($shipment->paid == 1) {{translate('Paid')}} @else {{translate('Pending')}} @endif</td>
                                <td>@if($shipment->paid == 1) {{$shipment->payment->payment_date ?? ""}} @else - @endif</td>
                                <td class="text-primary font-size-h3 font-weight-boldest text-right">{{format_price(convert_price((($shipment->tax * $shipment->shipping_cost) / 100) + $shipment->shipping_cost + $shipment->insurance)) }}<br /><span class="text-muted font-weight-bolder font-size-lg">{{translate('Included tax & insurance')}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: Invoice footer-->
        <!-- begin: Invoice action-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    @if($shipment->paid == 0 && $shipment->pay['id'] != 11)
                        <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST" id="checkout-form">
                            @csrf
                            <input type="hidden" name="shipment_id" value="{{$shipment->id}}">
                            <button type="submit" class="btn btn-success btn-md mr-3">{{translate('Pay Now')}} <i class="far fa-credit-card ml-2"></i></button>
                        </form>
                        <button class="btn btn-success btn-sm " onclick="copyToClipboard('#payment-link')">{{translate('Copy Payment Link')}}<i class="fas fa-copy ml-2"></i></button>
                        <div id="payment-link" style="display: none">{{route('admin.shipments.pay', $shipment->id)}}</div>
                    @endif

                    <a href="{{route('admin.shipments.print', array($shipment->id, 'label'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{translate('Print Label')}}<i class="la la-box-open ml-2"></i></a>
                    <a href="{{route('admin.shipments.print', array($shipment->id, 'invoice'))}}" class="btn btn-light-primary font-weight-bold" target="_blank">{{translate('Print Invoice')}}<i class="la la-file-invoice-dollar ml-2"></i></a>

                    @if(Auth::user()->user_type == 'admin' || in_array('1104', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                    <a href="{{route('admin.shipments.edit', $shipment->id)}}" class="btn btn-light-info btn-sm font-weight-bolder font-size-sm py-3 px-6">{{translate('Edit Shipment')}}</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- end: Invoice action-->
        <!-- end: Invoice-->
    </div>
</div>
<!--end::Card-->


<!--end::List Widget 19-->
@if((Auth::user()->user_type == 'admin' || in_array('1102', json_decode(Auth::user()->staff->role->permissions ?? "[]"))) && !empty($shipment->logs->toArray()))
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

@endsection

@section('modal')
@include('modals.delete_modal')
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            AIZ.plugins.notify('success', '{{translate("Payment Link Copied")}}');
        }
    </script>
@endsection