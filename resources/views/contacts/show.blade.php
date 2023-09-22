@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">show contact</div>

                <div class="card-body">
                    <p>{{$contact->name}}</p>
                    <a class="text-decoration-none"  href="tel:{{$contact->phone_number}}">
                        <p>{{$contact->phone_number}}</p>
                    </a>
                    <p>{{"contacto creado en ". $contact->created_at}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
