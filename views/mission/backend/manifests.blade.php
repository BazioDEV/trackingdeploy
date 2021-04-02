@extends('backend.layouts.app')

@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                {{translate('Manifests')}}
            </h3>
        </div>
       
    </div>

    <div class="card-body">
    <form action="{{route('admin.missions.get.manifest')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{translate('Captain')}}:</label>

                    <select name="captain_id" class="form-control">
                        @foreach(\App\Captain::all() as $captain)
                        <option value="{{$captain->id}}">{{$captain->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                 <label>{{translate('Get Manifest')}}:</label>
                  <button type="submit" class="btn btn-primary" style="display:block">{{translate('Get Manifest')}}</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection
@section('modal')
@include('modals.delete_modal')
@endsection