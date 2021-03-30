@php
use App\Http\Helpers\ShipmentActionHelper;
@endphp
@php 
$addon = \App\Addon::where('unique_identifier', 'shipment_addon')->first();
@endphp
@if ($addon != null)
@if($addon->activated) 

    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Shipment Index') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1009" @php if(isset($permissions) && in_array(1008, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @foreach(\App\Shipment::status_info() as $item)
    <div class="row">
        
        <div class="col-md-5">
            <label class="col-from-label">{{$item['text']}} {{translate('Shipments')}}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @endforeach

    @foreach(ShipmentActionHelper::permission_info() as $item)
    <div class="row">
        
        <div class="col-md-5">
            <label class="col-from-label">{{$item['text']}}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @endforeach


    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Shipments Counter Widget') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1100" @php if(isset($permissions) && in_array(1100, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Latest Shipments Widget') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1101" @php if(isset($permissions) && in_array(1101, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Shipment Log') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1102" @php if(isset($permissions) && in_array(1101, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Shipment Info') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1103" @php if(isset($permissions) && in_array(1101, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Shipment Packages') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1104" @php if(isset($permissions) && in_array(1101, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
@endif
@endif