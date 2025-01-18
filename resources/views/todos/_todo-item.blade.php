<div class="todo-item mb-3">
    <p class="mb-0"
       @if($item->status == 'completed')
           style="text-decoration: line-through;"
       @elseif($item->status == 'skipped')
           style="text-decoration: line-through double;"
        @endif
    >
        {{ $item->title }}
        <span class="badge bg-info text-dark">{{ ucfirst($item->status) }}</span>
    </p>

    <!-- Mark Todo Item as Completed or Skipped -->
    @if($item->status == 'active')
        <form action="{{ route('todos.updateItemStatus', ['todo' => $todo->id, 'item' => $item->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" name="status" value="completed" class="btn btn-success btn-sm mt-2">Mark as Completed</button>
            <button type="submit" name="status" value="skipped" class="btn btn-warning btn-sm mt-2">Mark as Skipped</button>
        </form>
    @endif
</div>
