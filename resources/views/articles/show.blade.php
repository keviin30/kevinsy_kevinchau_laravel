@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-center">Article numéro {{$id}}</h1>
            </div>
        </div>
        <div class="row">
            <div style="background-color:#FFF; margin:10px 0px; padding: 10px;" class="col-md-10 col-md-push-1">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

                <h3>{{$show->title}}</h3>
                <p>{{$show->content}}</p>
                <small class="pull-right">publié le {{$show->created_at}} par {{$show->user->name}}</small>
                @if( $admin == 1 || Auth::user()->id == $show->user->id)
                    <form method="POST" action="{{route('articles.destroy', [$show->id])}}" class="form-horizontal">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-primary">Supprimer</button>
                    </form>
                @endif
                <a href="{{route('articles.edit', $show->id)}}">
                    <button class="btn btn-primary">Editer</button>
                </a>
            </div>
        </div>
    </div>

    <h1></h1>
@endsection