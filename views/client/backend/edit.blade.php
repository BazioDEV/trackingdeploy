@extends('backend.layouts.app')

@section('content')

<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Client Information')}}</h5>
        </div>

        <form class="form-horizontal" action="{{ route('admin.clients.update',['client'=>$client->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            <div class="card-body">
                <div class="form-group">
                    <label>{{translate('Commercial Name')}}:</label>
                    <input type="text" id="name" class="form-control" value="{{$client->name}}" placeholder="{{translate('Here')}}" name="Client[name]">
                </div>
                <div class="form-group">
                    <label>{{translate('Email')}}:</label>
                    <input id="email-field" type="text" class="form-control" value="{{$client->email}}" placeholder="{{translate('Here')}}" name="Client[email]">
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{translate('Profile Picture')}}:</label>

                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="img" class="selected-files" value="{{$client->img}}">
                            </div>
                            <div class="file-preview">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الفرع المسؤول:</label>
                        <select class="form-control kt-select2" id="select-responsible-branch" name="Client[responsible_branch_id]">
                            <option></option>
                           
                           
                        </select>
                    </div>
                </div>
            </div> -->



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Password')}}:</label>
                            <input type="password" class="form-control" id="password" placeholder="{{translate('Here')}}" name="User[password]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Confirm Password')}}:</label>
                            <input type="password" class="form-control" placeholder="{{translate('Here')}}" name="User[confirm_password]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Name')}}:</label>
                            <input type="text" class="form-control" id="owner_name" value="{{$client->responsible_name}}" placeholder="{{translate('Here')}}" name="Client[responsible_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Owner Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->responsible_mobile}}" name="Client[responsible_mobile]">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Name')}} :</label>
                            <input type="text" class="form-control" id="followup_name" placeholder="{{translate('Here')}}" value="{{$client->follow_up_name}}" name="Client[follow_up_name]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{translate('Followup Phone')}}:</label>
                            <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->follow_up_mobile}}" name="Client[follow_up_mobile]">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>{{translate('National ID')}}:</label>
                    <input type="text" class="form-control" placeholder="{{translate('Here')}}" value="{{$client->national_id}}" name="Client[national_id]">
                </div>

                <div class="form-group">
                    <label>{{translate('Client Source')}}:</label>
                    <select class="form-control kt-select2" id="select-how" name="Client[how_know_us]">
                        <option></option>
                        <option  <?php if(isset($client->how_know_us) && $client->how_know_us == "Facebook"){echo "selected";} ?>  value="Facebook">{{translate('Facebook')}}</option>
                        <option  <?php if(isset($client->how_know_us) && $client->how_know_us == "Website"){echo "selected";} ?> value="Website">{{translate('ًWebsite')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Friend"){echo "selected";} ?>  value="Friend">{{translate('Friend')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Sales Team"){echo "selected";} ?>  value="Sales Team">{{translate('Sales Team')}}</option>
                        <option <?php if(isset($client->how_know_us) && $client->how_know_us == "Google"){echo "selected";} ?>  value="Google">{{translate('Google')}}</option>

                    </select>
                </div>
                {{hookView('spot-cargo-shipment-client-addon',$currentView,['client'=>$client])}}

                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        FormValidation.formValidation(
            document.getElementById('kt_form_1'), {
                fields: {
                    "Client[name]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "Client[email]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            }
                        }
                    },
                    "User[confirm_password]": {
                        validators: {
                            notEmpty: {
                                message: '{{translate("This is required!")}}'
                            },
                            identical: {
                                compare: function() {
                                    return  document.getElementById('kt_form_1').querySelector('[name="User[password]"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }

                },
                

                plugins: {
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    // Validate fields when clicking the Submit button
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // Submit the form when all fields are valid
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh',
                    }),
                }
            }
        );
    });
</script>
@endsection