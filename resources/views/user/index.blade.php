@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profil de {{Auth::user()->name}}</div>

                    <div class="panel-body">
                        @if(Auth::check())
                            <h2>Profil</h2>
                            <ul>
                                <li>Nom: {{Auth::user()->name}}</li>
                                <li>E-mail: {{Auth::user()->email}}</li>
                                <li>Date d'inscription: {{Auth::user()->created_at}}</li>
                            </ul>
                            <h2>Liste d'articles</h2>
                            <ul>
                                @foreach($articles as $article)
                                    <div style="background-color:#FFF; margin:10px 0px; padding: 10px;" class="col-md-10">

                                        <h3>{{$article->title}}</h3>
                                        <p>{{$article->content}}</p>
                                        <small class="pull-right">publié le {{$article->created_at}} par {{$article->user->name}}</small>
                                    </div>
                                @endforeach
                            </ul>
                        @else
                            Pas de profil trouvé
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
