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
    <answers :question="{{ $question }}"></answers>
</div>
@endsection
