<?php

namespace App\Livewire;

use Livewire\Component;

class ParentPortal extends Component
{
    public array $children = [];
    public int $selectedChildId = 1;

    public function mount()
    {
        // Mock Children Data
        $this->children = [
            1 => [
                'id' => 1,
                'name' => 'Ahmad Fauzi',
                'grade' => 'Grade 10 - Science 1',
                'avatar' => 'A',
                'homeroom_teacher' => 'Mr. Hendra Pratama',
                
                'academic' => [
                    'gpa' => '3.85',
                    'average_score' => '92/100',
                    'rank' => '4th in Class'
                ],
                'attendance' => [
                    'status_today' => 'Present',
                    'total_absences' => 2,
                    'total_late' => 1,
                ],
                'billing' => [
                    'outstanding_balance' => 0,
                    'status' => 'Paid in Full',
                    'next_due' => '-'
                ],
                'timeline' => [
                    ['type' => 'grade', 'icon' => 'award', 'color' => 'green', 'text' => 'Scored 95 on Mathematics Midterm', 'time' => 'Today, 10:30 AM'],
                    ['type' => 'attendance', 'icon' => 'user-check', 'color' => 'blue', 'text' => 'Arrived at school (06:45 AM)', 'time' => 'Today, 06:45 AM'],
                    ['type' => 'billing', 'icon' => 'file-invoice-dollar', 'color' => 'indigo', 'text' => 'Tuition Fee for May 2026 Paid', 'time' => 'May 02, 2026'],
                    ['type' => 'general', 'icon' => 'bell', 'color' => 'gray', 'text' => 'Science Project Proposal Submitted', 'time' => 'April 28, 2026'],
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Siti Aminah',
                'grade' => 'Grade 7 - A',
                'avatar' => 'S',
                'homeroom_teacher' => 'Mrs. Fatimah Az Zahra',
                
                'academic' => [
                    'gpa' => '3.60',
                    'average_score' => '85/100',
                    'rank' => '12th in Class'
                ],
                'attendance' => [
                    'status_today' => 'Absent',
                    'total_absences' => 5,
                    'total_late' => 3,
                ],
                'billing' => [
                    'outstanding_balance' => 1500000,
                    'status' => 'Overdue',
                    'next_due' => 'Due in 5 Days'
                ],
                'timeline' => [
                    ['type' => 'attendance', 'icon' => 'user-times', 'color' => 'red', 'text' => 'Marked Absent (Excused - Sick)', 'time' => 'Today, 07:15 AM'],
                    ['type' => 'billing', 'icon' => 'exclamation-circle', 'color' => 'orange', 'text' => 'Invoice INV-2026-0502 Generated', 'time' => 'May 01, 2026'],
                    ['type' => 'grade', 'icon' => 'award', 'color' => 'green', 'text' => 'Scored 88 on English Literature Quiz', 'time' => 'April 29, 2026'],
                    ['type' => 'attendance', 'icon' => 'clock', 'color' => 'yellow', 'text' => 'Marked Late for First Period', 'time' => 'April 25, 2026'],
                ]
            ]
        ];
    }

    public function selectChild($childId)
    {
        if (isset($this->children[$childId])) {
            $this->selectedChildId = $childId;
        }
    }

    public function render()
    {
        return view('livewire.parent-portal', [
            'child' => $this->children[$this->selectedChildId],
            'allChildren' => collect($this->children)->values()
        ])->title('Parent Portal | EduCore');
    }
}
