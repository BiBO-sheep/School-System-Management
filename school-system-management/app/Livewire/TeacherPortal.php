<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TeacherPortal extends Component
{
    public array $schedule = [];
    public array $activeTasks = [];
    public string $currentDate = '';

    public function mount()
    {
        $this->currentDate = Carbon::now()->format('l, j F Y');

        // Mock Data for Today's Schedule (Timeline)
        $this->schedule = [
            [
                'time' => '08:00 AM - 09:30 AM',
                'subject' => 'Mathematics (Advanced)',
                'class' => 'Grade 10 - Science 1',
                'room' => 'Room 402',
                'type' => 'Classroom',
                'color' => 'blue'
            ],
            [
                'time' => '10:00 AM - 11:30 AM',
                'subject' => 'Physics',
                'class' => 'Grade 11 - Science 2',
                'room' => 'Lab 2',
                'type' => 'Laboratory',
                'color' => 'purple'
            ],
            [
                'time' => '12:30 PM - 02:00 PM',
                'subject' => 'Mathematics (Core)',
                'class' => 'Grade 10 - Social 1',
                'room' => 'Room 305',
                'type' => 'Classroom',
                'color' => 'green'
            ],
        ];

        // Mock Data for Active Assignments / CBT
        $this->activeTasks = [
            [
                'title' => 'Midterm Physics Exam (CBT)',
                'type' => 'Exam',
                'due_date' => 'Today, 11:59 PM',
                'submitted' => 28,
                'total' => 30,
                'progress' => 93, // Percentage
                'status' => 'Active',
            ],
            [
                'title' => 'Calculus Chapter 4 Assignment',
                'type' => 'Homework',
                'due_date' => 'Tomorrow, 08:00 AM',
                'submitted' => 15,
                'total' => 32,
                'progress' => 46, // Percentage
                'status' => 'Ongoing',
            ],
            [
                'title' => 'Science Project Proposal',
                'type' => 'Project',
                'due_date' => 'In 3 days',
                'submitted' => 30,
                'total' => 30,
                'progress' => 100, // Percentage
                'status' => 'Needs Grading',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.teacher-portal')->title('Teacher Portal | EduCore');
    }
}
