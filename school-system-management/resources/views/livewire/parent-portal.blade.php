<div x-data="{ showMessageModal: false }">
    <!-- Header & Child Selector -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Parent Portal</h1>
                <p class="text-sm text-gray-500 mt-1">Monitor your children's academic progress and school activities.</p>
            </div>
            
            <!-- Child Selector -->
            <div class="flex space-x-3 w-full md:w-auto overflow-x-auto pb-2 md:pb-0 no-scrollbar">
                @foreach($allChildren as $c)
                    <button wire:click="selectChild({{ $c['id'] }})" 
                            class="flex items-center space-x-3 px-4 py-2.5 rounded-xl border transition-all flex-shrink-0 focus:outline-none {{ $selectedChildId === $c['id'] ? 'bg-indigo-50 border-indigo-200 shadow-sm ring-1 ring-indigo-500' : 'bg-white border-gray-200 hover:bg-gray-50 hover:border-gray-300 shadow-sm' }}">
                        <div class="h-8 w-8 rounded-full flex items-center justify-center font-bold text-sm {{ $selectedChildId === $c['id'] ? 'bg-indigo-600 text-white shadow-inner' : 'bg-indigo-100 text-indigo-600' }}">
                            {{ $c['avatar'] }}
                        </div>
                        <div class="text-left">
                            <h3 class="text-sm font-bold {{ $selectedChildId === $c['id'] ? 'text-indigo-900' : 'text-gray-900' }} leading-tight">{{ $c['name'] }}</h3>
                            <p class="text-[10px] {{ $selectedChildId === $c['id'] ? 'text-indigo-600 font-medium' : 'text-gray-500' }}">{{ $c['grade'] }}</p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 mb-8">
        
        <!-- Left Column: Overview Cards -->
        <div class="xl:col-span-8 space-y-6">
            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative overflow-hidden">
                <!-- Decorative pattern -->
                <div class="absolute right-0 top-0 opacity-5 pointer-events-none">
                    <i class="fas fa-graduation-cap text-9xl -mt-6 -mr-6"></i>
                </div>
                
                <div class="flex items-center relative z-10">
                    <div class="h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-bold border-4 border-white shadow-md ring-1 ring-indigo-50">
                        {{ $child['avatar'] }}
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-extrabold text-gray-900">{{ $child['name'] }}'s Dashboard</h2>
                        <p class="text-sm font-medium text-gray-500 flex items-center mt-1">
                            <i class="fas fa-layer-group text-indigo-400 mr-2 text-xs"></i> {{ $child['grade'] }}
                        </p>
                    </div>
                </div>
                <button @click="showMessageModal = true" class="relative z-10 w-full sm:w-auto bg-indigo-50 text-indigo-700 border border-indigo-200 hover:bg-indigo-100 hover:border-indigo-300 px-4 py-2.5 rounded-lg text-sm font-bold transition-colors flex items-center justify-center shadow-sm">
                    <i class="fas fa-comment-dots mr-2"></i> Contact Teacher
                </button>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Academic Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <div class="h-10 w-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">Academics</span>
                    </div>
                    <div class="mb-4 flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Current GPA</p>
                        <h3 class="text-3xl font-extrabold text-gray-900">{{ $child['academic']['gpa'] }}</h3>
                        <p class="text-sm font-medium text-gray-600 mt-2">Avg: <span class="font-bold text-gray-900">{{ $child['academic']['average_score'] }}</span> • <span class="text-blue-600">{{ $child['academic']['rank'] }}</span></p>
                    </div>
                    <button class="w-full bg-white border border-gray-200 hover:border-blue-400 text-gray-700 hover:text-blue-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex justify-center items-center">
                        <i class="fas fa-download mr-2 text-xs"></i> Report Card
                    </button>
                </div>

                <!-- Attendance Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <div class="h-10 w-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">Attendance</span>
                    </div>
                    <div class="mb-4 flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Status Today</p>
                        <h3 class="text-2xl font-extrabold {{ $child['attendance']['status_today'] === 'Present' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $child['attendance']['status_today'] }}
                        </h3>
                        <div class="mt-3 flex gap-3 text-sm">
                            <div class="bg-gray-50 rounded px-2 py-1 border border-gray-100">
                                <span class="text-red-600 font-bold">{{ $child['attendance']['total_absences'] }}</span> <span class="text-gray-500 text-xs">Absent</span>
                            </div>
                            <div class="bg-gray-50 rounded px-2 py-1 border border-gray-100">
                                <span class="text-yellow-600 font-bold">{{ $child['attendance']['total_late'] }}</span> <span class="text-gray-500 text-xs">Late</span>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-white border border-gray-200 hover:border-green-400 text-gray-700 hover:text-green-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex justify-center items-center">
                        <i class="fas fa-calendar-alt mr-2 text-xs"></i> Full Record
                    </button>
                </div>

                <!-- Finance/Billing Card -->
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 hover:shadow-md transition-shadow flex flex-col">
                    <div class="flex justify-between items-start mb-4">
                        <div class="h-10 w-10 rounded-full {{ $child['billing']['outstanding_balance'] > 0 ? 'bg-orange-50 text-orange-600' : 'bg-indigo-50 text-indigo-600' }} flex items-center justify-center">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <span class="{{ $child['billing']['outstanding_balance'] > 0 ? 'bg-orange-100 text-orange-800' : 'bg-indigo-100 text-indigo-800' }} text-xs font-bold px-2 py-1 rounded">Billing</span>
                    </div>
                    <div class="mb-4 flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Outstanding Balance</p>
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-1">Rp {{ number_format($child['billing']['outstanding_balance'], 0, ',', '.') }}</h3>
                        
                        @if($child['billing']['outstanding_balance'] > 0)
                            <p class="text-xs font-bold text-red-600 flex items-center mt-2">
                                <i class="fas fa-exclamation-triangle mr-1"></i> {{ $child['billing']['next_due'] }}
                            </p>
                        @else
                            <p class="text-xs font-bold text-green-600 flex items-center mt-2">
                                <i class="fas fa-check-circle mr-1"></i> Paid in Full
                            </p>
                        @endif
                    </div>
                    
                    @if($child['billing']['outstanding_balance'] > 0)
                        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white shadow-md shadow-orange-200 px-3 py-2 rounded-lg text-sm font-bold transition-all flex justify-center items-center">
                            Pay Now <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </button>
                    @else
                        <button class="w-full bg-white border border-gray-200 hover:border-indigo-400 text-gray-700 hover:text-indigo-700 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex justify-center items-center">
                            <i class="fas fa-history mr-2 text-xs"></i> Billing History
                        </button>
                    @endif
                </div>

            </div>
        </div>

        <!-- Right Column: Activity Timeline -->
        <div class="xl:col-span-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Recent Activity</h2>
                    <button class="text-indigo-600 text-xs font-bold hover:text-indigo-800 uppercase tracking-wider">View All</button>
                </div>

                <div class="relative border-l-2 border-gray-100 ml-3 space-y-6">
                    @foreach($child['timeline'] as $item)
                        <div class="relative pl-6">
                            <!-- Timeline Dot with Icon -->
                            <div class="absolute -left-4 top-0 h-8 w-8 rounded-full bg-{{ $item['color'] }}-100 flex items-center justify-center ring-4 ring-white shadow-sm">
                                <i class="fas fa-{{ $item['icon'] }} text-{{ $item['color'] }}-600 text-xs"></i>
                            </div>
                            
                            <div class="pt-1.5">
                                <p class="text-sm font-bold text-gray-900">{{ $item['text'] }}</p>
                                <p class="text-xs font-medium text-gray-400 mt-0.5">{{ $item['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- Message Teacher Modal (Alpine.js) -->
    <div x-show="showMessageModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showMessageModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showMessageModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showMessageModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                    
                    <div class="bg-indigo-600 px-6 py-5 flex justify-between items-center">
                        <div class="flex items-center text-white">
                            <div class="h-10 w-10 bg-indigo-500 rounded-full flex items-center justify-center mr-3 shadow-inner">
                                <i class="fas fa-chalkboard-teacher text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold" id="modal-title">Contact Teacher</h3>
                                <p class="text-xs text-indigo-200 font-medium mt-0.5">{{ $child['homeroom_teacher'] }} (Homeroom)</p>
                            </div>
                        </div>
                        <button @click="showMessageModal = false" class="text-indigo-200 hover:text-white transition-colors focus:outline-none p-2 rounded-full hover:bg-indigo-500">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 space-y-5 bg-gray-50/50">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subject</label>
                            <input type="text" placeholder="e.g., Question about Math Homework" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Message</label>
                            <textarea rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white shadow-sm" placeholder="Type your message here..."></textarea>
                        </div>
                    </div>
                    
                    <div class="bg-white px-6 py-4 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 rounded-b-2xl">
                        <button type="button" @click="showMessageModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="button" @click="showMessageModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-paper-plane mr-2 mt-0.5"></i> Send Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
