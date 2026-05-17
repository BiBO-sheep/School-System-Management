<div x-data="{ showPaymentModal: false }">
    <!-- Header & Actions -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Finance & Billing</h1>
            <p class="text-sm text-gray-500 mt-1">Manage school finances, track tuitions, and process payments.</p>
        </div>
        <button @click="showPaymentModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center whitespace-nowrap">
            <i class="fas fa-hand-holding-usd mr-2"></i> Record Payment
        </button>
    </div>

    <!-- Financial Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Total Collected -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute right-0 top-0 h-full w-2 bg-green-500"></div>
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Collected (This Month)</p>
                <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                    <i class="fas fa-chart-line text-lg"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($metrics['total_collected'], 0, ',', '.') }}</h3>
            <p class="text-xs font-medium text-green-600 flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 14% vs last month
            </p>
        </div>

        <!-- Outstanding Balance -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute right-0 top-0 h-full w-2 bg-red-500"></div>
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Outstanding Balance</p>
                <div class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($metrics['outstanding_balance'], 0, ',', '.') }}</h3>
            <p class="text-xs font-medium text-red-600 flex items-center">
                Requires immediate follow-up
            </p>
        </div>

        <!-- Pending Invoices -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-shadow">
            <div class="absolute right-0 top-0 h-full w-2 bg-yellow-500"></div>
            <div class="flex items-center justify-between mb-4">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Pending Invoices</p>
                <div class="h-10 w-10 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600">
                    <i class="fas fa-file-invoice-dollar text-lg"></i>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $metrics['pending_invoices'] }}</h3>
            <p class="text-xs font-medium text-gray-500">Awaiting payment confirmation</p>
        </div>

    </div>

    <!-- Main Content: Tuition & Invoices Table -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Recent Invoices</h3>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" class="w-full sm:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Search invoices...">
                </div>
                <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center whitespace-nowrap">
                    <i class="fas fa-file-invoice mr-2 text-indigo-600"></i> Generate Invoice
                </button>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Invoice ID</th>
                        <th class="px-6 py-4">Student Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 font-mono text-gray-600 text-xs">
                                {{ $invoice['id'] }}
                                <div class="text-[10px] text-gray-400 mt-1">{{ $invoice['date'] }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $invoice['student_name'] }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $invoice['description'] }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">Rp {{ number_format($invoice['amount'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($invoice['status'] === 'Paid')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        <i class="fas fa-check-circle mr-1.5"></i> Paid
                                    </span>
                                @elseif($invoice['status'] === 'Pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <i class="fas fa-clock mr-1.5"></i> Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                        <i class="fas fa-exclamation-triangle mr-1.5"></i> Overdue
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-gray-400 hover:text-indigo-600 p-2 rounded-full hover:bg-indigo-50 transition-colors" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-gray-400 hover:text-green-600 p-2 rounded-full hover:bg-green-50 transition-colors" title="Download Receipt">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="text-gray-400 hover:text-gray-900 p-2 rounded-full hover:bg-gray-200 transition-colors" title="More Options">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between bg-gray-50">
            <span class="text-sm text-gray-500">Showing {{ count($invoices) }} recent invoices</span>
            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View All Invoices &rarr;</button>
        </div>
    </div>

    <!-- Record Payment Modal (Alpine.js) -->
    <div x-show="showPaymentModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showPaymentModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showPaymentModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showPaymentModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                    
                    <div class="bg-indigo-600 px-6 py-4 border-b border-indigo-700 flex justify-between items-center">
                        <div class="flex items-center text-white">
                            <i class="fas fa-hand-holding-usd text-2xl mr-3 text-indigo-200"></i>
                            <h3 class="text-lg font-bold" id="modal-title">Record Payment</h3>
                        </div>
                        <button @click="showPaymentModal = false" class="text-indigo-200 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 space-y-5 bg-gray-50">
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Student</label>
                            <div class="relative">
                                <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white appearance-none shadow-sm">
                                    <option value="" disabled selected>Select a student...</option>
                                    @foreach(collect($invoices)->unique('student_name') as $invoice)
                                        <option value="{{ $invoice['student_name'] }}">{{ $invoice['student_name'] }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Select Invoice</label>
                            <div class="relative">
                                <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white appearance-none shadow-sm">
                                    <option value="" disabled selected>Select pending/overdue invoice...</option>
                                    @foreach(collect($invoices)->whereIn('status', ['Pending', 'Overdue']) as $invoice)
                                        <option value="{{ $invoice['id'] }}">{{ $invoice['id'] }} - {{ $invoice['description'] }} (Rp {{ number_format($invoice['amount'], 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Payment Method</label>
                                <div class="relative">
                                    <select class="w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white appearance-none shadow-sm">
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cash">Cash</option>
                                        <option value="credit_card">Credit Card</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Amount (Rp)</label>
                                <input type="number" placeholder="0" class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm font-mono">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Notes (Optional)</label>
                            <textarea rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Reference number or additional details..."></textarea>
                        </div>
                    </div>
                    
                    <div class="bg-white px-6 py-4 border-t border-gray-100 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="button" @click="showPaymentModal = false" class="inline-flex w-full justify-center rounded-lg bg-green-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                            <i class="fas fa-check mr-2 mt-0.5"></i> Confirm Payment
                        </button>
                        <button type="button" @click="showPaymentModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
