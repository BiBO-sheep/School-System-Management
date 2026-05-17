<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Academics;
use App\Livewire\Admission;
use App\Livewire\Finance;
use App\Livewire\TeacherPortal;
use App\Livewire\StudentPortal;
use App\Livewire\ParentPortal;
use App\Livewire\HRD;
use App\Livewire\Dormitory;
use App\Livewire\Clinic;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/academics', Academics::class)->name('academics');
Route::get('/admission', Admission::class)->name('admission');
Route::get('/finance', Finance::class)->name('finance');
Route::get('/teacher-portal', TeacherPortal::class)->name('teacher-portal');
Route::get('/student-portal', StudentPortal::class)->name('student-portal');
Route::get('/parent-portal', ParentPortal::class)->name('parent-portal');
Route::get('/human-resource', HRD::class)->name('human-resource');
Route::get('/dormitory', Dormitory::class)->name('dormitory');
Route::get('/clinic', Clinic::class)->name('clinic');
