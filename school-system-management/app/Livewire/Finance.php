<?php

namespace App\Livewire;

use Livewire\Component;

class Finance extends Component
{
    public array $metrics = [];
    public array $invoices = [];

    public function mount()
    {
        // Mock Financial Metrics
        $this->metrics = [
            'total_collected' => 450000000,
            'outstanding_balance' => 125500000,
            'pending_invoices' => 38
        ];

        // Mock Invoices Data
        $this->invoices = [
            [
                'id' => 'INV-2026-0501',
                'student_name' => 'Budi Santoso',
                'description' => 'Tuition Fee - May 2026',
                'amount' => 1500000,
                'status' => 'Paid',
                'date' => '02 May 2026'
            ],
            [
                'id' => 'INV-2026-0502',
                'student_name' => 'Siti Aminah',
                'description' => 'Tuition Fee - May 2026',
                'amount' => 1500000,
                'status' => 'Pending',
                'date' => '05 May 2026'
            ],
            [
                'id' => 'INV-2026-0415',
                'student_name' => 'Agus Setiawan',
                'description' => 'Annual Development Fee',
                'amount' => 5000000,
                'status' => 'Overdue',
                'date' => '15 Apr 2026'
            ],
            [
                'id' => 'INV-2026-0503',
                'student_name' => 'Dewi Lestari',
                'description' => 'Tuition Fee - May 2026',
                'amount' => 1500000,
                'status' => 'Paid',
                'date' => '06 May 2026'
            ],
            [
                'id' => 'INV-2026-0504',
                'student_name' => 'Rizky Pratama',
                'description' => 'Extracurricular Fee - Q2',
                'amount' => 350000,
                'status' => 'Pending',
                'date' => '08 May 2026'
            ],
            [
                'id' => 'INV-2026-0320',
                'student_name' => 'Nadia Putri',
                'description' => 'Tuition Fee - April 2026',
                'amount' => 1500000,
                'status' => 'Overdue',
                'date' => '20 Mar 2026'
            ],
            [
                'id' => 'INV-2026-0505',
                'student_name' => 'Ahmad Fauzi',
                'description' => 'Tuition Fee - May 2026',
                'amount' => 1500000,
                'status' => 'Paid',
                'date' => '10 May 2026'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.finance')->title('Finance & Billing | EduCore');
    }
}
