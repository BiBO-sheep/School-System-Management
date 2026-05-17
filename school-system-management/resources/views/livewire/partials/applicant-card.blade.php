<div class="bg-white rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow border border-gray-100 cursor-grab active:cursor-grabbing relative group">
    
    <!-- Action Dropdown (UI only) -->
    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
        <button class="text-gray-400 hover:text-indigo-600 p-1 rounded-md hover:bg-indigo-50 transition-colors focus:outline-none">
            <i class="fas fa-ellipsis-h text-sm"></i>
        </button>
    </div>

    <!-- Applicant Info -->
    <div class="flex flex-col gap-2">
        <div>
            <h4 class="text-sm font-bold text-gray-900 pr-6">{{ $applicant['name'] }}</h4>
            <span class="text-xs font-mono text-gray-500">{{ $applicant['id'] }}</span>
        </div>
        
        <div class="mt-1">
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-gray-100 text-gray-700 border border-gray-200">
                <i class="fas fa-layer-group text-gray-400 mr-1.5"></i> {{ $applicant['grade'] }}
            </span>
        </div>
        
        <div class="mt-2 pt-3 border-t border-gray-50 flex items-center justify-between text-xs text-gray-500">
            <div class="flex items-center truncate pr-2" title="{{ $applicant['previous_school'] }}">
                <i class="fas fa-school text-gray-400 mr-1.5 w-3"></i>
                <span class="truncate">{{ $applicant['previous_school'] }}</span>
            </div>
        </div>
        <div class="flex items-center text-[10px] text-gray-400 mt-0.5">
            <i class="far fa-calendar-alt text-gray-300 mr-1.5 w-3"></i> Applied: {{ $applicant['date'] }}
        </div>
    </div>
</div>
