@php

use App\Http\Helpers\MissionActionHelper;
@endphp


@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
@if($addon->activated)  
    <div class="row">
         
        <div class="col-md-5">
            <label class="col-from-label">{{ translate('Missions Index') }}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="1008" @php if(isset($permissions) && in_array(1009, $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
        
    </div>
    @foreach(\App\Mission::status_info() as $item)
    <div class="row">
        
        <div class="col-md-5">
            <label class="col-from-label">{{$item['text']}} {{translate('Missions')}}</label>
        </div>
        <div class="col-md-2">
            <label class="aiz-switch aiz-switch-success mb-0">
                <input type="checkbox" name="permissions[]" class="" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    @endforeach
    
    @foreach(MissionActionHelper::permission_info() as $item)
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
@endif
@endif