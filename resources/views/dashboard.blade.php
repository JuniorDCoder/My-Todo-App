<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
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
                                    <a class="nav-link active" href="#">
                                        <i class="fa-solid fa-gauge me-2 ms-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <hr>
                                <li class="nav-item dropdown mt-2">
                                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-tape me-2 ms-2"></i>
                                        Categories
                                    </a>
                                    <ul class="dropdown-menu bg-blue-300" aria-labelledby="categoriesDropdown">
                                        <li><a class="dropdown-item" href="#">Category 1</a></li>
                                        <li><a class="dropdown-item" href="#">Category 2</a></li>
                                        <li><a class="dropdown-item" href="#">Category 3</a></li>
                                        <!-- Add more dummy categories as needed -->
                                    </ul>
                                </li>
                                <hr>
                                <li class="nav-item mt-2">
                                    <a class="nav-link" href="#">
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
                            12 Task
                        </div>
                        <div class="p-3 flex items-center justify-center text-center text-3xl text-blue-300">
                            2 Overdue
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
