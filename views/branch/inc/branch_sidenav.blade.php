<!-- Client -->
@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
@endphp
@if ($addon != null)
@if($addon->activated)
    @if(Auth::user()->user_type == 'admin' || in_array('1001', json_decode(Auth::user()->staff->role->permissions)))
        <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.branchs.index','admin.branchs.update','admin.branchs.create'])}}" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-map-marked-alt"></i>
                <span class="menu-text">{{translate('Branches')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{translate('Branches')}}</span>
                        </span>
                    </li>
                  
                    @if(Auth::user()->user_type == 'admin' || in_array('1005', json_decode(Auth::user()->staff->role->permissions)))
                        <li class="menu-item {{ areActiveRoutes(['admin.branchs.index','admin.branchs.update'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.branchs.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('All Branches')}}</span>
                                
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.branchs.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.branchs.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Add Branch')}}</span>
                                
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @endif
@endif
