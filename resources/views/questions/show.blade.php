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
                            <vote :model="{{$question}}" name="question"></vote> 
                            <favorite :question="{{ $question }}"></favorite>
                        </div>
                        <div class="media-body">                   
                            {!! parsedown($question->body) !!}
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <user-info :model="{{ $question }}" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-4" v-cloak>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$question->answers_count . " " . str_plural('Answer', $question->answers_count)}}</h2>
                </div>
                @foreach ($question->answers as $answer)
                    <div class="card-body">
                        @include('answers._answer')
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
