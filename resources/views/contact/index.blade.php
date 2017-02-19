@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @include('messages.errors')
    <div style="background-color:#FFF; margin:10px 0px; padding: 10px;" class="col-md-10 col-md-push-1">
        <h3 class="text-center">Contact</h3>
        <form method="post" action="{{ route('contact.store') }}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="name" class="form-control" name="name" id="name"
                       placeholder="Nom..">
            </div>
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input type="email" class="form-control" name="email" id="email"
                       placeholder="Mail..">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3"
                          placeholder="Message.."></textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Envoyer</button>
        </form>
    </div>
@endsection