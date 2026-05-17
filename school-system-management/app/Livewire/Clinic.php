<?php

namespace App\Livewire;

use Livewire\Component;

class Clinic extends Component
{
    public array $metrics = [];
    public array $recentVisits = [];
    public array $inventory = [];

    public function mount()
    {
        // Mock Clinic Metrics
        $this->metrics = [
            'visits_today' => 12,
            'currently_resting' => 2,
            'low_stock_medicines' => 5,
        ];

        // Mock Visit Logs
        $this->recentVisits = [
            [
                'id' => 'VST-001',
                'date_time' => '14 May 2026, 10:15 AM',
                'student_name' => 'Budi Santoso',
                'grade' => 'Grade 10',
                'symptoms' => 'High Fever, Headache',
                'action_taken' => 'Given Paracetamol, resting in bed 1',
                'status' => 'Resting'
            ],
            [
                'id' => 'VST-002',
                'date_time' => '14 May 2026, 09:30 AM',
                'student_name' => 'Siti Aminah',
                'grade' => 'Grade 7',
                'symptoms' => 'Stomachache, Nausea',
                'action_taken' => 'Given Antacid, parents contacted',
                'status' => 'Sent Home'
            ],
            [
                'id' => 'VST-003',
                'date_time' => '14 May 2026, 08:45 AM',
                'student_name' => 'Ahmad Fauzi',
                'grade' => 'Grade 10',
                'symptoms' => 'Minor cut on knee during PE',
                'action_taken' => 'Wound cleaned, applied bandage',
                'status' => 'Returned to Class'
            ],
            [
                'id' => 'VST-004',
                'date_time' => '13 May 2026, 02:20 PM',
                'student_name' => 'Nadia Putri',
                'grade' => 'Grade 11',
                'symptoms' => 'Dizziness',
                'action_taken' => 'Given warm tea, rested for 30 mins',
                'status' => 'Returned to Class'
            ],
        ];

        // Mock Medicine Inventory
        $this->inventory = [
            [
                'item_name' => 'Paracetamol 500mg',
                'category' => 'Painkiller / Fever',
                'stock_level' => 150,
                'unit' => 'Tablets'
            ],
            [
                'item_name' => 'Antacid Syrup',
                'category' => 'Digestive',
                'stock_level' => 12,
                'unit' => 'Bottles'
            ],
            [
                'item_name' => 'Sterile Bandages',
                'category' => 'First Aid',
                'stock_level' => 45,
                'unit' => 'Pcs'
            ],
            [
                'item_name' => 'Antiseptic Liquid (Betadine)',
                'category' => 'First Aid',
                'stock_level' => 8,
                'unit' => 'Bottles'
            ],
            [
                'item_name' => 'Eucalyptus Oil (Minyak Kayu Putih)',
                'category' => 'Ointment',
                'stock_level' => 18,
                'unit' => 'Bottles'
            ],
            [
                'item_name' => 'Vitamin C 1000mg',
                'category' => 'Supplement',
                'stock_level' => 85,
                'unit' => 'Tablets'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.clinic')->title('Health & Clinic | EduCore');
    }
}
