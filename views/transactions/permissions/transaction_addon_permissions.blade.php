@php 
    $addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)   
        <label class="checkbox">
            <input type="checkbox" name="permissions[]" value="1106" @php if(isset($permissions) && in_array(1106, $permissions)) echo "checked"; @endphp>
            <span></span>{{ translate('Transactions') }}
        </label>
    @endif
@endif