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
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-4x" aria-hidden="true"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down fa-4x" aria-hidden="true"></i>
                            </a>
                            <a title="Click to mark as favorite question (Click again to undo)" class="favorite mt-2 favorited">
                                <i class="fas fa-star fa-2x"></i><br/>
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                        <div class="media-body">                   
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
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This question is useful" class="vote-up">
                                    <i class="fas fa-caret-up fa-4x" aria-hidden="true"></i>
                                </a>
                                <span class="votes-count">1230</span>
                                <a title="This question is not useful" class="vote-down off">
                                    <i class="fas fa-caret-down fa-4x" aria-hidden="true"></i>
                                </a>
                                @can ('accept', $answer)
                                    <a title="Mark this answer as best answer" class="{{$answer->status}} mt-2"
                                        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                        <i class="fas fa-check fa-2x"></i><br/>
                                    </a>
                                    <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                @else
                                    @if($question->best_answer_id == $answer->id)
                                    <a title="Question owner accepted this answer as best answer" class="{{$answer->status}} mt-2">
                                        <i class="fas fa-check fa-2x"></i><br/>
                                    </a>
                                    @endif
                                @endcan
                            </div>
                            <div class="media-body"> 
                                {!! parsedown($answer->body) !!}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            @can('update', $answer)
                                                <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}" class="btn btn-sm btn-outline-info">Edit</a>
                                            @endcan
                                            @can('delete', $answer)
                                                <form class="form-delete" action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure')">Delete</button>
                                                </form>  
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-4">

                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted">Answered {{$answer->created_at->diffForHumans()}}</span>
                                        <div class="media mt-2">
                                            <a href="{{$answer->user->url}}" class="pr-2"><img src="{{$answer->user->avatar}}" alt=""></a>
                                            <div class="media-body mt-1">
                                                <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Post your Answer</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('questions.answers.store', $question->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" rows="10">{{old('body')}}</textarea>
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('body')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
</div>
@endsection
