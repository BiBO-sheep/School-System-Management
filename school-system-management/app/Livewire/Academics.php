<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\SchoolClass;

class Academics extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedGrade = '';

    public array $subjects = [
        ['name' => 'Mathematics', 'teacher' => 'Mr. Hendra', 'curriculum' => 'National 2026'],
        ['name' => 'Physics', 'teacher' => 'Mrs. Ratna', 'curriculum' => 'National 2026'],
        ['name' => 'Biology', 'teacher' => 'Dr. Wahyudi', 'curriculum' => 'National 2026'],
        ['name' => 'English Literature', 'teacher' => 'Ms. Sarah', 'curriculum' => 'Cambridge'],
        ['name' => 'Indonesian History', 'teacher' => 'Mr. Bambang', 'curriculum' => 'National 2026'],
        ['name' => 'Computer Science', 'teacher' => 'Mr. Aditya', 'curriculum' => 'Cambridge'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedGrade()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Student::with(['user', 'schoolClass']);

        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('nisn', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function($qUser) {
                      $qUser->where('name', 'like', '%' . $this->search . '%');
                  });
            });
        }

        if (!empty($this->selectedGrade)) {
            $query->whereHas('schoolClass', function($qClass) {
                $qClass->where('name', $this->selectedGrade);
            });
        }

        return view('livewire.academics', [
            'students' => $query->paginate(10),
            'classes' => SchoolClass::orderBy('name')->pluck('name'),
        ])->title('Academics & Curriculum | EduCore');
    }
}
