
 @php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
@if($addon->activated)   
    <div class="row">
        <div class="col-md-10">
            <label class="col-from-label">{{ translate('Branch Index') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="form-control demo-sw" value="1006" @php if(isset($permissions) && in_array(1005, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @endif
@endif