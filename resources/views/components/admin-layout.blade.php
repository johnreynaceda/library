<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <script type="text/javascript" src="instascan.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.0/build/instascan.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    <style>
        body {
            background-color: #F0FFF4; /* Light green background */
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            background-color: #4CAF50; /* Bright green */
            color: white;
        }
        .sidebar img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .sidebar .text-center {
            margin-top: 1rem;
            margin-bottom: 2rem;
            font-size: 1.25rem;
        }
        .sidebar ul li a {
            color: #E8F5E9; /* Light green */
            transition: background-color 0.3s;
        }
        .sidebar ul li a:hover {
            background-color: #388E3C; /* Darker green */
            border-radius: 0.5rem;
        }
        .sidebar ul li a i {
            margin-right: 0.75rem;
        }
        .main-content {
            padding: 2rem;
            margin-left: 16rem; /* Adjust based on sidebar width */
            transition: margin-left 0.3s;
        }
        @media (max-width: 640px) {
            .main-content {
                margin-left: 0;
            }
            .sidebar {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0;
                left: -100%;
                transition: left 0.3s;
            }
            .sidebar.active {
                left: 0;
            }
        }
        .logout-button {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background-color: #66BB6A; /* Medium green */
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .logout-button:hover {
            background-color: #4CAF50; /* Bright green on hover */
        }
    </style>
</head>
<body>
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar" aria-controls="sidebar-multi-level-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar" class="sidebar fixed top-0 left-0 z-40 w-64 h-screen transition-transform sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <div class="text-center flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Admin">
                <div class="font-bold">ADMINISTRATOR</div>
            </div>
            <ul class="space-y-2 font-medium mt-4">
                <li>
                    <a href="{{ route('Admindashboard') }}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-dashboard-fill"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{{route('add-b')}}}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-book-shelf-fill"></i>
                        <span class="ms-3">Add Books</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('book-b')}}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-git-repository-commits-fill"></i>
                        <span class="ms-3">Borrower List</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('borrowed-b')}}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-git-repository-commits-fill"></i>
                        <span class="ms-3">Borrowed books</span>
                    </a>
                </li>



                <li>
                    <a href="{{route('not-return')}}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-git-repository-fill"></i>
                        <span class="ms-3">Book Not Returned</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('return')}}" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-git-repository-fill"></i>
                        <span class="ms-3">Book Returned</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 rounded-lg hover:bg-gray-700">
                        <i class="ri-team-fill"></i>
                        <span class="ms-3">Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="main-content">
        <main>
            {{ $slot }}
        </main>
    </div>

    <a href="{{route('logout')}}" class="logout-button">Logout</a>
</body>
</html>
