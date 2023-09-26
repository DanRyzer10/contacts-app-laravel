@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mx-auto">
            <div class="card card-body text-center">
              <p>your free trial has ended</p>
              <p> upgrade te  pro version <a href="{{route("checkout")}}">here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection


