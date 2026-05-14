<div>
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard & Analytics</h1>
            <p class="text-sm text-gray-500 mt-1">Overview of school performance and statistics</p>
        </div>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
            <i class="fas fa-download mr-2"></i> Download Report
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Students</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($stats['total_students']) }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 font-medium flex items-center"><i class="fas fa-arrow-up mr-1 text-xs"></i> {{ $stats['student_growth_percentage'] }}%</span>
                <span class="text-gray-400 ml-2">vs last year</span>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Teachers</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total_teachers'] }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-purple-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 font-medium flex items-center"><i class="fas fa-arrow-up mr-1 text-xs"></i> {{ $stats['new_teachers'] }}</span>
                <span class="text-gray-400 ml-2">new staffs</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Tuition Collected</p>
                    <h3 class="text-3xl font-bold text-gray-900">Rp {{ $stats['tuition_collected'] }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-wallet text-green-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 font-medium flex items-center"><i class="fas fa-arrow-up mr-1 text-xs"></i> {{ $stats['tuition_target_percentage'] }}%</span>
                <span class="text-gray-400 ml-2">target reached</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Today's Attendance</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['attendance_today'] }}%</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-orange-50 flex items-center justify-center">
                    <i class="fas fa-clipboard-check text-orange-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-red-500 font-medium flex items-center"><i class="fas fa-arrow-down mr-1 text-xs"></i> {{ $stats['attendance_drop'] }}%</span>
                <span class="text-gray-400 ml-2">vs yesterday</span>
            </div>
        </div>
    </div>

    <!-- Recent Activities Table -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Recent Admissions (PPDB)</h3>
            <a href="{{ route('admission') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4">Registration ID</th>
                        <th class="px-6 py-4">Applied Grade</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentAdmissions as $admission)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 font-medium text-gray-900 flex items-center">
                                <div class="h-8 w-8 rounded-full bg-{{ $admission['color'] }}-100 text-{{ $admission['color'] }}-600 flex items-center justify-center font-bold mr-3">
                                    {{ $admission['initial'] }}
                                </div>
                                {{ $admission['name'] }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $admission['id'] }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $admission['grade'] }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $admission['date'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $admission['status_color'] }}-100 text-{{ $admission['status_color'] }}-800">
                                    {{ $admission['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                No recent admissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
