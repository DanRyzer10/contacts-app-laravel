@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($contacts as $contact)
        <div class="d-flex justify-content-between mb-3 bg-dark px-4 py-2 rounded">
            <div>
               <a href="{{route("contacts.show",$contact->id)}}">
                 <img class="profile_picture" src="{{Storage::url($contact->profile_picture)}}" alt="user" width="40px"/>
               </a>
            </div>

            <div class="d-flex align-items-center">
                <p class="me-2 mb-0">
                    {{$contact->name}}
                </p>
            </div>
        </div>
        @empty
        <div class="col-md-4 mx-auto">
            <div class="card card-body text-center">
              <p>No contacts saved yet</p>
              <a href="{{route("contacts.create")}}">Add One!</a>
            </div>
        </div>
            
    @endforelse
    {{$contacts->links()}}
</div>
@endsection
