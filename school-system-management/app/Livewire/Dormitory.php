<?php

namespace App\Livewire;

use Livewire\Component;

class Dormitory extends Component
{
    public array $stats = [];
    public array $rooms = [];
    public array $tahfidzRecords = [];
    public array $disciplineRecords = [];

    public function mount()
    {
        // Mock Statistics
        $this->stats = [
            'total_boarders' => 850,
            'available_beds' => 45,
            'active_passes' => 12,
        ];

        // Mock Room Allocation Data
        $this->rooms = [
            [
                'id' => 'A-101',
                'name' => 'Room A-101',
                'type' => 'Male',
                'capacity' => 6,
                'filled' => 6,
                'supervisor' => 'Ust. Ahmad'
            ],
            [
                'id' => 'A-102',
                'name' => 'Room A-102',
                'type' => 'Male',
                'capacity' => 6,
                'filled' => 4,
                'supervisor' => 'Ust. Ahmad'
            ],
            [
                'id' => 'B-205',
                'name' => 'Room B-205',
                'type' => 'Female',
                'capacity' => 4,
                'filled' => 4,
                'supervisor' => 'Usth. Fatimah'
            ],
            [
                'id' => 'B-206',
                'name' => 'Room B-206',
                'type' => 'Female',
                'capacity' => 4,
                'filled' => 2,
                'supervisor' => 'Usth. Fatimah'
            ],
            [
                'id' => 'C-301',
                'name' => 'Room C-301',
                'type' => 'Male',
                'capacity' => 8,
                'filled' => 8,
                'supervisor' => 'Ust. Budi'
            ],
            [
                'id' => 'C-302',
                'name' => 'Room C-302',
                'type' => 'Male',
                'capacity' => 8,
                'filled' => 7,
                'supervisor' => 'Ust. Budi'
            ],
        ];

        // Mock Tahfidz Progress Data
        $this->tahfidzRecords = [
            [
                'student_name' => 'Budi Santoso',
                'grade' => 'Grade 10',
                'juz_memorized' => 15,
                'total_juz' => 30,
                'last_deposit' => '12 May 2026',
                'status' => 'On Track'
            ],
            [
                'student_name' => 'Siti Nurhaliza',
                'grade' => 'Grade 11',
                'juz_memorized' => 5,
                'total_juz' => 30,
                'last_deposit' => '13 May 2026',
                'status' => 'Needs Attention'
            ],
            [
                'student_name' => 'Ahmad Fauzi',
                'grade' => 'Grade 12',
                'juz_memorized' => 30,
                'total_juz' => 30,
                'last_deposit' => '10 May 2026',
                'status' => 'Completed'
            ],
            [
                'student_name' => 'Dewi Lestari',
                'grade' => 'Grade 10',
                'juz_memorized' => 12,
                'total_juz' => 30,
                'last_deposit' => '14 May 2026',
                'status' => 'On Track'
            ],
        ];

        // Mock Passes & Discipline Data
        $this->disciplineRecords = [
            [
                'student_name' => 'Rizky Pratama',
                'type' => 'Exit Pass',
                'details' => 'Family Event (Wedding)',
                'date' => '14 May 2026 - 16 May 2026',
                'status' => 'Active'
            ],
            [
                'student_name' => 'Agus Setiawan',
                'type' => 'Violation',
                'details' => 'Using mobile phone during study hour',
                'date' => '12 May 2026',
                'status' => 'Resolved'
            ],
            [
                'student_name' => 'Nadia Putri',
                'type' => 'Exit Pass',
                'details' => 'Medical checkup (Hospital)',
                'date' => '13 May 2026 (1 Day)',
                'status' => 'Returned'
            ],
            [
                'student_name' => 'Budi Santoso',
                'type' => 'Violation',
                'details' => 'Late for subuh prayer',
                'date' => '10 May 2026',
                'status' => 'Pending Action'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.dormitory')->title('Dormitory & Pesantren | EduCore');
    }
}
