<!-- Captain -->

@php 
$addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
$user_type = Auth::user()->user_type;
@endphp
@if ($addon != null)
@if($addon->activated)
    @if(in_array($user_type,['admin','branch']) || in_array('1007', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
        <li class="menu-item menu-item-submenu  {{ areActiveRoutes(['admin.captains.index','admin.captains.update','admin.captains.create'])}}" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-people-carry"></i>
                <span class="menu-text">{{translate('Captains')}}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{translate('Captains')}}</span>
                        </span>
                    </li>
                  
                    @if(in_array($user_type,['admin','branch']) || in_array('1007', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
                        <li class="menu-item {{ areActiveRoutes(['admin.captains.index','admin.captains.update','admin.captains.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.captains.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('All Captains')}}</span>
                                
                            </a>
                        </li>
                        <li class="menu-item {{ areActiveRoutes(['admin.captains.create'])}}" aria-haspopup="true">
                            <a href="{{ route('admin.captains.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{translate('Add Captain')}}</span>
                                
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
    @endif
@endif
