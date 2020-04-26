@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1> Questions</h1></div>

                <div class="card-body">
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="media-body">
                                <h3 class="mt-0">{{ $question->title}}</h3>
                                {{ \Illuminate\Support\Str::limit($question->body, 250, '  (more . . . )') }}
                            </div>                           
                        </div>
                        <hr> 
                    @endforeach

                    {{$questions->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
