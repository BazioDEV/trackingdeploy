@extends('backend.layouts.app')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!-- begin::Card-->
        <div class="card card-custom overflow-hidden">
            <div class="card-body p-0">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                            <h1 class="display-4 font-weight-boldest mb-10">{{translate('Mission Details')}}</h1>
                            <div class="d-flex flex-column align-items-md-end px-0">
                                <!--begin::Logo-->
                                <a href="#" class="mb-5">
                                    <img src="assets/media/logos/logo-dark.png" alt="" />
                                </a>
                                <!--end::Logo-->
                                <span class="d-flex flex-column align-items-md-end opacity-70">
                                   
                                </span>
                            </div>
                        </div>
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex justify-content-between pt-6">
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">{{translate('Mission Created Date')}}</span>
                                <span class="opacity-70">{{$mission->created_at}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">{{translate('Mission Code')}}</span>
                                <span class="opacity-70">M {{$mission->code}}</span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">{{translate('Mission Address.')}}</span>
                                <span class="opacity-70">{{$mission->address}}
                                    <br /></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2">{{translate('Mission Type.')}}</span>
                                <span class="font-weight-bolder opacity-70" >{{$mission->type}}
                                    <br /></span>
                            </div>
                            <div class="d-flex flex-column flex-root">
                                <span class="font-weight-bolder mb-2 {{\App\Mission::getStatusColor($mission->status_id)}}">{{translate('Mission Status.')}}</span>
                                <span class="font-weight-bolder {{\App\Mission::getStatusColor($mission->status_id)}}" >{{$mission->getStatus()}}
                                    <br /></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->
                {!! hookView('spot-cargo-shipment-mission-addon',$currentView,['mission'=>$mission]) !!}
                
               
                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->
                <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                       
                                        @if($mission->type == \App\Mission::getType(\App\Mission::PICKUP_TYPE))
                                        <th class="font-weight-bold text-muted text-uppercase">{{translate('Client/Sender Pickup Cost')}}</th>
                                        @endif
                                        
                                        <th class="font-weight-bold text-muted text-uppercase">{{translate('TOTAL AMOUNT')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="font-weight-bolder">
                                        
                                        @if($mission->type == \App\Mission::getType(\App\Mission::PICKUP_TYPE))
                                            <td>{{format_price(convert_price($mission->client->pickup_cost))}}</td>
                                        @endif
                                       
                                       
                                        <td class="text-danger font-size-h3 font-weight-boldest">{{format_price(convert_price($mission->amount))}}</td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">{{translate('Download Mission Details')}}</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{translate('Print Mission Details')}}</button>
                        </div>
                    </div>
                </div>
                <!-- end: Invoice action-->
                <!-- end: Invoice-->
            </div>
        </div>
        <!-- end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection
@section('modal')
    @include('modals.delete_modal')
@endsection
