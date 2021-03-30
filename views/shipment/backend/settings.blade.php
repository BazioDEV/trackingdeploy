@extends('backend.layouts.app')

@section('content')
<style>
    label {
        font-weight: bold !important;
    }
</style>
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Shipping General Settings')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.shipments.settings.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group row mt-3">

                    <div class="col-lg-3">
                        <div class="form-group row">
                            <label class=" col-form-label">{{translate('Enable Shipping date')}}</label>
                            <div class="col-12 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-success">

                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required')=='1' || \App\ShipmentSetting::getVal('is_date_required')==null) checked @endif value="1" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('Yes')}}
                                    </label>
                                    <label class="radio radio-danger">
                                        <input name="Setting[is_date_required]" @if(\App\ShipmentSetting::getVal('is_date_required')=='0' ) checked @endif value="0" type="radio" class="form-control" />
                                        <span></span>
                                        {{translate('No')}}
                                    </label>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label class="col-form-label text-lg-right">{{translate('Defult Shipping date')}}:</label>
                        <input type="text" value="{{\App\ShipmentSetting::getVal('def_shipping_date')}}" name="Setting[def_shipping_date]" class="form-control datepicker" placeholder="Defult Shipping date" />

                    </div>

                </div>

                <div class="separator separator-dashed my-10"></div>

                <div class="form-group row">

                    <label class="col-2 col-form-label">{{translate('Default Shipment Type')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio radio-success  btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='1' ) checked @endif type="radio" name="Setting[def_shipment_type]" checked="checked" value="1" />
                                <span></span>
                                {{translate("Pickup (For door to door delivery)")}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_type')=='2' ) checked @endif type="radio" name="Setting[def_shipment_type]" value="2" />
                                <span></span>
                                {{translate("Drop off (For delivery package from branch directly)")}}
                            </label>
                        </div>

                    </div>

                </div>

                <div class="separator separator-dashed my-10"></div>

                <div class="form-group row">

                    <label class="col-2 col-form-label">{{translate('Receiving Mission Confirmation Type')}}</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio radio-success  btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='seg' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="seg" />
                                <span></span>
                            {{translate('Customer Signature')}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='otp' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="otp" />
                                <span></span>
                                {{translate('OTP')}}
                            </label>
                            <label class="radio radio-success btn btn-default">
                                <input @if(\App\ShipmentSetting::getVal('def_shipment_conf_type')=='none' ) checked @endif type="radio" name="Setting[def_shipment_conf_type]" value="none" />
                                <span></span>
                                {{translate('Without Confirmation')}}
                            </label>
                        </div>

                    </div>

                </div>


                <div class="separator separator-dashed my-10"></div>

                <div class="form-group row">

                    <div class="col-lg-3">
                        <label class="col-form-label text-lg-right">{{translate('Default Package Type')}}:</label>
                        <select  class="form-control kt-select2" id="select-how" name="Setting[def_package_type]">
                            <option>{{translate('Choose Package Type')}}</option>
                            @foreach(\App\Package::all() as $package)
                            <option @if(\App\ShipmentSetting::getVal('def_package_type')== $package->id) selected @endif  value="{{$package->id}}">{{$package->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label class="col-form-label text-lg-right">{{translate('Default Branch')}}:</label>
                        <select class="form-control kt-select2" id="select-how" name="Setting[def_branch]">
                            <option>{{translate('Choose Branch')}}</option>
                            @foreach(\App\Branch::where('is_archived',0)->get() as $branch)
                            <option @if(\App\ShipmentSetting::getVal('def_branch')== $branch->id) selected @endif value="{{$branch->id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                      
                            <label class="col-form-label text-lg-right">{{translate('Default Payment Type')}}:</label>
                            <select class="form-control kt-select2" id="select-how" name="Setting[def_payment_type]">


                                <option @if(\App\ShipmentSetting::getVal('def_payment_type')== '1') selected @endif value="1">{{translate('Postpaid')}}</option>
                                <option @if(\App\ShipmentSetting::getVal('def_payment_type')== '2') selected @endif  value="2">{{translate('Prepaid')}}</option>


                            </select>

                     
                    </div>
                    <div class="col-md-3">
                      
                            <label class="col-form-label text-lg-right">{{translate('Default Payment Method')}}:</label>
                            <select class="form-control kt-select2" id="select-how" name="Setting[def_payment_method]">
                                <option @if(\App\ShipmentSetting::getVal('def_payment_method')== '1') selected @endif  value="1">{{translate('Cash')}}</option>
                                <option @if(\App\ShipmentSetting::getVal('def_payment_method')== '2') selected @endif value="2">{{translate('Paypal')}}</option>
                            </select>
                    
                    </div>
                </div>
                {!! hookView('shipment_addon',$currentView) !!}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-lg btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>


        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            orientation: "bottom auto",
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: true,
            todayHighlight: true,
            startDate: new Date(),
        });
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {


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
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection