@extends('layout.main')
@section('content')

<h1>Edit page</h1>
<hr>
<form
    action="{{route('worker.update', $worker->id)}}"
    @style(['display: flex', 'flex-direction: column', 'width: 200px'])
    method="Post">
    @csrf
    @method('Patch')
    <label>
        Name:
        <input type="text" name="name" value="{{old('name') ?? $worker->name}}">
    </label>
    <label>
        Surname:
        <input type="text" name="surname" value="{{old('surname') ?? $worker->surname}}">
    </label>
    <label>
        Email:
        <input type="email" name="email" value="{{old('email') ?? $worker->email}}">
    </label>
    <label>
        Age:
        <input type="number" name="age" value="{{$worker->age}}">
    </label>
    <label>
        Description:
        <textarea name="description">{{$worker->description}}</textarea>
    </label>
    <label>
        Married:
        <input type="checkbox" name="is_married" {{$worker->is_married ? 'checked' : ''}}>
    </label>
    <input type="submit" value="Save">
</form>

@endsection
