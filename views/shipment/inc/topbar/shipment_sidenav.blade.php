@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
    @if($addon->activated)
        @if(Auth::user()->user_type == 'admin' || in_array('1001', json_decode(Auth::user()->staff->role->permissions)))
            <li class="menu-item menu-item-rel ">
                <a href="{{ route('admin.shipments.create') }}" class="btn btn-success btn-sm mr-3">
                    + {{translate('Add Shipment')}}<i class="ml-2 flaticon2-box-1"></i>
                </a>
            </li>
        @endif
    @endif
@endif
