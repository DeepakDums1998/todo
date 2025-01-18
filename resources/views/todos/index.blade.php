@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Display success message for creating Todo -->
                @if (session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <!-- Display Todos -->
                @foreach($todos as $todo)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light">
                            <h5 class="m-0"
                                @if($todo->status == 'completed')
                                    style="text-decoration: line-through;"
                                @elseif($todo->status == 'skipped')
                                    style="text-decoration: line-through double;"
                                @endif
                            >
                                {{ $todo->title }}
                            </h5>
                            <span class="badge {{ $todo->priority == 'high' ? 'bg-danger' : ($todo->priority == 'normal' ? 'bg-warning' : 'bg-success') }} rounded-pill">
                                {{ ucfirst($todo->priority) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <p>Status:
                                @if($todo->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($todo->status == 'skipped')
                                    <span class="badge bg-warning">Skipped</span>
                                @else
                                    <span class="badge bg-secondary">Active</span>
                                @endif
                            </p>

                            <!-- Display Todo Items -->
                            @foreach($todo->todoItems as $item)
                                @include('todos._todo-item', ['item' => $item, 'todo' => $todo])
                            @endforeach

                            <!-- Mark the entire Todo as completed or skipped -->
                            @if($todo->status == 'active')
                                <form action="{{ route('todos.updateStatus', $todo->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="completed" class="btn btn-success w-100 mt-3">Mark Todo as Completed</button>
                                    <button type="submit" name="status" value="skipped" class="btn btn-warning w-100 mt-2">Mark Todo as Skipped</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
