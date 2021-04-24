@php
use App\Http\Helpers\ShipmentActionHelper;
@endphp
@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated) 
        <label class="checkbox">
            <input type="checkbox" name="permissions[]" value="1009" @php if(isset($permissions) && in_array(1009, $permissions)) echo "checked"; @endphp>
            <span></span>{{ translate('Shipment Index') }}
        </label>
        @foreach(\App\Shipment::status_info() as $item)
            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span></span>{{$item['text']}} {{translate('Shipments')}}
            </label>
        @endforeach

        @foreach(ShipmentActionHelper::permission_info() as $item)
            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="{{$item['permissions']}}" @php if(isset($permissions) && in_array($item['permissions'], $permissions)) echo "checked"; @endphp>
                <span></span>{{$item['text']}}
            </label>
        @endforeach

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1100" @php if(isset($permissions) && in_array(1100, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Shipments Counter Widget') }}
            </label>

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1101" @php if(isset($permissions) && in_array(1101, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Latest Shipments Widget') }}
            </label>

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1102" @php if(isset($permissions) && in_array(1102, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Shipment Log') }}
            </label>

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1103" @php if(isset($permissions) && in_array(1103, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Shipment Info') }}
            </label>

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1104" @php if(isset($permissions) && in_array(1104, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Shipment Packages') }}
            </label>

            <label class="checkbox">
                <input type="checkbox" name="permissions[]" class="" value="1105" @php if(isset($permissions) && in_array(1105, $permissions)) echo "checked"; @endphp>
                <span></span>{{ translate('Shipment Settings') }}
            </label>
    @endif
@endif