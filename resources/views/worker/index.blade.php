@extends('layout.main')
@section('content')

<h1>Index page</h1>
<hr>
<div>
    <a href="{{route('worker.create')}}">Create</a>
</div>
<hr>
<div>
    <form action="{{route('worker.index')}}">
        <input type="text" name="name" placeholder="name" value="{{ request()->get('name') }}">
        <input type="text" name="surname" placeholder="surname" value="{{ request()->get('surname') }}">
        <input type="text" name="email" placeholder="email" value="{{ request()->get('email') }}">
        <input type="number" name="from" placeholder="from" value="{{ request()->get('from') }}">
        <input type="number" name="to" placeholder="to" value="{{ request()->get('to') }}">
        <input type="text" name="description" placeholder="description" value="{{ request()->get('description') }}">
        <label>
            Is married:
            <input type="checkbox" name="is_married" {{request()->get('is_married') ? 'checked' : ''}}>
        </label>
        <input type="submit" value="go">
        <a href="{{route('worker.index')}}">Clear filter</a>
    </form>
</div>
<hr>
<ul>
    @foreach($workers as $worker)
        <li @style(['width: 300px'])>
            <div>
                <b>
                    {{$worker->name}}
                    {{$worker->surname}}
                </b>
                ({{$worker->age}}) <span @style(['color: red'])>{{$worker->is_married ? 'Married' : ''}}</span>
            </div>
            <div @style(['color: green'])>
                {{$worker->email}}
            </div>
            <q><i @style(['color: red'])>{{$worker->description}}</i></q>
            <div>
                <a href="{{ route('worker.show', $worker->id) }}">Check</a>
            </div>
            <div>
                <a href="{{ route('worker.edit', $worker->id) }}">Edit</a>
            </div>
            <form action="{{ route('worker.delete', $worker->id) }}" method="Post">
                @csrf
                @method('Delete')
                <input type="submit" value="delete">
            </form>
            <hr>
        </li>
    @endforeach
    <div class="nav">
        {{$workers->withQueryString()->links()}}
    </div>
</ul>

@endsection
