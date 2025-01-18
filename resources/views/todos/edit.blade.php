@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Todo List</h2>

        <form method="POST" action="{{ route('todos.update', $todo->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $todo->title) }}" required maxlength="25">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update Todo List</button>
        </form>
    </div>
@endsection
