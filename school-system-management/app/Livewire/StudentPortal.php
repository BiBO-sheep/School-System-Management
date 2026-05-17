<?php

namespace App\Livewire;

use Livewire\Component;

class StudentPortal extends Component
{
    public array $studentInfo = [];
    public array $pendingTasks = [];
    public array $timetable = [];
    public array $recentGrades = [];

    public function mount()
    {
        // Mock Student Info
        $this->studentInfo = [
            'name' => 'Ahmad Fauzi',
            'grade' => 'Grade 10 - Science 1',
            'avatar' => 'A',
            'gpa' => '3.8',
            'attendance' => '98%',
            'points' => '1,250'
        ];

        // Mock Pending Tasks & Exams
        $this->pendingTasks = [
            [
                'id' => 1,
                'title' => 'Midterm Physics Exam',
                'type' => 'CBT Exam',
                'due_date' => 'Today, 11:59 PM',
                'subject' => 'Physics',
                'icon' => 'laptop-code',
                'color' => 'purple'
            ],
            [
                'id' => 2,
                'title' => 'Calculus Chapter 4 Exercises',
                'type' => 'Homework',
                'due_date' => 'Tomorrow, 08:00 AM',
                'subject' => 'Mathematics',
                'icon' => 'file-alt',
                'color' => 'blue'
            ],
            [
                'id' => 3,
                'title' => 'Biology Cell Structure Essay',
                'type' => 'Assignment',
                'due_date' => 'Friday, 11:59 PM',
                'subject' => 'Biology',
                'icon' => 'flask',
                'color' => 'green'
            ]
        ];

        // Mock Today's Timetable
        $this->timetable = [
            [
                'time' => '08:00 AM - 09:30 AM',
                'subject' => 'Mathematics (Advanced)',
                'teacher' => 'Mr. Hendra',
                'room' => 'Room 402',
                'status' => 'Ongoing',
                'color' => 'indigo'
            ],
            [
                'time' => '10:00 AM - 11:30 AM',
                'subject' => 'Physics',
                'teacher' => 'Mrs. Ratna',
                'room' => 'Lab 2',
                'status' => 'Upcoming',
                'color' => 'blue'
            ],
            [
                'time' => '12:30 PM - 02:00 PM',
                'subject' => 'English Literature',
                'teacher' => 'Ms. Sarah',
                'room' => 'Room 305',
                'status' => 'Upcoming',
                'color' => 'rose'
            ],
        ];

        // Mock Recent Grades
        $this->recentGrades = [
            [
                'title' => 'Mathematics Quiz 3',
                'subject' => 'Mathematics',
                'date' => 'May 12, 2026',
                'score' => 95,
                'max_score' => 100,
                'status' => 'Excellent'
            ],
            [
                'title' => 'History Essay: Independence',
                'subject' => 'Indonesian History',
                'date' => 'May 10, 2026',
                'score' => 88,
                'max_score' => 100,
                'status' => 'Good'
            ],
            [
                'title' => 'Physics Lab Report',
                'subject' => 'Physics',
                'date' => 'May 05, 2026',
                'score' => 92,
                'max_score' => 100,
                'status' => 'Excellent'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.student-portal')->title('Student Portal | EduCore');
    }
}
