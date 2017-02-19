@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="text-align:center;">Editer un article</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('messages.errors')
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="{{route('articles.update', [$edit->id])}}" class="form-horizontal">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{$edit->title}}">
                    </div>
                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea class="form-control" id="content" name="content" rows="3">{{$edit->content}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Editer</button>
                </form>
            </div>
        </div>
    </div>

@endsection