<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public array $stats = [];
    public array $recentAdmissions = [];

    public function mount()
    {
        // Simulate Eloquent Database Query Data
        $this->stats = [
            'total_students' => 1248,
            'student_growth_percentage' => 12,
            'total_teachers' => 86,
            'new_teachers' => 4,
            'tuition_collected' => '480M',
            'tuition_target_percentage' => 85,
            'attendance_today' => 96.5,
            'attendance_drop' => 1.2,
        ];

        $this->recentAdmissions = [
            [
                'id' => 'REG-26001',
                'name' => 'Ahmad Fauzi',
                'initial' => 'A',
                'color' => 'indigo',
                'grade' => 'Grade 10 - Science',
                'date' => '14 May 2026',
                'status' => 'Accepted',
                'status_color' => 'green'
            ],
            [
                'id' => 'REG-26002',
                'name' => 'Siti Nurhaliza',
                'initial' => 'S',
                'color' => 'pink',
                'grade' => 'Grade 10 - Social',
                'date' => '14 May 2026',
                'status' => 'Under Review',
                'status_color' => 'yellow'
            ],
            [
                'id' => 'REG-26003',
                'name' => 'Budi Santoso',
                'initial' => 'B',
                'color' => 'blue',
                'grade' => 'Grade 11 - Science',
                'date' => '13 May 2026',
                'status' => 'Interview',
                'status_color' => 'blue'
            ],
            [
                'id' => 'REG-26004',
                'name' => 'Dewi Lestari',
                'initial' => 'D',
                'color' => 'purple',
                'grade' => 'Grade 10 - Science',
                'date' => '12 May 2026',
                'status' => 'Rejected',
                'status_color' => 'red'
            ],
            [
                'id' => 'REG-26005',
                'name' => 'Rizky Pratama',
                'initial' => 'R',
                'color' => 'orange',
                'grade' => 'Grade 12 - Social',
                'date' => '10 May 2026',
                'status' => 'Accepted',
                'status_color' => 'green'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.dashboard')->title('Dashboard & Analytics | EduCore');
    }
}
