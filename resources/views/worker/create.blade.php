@extends('layout.main')
@section('content')

<h1>Create page</h1>
<hr>
<form
    action="{{route('worker.store')}}"
    @style(['display: flex', 'flex-direction: column', 'width: 200px'])
    method="Post">
    @csrf
    <label>
        Name:
        <input type="text" name="name" value="{{@old('name') ?? $worker['name']}}">
        @error('name')
        <span @style(['color: red'])>
                {{ $message }}
            </span>
        @enderror
    </label>
    <label>
        Surname:
        <input type="text" name="surname" value="{{@old('surname') ?? $worker['surname']}}">
        @error('surname')
        <span @style(['color: red'])>
                {{ $message }}
            </span>
        @enderror
    </label>
    <label>
        Email:
        <input type="email" name="email" value="{{@old('email') ?? $worker['email']}}">
        @error('email')
        <span @style(['color: red'])>
                {{ $message }}
            </span>
        @enderror
    </label>
    <label>
        Age:
        <input type="number" name="age" value="{{@old('age') ?? $worker['age']}}">
    </label>
    <label>
        Description:
        <textarea name="description">{{@old('description') ?? $worker['description']}}</textarea>
    </label>
    <label>
        Married:
        <input type="checkbox" name="is_married">
    </label>
    <input type="submit" value="create">
</form>

@endsection
