@extends('backEnd.layoutes.mastar')
@section('title','confirm password')
@section('content')
    @include('backEnd.layoutes.navbar')

    <div class="back-ground" style="padding-top:120px; padding-bottom:120px;">
        <div class="container row no-gutters bg-message card ml-auto mr-auto mb-5" style="flex-direction: row; margin-top:120px">
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            <div class="col-6 mt-5 pt-5 pb-5 mb-5 ml-auto mr-auto">
                <form action="{{route('post_labs_confirm_password',$labs->id)}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="labs_id" value="{{$labs->id}}">
                    <div class="form-group">
                        <label class="h6 font-weight-bold">New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="h6 font-weight-bold">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update password" class="col-12 mt-5 btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('backEnd.layoutes.footer')

@stop



