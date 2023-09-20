<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Tasks') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-200">
        <div class="py-12">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <!-- Sidebar navigation -->
                        <nav class="navbar navbar-expand-lg navbar-light bg-blue-300">
                            <ul class="navbar-nav flex-column w-100">
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{route('dashboard')}}">
                                        <i class="fa-solid fa-gauge me-2 ms-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item dropdown mt-2">
                                    <a class="nav-link" href="{{route('categories.create')}}">
                                        <i class="fa-solid fa-tape me-2 ms-2"></i>
                                        Categories
                                    </a>
                                    {{-- <ul class="dropdown-menu bg-blue-300" aria-labelledby="categoriesDropdown">
                                        <li><a class="dropdown-item" href="#">Category 1</a></li>
                                        <li><a class="dropdown-item" href="#">Category 2</a></li>
                                        <li><a class="dropdown-item" href="#">Category 3</a></li>
                                        <!-- Add more dummy categories as needed -->
                                    </ul> --}}
                                </li>
                                <hr>
                                <li class="nav-item mt-2">
                                    <a class="nav-link active" href="#">
                                        <i class="fa-solid fa-list-check me-2 ms-2"></i>
                                        All Tasks
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="#">
                                        <i class="fa-solid fa-tape me-2 ms-2"></i>
                                        Overdue Tasks
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="#">
                                        <i class="fa-solid fa-square-check me-2 ms-2"></i>
                                        Completed Tasks
                                    </a>
                                </li>
                                <!-- Add more navigation items as needed -->
                            </ul>
                        </nav>
                    </div>
                    <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg">
                        <div class="p-6 flex items-center justify-center text-center text-3xl text-blue-300">
                            {{ now()->format('F j, Y') }}
                        </div>
                        @if ($tasks->count() > 0)

                                @if ($tasks->count() > 1)
                                    <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                                        {{count($tasks)}} Tasks
                                    </div>
                                @else
                                    <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                                        {{count($tasks)}} Task
                                    </div>
                                @endif
                                @php
                                    $overdueCount = $tasks->filter(function ($task) {
                                        return \Carbon\Carbon::parse($task->due_date)->isPast();
                                    })->count();
                                @endphp

                                <br><div class="p-1 flex items-center justify-center text-center text-3xl text-blue-300">

                                    @if ($overdueCount == 0)
                                        No Overdue Task

                                    @elseif ($overdueCount == 1)
                                        {{ $overdueCount }} Overdue Task

                                    @else
                                        {{ $overdueCount }} Overdue Tasks
                                    @endif
                                </div>
                            @else
                            <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                                No Tasks Available
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- New section !-->
        <div class="bg-gray-200 mt-1">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">
                        All Your Tasks
                    </h2>
                    @if(session('success'))
                                <div class="alert alert-success mt-2 mb-2 me-2 ms-2">
                                    {{ session('success') }}
                                </div>
                    @endif
                    <!-- Placeholder for displaying created tasks -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <!-- Task cards -->
                        @if ($tasks->count() > 0)
                            @foreach ($tasks as $task)
                                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                                    <div class="p-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-2 @if($task->is_completed) line-through @endif">
                                            {{$task->title}}
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400">
                                            {{$task->description}}
                                        </p>
                                    </div>
                                    <div class="p-2 ms-3">
                                        <p class="text-blue-600 dark:text-gray-400">
                                            {{$task->category->name}}
                                        </p>
                                        <div class="text-sm text-gray-500 font-medium mt-1">
                                            Priority: {{ucfirst($task->priority)}}
                                        </div>
                                        <div class="text-sm text-gray-500 font-medium mt-1">
                                            Due On: {{ date("l, F d, Y", strtotime($task->due_date)) }}
                                        </div>
                                    </div>
                                    <div class="px-4 py-2 bg-white">
                                        <form action="{{ route('tasks.updateStatus', ['task' => $task]) }}" method="POST" class="flex items-center">
                                            @csrf
                                            @method('PATCH')
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500" onchange="this.form.submit()"
                                                    @if ($task->is_completed) checked @endif>
                                                <span class="ml-2">
                                                    @if ($task->is_completed)
                                                        <span class="line-through">Mark as Incomplete</span>
                                                    @else
                                                        Mark as Complete
                                                    @endif
                                                </span>
                                            </label>
                                            <a href="" class="ml-2 me-3 px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">Edit</a>
                                            <button type="button" class="ml-auto px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md" onclick="showConfirmationPopup()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Display a message when no tasks are available -->
                            <div class="text-gray-500 text-center py-4">
                                No tasks created.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirmation Popup -->
        @if (isset($task))
            <div id="confirmationPopup" class="hidden fixed inset-0 flex items-center justify-center">
                <div class="bg-gray-300 rounded-lg p-8 max-w-md">
                    <p>This Action will delete this task (Can be retrieved from the trashed items)</p>
                    <p class="mt-1">Are you sure you want to delete this task?</p>
                    <div class="flex justify-end">
                        <button type="button" class="mr-2 px-3 py-2 bg-gray-500 hover:bg-gray-400 text-gray-800 rounded-md" onclick="hideConfirmationPopup()">Cancel</button>
                        <form action="{{route('task.destroy', ['task' => $task])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- End of new section !-->
    </div>


</x-app-layout>
