<?php

namespace App\Livewire;

use Livewire\Component;

class HRD extends Component
{
    public array $hrStats = [];
    public array $employees = [];
    public array $leaveRequests = [];
    public array $payrollData = [];

    public function mount()
    {
        // Mock HR Statistics
        $this->hrStats = [
            'total_employees' => 86,
            'on_leave_today' => 3,
            'upcoming_appraisals' => 5,
        ];

        // Mock Employees Data
        $this->employees = [
            [
                'id' => 'EMP-1001',
                'name' => 'Dr. Wahyudi',
                'avatar' => 'W',
                'role' => 'Senior Teacher',
                'department' => 'Academics (Science)',
                'status' => 'Active',
            ],
            [
                'id' => 'EMP-1002',
                'name' => 'Fatimah Az Zahra',
                'avatar' => 'F',
                'role' => 'Dormitory Warden',
                'department' => 'Pesantren Affairs',
                'status' => 'Active',
            ],
            [
                'id' => 'EMP-1005',
                'name' => 'Bambang Supriyadi',
                'avatar' => 'B',
                'role' => 'Head of Security',
                'department' => 'Operations & Security',
                'status' => 'Active',
            ],
            [
                'id' => 'EMP-1012',
                'name' => 'Sri Rahayu',
                'avatar' => 'S',
                'role' => 'Finance Officer',
                'department' => 'Finance & Admin',
                'status' => 'On Leave',
            ],
            [
                'id' => 'EMP-1020',
                'name' => 'Hendra Pratama',
                'avatar' => 'H',
                'role' => 'Mathematics Teacher',
                'department' => 'Academics',
                'status' => 'Active',
            ],
            [
                'id' => 'EMP-1024',
                'name' => 'Aditya Wijaya',
                'avatar' => 'A',
                'role' => 'IT Support',
                'department' => 'IT & Infrastructure',
                'status' => 'Active',
            ],
        ];

        // Mock Leave Requests (Cuti)
        $this->leaveRequests = [
            [
                'id' => 'REQ-001',
                'staff_name' => 'Sri Rahayu',
                'role' => 'Finance Officer',
                'dates' => '15 May - 17 May 2026',
                'reason' => 'Sick Leave',
                'status' => 'Pending',
            ],
            [
                'id' => 'REQ-002',
                'staff_name' => 'Dr. Wahyudi',
                'role' => 'Senior Teacher',
                'dates' => '20 May - 24 May 2026',
                'reason' => 'Annual Leave',
                'status' => 'Pending',
            ],
            [
                'id' => 'REQ-003',
                'staff_name' => 'Bambang Supriyadi',
                'role' => 'Head of Security',
                'dates' => '12 May - 13 May 2026',
                'reason' => 'Personal Leave (Family Event)',
                'status' => 'Approved',
            ],
        ];

        // Mock Payroll & Attendance Data
        $this->payrollData = [
            [
                'employee_id' => 'EMP-1001',
                'name' => 'Dr. Wahyudi',
                'base_hours' => 160,
                'actual_hours' => 160,
                'overtime' => 5,
                'status' => 'Draft',
            ],
            [
                'employee_id' => 'EMP-1002',
                'name' => 'Fatimah Az Zahra',
                'base_hours' => 160,
                'actual_hours' => 160,
                'overtime' => 12,
                'status' => 'Draft',
            ],
            [
                'employee_id' => 'EMP-1005',
                'name' => 'Bambang Supriyadi',
                'base_hours' => 160,
                'actual_hours' => 180,
                'overtime' => 20,
                'status' => 'Draft',
            ],
            [
                'employee_id' => 'EMP-1012',
                'name' => 'Sri Rahayu',
                'base_hours' => 160,
                'actual_hours' => 136, // Took leave
                'overtime' => 0,
                'status' => 'Draft',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.hrd')->title('HR & Staffing | EduCore');
    }
}
