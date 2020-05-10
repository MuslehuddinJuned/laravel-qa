@extends('layouts.app')

@section('content')
<div class="container">
    <question :question="{{ $question }}"></question>
    <answers :question="{{ $question }}"></answers>
</div>
@endsection
