<div x-data="{ showCbtModal: false }">
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-md p-8 mb-8 text-white relative overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 -mt-16 -mr-16 opacity-20">
            <svg width="300" height="300" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" d="M42.7,-73.4C56.2,-67.2,68.6,-56.4,78.5,-42.6C88.4,-28.8,95.8,-11.9,94.3,4.4C92.8,20.7,82.4,36.4,70.5,49.8C58.6,63.2,45.2,74.3,29.9,80.1C14.6,85.9,-2.6,86.4,-19.1,81.8C-35.6,77.2,-51.4,67.5,-63.9,54.4C-76.4,41.3,-85.6,24.8,-88.7,7.4C-91.8,-10,-88.8,-28.3,-79.8,-43.3C-70.8,-58.3,-55.8,-70,-40.4,-76C-25,-82,-9.2,-82.3,3.4,-86.6L42.7,-73.4Z" transform="translate(100 100)" />
            </svg>
        </div>
        
        <div class="relative z-10">
            <p class="text-indigo-100 font-medium tracking-wide text-sm mb-1 uppercase">{{ $currentDate }}</p>
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">Welcome back, Mr. Budi!</h1>
            <p class="text-indigo-100 text-lg max-w-xl">You have <span class="font-bold text-white">3 classes</span> scheduled today and <span class="font-bold text-white">12 ungraded assignments</span> waiting for your review.</p>
        </div>
    </div>

    <!-- Quick Actions Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Upload Action -->
        <button class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-left hover:border-blue-300 hover:shadow-md transition-all group focus:outline-none focus:ring-2 focus:ring-blue-500">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-file-upload text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">Upload Study Material</h3>
            <p class="text-xs text-gray-500 mt-1">Share PDFs, slides, or links</p>
        </button>

        <!-- Create CBT Action -->
        <button @click="showCbtModal = true" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-left hover:border-purple-300 hover:shadow-md transition-all group focus:outline-none focus:ring-2 focus:ring-purple-500">
            <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-laptop-code text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 group-hover:text-purple-700 transition-colors">Create CBT Exam</h3>
            <p class="text-xs text-gray-500 mt-1">Setup online quizzes or exams</p>
        </button>

        <!-- Input Grades Action -->
        <button class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-left hover:border-green-300 hover:shadow-md transition-all group focus:outline-none focus:ring-2 focus:ring-green-500">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-award text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition-colors">Input Grades</h3>
            <p class="text-xs text-gray-500 mt-1">Record scores to gradebook</p>
        </button>

        <!-- Mark Attendance Action -->
        <button class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 text-left hover:border-orange-300 hover:shadow-md transition-all group focus:outline-none focus:ring-2 focus:ring-orange-500">
            <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i class="fas fa-user-check text-xl"></i>
            </div>
            <h3 class="font-semibold text-gray-900 group-hover:text-orange-700 transition-colors">Mark Attendance</h3>
            <p class="text-xs text-gray-500 mt-1">Record daily presences</p>
        </button>
    </div>

    <!-- Split Layout: Schedule & Tasks -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Today's Schedule -->
        <div class="lg:col-span-5 xl:col-span-4">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Today's Schedule</h2>
                    <button class="text-indigo-600 text-sm font-medium hover:text-indigo-800">View Full</button>
                </div>

                <div class="relative border-l-2 border-gray-100 ml-3 space-y-8 pb-4">
                    @foreach($schedule as $class)
                    <div class="relative pl-6">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-{{ $class['color'] }}-100 border-2 border-{{ $class['color'] }}-500 ring-4 ring-white"></div>
                        
                        <div>
                            <span class="text-xs font-bold text-{{ $class['color'] }}-600 mb-1 block tracking-wide">{{ $class['time'] }}</span>
                            <h3 class="text-base font-bold text-gray-900">{{ $class['subject'] }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5 font-medium">{{ $class['class'] }}</p>
                            
                            <div class="flex items-center text-xs text-gray-500 mt-2 space-x-3">
                                <span class="flex items-center bg-gray-50 px-2 py-1 rounded text-gray-600">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1.5"></i> {{ $class['room'] }}
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-door-open text-gray-400 mr-1.5"></i> {{ $class['type'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Active Assignments & CBT -->
        <div class="lg:col-span-7 xl:col-span-8">
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 h-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-gray-900">Active Assignments & Exams</h2>
                    <div class="flex space-x-2">
                        <button class="text-gray-400 hover:text-indigo-600"><i class="fas fa-filter"></i></button>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach($activeTasks as $task)
                    <div class="group border border-gray-100 rounded-xl p-5 hover:border-indigo-200 hover:shadow-sm transition-all bg-white">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <div class="flex items-center space-x-2 mb-1.5">
                                    @if($task['type'] === 'Exam')
                                        <span class="bg-purple-100 text-purple-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">Exam</span>
                                    @elseif($task['type'] === 'Homework')
                                        <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">Homework</span>
                                    @else
                                        <span class="bg-green-100 text-green-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">Project</span>
                                    @endif
                                    <span class="text-xs text-gray-400 font-medium flex items-center"><i class="far fa-clock mr-1"></i> Due: {{ $task['due_date'] }}</span>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 group-hover:text-indigo-700 transition-colors">{{ $task['title'] }}</h3>
                            </div>
                            <button class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                Review
                            </button>
                        </div>
                        
                        <!-- Progress Bar Section -->
                        <div>
                            <div class="flex justify-between text-xs mb-1">
                                <span class="font-medium text-gray-700">Submissions</span>
                                <span class="font-bold text-gray-900">{{ $task['submitted'] }} <span class="text-gray-400 font-normal">/ {{ $task['total'] }} Students</span></span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-indigo-500 h-2 rounded-full transition-all duration-500" style="width: {{ $task['progress'] }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- Create CBT Modal (Alpine.js) -->
    <div x-show="showCbtModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showCbtModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showCbtModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     @click.away="showCbtModal = false"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-200">
                    
                    <!-- Modal Header -->
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div class="flex items-center text-gray-900">
                            <div class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                <i class="fas fa-laptop-code text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold" id="modal-title">Create New CBT Exam</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Setup a new computer-based test for your classes.</p>
                            </div>
                        </div>
                        <button @click="showCbtModal = false" class="text-gray-400 hover:text-gray-600 transition-colors focus:outline-none p-2 rounded-full hover:bg-gray-100">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <!-- Modal Body Form -->
                    <div class="px-6 py-6 space-y-5 bg-gray-50/50">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Exam Title</label>
                            <input type="text" placeholder="e.g., Final Semester Mathematics" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm transition-shadow">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subject</label>
                                <select class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white shadow-sm appearance-none">
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Duration (Minutes)</label>
                                <input type="number" placeholder="90" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 shadow-sm font-mono">
                            </div>
                        </div>

                        <!-- AI Generation Banner -->
                        <div class="bg-gradient-to-r from-fuchsia-50 to-purple-50 border border-purple-200 rounded-xl p-5 flex flex-col sm:flex-row items-center justify-between gap-4 mt-2">
                            <div>
                                <h4 class="text-sm font-bold text-purple-900 flex items-center">
                                    <i class="fas fa-sparkles text-purple-500 mr-2"></i> Smart Question Generator
                                </h4>
                                <p class="text-xs text-purple-700 mt-1">Let our AI draft multiple-choice questions based on your syllabus.</p>
                            </div>
                            <button type="button" class="bg-purple-600 hover:bg-purple-700 text-white shadow-md shadow-purple-200 px-4 py-2 rounded-lg text-sm font-bold transition-all hover:-translate-y-0.5 w-full sm:w-auto whitespace-nowrap">
                                Generate with AI 🪄
                            </button>
                        </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="bg-white px-6 py-4 border-t border-gray-100 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="button" @click="showCbtModal = false" class="inline-flex w-full justify-center rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-gray-800 sm:ml-3 sm:w-auto transition-colors">
                            Save Exam Setup
                        </button>
                        <button type="button" @click="showCbtModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
