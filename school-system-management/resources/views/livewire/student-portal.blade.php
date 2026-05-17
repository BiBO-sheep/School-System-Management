<div x-data="{ showCbtModal: false, agreeRules: false }">
    <!-- Student Profile Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 relative overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 -mt-8 -mr-8 opacity-10">
            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#4f46e5" d="M44.7,-76.4C58.2,-69.2,70.6,-58.4,80.5,-44.6C90.4,-30.8,97.8,-13.9,96.3,2.4C94.8,18.7,84.4,34.4,72.5,47.8C60.6,61.2,47.2,72.3,31.9,78.1C16.6,83.9,-2.6,84.4,-19.1,79.8C-35.6,75.2,-51.4,65.5,-63.9,52.4C-76.4,39.3,-85.6,22.8,-88.7,5.4C-91.8,-12,-88.8,-30.3,-79.8,-45.3C-70.8,-60.3,-55.8,-72,-40.4,-78C-25,-84,-9.2,-84.3,3.4,-88.6L44.7,-76.4Z" transform="translate(100 100)" />
            </svg>
        </div>

        <div class="flex flex-col md:flex-row items-center md:items-start justify-between relative z-10 gap-6">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-5">
                <div class="h-20 w-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-3xl font-bold shadow-inner border-4 border-white ring-2 ring-indigo-50">
                    {{ $studentInfo['avatar'] }}
                </div>
                <div class="text-center md:text-left mt-2 md:mt-0">
                    <h1 class="text-2xl font-extrabold text-gray-900">{{ $studentInfo['name'] }}</h1>
                    <p class="text-sm font-medium text-gray-500 mt-1 flex items-center justify-center md:justify-start">
                        <i class="fas fa-layer-group mr-2 text-indigo-400"></i> {{ $studentInfo['grade'] }}
                    </p>
                </div>
            </div>
            
            <div class="flex flex-wrap justify-center md:justify-end gap-3 mt-2 md:mt-0">
                <div class="bg-blue-50 border border-blue-100 rounded-lg px-4 py-2 flex flex-col items-center justify-center w-32">
                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Current GPA</span>
                    <span class="text-xl font-bold text-blue-900">{{ $studentInfo['gpa'] }}</span>
                </div>
                <div class="bg-green-50 border border-green-100 rounded-lg px-4 py-2 flex flex-col items-center justify-center w-32">
                    <span class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-1">Attendance</span>
                    <span class="text-xl font-bold text-green-900">{{ $studentInfo['attendance'] }}</span>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg px-4 py-2 flex flex-col items-center justify-center w-32 shadow-sm">
                    <span class="text-xs font-semibold text-yellow-700 uppercase tracking-wider mb-1">Points 🏆</span>
                    <span class="text-xl font-bold text-yellow-900">{{ $studentInfo['points'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content: 2 Columns -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 mb-8">
        
        <!-- Left Column: My Tasks & Exams -->
        <div class="xl:col-span-7 2xl:col-span-8 space-y-6">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-tasks text-indigo-500 mr-2"></i> My Tasks & Exams
                </h2>
                <span class="text-sm font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">{{ count($pendingTasks) }} Pending</span>
            </div>

            <div class="space-y-4">
                @foreach($pendingTasks as $task)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 hover:shadow-md transition-shadow group relative overflow-hidden">
                    <!-- Accent Line -->
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-{{ $task['color'] }}-500"></div>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pl-2">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-lg bg-{{ $task['color'] }}-50 text-{{ $task['color'] }}-600 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                <i class="fas fa-{{ $task['icon'] }} text-xl"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-{{ $task['color'] }}-700 bg-{{ $task['color'] }}-100 px-2 py-0.5 rounded">
                                        {{ $task['type'] }}
                                    </span>
                                    <span class="text-xs font-medium text-gray-400"><i class="far fa-clock mr-1"></i> Due: {{ $task['due_date'] }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-{{ $task['color'] }}-700 transition-colors">{{ $task['title'] }}</h3>
                                <p class="text-sm text-gray-500 mt-0.5">{{ $task['subject'] }}</p>
                            </div>
                        </div>
                        
                        <div class="w-full sm:w-auto flex justify-end">
                            @if($task['type'] === 'CBT Exam')
                                <button @click="showCbtModal = true" class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md shadow-purple-200 transition-all hover:-translate-y-0.5 flex items-center justify-center">
                                    <i class="fas fa-play mr-2 text-xs"></i> Start CBT Exam
                                </button>
                            @else
                                <button class="w-full sm:w-auto bg-white border-2 border-gray-200 hover:border-indigo-500 text-gray-700 hover:text-indigo-700 px-5 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt mr-2 text-indigo-500"></i> Upload File
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column: Today's Timetable -->
        <div class="xl:col-span-5 2xl:col-span-4">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-full">
                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="far fa-calendar-alt text-indigo-500 mr-2"></i> Today's Timetable
                    </h2>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ date('l, M j') }}</span>
                </div>

                <div class="space-y-4">
                    @foreach($timetable as $class)
                    <div class="flex gap-4 items-start p-3 rounded-xl hover:bg-gray-50 transition-colors border border-transparent {{ $class['status'] === 'Ongoing' ? 'bg-indigo-50/50 border-indigo-100' : '' }}">
                        <div class="w-24 flex-shrink-0 pt-1 text-right">
                            <span class="block text-sm font-bold text-gray-900">{{ explode(' - ', $class['time'])[0] }}</span>
                            <span class="block text-xs font-medium text-gray-500">{{ explode(' - ', $class['time'])[1] }}</span>
                        </div>
                        
                        <div class="flex flex-col items-center justify-start pt-1">
                            <div class="w-3 h-3 rounded-full {{ $class['status'] === 'Ongoing' ? 'bg-indigo-500 ring-4 ring-indigo-100 animate-pulse' : 'bg-gray-300' }}"></div>
                            @if(!$loop->last)
                                <div class="w-0.5 h-full bg-gray-200 mt-2 min-h-[40px]"></div>
                            @endif
                        </div>
                        
                        <div class="flex-1 pb-2">
                            <h4 class="text-base font-bold text-gray-900 {{ $class['status'] === 'Ongoing' ? 'text-indigo-700' : '' }}">{{ $class['subject'] }}</h4>
                            <p class="text-sm font-medium text-gray-600 mt-0.5">{{ $class['teacher'] }}</p>
                            <div class="flex items-center text-xs text-gray-500 mt-2 bg-gray-100 px-2 py-1 rounded w-max">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-1.5"></i> {{ $class['room'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Recent Grades -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h2 class="text-lg font-bold text-gray-900 flex items-center">
                <i class="fas fa-star text-yellow-400 mr-2"></i> Recent Grades
            </h2>
            <button class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View All Transcripts</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white text-gray-400 uppercase text-xs font-semibold border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Assignment / Exam</th>
                        <th class="px-6 py-4">Subject</th>
                        <th class="px-6 py-4">Date Graded</th>
                        <th class="px-6 py-4 text-right">Score</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentGrades as $grade)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-900">{{ $grade['title'] }}</td>
                        <td class="px-6 py-4 font-medium text-gray-600">{{ $grade['subject'] }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $grade['date'] }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-green-100 text-green-800 border border-green-200">
                                {{ $grade['score'] }} / {{ $grade['max_score'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Start CBT Modal (Alpine.js) -->
    <div x-show="showCbtModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak>
        <div x-show="showCbtModal" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showCbtModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-200">
                    
                    <!-- Pre-Exam Header -->
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-5 flex justify-between items-center">
                        <div class="flex items-center text-white">
                            <i class="fas fa-shield-alt text-2xl mr-3 text-purple-200"></i>
                            <h3 class="text-lg font-bold">Pre-Exam Check</h3>
                        </div>
                        <button @click="showCbtModal = false" class="text-purple-200 hover:text-white transition-colors focus:outline-none">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                    
                    <div class="px-6 py-6 space-y-6 bg-white">
                        
                        <div class="text-center">
                            <h2 class="text-xl font-bold text-gray-900 mb-1">Midterm Physics Exam</h2>
                            <p class="text-sm font-medium text-gray-500">Duration: 90 Minutes • Total Questions: 30</p>
                        </div>

                        <!-- Proctoring Warning -->
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-4">
                            <div class="bg-red-100 text-red-600 rounded-full p-2.5 flex-shrink-0 mt-0.5">
                                <i class="fas fa-video text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-800 text-sm mb-1">Proctoring Enabled</h4>
                                <p class="text-xs text-red-700 leading-relaxed">
                                    Your webcam and microphone will be active during this session to ensure academic integrity. Ensure you are in a quiet, well-lit room. Navigating away from the exam tab will be recorded.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Agreement Checkbox -->
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                            <label class="flex items-start cursor-pointer group">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" x-model="agreeRules" class="w-5 h-5 text-purple-600 bg-white border-gray-300 rounded focus:ring-purple-500 focus:ring-2 cursor-pointer transition-colors">
                                </div>
                                <div class="ml-3 text-sm">
                                    <span class="font-medium text-gray-900 group-hover:text-purple-700 transition-colors">I agree to the academic integrity rules</span>
                                    <p class="text-gray-500 text-xs mt-0.5">I confirm that I will not use unauthorized materials or assistance during this examination.</p>
                                </div>
                            </label>
                        </div>

                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 sm:flex sm:flex-row-reverse rounded-b-2xl">
                        <button type="button" 
                                :disabled="!agreeRules"
                                :class="agreeRules ? 'bg-purple-600 hover:bg-purple-700 text-white shadow-md shadow-purple-200 hover:-translate-y-0.5' : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                                class="inline-flex w-full justify-center rounded-lg px-5 py-2.5 text-sm font-bold transition-all sm:ml-3 sm:w-auto focus:outline-none">
                            <i class="fas fa-lock-open mr-2 mt-0.5" x-show="agreeRules"></i>
                            <i class="fas fa-lock mr-2 mt-0.5" x-show="!agreeRules"></i>
                            Begin Exam
                        </button>
                        <button type="button" @click="showCbtModal = false" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 hover:text-gray-900 sm:mt-0 sm:w-auto transition-colors">
                            Return to Dashboard
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
