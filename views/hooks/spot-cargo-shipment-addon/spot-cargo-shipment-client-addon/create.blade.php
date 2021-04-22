<div class="form-group">
    <label>{{translate('Pickup Cost')}}({{currency_symbol()}}):</label>
    <input type="number" min="0" value="{{convert_price(\App\ShipmentSetting::getVal('def_pickup_cost'))}}" class="form-control" placeholder="{{translate('Here')}}" name="Client[pickup_cost]" value="0">
</div>