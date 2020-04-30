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
                {{-- {!!  !!} --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
