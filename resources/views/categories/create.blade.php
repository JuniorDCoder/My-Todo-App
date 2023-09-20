<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
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
                                    <a class="nav-link active" href="{{route('categories.create')}}" >
                                        <i class="fa-solid fa-tape me-2 ms-2"></i>
                                        Categories
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="{{route('tasks.all')}}">
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
                        <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                            @if (count($categories) == 0)
                                No Category
                            @elseif (count($categories) == 1)
                                {{count($categories)}} Category
                            @else
                                {{count($categories)}} Categories
                            @endif
                        </div>
                        {{-- <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                            2 Overdue
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- New section for creating a new category -->
        <div class="py-6">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    @if(session('success'))
                        <div class="alert alert-success mt-2 mb-2 me-2 ms-2">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-white mb-4">
                            Create New Category
                        </h3>
                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="categoryName" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
                                <input type="text" name="name" id="categoryName" class="border border-gray-300 rounded-md p-2" value="{{old('name')}}">

                                @error('name')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>

                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of new section for creating a new category -->

        <!-- New section for displaying user's categories -->
        <div class="py-6">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-medium text-gray-800 dark:text-white mb-4">
                                Your Categories
                            </h3>
                            <ul class="divide-y divide-gray-200">
                                @foreach ($categories as $category)
                                    <li class="py-4 flex items-center justify-between">
                                        <span class="text-lg text-gray-800">{{$category->name}}</span>
                                        <div>
                                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded mr-2">Edit</button>
                                            <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="showConfirmationPopup()">Delete</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Confirmation Popup -->
        @if (isset($category))
        <div id="confirmationPopup" class="hidden fixed inset-0 flex items-center justify-center">
            <div class="bg-gray-300 rounded-lg p-8 max-w-md">
                <p>This Action will delete the category and all the tasks that belong to this category</p>
                <p class="mt-1">Are you sure you want to delete this category?</p>
                <div class="flex justify-end">
                    <button type="button" class="mr-2 px-3 py-2 bg-gray-500 hover:bg-gray-400 text-gray-800 rounded-md" onclick="hideConfirmationPopup()">Cancel</button>
                    <form action="{{route('category.destroy', ['category' => $category])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @else

        @endif
        <!-- End of new section for displaying user's categories -->
    </div>
</x-app-layout>
