<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite('resources/js/app.js')
  @vite('resources/css/app.css')

  <title>TODO LIST LARAVEL</title>
</head>
<body class="bg-indigo-300 ">
    <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-16 relative">
        <div class="px-4 py-2">
            <h1 class="text-gray-800 font-bold text-2xl uppercase">To-Do List</h1>
        </div>
        <form class="w-full max-w-sm mx-auto " action="{{ url('/') }}" method="POST">
            @csrf
            <div class="flex items-center border-b-2 border-violet-700 ">
                <input
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                    type="text" placeholder="Add a task" name="task">
                <button
                    class="shadow-sm bg-purple-500 hover:bg-purple-400 w-10 h-10 rounded- text-white   my-2"
                    type="submit">
                    +
                </button>
            </div>
        </form>

        <ul class="list-of-task divide-y divide-gray-200 px-4">
            @foreach ($tasks as $task)
            <?php $isChecked = $task->is_done; ?>

            <li class="py-4">
                <div class="flex items-center justify-between  w-auto px-4">
                    <input class="todoCheck"  data-id ="{{ $task->id }}" name="todo1" type="checkbox"  <?php echo $isChecked ? 'checked' : ''; ?>
                        class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                    <label for="todo1" class="ml-3 flex text-gray-900  w-full justify-between align-middle items-center">
                        <span class="text-lg font-medium ">{{ $task->task }}</span>
                        <span class="text-sm font-light bg-gray-400 text-white text-center w-5 h-5 rounded-full">
                            <form action="{{ route('task.destroy', $task->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                            <button type="submit">X</button>
                            </form>
                        </span>
                    </label>
                </div>
            </li>
            @endforeach
        </ul>
    </div>


</body>
</html>