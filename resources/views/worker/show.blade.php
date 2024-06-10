@extends('layout.main')
@section('content')

<h1>Worker page</h1>
<hr>
<div @style(['width: 300px', 'border: 1px solid green', 'padding: 5px', 'margin: auto'])>
    <div>
        <b>
            {{$worker->name}}
            {{$worker->surname}}
        </b>
        ({{$worker->age}})
    </div>
    <div @style(['color: green'])>
        {{$worker->email}}
    </div>
    <q><i @style(['color: red'])>{{$worker->description}}</i></q>
    <div>
        <a href="{{ route('worker.index') }}">Back</a>
    </div>
    <div>
        <a href="{{ route('worker.edit', $worker->id) }}">Edit</a>
    </div>
</div>

@endsection
