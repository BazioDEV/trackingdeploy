@extends('backend.layouts.app')

@section('content')
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('From')}}: ( {{$from->name}} ) | {{translate('To')}}: ( {{$to->name}})</h5>
        </div>
        <form class="form-horizontal" action="{{ route('admin.shipments.post.config.costs') }}?from_country={{$from->id}}&to_country={{$to->id}}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            <div class="card-body">

                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        @php
                        $default_country_cost = \App\Cost::where('from_country_id',$from->id)->where('to_country_id',$to->id)->where('from_state_id',0)->where('to_state_id',0)->first();
                        @endphp

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{translate('From Country')}}:</label>
                                <input disabled readonly class="form-control disabled" value="{{$from->name}}">
                                <input type="hidden" name="from_country_h[]" value="{{$from->id}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{translate('To Country')}}:</label>
                                <input disabled readonly class="form-control disabled" value="{{$to->name}}">
                                <input type="hidden" name="to_country_h[]" value="{{$to->id}}">
                            </div>

                            <div class="form-group col-md-3">
                                <label>{{translate(' Shipping Cost')}} ({{currency_symbol()}}):</label>
                                <input type="number" onchange="changeShippingCosts(this)" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="@php if(isset($default_country_cost->shipping_cost)){echo convert_price($default_country_cost->shipping_cost);}else{ echo 0;} @endphp" name="shipping_cost[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Tax')}} %:</label>
                                <input type="number" onchange="changeTax(this)" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="@php if(isset($default_country_cost->tax)){echo $default_country_cost->tax;}else{ echo 0;} @endphp" name="tax[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Insurance')}} ({{currency_symbol()}}):</label>
                                <input type="number" onchange="changeInsurance(this)" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="@php if(isset($default_country_cost->insurance)){echo convert_price($default_country_cost->insurance);}else{ echo 0;} @endphp" name="insurance[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Returned Shipment Cost')}} ({{currency_symbol()}}):</label>
                                <input type="number" onchange="changeReturnCosts(this)" min="0" id="name" class="form-control" placeholder="{{translate('Here')}}" value="@php if(isset($default_country_cost->return_cost)){echo convert_price($default_country_cost->return_cost);}else{ echo 0;} @endphp" name="return_cost[]">
                            </div>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-secondary spinner spinner-dark spinner-right evenAjaxRemove">
                            {{translate('Loading Costs...')}}
                        </button>
                        <div id="placeholder_cost"></div>

                    </div>

                </div>


            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="evenAjaxButton btn btn-lg btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.evenAjaxButton').hide();
    function cost_block(from_name,to_name,from_id,to_id,from_city_name,to_city_name,from_city_id,to_city_id,shipping_cost,tax,return_cost,insurance) {
        return `<div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>{{translate('From Country')}}:</label>
                                <input disabled readonly class="form-control disabled" value="`+from_name+`">
                                <input type="hidden" name="from_country_h[]" value="`+from_id+`">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{translate('To Country')}}:</label>
                                <input disabled readonly class="form-control disabled" value="`+to_name+`">
                                <input type="hidden" name="to_country_h[]" value="`+to_id+`">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{translate('From City')}}:</label>
                                <input disabled readonly class="form-control disabled" value="`+from_city_name+`">
                                <input type="hidden" name="from_state[]" value="`+from_city_id+`">
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{translate('To City')}}:</label>
                                <input disabled readonly class="form-control disabled" value="`+to_city_name+`">
                                <input type="hidden" name="to_state[]" value="`+to_city_id+`">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Shipping Cost')}} ({{currency_symbol()}}):</label>
                                <input type="number" min="0" id="name" class="form-control shipp_cost" placeholder="{{translate('Here')}}" value="`+shipping_cost+`" name="shipping_cost[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Tax')}} %:</label>
                                <input type="number" min="0" id="name" class="form-control tax_cost" placeholder="{{translate('Here')}}" value="`+tax+`" name="tax[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Insurance')}} ({{currency_symbol()}}):</label>
                                <input type="number" min="0" id="name" class="form-control insurance_cost" placeholder="{{translate('Here')}}" value="`+insurance+`" name="insurance[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label>{{translate(' Returned Shipment Cost')}} ({{currency_symbol()}}):</label>
                                <input type="number" min="0" id="name" class="form-control return_cost" placeholder="{{translate('Here')}}" value="`+return_cost+`" name="return_cost[]">
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                `;
    }
    $.ajax( "{{route('admin.shipments.config.costs.ajax')}}?from_country={{$from->id}}&to_country={{$to->id}}" )
    .done(function(data) {
        $.each(data, function(k, v) {
            $('#placeholder_cost').append(cost_block(v.from_country,v.to_country,v.from_country_id,v.to_country_id,v.from_state,v.to_state,v.from_state_id,v.to_state_id,v.shipping_cost,v.tax,v.return_cost,v.insurance));
        });
        $('.evenAjaxRemove').remove();
        $('.evenAjaxButton').show();
    })
    .fail(function() {
        alert( "error" );
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
    function changeShippingCosts(element)
    {
        $('.shipp_cost').val($(element).val());
    }
    function changeTax(element)
    {
        $('.tax_cost').val($(element).val());
    }
    function changeInsurance(element)
    {
        $('.insurance_cost').val($(element).val());
    }
    function changeReturnCosts(element)
    {
        $('.return_cost').val($(element).val());
    }
    
</script>
@endsection