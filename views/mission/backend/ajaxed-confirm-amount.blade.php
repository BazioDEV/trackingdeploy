<form action="{{route('admin.missions.action',['to'=>\App\Mission::RECIVED_STATUS])}}" method="POST">
    @csrf
    <div class="modal-header">
        <h4 class="modal-title h6">{{translate('Confirm Mission Amount')}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{translate('Amount')}}({{currency_symbol()}}):</label>
                    <input type="hidden" class="form-control" value="{{$mission->id}}" name="checked_ids[]" />
                    @if(in_array(Auth::user()->user_type,['admin']) || in_array('1030', json_decode(Auth::user()->staff->role->permissions ?? "[]")) )
                        <input type="number" class="form-control" value="{{convert_price($mission->amount)}}" name="amount" />
                    @else
                        <input type="number" class="form-control" value="{{convert_price($mission->amount)}}" name="amount" disabled/>
                    @endif
                </div>
            </div>

        </div>
        @if(\App\ShipmentSetting::getVal('def_shipment_conf_type') == 'seg')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{translate('Customer Signature')}}:</label>

                    <div class="input-group " data-toggle="aizuploader" data-type="image">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                        </div>
                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                        <input type="hidden" name="seg_img" class="selected-files" value="{{old('seg_img')}}">
                    </div>
                    <div class="file-preview">
                    </div>
                </div>
            </div>
        </div>
        @elseif(\App\ShipmentSetting::getVal('def_shipment_conf_type') == 'otp')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{translate('OTP')}}:</label>

                    <input type="text" class="form-control" value="" name="otp" />
                </div>
            </div>

        </div>
        @endif


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{translate('Close')}}</button>
        <button type="submit" class="btn btn-primary">{{translate('Confirm amount and Receive')}}</button>
    </div>
</form>