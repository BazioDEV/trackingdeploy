@extends('backend.layouts.app')
@php
    $checked_google_map = \App\BusinessSetting::where('type', 'google_map')->first();
@endphp

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
</style>
<div class="mx-auto col-lg-12">
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Shipment Info')}}</h5>
        </div>

        @if( \App\ShipmentSetting::getVal('def_shipping_cost') == null)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Configure Fees Settings , Costs in creation will be zero without configuration')}},
                <a class="alert-link" href="{{ route('admin.shipments.settings.fees') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif
        @if(count($countries = \App\Country::where('covered',1)->get()) == 0 || \App\State::where('covered', 1)->count() == 0)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Configure Your covered countries and cities')}},
                <a class="alert-link" href="{{ route('admin.shipments.covered_countries') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif
        @if(\App\Area::count() == 0)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Add areas before creating your first shipment')}},
                <a class="alert-link" href="{{ route('admin.areas.create') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif
        @if(count($packages = \App\Package::all()) == 0)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Add package types before creating your first shipment')}},
                <a class="alert-link" href="{{ route('admin.packages.create') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif
        @if($branchs->count() == 0)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Add branches before creating your first shipment')}},
                <a class="alert-link" href="{{ route('admin.branchs.index') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif

        @if($clients->count() == 0)
        <div class="row">
            <div class="alert alert-danger col-lg-8" style="margin: auto;margin-top:10px;" role="alert">
                {{translate('Please Add clients before creating your first shipment')}},
                <a class="alert-link" href="{{ route('admin.clients.index') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
        @endif

        <form class="form-horizontal" action="{{ route('admin.shipments.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group row">
                            <label class="col-2 col-form-label">{{translate('Shipment Type')}}</label>
                            <div class="col-9 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success btn btn-default">
                                        <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='1' ) checked @endif type="radio" name="Shipment[type]" checked="checked" value="1" />
                                        <span></span>
                                        {{translate("Pickup (For door to door delivery)")}}
                                    </label>
                                    <label class="radio radio-success btn btn-default">
                                        <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='2' ) checked @endif type="radio" name="Shipment[type]" value="2" />
                                        <span></span>
                                        {{translate("Drop off (For delivery package from branch directly)")}}
                                    </label>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Branch')}}:</label>
                                    <select class="form-control kt-select2 select-branch" name="Shipment[branch_id]">
                                        <option></option>
                                        @foreach($branchs as $branch)
                                        <option @if(\App\ShipmentSetting::getVal('def_branch')==$branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(\App\ShipmentSetting::getVal('is_date_required') == '1' || \App\ShipmentSetting::getVal('is_date_required') == null)
                                <div class="form-group">
                                    <label>{{translate('Shipping Date')}}:</label>
                                    <div class="input-group date">
                                        @php
                                            $defult_shipping_date = \App\ShipmentSetting::getVal('def_shipping_date');
                                            if($defult_shipping_date == null )
                                            {
                                                $shipping_data = \Carbon\Carbon::now()->addDays(0);
                                            }else{
                                                $shipping_data = \Carbon\Carbon::now()->addDays($defult_shipping_date);
                                            }

                                        @endphp
                                        <input type="text" placeholder="{{translate('Shipping Date')}}" value="{{ $shipping_data->toDateString() }}" name="Shipment[shipping_date]" autocomplete="off" class="form-control" id="kt_datepicker_3" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group client-select">
                                    <label>{{translate('Client/Sender')}}:</label>
                                    <select class="form-control kt-select2 select-client" name="Shipment[client_id]">
                                        <option></option>
                                        @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Client Address')}}:</label>
                                    <input placeholder="{{translate('Client Address')}}" name="Shipment[client_address]" class="form-control address" id="" />

                                </div>
                            </div>

                            @if($checked_google_map->value == 1 )
                                <div class="col-md-12 mb-3">
                                    <div class="location-client">
                                        <label>{{translate('Client Location')}}:</label>
                                        <input type="text" class="form-control address-client " name="Shipment[client_street_address_map]" placeholder="{{translate('Client Location')}}" name="client[street_address_map]"  rel="client" value="" />
                                        <input type="hidden" class="form-control lat" data-client="lat" name="Shipment[client_lat]" />
                                        <input type="hidden" class="form-control lng" data-client="lng" name="Shipment[client_lng]" />
                                        <input type="hidden" class="form-control url" data-client="url" name="Shipment[client_url]" />
                            
                                        <div class="mt-2 col-sm-12 map_canvas map-client" style="width:100%;height:300px;"></div>
                                        <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Receiver Name')}}:</label>
                                    <input type="text" placeholder="{{translate('Receiver Name')}}" name="Shipment[reciver_name]" class="form-control" />

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Receiver Address')}}:</label>
                                    <input type="text" placeholder="{{translate('Receiver Address')}}" name="Shipment[reciver_address]" class="form-control" />

                                </div>
                            </div>

                            @if($checked_google_map->value == 1 )
                                <div class="col-md-12">
                                    <div class="location-receiver">
                                        <label>{{translate('Receiver Location')}}:</label>
                                        <input type="text" class="form-control address-receiver " placeholder="{{translate('Receiver Location')}}" name="Shipment[reciver_street_address_map]"  rel="receiver" value="" />
                                        <input type="hidden" class="form-control lat" data-receiver="lat" name="Shipment[reciver_lat]" />
                                        <input type="hidden" class="form-control lng" data-receiver="lng" name="Shipment[reciver_lng]" />
                                        <input type="hidden" class="form-control url" data-receiver="url" name="Shipment[reciver_url]" />
                            
                                        <div class="mt-2 col-sm-12 map_canvas map-receiver" style="width:100%;height:300px;"></div>
                                        <span class="form-text text-muted">{{'Change the pin to select the right location'}}</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Country')}}:</label>
                                    <select id="change-country" name="Shipment[from_country_id]" class="form-control select-country">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Country')}}:</label>
                                    <select id="change-country-to" name="Shipment[to_country_id]" class="form-control select-country">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Region')}}:</label>
                                    <select id="change-state-from" name="Shipment[from_state_id]" class="form-control select-state">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Region')}}:</label>
                                    <select id="change-state-to" name="Shipment[to_state_id]" class="form-control select-state">
                                        <option value=""></option>

                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('From Area')}}:</label>
                                    <select name="Shipment[from_area_id]" class="form-control select-area">
                                        <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('To Area')}}:</label>
                                    <select name="Shipment[to_area_id]" class="form-control select-area">
                                        <option value=""></option>

                                    </select>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Payment Type')}}:</label>
                                    <select class="form-control kt-select2 payment-type" id="payment_type" name="Shipment[payment_type]">
                                        <option @if(\App\ShipmentSetting::getVal('def_payment_type')=='1' ) selected @endif value="1">{{translate('Postpaid')}}</option>
                                        <option @if(\App\ShipmentSetting::getVal('def_payment_type')=='2' ) selected @endif value="2">{{translate('Prepaid')}}</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{translate('Payment Method')}}:</label>
                                    <select class="form-control kt-select2 payment-method" id="payment_method_id" name="Shipment[payment_method_id]">
                                        @forelse (\App\BusinessSetting::where("key","payment_gateway")->where("value","1")->get() as $gateway)
                                            <option value="{{$gateway->id}}" @if($gateway->id == 11) selected @endif>{{$gateway->name}}</option>
                                        @empty
                                            <option value="11">{{translate('Cash')}}</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div id="kt_repeater_1">
                            <div class="row" id="kt_repeater_1">
                                <h2 class="text-left">{{translate('Package Info')}}:</h2>
                                <div data-repeater-list="Package" class="col-lg-12">
                                    <div data-repeater-item class="row align-items-center" style="margin-top: 15px;padding-bottom: 15px;padding-top: 15px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;">



                                        <div class="col-md-3">

                                            <label>{{translate('Package Type')}}:</label>
                                            <select class="form-control kt-select2 package-type-select" name="package_id">
                                                <option></option>
                                                @foreach($packages as $package)
                                                <option @if(\App\ShipmentSetting::getVal('def_package_type')==$package->id) selected @endif value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="mb-2 d-md-none"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>{{translate('description')}}:</label>
                                            <input type="text" placeholder="{{translate('description')}}" class="form-control" name="description">
                                            <div class="mb-2 d-md-none"></div>
                                        </div>
                                        <div class="col-md-3">

                                            <label>{{translate('Quantity')}}:</label>

                                            <input class="kt_touchspin_qty" placeholder="{{translate('Quantity')}}" type="number" min="1" name="qty" class="form-control" value="1" />
                                            <div class="mb-2 d-md-none"></div>

                                        </div>

                                        <div class="col-md-3">

                                            <label>{{translate('Weight')}}:</label>

                                            <input type="number" min="1" placeholder="{{translate('Weight')}}" name="weight" class="form-control weight-listener kt_touchspin_weight" onchange="calcTotalWeight()" value="1" />
                                            <div class="mb-2 d-md-none"></div>

                                        </div>


                                        <div class="col-md-12" style="margin-top: 10px;">
                                            <label>{{translate('Dimensions [Length x Width x Height] (cm):')}}:</label>
                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control" placeholder="{{translate('Length')}}" name="length" value="1" />

                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control" placeholder="{{translate('Width')}}" name="width" value="1" />

                                        </div>
                                        <div class="col-md-2">

                                            <input class="dimensions_r" type="number" min="1" class="form-control " placeholder="{{translate('Height')}}" name="height" value="1" />

                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">

                                                <div>
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                        <i class="la la-trash-o"></i>{{translate('Delete')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="">
                                    <label class="text-right col-form-label">{{translate('Add')}}</label>
                                    <div>
                                        <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                                            <i class="la la-plus"></i>{{translate('Add')}}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{translate('Amount to be Collected')}}:</label>
                                        <input id="kt_touchspin_3" placeholder="{{translate('Amount to be Collected')}}" type="text" min="0" class="form-control" value="0" name="Shipment[amount_to_be_collected]" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Delivery Time')}}:</label>
                                        <select class="form-control kt-select2 delivery-time" id="delivery_time" name="Shipment[delivery_time]">
                                            <option value="1-2 Days">{{translate('1-2 Days')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{translate('Total Weight')}}:</label>
                                        <input id="kt_touchspin_4" placeholder="{{translate('Total Weight')}}" type="text" min="1" class="form-control total-weight" value="1" name="Shipment[total_weight]" />
                                    </div>
                                </div>

                            </div>




                        </div>

                    </div>



                    {!! hookView('shipment_addon',$currentView) !!}

                    <div class="mb-0 text-right form-group">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
        </form>

    </div>
</div>

@endsection

@section('script')
<script src="{{ static_asset('assets/dashboard/js/geocomplete/jquery.geocomplete.js') }}"></script>
<script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{$checked_google_map->key}}"></script>
<script type="text/javascript">
    $('.address-receiver').each(function(){
        var address = $(this);
        address.geocomplete({
            map: ".map_canvas.map-receiver",
            mapOptions: {
                zoom: 18
            },
            markerOptions: {
                draggable: true
            },
            details: ".location-receiver",
            detailsAttribute: 'data-receiver',
            autoselect: true,
            restoreValueAfterBlur: true,
        });
        address.bind("geocode:dragged", function(event, latLng){
            $("input[data-receiver=lat]").val(latLng.lat());
            $("input[data-receiver=lng]").val(latLng.lng());
        });

    });

    $('.address-client').each(function(){
        var address = $(this);
        address.geocomplete({
            map: ".map_canvas.map-client",
            mapOptions: {
                zoom: 18
            },
            markerOptions: {
                draggable: true
            },
            details: ".location-client",
            detailsAttribute: 'data-client',
            autoselect: true,
            restoreValueAfterBlur: true,
        });
        address.bind("geocode:dragged", function(event, latLng){
            $("input[data-client=lat]").val(latLng.lat());
            $("input[data-client=lng]").val(latLng.lng());
        });

    });

    var inputs = document.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'number') {
            inputs[i].onkeydown = function(e) {
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8)) {
                    return false;
                }
            }
        }
    }

    $('.select-client').select2({
        placeholder: "Select Client",
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.clients.create')}}?redirect=admin.shipments.create"
            class="btn btn-primary" >+ {{translate('Add New Client')}}</a>
            </li>`);
    });

    $('.payment-method').select2({
        placeholder: "Payment Method",
    });

    $('.payment-type').select2({
        placeholder: "Payment Type",
    });



    $('.delivery-time').select2({
        placeholder: "Delivery Time",
    });


    $('.select-branch').select2({
        placeholder: "Select Branch",
    }).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append(`<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.branchs.create')}}?redirect=admin.shipments.create"
            class="btn btn-primary" >+ {{translate('Add New Branch')}}</a>
            </li>`);
    });


    $('#change-country').change(function() {
        var id = $(this).val();
        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Shipment[from_state_id]"]').empty();

            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('select[name ="Shipment[from_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-country-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-states-ajax')}}?country_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Shipment[to_state_id]"]').empty();

            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[to_state_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-from').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Shipment[from_area_id]"]').empty();

            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[from_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });
    $('#change-state-to').change(function() {
        var id = $(this).val();

        $.get("{{route('admin.shipments.get-areas-ajax')}}?state_id=" + id, function(data) {
            console.log(data[0]);
            $('select[name ="Shipment[to_area_id]"]').empty();

            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                $('select[name ="Shipment[to_area_id]"]').append('<option value="' + element['id'] + '">' + element['name'] + '</option>');
            }


        });
    });

    function calcTotalWeight() {
        console.log('sds');
        var elements = $('.weight-listener');
        var sumWeight = 0;
        elements.map(function() {
            sumWeight += parseInt($(this).val());
            console.log(sumWeight);
        }).get();
        $('.total-weight').val(sumWeight);
    }
    $(document).ready(function() {
        $('.select-country').select2({
            placeholder: "Select country",
            language: {
              noResults: function() {
                return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.shipments.covered_countries')}}?redirect=admin.shipments.create"
                  class="btn btn-primary" >Manage {{translate('Countries')}}</a>
                  </li>`;
              },
            },
            escapeMarkup: function(markup) {
              return markup;
            },
        });

        $('.select-state').select2({
            placeholder: "Select state",
            language: {
              noResults: function() {
                return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.shipments.covered_countries')}}?redirect=admin.shipments.create"
                  class="btn btn-primary" >Manage {{translate('States')}}</a>
                  </li>`;
              },
            },
            escapeMarkup: function(markup) {
              return markup;
            },
        });

        $('.select-area').select2({
            placeholder: "Select Area",
            language: {
              noResults: function() {
                return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.areas.create')}}?redirect=admin.shipments.create"
                  class="btn btn-primary" >Manage {{translate('Areas')}}</a>
                  </li>`;
              },
            },
            escapeMarkup: function(markup) {
              return markup;
            },
        });

        $('.select-country').trigger('change');
        $('.select-state').trigger('change');
        $('#kt_datepicker_3').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
        $( document ).ready(function() {
            $('.package-type-select').select2({
                placeholder: "Package Type",
                language: {
                noResults: function() {
                    return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.packages.create')}}?redirect=admin.shipments.create"
                    class="btn btn-primary" >Manage {{translate('Packages')}}</a>
                    </li>`;
                },
                },
                escapeMarkup: function(markup) {
                return markup;
                },
            });
        });


        //Package Types Repeater

        $('#kt_repeater_1').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();

                $('.package-type-select').select2({
                    placeholder: "Package Type",
                    language: {
                    noResults: function() {
                        return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('admin.packages.create')}}?redirect=admin.shipments.create"
                        class="btn btn-primary" >Manage {{translate('Packages')}}</a>
                        </li>`;
                    },
                    },
                    escapeMarkup: function(markup) {
                    return markup;
                    },
                });

                $('.dimensions_r').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                });

                $('.kt_touchspin_weight').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                    prefix: 'Kg'
                });
                $('.kt_touchspin_qty').TouchSpin({
                    buttondown_class: 'btn btn-secondary',
                    buttonup_class: 'btn btn-secondary',

                    min: 1,
                    max: 1000000000,
                    stepinterval: 50,
                    maxboostedstep: 10000000,
                    initval: 1,
                });

            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });


        $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '%'
        });
        $('#kt_touchspin_3').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 0,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '{{currency_symbol()}}'
        });
        $('#kt_touchspin_4').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
            prefix: 'Kg'
        });
        $('.kt_touchspin_weight').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
            prefix: 'Kg'
        });
        $('.kt_touchspin_qty').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });
        $('.dimensions_r').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            initval: 1,
        });


        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Shipment[type]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[shipping_date]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[branch_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[client_id]": {
                        validators: {
                            callback: {
                                message: '{{translate("This is required!")}}',
                                callback: function(input) {
                                    // Get the selected options
                                    if ((input.value !== "")) {
                                        $('.client-select').removeClass('has-errors');
                                    } else {
                                        $('.client-select').addClass('has-errors');
                                    }
                                    return (input.value !== "");
                                }
                            }
                        }
                    },
                    "Shipment[client_address]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[payment_type]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[payment_method_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[tax]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[insurance]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[shipping_cost]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[delivery_time]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[delivery_time]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[total_weight]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[from_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[to_country_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[reciver_name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Shipment[reciver_address]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Package[0][package_id]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    }



                },


                plugins: {
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    icon: new FormValidation.plugins.Icon({
                        valid: '',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection
