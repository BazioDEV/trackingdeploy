<div class="form-group">
    <label>{{translate('Pickup Cost')}}({{currency_symbol()}}):</label>
    <input type="number" min="0" class="form-control" placeholder="{{translate('Here')}}" name="Client[pickup_cost]" value="{{convert_price($data['client']->pickup_cost)}}">
</div>