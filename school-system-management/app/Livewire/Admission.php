<?php

namespace App\Livewire;

use Livewire\Component;

class Admission extends Component
{
    public array $applicants = [];
    public array $groupedApplicants = [];
    public array $metrics = [];

    public function mount()
    {
        // Mock data for applicants
        $this->applicants = [
            [
                'id' => 'REG-2026-001',
                'name' => 'Ahmad Fauzi',
                'grade' => 'Grade 10 - Science',
                'previous_school' => 'SMP Negeri 1 Jakarta',
                'status' => 'new',
                'date' => '10 May 2026',
            ],
            [
                'id' => 'REG-2026-002',
                'name' => 'Siti Nurhaliza',
                'grade' => 'Grade 10 - Social',
                'previous_school' => 'SMP IT Al-Hikmah',
                'status' => 'interview',
                'date' => '11 May 2026',
            ],
            [
                'id' => 'REG-2026-003',
                'name' => 'Budi Santoso',
                'grade' => 'Grade 11 - Science',
                'previous_school' => 'SMP Muhammadiyah 2',
                'status' => 'accepted',
                'date' => '05 May 2026',
            ],
            [
                'id' => 'REG-2026-004',
                'name' => 'Dewi Lestari',
                'grade' => 'Grade 10 - Science',
                'previous_school' => 'SMP Negeri 5 Bandung',
                'status' => 'rejected',
                'date' => '02 May 2026',
            ],
            [
                'id' => 'REG-2026-005',
                'name' => 'Rizky Pratama',
                'grade' => 'Grade 10 - Social',
                'previous_school' => 'SMP Taruna Bakti',
                'status' => 'new',
                'date' => '12 May 2026',
            ],
            [
                'id' => 'REG-2026-006',
                'name' => 'Nadia Putri',
                'grade' => 'Grade 11 - Social',
                'previous_school' => 'SMP Pelita Harapan',
                'status' => 'interview',
                'date' => '13 May 2026',
            ],
            [
                'id' => 'REG-2026-007',
                'name' => 'Agus Setiawan',
                'grade' => 'Grade 10 - Science',
                'previous_school' => 'SMP Negeri 1 Surabaya',
                'status' => 'new',
                'date' => '14 May 2026',
            ],
            [
                'id' => 'REG-2026-008',
                'name' => 'Kartika Sari',
                'grade' => 'Grade 10 - Science',
                'previous_school' => 'SMP BPK Penabur',
                'status' => 'accepted',
                'date' => '04 May 2026',
            ],
        ];

        // Group applicants by status
        $this->groupedApplicants = [
            'new' => array_filter($this->applicants, fn($a) => $a['status'] === 'new'),
            'interview' => array_filter($this->applicants, fn($a) => $a['status'] === 'interview'),
            'accepted' => array_filter($this->applicants, fn($a) => $a['status'] === 'accepted'),
            'rejected' => array_filter($this->applicants, fn($a) => $a['status'] === 'rejected'),
        ];

        // Calculate metrics
        $this->metrics = [
            'total' => count($this->applicants),
            'under_review' => count($this->groupedApplicants['new']) + count($this->groupedApplicants['interview']),
            'accepted' => count($this->groupedApplicants['accepted']),
            'rejected' => count($this->groupedApplicants['rejected']),
        ];
    }

    public function render()
    {
        return view('livewire.admission')->title('Admission (PPDB) | EduCore');
    }
}
