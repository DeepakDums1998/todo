@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Todo Creation Card -->
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Create a New Todo</h3>
                    </div>
                    <div class="card-body">
                        <!-- Display success message -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Todo creation form -->
                        <form action="{{ route('todos.store') }}" method="POST">
                            @csrf

                            <!-- Todo Title Input -->
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold">Todo Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" maxlength="255" placeholder="Enter your Todo title here..." required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Priority Selection -->
                            <div class="mb-4">
                                <label for="priority" class="form-label fw-bold">Priority</label>
                                <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                    <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                                    <option value="normal" {{ old('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                </select>
                                @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Todo Item Inputs -->
                            <div id="todo-items-container">
                                <div class="todo-item mb-3">
                                    <label for="item_title" class="form-label fw-bold">Todo Item Title</label>
                                    <input type="text" class="form-control @error('item_titles.*') is-invalid @enderror" name="item_titles[]" value="{{ old('item_titles.0') }}" maxlength="25" placeholder="Enter a task..." required>
                                    @error('item_titles.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Button to add more Todo items -->
                            <button type="button" id="add-item" class="btn btn-outline-secondary w-100 mb-4">
                                <i class="fas fa-plus"></i> Add Todo Item
                            </button>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Create Todo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to dynamically add more Todo Items -->
    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            // Create a new div for the new todo item input
            const newItem = document.createElement('div');
            newItem.classList.add('todo-item', 'mb-3');
            newItem.innerHTML = `
                <label for="item_title" class="form-label fw-bold">Todo Item Title</label>
                <input type="text" class="form-control" name="item_titles[]" maxlength="25" placeholder="Enter a task..." required>
            `;

            // Append the new item input to the container
            document.getElementById('todo-items-container').appendChild(newItem);
        });
    </script>
@endsection
