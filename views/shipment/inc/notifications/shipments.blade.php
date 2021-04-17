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