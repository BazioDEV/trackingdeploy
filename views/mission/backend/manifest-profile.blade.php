@extends('backend.layouts.app')
@section('style')
    <link href="{{asset('public/assets/dragula/dragula.css')}}" rel="stylesheet">
    <style>
        tr{
            cursor: move !important;
        }
    </style>
@endsection

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
                            <h1 class="display-4 font-weight-boldest mb-10">{{translate('Manifest Profile')}}</h1>
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
                                <span class="font-weight-bolder mb-2">{{translate('Captain')}}</span>
                                <span class="opacity-70">{{$captain->name}}</span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->


                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <h1 class="display-4 font-weight-boldest mb-10">{{translate('Manifest Missions')}}</h1>

                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="3%"></th>
                                        <th>{{translate('Code')}}</th>
                                        <th>{{translate('Type')}}</th>
                                        <th>{{translate('Amount')}}</th>
                                        <th>{{translate('Address')}}</th>
                                        <th>{{translate('Arrived')}}</th>


                                    </tr>
                                </thead>
                                <tbody id="profile_manifest">

                                    @foreach($missions as $key=>$mission)

                                    <tr style="background-color:tomatom">
                                        <td></td>
                                        <td width="5%">M{{$mission->code}}</td>
                                        <td>{{$mission->type}}</td>
                                        <td>{{format_price(convert_price($mission->amount))}}</td>
                                        <td>{{$mission->address}}</td>
                                        <td>
                                            <div style="width: 55%;height: 30px;border: 1px solid;border-radius: 3px;"></div>
                                        </td>

                                       
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- end: Invoice body-->
                <!-- begin: Invoice footer-->

                <!-- end: Invoice footer-->
                <!-- begin: Invoice action-->
                <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">{{translate('Download Manifest Details')}}</button>
                            <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">{{translate('Print Manifest Details')}}</button>
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

@section('script')
    <script src="{{asset('public/assets/dragula/dragula.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        dragula([document.getElementById('profile_manifest')]);
    </script>
@endsection