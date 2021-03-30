@extends('backend.layouts.app')

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
</style>
<div class="col-lg-12 mx-auto">
    <div class="card mb-10">

        <div class="card-body">
            <div class="alert alert-info">
                - Calculation equation = Default Costs or Custom Covered Area Cost + Extra fees for Kg + Extra Fees for Package Types
                <br />
            
            </div>
        </div>
    </div>
    <form class="form-horizontal" action="{{ route('admin.shipments.settings.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Default Costs')}}</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">


                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>{{translate('Default Shipping Cost')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_shipping_cost')}}" name="Setting[def_shipping_cost]">
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{translate('Default Tax')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_tax')}}" name="Setting[def_tax]">
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{translate('Default Insurance')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_insurance')}}" name="Setting[def_insurance]">
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{translate('Default Returned Shipment Cost')}}:</label>
                                <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_return_cost')}}" name="Setting[def_return_cost]">
                            </div>
                        </div>
                        <hr>


                    </div>

                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Extra Costs For Kg')}}</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label>{{translate('Fixed Shipping Cost/Kg')}}:</label>
                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_shipping_cost_gram')}}" name="Setting[def_shipping_cost_gram]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Fixed Tax/Kg')}}:</label>
                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_tax_gram')}}" name="Setting[def_tax_gram]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Fixed Insurance/Kg')}}:</label>
                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_insurance_gram')}}" name="Setting[def_insurance_gram]">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Fixed Returned Shipment Cost/Kg')}}:</label>
                        <input type="number" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="{{\App\ShipmentSetting::getVal('def_return_cost_gram')}}" name="Setting[def_return_cost_gram]">
                    </div>

                </div>




            </div>
        </div>
        <div class="form-group mb-0 text-right">
            <button type="submit" class="btn btn-lg btn-success">{{translate('Save')}}</button>
        </div>
    </form>
    <form class="form-horizontal" action="{{ route('admin.shipments.config.costs') }}" id="kt_form_1" method="GET" enctype="multipart/form-data">
        <div class="card mt-5">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Custom Costs for Covered Areas')}}</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label>{{translate('From Country')}}:</label>
                        <select name="from_country" class="form-control select-country">
                            <option value=""></option>

                            @foreach(\App\Country::where('covered',1)->get() as $covered)
                            <option value="{{$covered->id}}">{{$covered->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('To Country')}}:</label>
                        <select name="to_country" class="form-control select-country">
                            <option value=""></option>
                            @foreach(\App\Country::where('covered',1)->get() as $covered)
                            <option value="{{$covered->id}}">{{$covered->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{translate('Configure Costs')}}:</label>
                        <button class="btn btn-primary form-control">{{translate('Configure Selected Countries Costs')}}</button>
                    </div>


                </div>




            </div>
        </div>
    </form>
    <form class="form-horizontal" action="{{ route('admin.shipments.post.config.package.costs') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mt-5">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Extra Fees for Package Types')}}</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>

                                <th>{{translate('Name')}}</th>

                                <th>{{translate('Extra Cost')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages = \App\Package::all() as $key => $package)

                            <tr>
                                <td>{{$package->name}}</td>


                                <td>

                                    <input type="number" min="0" name="package_extra[]" class="form-control" id="" value="{{$package->cost}}" />
                                    <input type="hidden" name="package_id[]" value="{{$package->id}}">

                                </td>
                            </tr>

                            @endforeach
                            <tr>
                                <td></td>
                                <td> <button class="btn btn-primary form-control">{{translate('Save Package Types Extra Fees')}}</button></td>
                            </tr>
                        </tbody>
                    </table>





                </div>
            </div>
    </form>



</div>
</div>
@endsection

@section('script')
<script>
    $('.select-country').select2({
        placeholder: "Select country"
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
</script>
@endsection