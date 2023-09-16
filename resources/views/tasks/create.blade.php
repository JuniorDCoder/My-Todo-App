<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
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
                                    <a class="nav-link" href="{{ route('dashboard') }}">
                                        <i class="fa-solid fa-gauge me-2 ms-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item dropdown mt-2">
                                    <a class="nav-link" href="{{ route('categories.create') }}">
                                        <i class="fa-solid fa-tape me-2 ms-2"></i>
                                        Categories
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item active mt-2">
                                    <a class="nav-link active" href="{{route('tasks.all')}}">
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

                                <br><div class="p-1 flex items-center justify-center text-center text-3xl text-blue-300">
                                    0 Overdue
                                </div>
                            @else
                                No Tasks Yet
                            @endif
                    </div>
                </div>
            </div>

            <!-- New task form section -->
                <div class="mx-auto px-4 sm:px-6 lg:px-8 mt-8">
                    <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg">
                        <div class="p-6">
                            @if(session('success'))
                                <div class="alert alert-success mt-2 mb-2 me-2 ms-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h2 class="text-xl font-semibold mb-4">Create New Task</h2>
                            <form action="{{route('tasks.store')}}" method="POST">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-2 mb-2 me-2 ms-2">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Title field -->
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                    <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full">
                                </div>

                                <!-- Description field -->
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                    <textarea name="description" id="description" class="form-textarea rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full"></textarea>
                                </div>

                                <!-- Priority field -->
                                <div class="mb-4">
                                    <label for="priority" class="block text-gray-700 text-sm font-bold mb-2">Priority</label>
                                    <select name="priority" id="priority" class="form-select rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full">
                                        <option value="low">Low</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <!-- Categories dropdown field -->
                                <div class="mb-4">
                                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                                    <select name="category_id" id="category" class="form-select rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Due Date field -->
                                <div class="mb-4">
                                    <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
                                    <input type="date" name="due_date" id="due_date" class="form-input rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full">
                                </div>

                                <!-- Submit button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Create Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- End of new task form section -->
        </div>
    </div>
</x-app-layout>
