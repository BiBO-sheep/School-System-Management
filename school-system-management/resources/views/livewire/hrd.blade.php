<div x-data="{ activeTab: 'directory', showStaffModal: false }">
    <!-- Header & Metrics -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">HR & Staffing</h1>
                <p class="text-sm text-gray-500 mt-1">Manage personnel, process leave requests, and track payroll.</p>
            </div>
            
            <button @click="showStaffModal = true" class="hidden sm:flex bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm items-center">
                <i class="fas fa-user-plus mr-2"></i> Add New Staff
            </button>
        </div>

        <!-- HR Metrics Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Total Employees</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $hrStats['total_employees'] }} <span class="text-sm font-medium text-green-500 ml-1">Active</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-xl">
                    <i class="fas fa-id-card"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">On Leave Today</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $hrStats['on_leave_today'] }} <span class="text-sm font-medium text-orange-500 ml-1">Staff</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 text-xl">
                    <i class="fas fa-plane-departure"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Upcoming Appraisals</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $hrStats['upcoming_appraisals'] }} <span class="text-sm font-medium text-purple-500 ml-1">Reviews</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 text-xl">
                    <i class="fas fa-clipboard-check"></i>
                </div>
            </div>
        </div>
        
        <!-- Mobile Add Button -->
        <div class="mt-4 sm:hidden">
            <button @click="showStaffModal = true" class="w-full flex justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm items-center">
                <i class="fas fa-user-plus mr-2"></i> Add New Staff
            </button>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8 overflow-x-auto no-scrollbar" aria-label="Tabs">
            <button @click="activeTab = 'directory'" 
                    :class="activeTab === 'directory' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center">
                <i class="fas fa-users mr-2"></i> Staff Directory
            </button>

            <button @click="activeTab = 'leave'" 
                    :class="activeTab === 'leave' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center relative">
                <i class="fas fa-calendar-times mr-2"></i> Leave Requests (Cuti)
                <span class="ml-2 bg-red-100 text-red-600 py-0.5 px-2 rounded-full text-[10px] font-bold">{{ count(array_filter($leaveRequests, fn($r) => $r['status'] === 'Pending')) }}</span>
            </button>

            <button @click="activeTab = 'payroll'" 
                    :class="activeTab === 'payroll' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center">
                <i class="fas fa-money-check-alt mr-2"></i> Payroll & Attendance
            </button>
        </nav>
    </div>

    <!-- TAB 1: Staff Directory -->
    <div x-show="activeTab === 'directory'" x-transition.opacity.duration.300ms>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <h3 class="text-lg font-bold text-gray-900">Employee Roster</h3>
            <div class="relative w-full sm:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" placeholder="Search staff...">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Employee</th>
                            <th class="px-6 py-4">ID / Role</th>
                            <th class="px-6 py-4">Department</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($employees as $employee)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 flex items-center">
                                <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3 shadow-inner">
                                    {{ $employee['avatar'] }}
                                </div>
                                <div class="font-bold text-gray-900">{{ $employee['name'] }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-mono text-gray-500 mb-0.5">{{ $employee['id'] }}</div>
                                <div class="font-medium text-gray-700">{{ $employee['role'] }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $employee['department'] }}</td>
                            <td class="px-6 py-4">
                                @if($employee['status'] === 'Active')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800 border border-orange-200">
                                        On Leave
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-md hover:bg-indigo-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center text-sm text-gray-500">
                <span>Showing {{ count($employees) }} records</span>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded hover:bg-white disabled:opacity-50" disabled>Prev</button>
                    <button class="px-3 py-1 border border-gray-300 rounded hover:bg-white disabled:opacity-50" disabled>Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 2: Leave Requests (Cuti) -->
    <div x-show="activeTab === 'leave'" x-transition.opacity.duration.300ms style="display: none;">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Pending Leave Requests</h3>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($leaveRequests as $request)
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                @if($request['status'] === 'Approved')
                    <div class="absolute right-0 top-0 h-full w-1.5 bg-green-500"></div>
                @else
                    <div class="absolute right-0 top-0 h-full w-1.5 bg-yellow-400"></div>
                @endif
                
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="font-bold text-gray-900">{{ $request['staff_name'] }}</h4>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $request['role'] }}</p>
                    </div>
                    <span class="text-xs font-mono text-gray-400">{{ $request['id'] }}</span>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-3 mb-4 border border-gray-100">
                    <div class="flex items-center text-sm mb-2">
                        <i class="far fa-calendar-alt text-gray-400 mr-2 w-4"></i>
                        <span class="font-medium text-gray-800">{{ $request['dates'] }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i class="fas fa-info-circle text-gray-400 mr-2 w-4"></i>
                        <span class="text-gray-600">{{ $request['reason'] }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    @if($request['status'] === 'Pending')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-yellow-100 text-yellow-800">Pending Review</span>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1.5 bg-white border border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 rounded-md text-xs font-bold transition-colors">
                                Reject
                            </button>
                            <button class="px-3 py-1.5 bg-green-600 text-white hover:bg-green-700 rounded-md text-xs font-bold transition-colors shadow-sm">
                                Approve
                            </button>
                        </div>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-green-100 text-green-800">Approved</span>
                        <button class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View Details</button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 3: Payroll & Attendance -->
    <div x-show="activeTab === 'payroll'" x-transition.opacity.duration.300ms style="display: none;">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Payroll Calculation</h3>
                <p class="text-sm text-gray-500">Period: May 2026</p>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i> Generate Bulk Payroll
            </button>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Employee</th>
                            <th class="px-6 py-4 text-center">Base Hours</th>
                            <th class="px-6 py-4 text-center">Actual Hours</th>
                            <th class="px-6 py-4 text-center">Overtime</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($payrollData as $payroll)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $payroll['name'] }}</div>
                                <div class="text-xs font-mono text-gray-500">{{ $payroll['employee_id'] }}</div>
                            </td>
                            <td class="px-6 py-4 text-center font-medium text-gray-600">{{ $payroll['base_hours'] }}h</td>
                            <td class="px-6 py-4 text-center font-bold {{ $payroll['actual_hours'] < $payroll['base_hours'] ? 'text-orange-600' : 'text-gray-900' }}">
                                {{ $payroll['actual_hours'] }}h
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-green-600">
                                {{ $payroll['overtime'] > 0 ? '+'.$payroll['overtime'].'h' : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $payroll['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Review</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add New Staff Modal (Alpine.js) -->
    <div x-show="showStaffModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showStaffModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showStaffModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showStaffModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-200">
                    
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div class="flex items-center text-gray-900">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3">
                                <i class="fas fa-user-plus text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold" id="modal-title">Onboard New Staff</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Enter the employee's core HR details.</p>
                            </div>
                        </div>
                        <button @click="showStaffModal = false" class="text-gray-400 hover:text-gray-600 transition-colors focus:outline-none p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 bg-gray-50/50">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">First Name</label>
                                <input type="text" placeholder="e.g., Anisa" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Last Name</label>
                                <input type="text" placeholder="e.g., Rahmawati" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Professional Email</label>
                                <input type="email" placeholder="anisa.r@educore.com" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role / Position</label>
                                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                                    <option>Teacher</option>
                                    <option>Senior Teacher</option>
                                    <option>Admin Staff</option>
                                    <option>Security / Operations</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Department</label>
                                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                                    <option>Academics</option>
                                    <option>Finance & Admin</option>
                                    <option>Pesantren Affairs</option>
                                    <option>IT & Infrastructure</option>
                                </select>
                            </div>

                            <div class="sm:col-span-2 mt-2 pt-5 border-t border-gray-200">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Base Salary (IDR) / Month</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium">Rp</span>
                                    <input type="text" placeholder="5.000.000" class="w-full pl-12 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm font-mono">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white px-6 py-4 border-t border-gray-100 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="button" @click="showStaffModal = false" class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto transition-colors">
                            Add Employee
                        </button>
                        <button type="button" @click="showStaffModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
