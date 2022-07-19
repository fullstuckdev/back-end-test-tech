<?php

use App\Http\Livewire\City\CityIndex;
use App\Http\Livewire\Country\CountryIndex;
use App\Http\Livewire\Department\DepartmentIndex;
use App\Http\Livewire\Employee\EmployeeIndex;
use App\Http\Livewire\State\StateIndex;
use App\Http\Livewire\Users\UserIndex;
use App\Http\Livewire\Report\ReportIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/departments', DepartmentIndex::class)->name('departments.index');
    Route::get('/employees', EmployeeIndex::class)->name('employees.index');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});
