<?php

namespace App\Livewire;

use Livewire\Component;

class Academics extends Component
{
    public $search = '';
    public $selectedGrade = '';

    public array $classes = [
        'Grade 10 - Science 1',
        'Grade 10 - Science 2',
        'Grade 10 - Social 1',
        'Grade 11 - Science 1',
        'Grade 11 - Social 1',
        'Grade 12 - Science 1',
    ];

    public array $subjects = [
        ['name' => 'Mathematics', 'teacher' => 'Mr. Hendra', 'curriculum' => 'National 2026'],
        ['name' => 'Physics', 'teacher' => 'Mrs. Ratna', 'curriculum' => 'National 2026'],
        ['name' => 'Biology', 'teacher' => 'Dr. Wahyudi', 'curriculum' => 'National 2026'],
        ['name' => 'English Literature', 'teacher' => 'Ms. Sarah', 'curriculum' => 'Cambridge'],
        ['name' => 'Indonesian History', 'teacher' => 'Mr. Bambang', 'curriculum' => 'National 2026'],
        ['name' => 'Computer Science', 'teacher' => 'Mr. Aditya', 'curriculum' => 'Cambridge'],
    ];

    // Simulating database records
    private function getStudents()
    {
        $allStudents = [
            [
                'id' => 'STU-23001',
                'name' => 'Budi Santoso',
                'grade' => 'Grade 10 - Science 1',
                'gender' => 'Male',
                'contact' => '+62 812-3456-7890',
                'avatar' => 'B'
            ],
            [
                'id' => 'STU-23002',
                'name' => 'Siti Aminah',
                'grade' => 'Grade 10 - Science 1',
                'gender' => 'Female',
                'contact' => '+62 813-4567-8901',
                'avatar' => 'S'
            ],
            [
                'id' => 'STU-23003',
                'name' => 'Rizky Pratama',
                'grade' => 'Grade 10 - Social 1',
                'gender' => 'Male',
                'contact' => '+62 814-5678-9012',
                'avatar' => 'R'
            ],
            [
                'id' => 'STU-22001',
                'name' => 'Dewi Lestari',
                'grade' => 'Grade 11 - Science 1',
                'gender' => 'Female',
                'contact' => '+62 815-6789-0123',
                'avatar' => 'D'
            ],
            [
                'id' => 'STU-22002',
                'name' => 'Agus Setiawan',
                'grade' => 'Grade 11 - Social 1',
                'gender' => 'Male',
                'contact' => '+62 816-7890-1234',
                'avatar' => 'A'
            ],
            [
                'id' => 'STU-21001',
                'name' => 'Nadia Putri',
                'grade' => 'Grade 12 - Science 1',
                'gender' => 'Female',
                'contact' => '+62 817-8901-2345',
                'avatar' => 'N'
            ],
        ];

        return collect($allStudents)
            ->filter(function ($student) {
                // Filter by search
                if (!empty($this->search)) {
                    return stripos($student['name'], $this->search) !== false || 
                           stripos($student['id'], $this->search) !== false;
                }
                return true;
            })
            ->filter(function ($student) {
                // Filter by grade
                if (!empty($this->selectedGrade)) {
                    return $student['grade'] === $this->selectedGrade;
                }
                return true;
            })
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.academics', [
            'students' => $this->getStudents(),
        ])->title('Academics & Curriculum | EduCore');
    }
}
