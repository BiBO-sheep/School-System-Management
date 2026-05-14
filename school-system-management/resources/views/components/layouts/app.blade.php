<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'School Management System - Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Hide scrollbar for sidebar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">
        
        <!-- Mobile sidebar backdrop -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden" @click="sidebarOpen = false" x-cloak></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white flex flex-col h-full transition-transform duration-300 lg:relative lg:translate-x-0">
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-700">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-indigo-400 text-2xl mr-3"></i>
                    <span class="text-xl font-bold tracking-wider">EduCore</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto no-scrollbar py-4">
                <nav class="px-3 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 rounded-lg group transition-colors {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-chart-pie w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Dashboard & Analytics</span>
                    </a>
                    
                    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Core Modules</p>
                    
                    <a href="{{ route('academics') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('academics') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-book-open w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Academics</span>
                    </a>
                    <a href="{{ route('admission') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admission') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-user-plus w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Admission (PPDB)</span>
                    </a>
                    <a href="{{ route('finance') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('finance') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-wallet w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Finance & Billing</span>
                    </a>

                    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Portals</p>

                    <a href="{{ route('teacher-portal') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('teacher-portal') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-chalkboard-teacher w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Teacher Portal</span>
                    </a>
                    <a href="{{ route('student-portal') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('student-portal') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-user-graduate w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Student Portal</span>
                    </a>
                    <a href="{{ route('parent-portal') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('parent-portal') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-users w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Parent Portal</span>
                    </a>

                    <p class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4 mb-2">Management</p>

                    <a href="{{ route('human-resource') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('human-resource') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-id-badge w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">HR & Staffing</span>
                    </a>
                    <a href="{{ route('dormitory') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('dormitory') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-building w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Dormitory / Pesantren</span>
                    </a>
                    <a href="{{ route('clinic') }}" class="flex items-center px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('clinic') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-notes-medical w-6 text-center mr-2"></i>
                        <span class="font-medium text-sm">Health & Clinic (UKS)</span>
                    </a>
                </nav>
            </div>
            
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center">
                    <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" alt="Admin">
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">Super Admin</p>
                        <p class="text-xs text-slate-400">admin@educore.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Top Navbar -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="relative ml-4 hidden sm:block">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Search students, staff...">
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Notifications Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="text-gray-400 hover:text-gray-600 relative focus:outline-none mt-1">
                            <i class="far fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        </button>
                        
                        <div x-show="open" x-transition.opacity class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 border border-gray-100 z-50" x-cloak>
                            <div class="px-4 py-2 border-b border-gray-100 font-semibold text-sm text-gray-700">Notifications</div>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 hover:bg-gray-50 border-l-2 border-indigo-500 bg-indigo-50/30">New student registration (REG-26004)</a>
                            <a href="#" class="block px-4 py-3 text-sm text-gray-600 hover:bg-gray-50">Tuition payment received from Budi Santoso</a>
                            <a href="#" class="block px-4 py-2 text-xs text-center text-indigo-600 font-medium hover:text-indigo-800">View all notifications</a>
                        </div>
                    </div>
                    
                    <div class="h-8 w-px bg-gray-200"></div>
                    
                    <!-- User Dropdown -->
                    <div class="relative flex items-center" x-data="{ open: false }">
                        <span class="text-sm font-medium text-gray-700 mr-3 hidden md:block">Academic Year 2026/2027</span>
                        
                        <button @click="open = !open" @click.away="open = false" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff" alt="User Avatar">
                        </button>
                        
                        <div x-show="open" x-transition.opacity class="absolute right-0 top-10 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 border border-gray-100 z-50" x-cloak>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="far fa-user mr-2 text-gray-400"></i> Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="fas fa-cog mr-2 text-gray-400"></i> Settings</a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100"><i class="fas fa-sign-out-alt mr-2 text-red-400"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
