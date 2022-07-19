<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;

class EmployeeIndex extends Component
{
    public $search = '';
    public $fullname;
    public $company_fk;
    public $department;
    public $email;
    public $phone;
    public $editMode = false;
    public $employeeId;
    public $selectedDepartmentId = null;

    protected $rules = [
        'fullname' => 'required',
        'company_fk' => 'required',
        'department' => 'required',
        'email' => 'required',
        'phone' => 'required',
    ];

    public function showEditModal($id)
    {
        $this->reset();
        $this->employeeId = $id;
        $this->loadEmployee();
        $this->editMode = true;
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'show']);
    }

    public function loadEmployee()
    {
        $employee = Employee::find($this->employeeId);
        $this->fullname = $employee->fullname;
        $this->company_fk = $employee->company_fk;
        $this->department = $employee->department;
        $this->email = $employee->email;
        $this->phone = $employee->phone;

 
    }
    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        session()->flash('employee-message', 'Employee successfully deleted');
    }
    public function showEmployeeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'show']);
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
    }
    public function storeEmployee()
    {
        $this->validate();
        Employee::create([
        'fullname' => $this->fullname,
        'company_fk' => $this->company_fk,
        'department' => $this->department,
        'email' => $this->email,
        'phone' => $this->phone,
       ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
        session()->flash('employee-message', 'Employee successfully created');
    }
    public function updateEmployee()
    {
        $this->validate();
        $employee = Employee::find($this->employeeId);
        $employee->update([
        'fullname' => $this->fullname,
        'company_fk' => $this->company_fk,
        'department' => $this->department,
        'email' => $this->email,
        'phone' => $this->phone,
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#employeeModal', 'actionModal' => 'hide']);
        session()->flash('employee-message', 'Employee successfully updated');
    }
    public function render()
    {
        $employees = Employee::paginate(5);
        if (strlen($this->search) > 2) {
            if ($this->selectedDepartmentId) {
                $employees = Employee::where('fullname', 'like', "%{$this->search}%")
                             ->where('company_fk', $this->selectedDepartmentId)
                             ->paginate(5);
            } else {
                $employees = Employee::where('fullname', 'like', "%{$this->search}%")->paginate(5);
            }
        } elseif ($this->selectedDepartmentId) {
            $employees = Employee::where('company_fk', $this->selectedDepartmentId)->paginate(5);
        }

        return view('livewire.employee.employee-index', ['employees' => $employees])->layout('layouts.main');
    }
}
