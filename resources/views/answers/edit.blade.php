@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h3>Editing answer for question: <b>{{$question->title}}</b></h3><hr>
                        <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" rows="10">{{old('body', $answer->body)}}</textarea>
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
            </div>
        </div>
    </div>
</div>
@endsection