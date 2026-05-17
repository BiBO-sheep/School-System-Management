<div x-data="{ activeTab: 'rooms', showPassModal: false }">
    
    <!-- Header & Stats -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dormitory & Pesantren</h1>
                <p class="text-sm text-gray-500 mt-1">Manage boarding students, Tahfidz progress, and discipline records.</p>
            </div>
            <!-- Issue Pass Button (Desktop) -->
            <button @click="showPassModal = true" class="hidden sm:flex bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm items-center">
                <i class="fas fa-ticket-alt mr-2"></i> Issue Exit Pass
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Total Boarders</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total_boarders'] }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-xl">
                    <i class="fas fa-bed"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Available Beds</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['available_beds'] }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-green-50 flex items-center justify-center text-green-500 text-xl">
                    <i class="fas fa-door-open"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Active Exit Passes</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $stats['active_passes'] }}</h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-orange-50 flex items-center justify-center text-orange-500 text-xl">
                    <i class="fas fa-walking"></i>
                </div>
            </div>
        </div>

        <!-- Issue Pass Button (Mobile) -->
        <div class="mt-4 sm:hidden">
            <button @click="showPassModal = true" class="w-full flex justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm items-center">
                <i class="fas fa-ticket-alt mr-2"></i> Issue Exit Pass
            </button>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8 overflow-x-auto no-scrollbar" aria-label="Tabs">
            <button @click="activeTab = 'rooms'" 
                    :class="activeTab === 'rooms' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center">
                <i class="fas fa-building mr-2"></i> Room Allocation
            </button>

            <button @click="activeTab = 'tahfidz'" 
                    :class="activeTab === 'tahfidz' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center">
                <i class="fas fa-quran mr-2"></i> Tahfidz Progress
            </button>

            <button @click="activeTab = 'passes'" 
                    :class="activeTab === 'passes' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors flex items-center">
                <i class="fas fa-clipboard-list mr-2"></i> Passes & Discipline
            </button>
        </nav>
    </div>

    <!-- TAB 1: Room Allocation Grid -->
    <div x-show="activeTab === 'rooms'" x-transition.opacity.duration.300ms>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Dormitory Rooms</h3>
            <div class="flex space-x-2 text-sm">
                <select class="border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700 bg-white shadow-sm">
                    <option>All Buildings</option>
                    <option>Building A (Male)</option>
                    <option>Building B (Female)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($rooms as $room)
            <div class="bg-white rounded-xl border {{ $room['filled'] == $room['capacity'] ? 'border-gray-200' : 'border-indigo-100 hover:border-indigo-300' }} shadow-sm p-5 transition-all group">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 flex items-center">
                            {{ $room['name'] }}
                            @if($room['type'] === 'Male')
                                <span class="ml-2 bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Male</span>
                            @else
                                <span class="ml-2 bg-pink-100 text-pink-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase">Female</span>
                            @endif
                        </h4>
                        <p class="text-xs text-gray-500 mt-1"><i class="fas fa-user-shield mr-1"></i> {{ $room['supervisor'] }}</p>
                    </div>
                    <div class="h-10 w-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                        <i class="fas fa-door-closed"></i>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="flex justify-between text-xs mb-1.5">
                        <span class="font-medium text-gray-700">Capacity</span>
                        <span class="font-bold {{ $room['filled'] == $room['capacity'] ? 'text-red-600' : 'text-green-600' }}">
                            {{ $room['filled'] }} / {{ $room['capacity'] }} Beds
                        </span>
                    </div>
                    <!-- Dots Progress visualization -->
                    <div class="flex gap-1">
                        @for($i = 0; $i < $room['capacity']; $i++)
                            <div class="h-2 flex-1 rounded-full {{ $i < $room['filled'] ? ($room['filled'] == $room['capacity'] ? 'bg-red-400' : 'bg-green-500') : 'bg-gray-200' }}"></div>
                        @endfor
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-gray-100">
                    <button class="w-full bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm">
                        Manage Room
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- TAB 2: Tahfidz Progress -->
    <div x-show="activeTab === 'tahfidz'" x-transition.opacity.duration.300ms style="display: none;">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Quran Memorization (Tahfidz)</h3>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                <i class="fas fa-book-reader mr-2 text-indigo-600"></i> Log Memorization
            </button>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4 w-1/3">Progress (Juz)</th>
                            <th class="px-6 py-4">Last Deposit</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($tahfidzRecords as $record)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $record['student_name'] }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $record['grade'] }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="font-medium text-gray-700">Juz {{ $record['juz_memorized'] }}</span>
                                    <span class="text-gray-500">{{ $record['juz_memorized'] }}/{{ $record['total_juz'] }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php $percent = ($record['juz_memorized'] / $record['total_juz']) * 100; @endphp
                                    <div class="h-2 rounded-full {{ $percent == 100 ? 'bg-yellow-400' : 'bg-indigo-500' }}" style="width: {{ $percent }}%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs font-medium">{{ $record['last_deposit'] }}</td>
                            <td class="px-6 py-4">
                                @if($record['status'] === 'Completed')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-100 text-yellow-800 uppercase">
                                        <i class="fas fa-crown mr-1"></i> Khatam
                                    </span>
                                @elseif($record['status'] === 'Needs Attention')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-100 text-red-800 uppercase">
                                        Delayed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800 uppercase">
                                        On Track
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-md hover:bg-indigo-50 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 3: Passes & Discipline -->
    <div x-show="activeTab === 'passes'" x-transition.opacity.duration.300ms style="display: none;">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Recent Passes & Violations</h3>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input type="text" class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" placeholder="Search student...">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Student</th>
                            <th class="px-6 py-4">Type</th>
                            <th class="px-6 py-4">Details / Reason</th>
                            <th class="px-6 py-4">Date / Duration</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($disciplineRecords as $record)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $record['student_name'] }}</td>
                            <td class="px-6 py-4">
                                @if($record['type'] === 'Exit Pass')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                        <i class="fas fa-ticket-alt mr-1.5"></i> Exit Pass
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1.5"></i> Violation
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $record['details'] }}</td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $record['date'] }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium px-2 py-1 bg-gray-100 text-gray-700 rounded-md">
                                    {{ $record['status'] }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Issue Exit Pass Modal (Alpine.js) -->
    <div x-show="showPassModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showPassModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showPassModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showPassModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                    
                    <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center">
                        <div class="flex items-center text-white">
                            <i class="fas fa-ticket-alt text-2xl mr-3 text-indigo-200"></i>
                            <h3 class="text-lg font-bold" id="modal-title">Issue Exit Pass (Izin)</h3>
                        </div>
                        <button @click="showPassModal = false" class="text-indigo-200 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 space-y-5 bg-gray-50/50">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Select Student</label>
                            <div class="relative">
                                <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white appearance-none shadow-sm">
                                    <option value="" disabled selected>Search by name or ID...</option>
                                    <option>Rizky Pratama (Grade 10)</option>
                                    <option>Nadia Putri (Grade 11)</option>
                                    <option>Budi Santoso (Grade 10)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Reason for Leaving</label>
                            <div class="relative">
                                <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white appearance-none shadow-sm">
                                    <option>Family Event / Going Home (Pulang)</option>
                                    <option>Medical checkup / Hospital</option>
                                    <option>Buy personal supplies</option>
                                    <option>Other / Authorized Event</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Departure Date</label>
                                <input type="date" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm text-gray-700 bg-white">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Return Date</label>
                                <input type="date" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm text-gray-700 bg-white">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Additional Details</label>
                            <textarea rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Who is picking up the student?..."></textarea>
                        </div>
                    </div>
                    
                    <div class="bg-white px-6 py-4 border-t border-gray-100 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="button" @click="showPassModal = false" class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:w-auto transition-colors">
                            Issue Pass
                        </button>
                        <button type="button" @click="showPassModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
