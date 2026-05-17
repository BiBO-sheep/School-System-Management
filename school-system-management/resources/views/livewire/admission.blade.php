<div x-data="{ showModal: false }" class="h-full flex flex-col">
    
    <!-- Header & Metrics -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Admission (PPDB)</h1>
                <p class="text-sm text-gray-500 mt-1">Track and manage new student applications.</p>
            </div>
            <button @click="showModal = true" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i> Register New Student
            </button>
        </div>

        <!-- Metrics Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Total Applicants</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $metrics['total'] }}</h3>
                </div>
                <div class="h-10 w-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-400">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Under Review</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $metrics['under_review'] }}</h3>
                </div>
                <div class="h-10 w-10 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-500">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Accepted</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $metrics['accepted'] }}</h3>
                </div>
                <div class="h-10 w-10 rounded-full bg-green-50 flex items-center justify-center text-green-500">
                    <i class="fas fa-check"></i>
                </div>
            </div>
            
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Rejected</p>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $metrics['rejected'] }}</h3>
                </div>
                <div class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-500">
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="flex-1 overflow-x-auto overflow-y-hidden no-scrollbar pb-4 -mx-6 px-6">
        <div class="flex gap-6 h-full min-w-max items-start">
            
            <!-- Column 1: New Applications -->
            <div class="w-80 flex flex-col max-h-full">
                <div class="flex items-center justify-between mb-3 px-1">
                    <h3 class="font-semibold text-gray-800 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> New Applications
                    </h3>
                    <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ count($groupedApplicants['new']) }}</span>
                </div>
                <div class="bg-gray-100/50 rounded-xl p-3 flex-1 overflow-y-auto space-y-3 border-t-2 border-blue-400 shadow-inner">
                    @foreach($groupedApplicants['new'] as $applicant)
                        @include('livewire.partials.applicant-card', ['applicant' => $applicant])
                    @endforeach
                    @if(empty($groupedApplicants['new']))
                        <div class="text-center py-6 text-sm text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">No new applications</div>
                    @endif
                </div>
            </div>

            <!-- Column 2: Testing & Interview -->
            <div class="w-80 flex flex-col max-h-full">
                <div class="flex items-center justify-between mb-3 px-1">
                    <h3 class="font-semibold text-gray-800 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span> Testing & Interview
                    </h3>
                    <span class="bg-yellow-100 text-yellow-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ count($groupedApplicants['interview']) }}</span>
                </div>
                <div class="bg-gray-100/50 rounded-xl p-3 flex-1 overflow-y-auto space-y-3 border-t-2 border-yellow-400 shadow-inner">
                    @foreach($groupedApplicants['interview'] as $applicant)
                        @include('livewire.partials.applicant-card', ['applicant' => $applicant])
                    @endforeach
                    @if(empty($groupedApplicants['interview']))
                        <div class="text-center py-6 text-sm text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">No applicants in phase</div>
                    @endif
                </div>
            </div>

            <!-- Column 3: Accepted -->
            <div class="w-80 flex flex-col max-h-full">
                <div class="flex items-center justify-between mb-3 px-1">
                    <h3 class="font-semibold text-gray-800 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span> Accepted
                    </h3>
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ count($groupedApplicants['accepted']) }}</span>
                </div>
                <div class="bg-gray-100/50 rounded-xl p-3 flex-1 overflow-y-auto space-y-3 border-t-2 border-green-500 shadow-inner">
                    @foreach($groupedApplicants['accepted'] as $applicant)
                        @include('livewire.partials.applicant-card', ['applicant' => $applicant])
                    @endforeach
                    @if(empty($groupedApplicants['accepted']))
                        <div class="text-center py-6 text-sm text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">No accepted applicants</div>
                    @endif
                </div>
            </div>

            <!-- Column 4: Rejected -->
            <div class="w-80 flex flex-col max-h-full">
                <div class="flex items-center justify-between mb-3 px-1">
                    <h3 class="font-semibold text-gray-800 flex items-center">
                        <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Rejected
                    </h3>
                    <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-0.5 rounded-full">{{ count($groupedApplicants['rejected']) }}</span>
                </div>
                <div class="bg-gray-100/50 rounded-xl p-3 flex-1 overflow-y-auto space-y-3 border-t-2 border-red-500 shadow-inner">
                    @foreach($groupedApplicants['rejected'] as $applicant)
                        @include('livewire.partials.applicant-card', ['applicant' => $applicant])
                    @endforeach
                    @if(empty($groupedApplicants['rejected']))
                        <div class="text-center py-6 text-sm text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">No rejected applicants</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Registration Modal (Alpine Overlay) -->
    <div x-show="showModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showModal = false"
                     class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-indigo-50 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-user-plus text-indigo-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Register New Student</h3>
                                <p class="text-sm text-gray-500 mt-1">Enter the applicant's details to begin the enrollment process.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" placeholder="e.g., Ahmad Fauzi" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Previous School</label>
                            <input type="text" placeholder="e.g., SMP Negeri 1 Jakarta" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Applied Grade</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
                                <option>Grade 10 - Science</option>
                                <option>Grade 10 - Social</option>
                                <option>Grade 11 - Science</option>
                                <option>Grade 11 - Social</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" @click="showModal = false" class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto transition-colors">Submit Registration</button>
                        <button type="button" @click="showModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
