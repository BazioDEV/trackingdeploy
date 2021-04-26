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
        <div class="overflow-hidden card card-custom">
            <div class="p-0 card-body">
                <!-- begin: Invoice-->
                <!-- begin: Invoice header-->
                <div class="px-8 py-8 row justify-content-center py-md-27 px-md-0">
                    <div class="col-md-9">
                        <div class="pb-10 d-flex justify-content-between pb-md-20 flex-column flex-md-row">
                            <h1 class="mb-10 display-4 font-weight-boldest">{{translate('Manifest Profile')}}</h1>
                            <div class="px-0 d-flex flex-column align-items-md-end">
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
                        <div class="pt-6 d-flex justify-content-between">
                            <div class="d-flex flex-column flex-root">
                                <span class="mb-2 font-weight-bolder">{{translate('Captain')}}</span>
                                <span class="opacity-70">{{$captain->name}}</span>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end: Invoice header-->
                <!-- begin: Invoice body-->


                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
                    <h1 class="mb-10 display-4 font-weight-boldest">{{translate('Manifest Missions')}}</h1>

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

                                    <tr data-missionid="{{$mission->id}}" class="mission" style="background-color:tomatom">
                                        <td></td>
                                        <td width="5%">{{$mission->code}}</td>
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
                <div class="px-8 py-8 row justify-content-center py-md-10 px-md-0">
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
        dragula([document.getElementById('profile_manifest')]).on('drop', function (el, container, source) {
            if(container){
                var missions = container.getElementsByClassName('mission');
                var missions_order = [];
                for (let index = 0; index < missions.length; index++) {
                    missions_order.push(missions[index].dataset.missionid);
                }
                $.ajax({
                    url:'{{ route("admin.missions.manifests.order") }}',
                    type:'POST',
                    data:  { _token: AIZ.data.csrf, missions_ids:missions_order},
                    dataTy:'json',
                    success:function(response){
                    },
                    error: function(returnval) {
                        // console.log(returnval);
                    }
                });
            }
        });
    </script>
@endsection