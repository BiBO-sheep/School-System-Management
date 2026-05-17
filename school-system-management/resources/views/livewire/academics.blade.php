<div x-data="{ activeTab: 'students' }">
    <!-- Header & Tabs -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Academics & Curriculum</h1>
        <p class="text-sm text-gray-500 mt-1">Manage students, daily attendance, and academic records.</p>
        
        <!-- Tab Navigation -->
        <div class="mt-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button @click="activeTab = 'students'" 
                        :class="activeTab === 'students' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    <i class="fas fa-user-graduate mr-2"></i> Student Directory
                </button>

                <button @click="activeTab = 'attendance'" 
                        :class="activeTab === 'attendance' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    <i class="fas fa-clipboard-user mr-2"></i> Daily Attendance
                </button>

                <button @click="activeTab = 'grades'" 
                        :class="activeTab === 'grades' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    <i class="fas fa-award mr-2"></i> Grades & Exams
                </button>
            </nav>
        </div>
    </div>

    <!-- TAB 1: Student Directory -->
    <div x-show="activeTab === 'students'" x-transition.opacity.duration.300ms class="space-y-6">
        
        <!-- Actions & Filters -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" wire:model.live="search" class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Search by name or ID...">
                </div>
                
                <select wire:model.live="selectedGrade" class="w-full sm:w-48 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
                    <option value="">All Grades</option>
                    @foreach($classes as $class)
                        <option value="{{ $class }}">{{ $class }}</option>
                    @endforeach
                </select>
            </div>
            
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Add New Student
            </button>
        </div>

        <!-- Student Data Table -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4">Student ID</th>
                            <th class="px-6 py-4">Grade / Class</th>
                            <th class="px-6 py-4">Gender</th>
                            <th class="px-6 py-4">Contact</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-gray-900 flex items-center">
                                    <img class="h-8 w-8 rounded-full mr-3" src="https://ui-avatars.com/api/?name={{ urlencode($student->user->name) }}&color=4f46e5&background=e0e7ff" alt="{{ $student->user->name }}">
                                    {{ $student->user->name }}
                                </td>
                                <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $student->nisn }}</td>
                                <td class="px-6 py-4 text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $student->schoolClass->name ?? 'Unassigned' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $student->gender }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $student->phone }}</td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors" title="View Profile">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors" title="Edit Student">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="h-16 w-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-user-slash text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900">No students found</h3>
                                    <p class="text-sm text-gray-500 mt-1">Try adjusting your search or filter to find what you're looking for.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $students->links() }}
            </div>
        </div>
    </div>

    <!-- TAB 2: Daily Attendance -->
    <div x-show="activeTab === 'attendance'" x-transition.opacity.duration.300ms style="display: none;" class="space-y-6">
        
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Record Attendance</h3>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-2/3 lg:w-1/2">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Class / Grade</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
                        <option>Grade 10 - Science 1</option>
                        <option>Grade 10 - Science 2</option>
                        <option>Grade 10 - Social 1</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm w-full sm:w-auto h-10">
                        Load Roster
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h4 class="font-medium text-gray-800">Grade 10 - Science 1</h4>
                <div class="flex items-center space-x-2 text-sm">
                    <span class="flex items-center text-green-600"><span class="h-2 w-2 rounded-full bg-green-500 mr-1.5"></span> Present</span>
                    <span class="flex items-center text-yellow-600 ml-3"><span class="h-2 w-2 rounded-full bg-yellow-400 mr-1.5"></span> Late</span>
                    <span class="flex items-center text-red-600 ml-3"><span class="h-2 w-2 rounded-full bg-red-500 mr-1.5"></span> Absent</span>
                    <span class="flex items-center text-blue-600 ml-3"><span class="h-2 w-2 rounded-full bg-blue-500 mr-1.5"></span> Excused</span>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        @foreach(collect($students->items())->take(4) as $index => $student)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900 w-1/3">
                                {{ $student->user->name }}
                                <div class="text-xs text-gray-500 font-normal mt-0.5">{{ $student->nisn }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-4">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="radio" name="attendance_{{ $student->id }}" value="present" class="peer sr-only" checked>
                                        <div class="px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 peer-checked:bg-green-50 peer-checked:border-green-500 peer-checked:text-green-700 transition-all text-xs font-medium hover:bg-gray-50">
                                            Present
                                        </div>
                                    </label>
                                    
                                        <input type="radio" name="attendance_{{ $student->id }}" value="late" class="peer sr-only">
                                        <div class="px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 peer-checked:bg-yellow-50 peer-checked:border-yellow-400 peer-checked:text-yellow-700 transition-all text-xs font-medium hover:bg-gray-50">
                                            Late
                                        </div>
                                    </label>

                                        <input type="radio" name="attendance_{{ $student->id }}" value="absent" class="peer sr-only">
                                        <div class="px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 peer-checked:bg-red-50 peer-checked:border-red-500 peer-checked:text-red-700 transition-all text-xs font-medium hover:bg-gray-50">
                                            Absent
                                        </div>
                                    </label>
                                    
                                        <input type="radio" name="attendance_{{ $student->id }}" value="excused" class="peer sr-only">
                                        <div class="px-3 py-1.5 rounded-md border border-gray-200 text-gray-600 peer-checked:bg-blue-50 peer-checked:border-blue-500 peer-checked:text-blue-700 transition-all text-xs font-medium hover:bg-gray-50">
                                            Excused
                                        </div>
                                    </label>
                                </div>
                            </td>
                            <td class="px-6 py-4 w-1/4">
                                <input type="text" class="w-full px-3 py-1.5 border border-gray-300 rounded text-xs focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Optional notes...">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                    Save Attendance
                </button>
            </div>
        </div>
    </div>

    <!-- TAB 3: Grades / Exams -->
    <div x-show="activeTab === 'grades'" x-transition.opacity.duration.300ms style="display: none;" class="space-y-6">
        
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Academic Subjects</h3>
            <button class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm bg-white">
                <i class="fas fa-file-export mr-2"></i> Export Gradebook
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($subjects as $subject)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden hover:border-indigo-300 transition-colors group">
                <div class="p-6 border-b border-gray-100">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-book"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">{{ $subject['name'] }}</h4>
                    <p class="text-sm text-gray-500 mt-1 flex items-center">
                        <i class="fas fa-chalkboard-teacher w-4 text-gray-400 mr-1"></i> {{ $subject['teacher'] }}
                    </p>
                    <div class="mt-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $subject['curriculum'] }}
                        </span>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <span class="text-xs text-gray-500 font-medium">Mid-Term pending</span>
                    <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                        Input Grades <i class="fas fa-arrow-right ml-1 text-xs transition-transform group-hover:translate-x-1"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
