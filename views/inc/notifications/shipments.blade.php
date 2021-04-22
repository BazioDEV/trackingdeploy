@php
    $addon = \App\Addon::where('unique_identifier', 'spot-cargo-shipment-addon')->first();
    $user_type = Auth::user()->user_type;
@endphp
@if ($addon != null)
    @if($addon->activated)
        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('New Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','new_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'new_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="new_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'new_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="new_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'new_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="new_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'new_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'new_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a new shipment created?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Aprroved Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','aprroved_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'aprroved_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="aprroved_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'aprroved_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'aprroved_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="aprroved_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'aprroved_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'aprroved_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="aprroved_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'aprroved_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'aprroved_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is approved?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Reject Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','reject_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'reject_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="reject_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'reject_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'reject_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="reject_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'reject_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'reject_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="reject_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'reject_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'reject_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is rejected?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Assigned Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','assigned_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'assigned_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="assigned_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'assigned_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'assigned_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="assigned_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'assigned_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'assigned_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="assigned_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'assigned_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'assigned_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'assigned_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is assigned to a captain?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Captain Received Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','received_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'received_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="received_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'received_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'received_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="received_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'received_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'received_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="received_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'received_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'received_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'received_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is r to received by assigned captain?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Delivered Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','deliverd_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'deliverd_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="deliverd_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'deliverd_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'deliverd_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="deliverd_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'deliverd_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'deliverd_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="deliverd_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'deliverd_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'deliverd_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'deliverd_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is delivered to receiver?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Supplied Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','supplied_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'supplied_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="supplied_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'supplied_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'supplied_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="supplied_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'supplied_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'supplied_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="supplied_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'supplied_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'supplied_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'supplied_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment COD has been supplied to the sender?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Request Returned Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','returned_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a customer request to return shipment?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Returned to stock Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','returned_to_stock_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_stock_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_stock_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_stock_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_stock_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_stock_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_stock_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_stock_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_stock_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_stock_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_stock_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_stock_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is assigned to company stock?')}}</span>
            </div>
        @endif

        @if( in_array($user_type,['admin','stuff']) || in_array('1009', json_decode(Auth::user()->staff->role->permissions ?? "[]")))
            <div class="form-group">
                <label class="font-weight-bolder">{{translate('Returned to sender Shipments')}}</label>
                @php
                    $notify = json_decode(\App\BusinessSetting::where('type', 'notifications')->where('key','returned_to_sender_shipment')->first()->value, true);
                @endphp
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_sender_shipment', 'administrators')" <?php if(isset($notify['administrators'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('System administrators')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_sender_shipment_administrators" <?php if(!isset($notify['administrators'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_sender_shipment', 'administrators', false)" >
                        @foreach(\App\User::where('user_type', 'admin')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['administrators']) && in_array($user->id, $notify['administrators'])) echo "selected";?>>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_sender_shipment', 'roles')" <?php if(isset($notify['roles'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees roles')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_sender_shipment_roles" <?php if(!isset($notify['roles'])) echo "disabled";?> data-live-search="true" multiple="multiple" data-actions-box="true" data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_sender_shipment', 'roles', false)">
                        @foreach(\App\Role::get() as $role)
                            <option value="{{$role->id}}" <?php if(isset($notify['roles']) && in_array($role->id, $notify['roles'])) echo "selected";?>>{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_sender_shipment', 'employees')" <?php if(isset($notify['employees'])) echo "checked";?> /><span></span>
                            </label>
                        </span>
                        <span class="input-group-text font-weight-bolder">{{translate('Employees')}}</span>
                    </div>
                    <select class="form-control selectpicker" id="returned_to_sender_shipment_employees" <?php if(!isset($notify['employees'])) echo "disabled";?> data-live-search="true" multiple="multiple"  data-actions-box="true"  data-header="{{translate('Select an option')}}" onchange="updateSettings(this, 'returned_to_sender_shipment', 'employees', false)">
                        @foreach(\App\User::where('user_type', 'staff')->get() as $user)
                            <option value="{{$user->id}}" <?php if(isset($notify['employees']) && in_array($user->id, $notify['employees'])) echo "selected";?> >{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_sender_shipment', 'sender', false)" <?php if(isset($notify['sender'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Sender')}}</span>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <label class="checkbox checkbox-inline checkbox-success">
                                <input type="checkbox" onchange="updateSettings(this, 'returned_to_sender_shipment', 'captain', false)" <?php if(isset($notify['captain'])) echo "checked";?> value="true"/><span></span>
                            </label>
                        </span>
                    </div>
                    <span class="input-group-text font-weight-bolder form-control">{{translate('Assigned Captain')}}</span>
                </div>
                <span class="form-text text-muted">{{translate('Which one will receive a notification when a shipment is returned to the sender?')}}</span>
            </div>
        @endif
    @endif
@endif