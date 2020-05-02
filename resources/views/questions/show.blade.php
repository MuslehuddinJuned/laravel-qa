@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{$question->title}}</h1>                    
                        <div class="ml-auto">
                            <a href="/questions" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">                    
                    {!! parsedown($question->body) !!}
                    <div class="float-right">
                        <span class="text-muted">Answered {{$question->created_at->diffForHumans()}}</span>
                        <div class="media mt-2">
                            <a href="{{$question->user->url}}" class="pr-2"><img src="{{$question->user->avatar}}" alt=""></a>
                            <div class="media-body mt-1">
                                <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$question->answers_count . " " . str_plural('Answer', $question->answers_count)}}</h2>
                </div>
                @foreach ($question->answers as $answer)
                    <div class="card-body">
                        {!! parsedown($answer->body) !!}
                        <div class="float-right">
                            <span class="text-muted">Answered {{$answer->created_at->diffForHumans()}}</span>
                            <div class="media mt-2">
                                <a href="{{$answer->user->url}}" class="pr-2"><img src="{{$answer->user->avatar}}" alt=""></a>
                                <div class="media-body mt-1">
                                    <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
