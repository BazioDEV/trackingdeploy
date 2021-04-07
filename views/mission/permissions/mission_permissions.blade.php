@php

use App\Http\Helpers\MissionActionHelper;
@endphp


@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)  
        <label class="checkbox">
            <input type="checkbox" name="permissions[]" value="1008" @php if(isset($permissions) && in_array(1008, $permissions)) echo "checked"; @endphp>
            <span></span>{{ translate('Missions Index') }}
        </label>
        @foreach(\App\Mission::status_info() as $item)
            <label class="checkbox">
                <input type="checkbox" name="permissions[]" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span></span>{{$item['text']}} {{translate('Missions')}}
            </label>
        @endforeach
    
        @foreach(MissionActionHelper::permission_info() as $item)
            <label class="checkbox">
                <input type="checkbox" name="permissions[]" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span class="slider round"></span>{{$item['text']}}
            </label>
        @endforeach
    @endif
@endif