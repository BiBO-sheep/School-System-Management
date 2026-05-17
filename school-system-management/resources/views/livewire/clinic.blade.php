<div x-data="{ activeTab: 'logs', showVisitModal: false }">
    
    <!-- Header & Title -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Health & Clinic (UKS)</h1>
                <p class="text-sm text-gray-500 mt-1">Manage student health records, daily clinic visits, and medical inventory.</p>
            </div>
            <!-- Log Visit Button (Desktop) -->
            <button @click="showVisitModal = true" class="hidden sm:flex bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-sm items-center">
                <i class="fas fa-notes-medical mr-2 text-lg"></i> Log New Visit
            </button>
        </div>

        <!-- Dashboard Metrics Bar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Visits Today</p>
                    <h3 class="text-3xl font-extrabold text-gray-900">{{ $metrics['visits_today'] }} <span class="text-sm font-medium text-teal-600 ml-1">Students</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-teal-50 flex items-center justify-center text-teal-500 text-xl shadow-inner">
                    <i class="fas fa-stethoscope"></i>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Currently Resting</p>
                    <h3 class="text-3xl font-extrabold text-gray-900">{{ $metrics['currently_resting'] }} <span class="text-sm font-medium text-blue-500 ml-1">In Beds</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 text-xl shadow-inner">
                    <i class="fas fa-procedures"></i>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-red-100 shadow-sm p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-red-500 uppercase tracking-wider mb-1">Low Stock Medicines</p>
                    <h3 class="text-3xl font-extrabold text-red-600">{{ $metrics['low_stock_medicines'] }} <span class="text-sm font-bold text-red-500 ml-1">Items</span></h3>
                </div>
                <div class="h-12 w-12 rounded-full bg-red-50 flex items-center justify-center text-red-500 text-xl shadow-inner">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
            </div>

        </div>

        <!-- Log Visit Button (Mobile) -->
        <div class="mt-4 sm:hidden">
            <button @click="showVisitModal = true" class="w-full flex justify-center bg-teal-600 hover:bg-teal-700 text-white px-4 py-2.5 rounded-lg text-sm font-bold transition-colors shadow-sm items-center">
                <i class="fas fa-notes-medical mr-2 text-lg"></i> Log New Visit
            </button>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8 overflow-x-auto no-scrollbar" aria-label="Tabs">
            <button @click="activeTab = 'logs'" 
                    :class="activeTab === 'logs' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm transition-colors flex items-center">
                <i class="fas fa-clipboard-list mr-2"></i> Visit Logs & Records
            </button>

            <button @click="activeTab = 'inventory'" 
                    :class="activeTab === 'inventory' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm transition-colors flex items-center">
                <i class="fas fa-pills mr-2"></i> Medicine Inventory
            </button>
        </nav>
    </div>

    <!-- TAB 1: Visit Logs & Records -->
    <div x-show="activeTab === 'logs'" x-transition.opacity.duration.300ms>
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-900">Recent Clinic Visits</h3>
            <div class="relative w-48 sm:w-64">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                </span>
                <input type="text" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 shadow-sm" placeholder="Search patient...">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-[11px] tracking-wider font-bold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Date / Time</th>
                            <th class="px-6 py-4">Patient</th>
                            <th class="px-6 py-4">Symptoms</th>
                            <th class="px-6 py-4">Action Taken</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentVisits as $visit)
                        <tr class="hover:bg-teal-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ explode(', ', $visit['date_time'])[0] }}</div>
                                <div class="text-xs text-gray-500 font-mono mt-0.5">{{ explode(', ', $visit['date_time'])[1] }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $visit['student_name'] }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $visit['grade'] }}</div>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $visit['symptoms'] }}</td>
                            <td class="px-6 py-4 text-gray-600 text-xs leading-relaxed">{{ $visit['action_taken'] }}</td>
                            <td class="px-6 py-4">
                                @if($visit['status'] === 'Returned to Class')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-[11px] font-bold bg-green-100 text-green-800 uppercase tracking-wide">
                                        <i class="fas fa-check mr-1.5"></i> Class
                                    </span>
                                @elseif($visit['status'] === 'Sent Home')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-[11px] font-bold bg-orange-100 text-orange-800 uppercase tracking-wide">
                                        <i class="fas fa-home mr-1.5"></i> Home
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-[11px] font-bold bg-blue-100 text-blue-800 uppercase tracking-wide animate-pulse">
                                        <i class="fas fa-bed mr-1.5"></i> Resting
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB 2: Medicine Inventory -->
    <div x-show="activeTab === 'inventory'" x-transition.opacity.duration.300ms style="display: none;">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
            <h3 class="text-lg font-bold text-gray-900">Medical Supplies</h3>
            <div class="flex space-x-2">
                <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                    <i class="fas fa-file-export mr-2 text-teal-600"></i> Export Report
                </button>
                <button class="bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-sm flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Item
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-[11px] tracking-wider font-bold border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4">Item Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4 text-center">Stock Level</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($inventory as $item)
                        <tr class="hover:bg-teal-50/30 transition-colors {{ $item['stock_level'] < 20 ? 'bg-red-50/10' : '' }}">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $item['item_name'] }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item['category'] }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-mono text-lg font-bold {{ $item['stock_level'] < 20 ? 'text-red-600' : 'text-gray-900' }}">
                                    {{ $item['stock_level'] }}
                                </span>
                                <span class="text-xs text-gray-500 ml-1">{{ $item['unit'] }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($item['stock_level'] < 20)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-[11px] font-bold bg-red-100 text-red-800 uppercase tracking-wide border border-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1.5"></i> Low Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wide border border-emerald-200">
                                        <i class="fas fa-check-circle mr-1.5"></i> In Stock
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-teal-600 hover:text-teal-800 text-sm font-bold bg-teal-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Restock
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Log New Visit Modal (Alpine.js) -->
    <div x-show="showVisitModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showVisitModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showVisitModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showVisitModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-200">
                    
                    <div class="bg-teal-600 px-6 py-5 flex justify-between items-center">
                        <div class="flex items-center text-white">
                            <div class="h-10 w-10 bg-teal-500 rounded-full flex items-center justify-center mr-3 shadow-inner">
                                <i class="fas fa-file-medical text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold" id="modal-title">Log Clinic Visit</h3>
                                <p class="text-xs text-teal-100 font-medium mt-0.5">Record patient symptoms and actions taken.</p>
                            </div>
                        </div>
                        <button @click="showVisitModal = false" class="text-teal-200 hover:text-white transition-colors focus:outline-none p-2 rounded-full hover:bg-teal-500">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 bg-gray-50/50 space-y-5">
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Select Patient (Student)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-search text-gray-400"></i>
                                </span>
                                <select class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white appearance-none shadow-sm text-gray-700">
                                    <option value="" disabled selected>Search by name or ID...</option>
                                    <option>Budi Santoso (Grade 10)</option>
                                    <option>Siti Aminah (Grade 7)</option>
                                    <option>Ahmad Fauzi (Grade 10)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Symptoms & Diagnosis</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white shadow-sm" placeholder="Describe the patient's symptoms..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Medicine Given</label>
                                <div class="relative">
                                    <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white appearance-none shadow-sm text-gray-700">
                                        <option>None</option>
                                        <option>Paracetamol 500mg</option>
                                        <option>Antacid Syrup</option>
                                        <option>Eucalyptus Oil</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visit Outcome</label>
                                <div class="relative">
                                    <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white appearance-none shadow-sm text-gray-700">
                                        <option>Rest in Clinic</option>
                                        <option>Return to Class</option>
                                        <option>Sent Home (Parents Contacted)</option>
                                        <option>Transferred to Hospital</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="bg-white px-6 py-4 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3 rounded-b-2xl">
                        <button type="button" @click="showVisitModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="button" @click="showVisitModal = false" class="w-full sm:w-auto inline-flex justify-center rounded-lg bg-teal-600 px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-teal-200 hover:bg-teal-700 hover:-translate-y-0.5 transition-all">
                            <i class="fas fa-save mr-2 mt-0.5"></i> Save Record
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
