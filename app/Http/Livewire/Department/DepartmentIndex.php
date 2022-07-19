<?php

namespace App\Http\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentIndex extends Component
{
    public $search = '';
    public $company_name, $company_email, $company_address, $company_phone;
    public $editMode = false;
    public $departmentId;

    protected $rules = [
        'company_name' => 'required',
        'company_email' => 'required',
        'company_address' => 'required',
        'company_phone' => 'required',
    ];

    public function showEditModal($id)
    {
        $this->reset();
        $this->departmentId = $id;
        $this->loadDepartment();
        $this->editMode = true;
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'show']);
    }

    public function loadDepartment()
    {
        $department = Department::find($this->departmentId);
        $this->company_name = $department->company_name;
        $this->company_email = $department->company_email;
        $this->company_address = $department->company_address;
        $this->company_phone = $department->company_phone;
    }
    public function deleteDepartment($id)
    {
        $department = Department::find($id);
        $department->delete();
        session()->flash('department-message', 'Data berhasil dihapus!');
    }
    public function showDepartmentModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'show']);
    }
    public function closeModal()
    {
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
    }
    public function storeDepartment()
    {
        $this->validate();
        Department::create([
           'company_name'         => $this->company_name,
            'company_email'         => $this->company_email,
            'company_address'         => $this->company_address,
            'company_phone'         => $this->company_phone
       ]);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
        session()->flash('department-message', 'Data berhasil dibuat!');
    }
    public function updateDepartment()
    {
        $validated = $this->validate([
            'company_name'        => 'required',
            'company_email'        => 'required',
            'company_address'        => 'required',
            'company_phone'        => 'required'
        ]);
        $department = Department::find($this->departmentId);
        $department->update($validated);
        $this->reset();
        $this->dispatchBrowserEvent('modal', ['modalId' => '#departmentModal', 'actionModal' => 'hide']);
        session()->flash('department-message', 'Data berhasil diperbarui!');
    }
    public function render()
    {
        $departments = Department::paginate(5);
        if (strlen($this->search) > 2) {
            $departments = Department::where('company_name', 'like', "%{$this->search}%")->paginate(5);
        }

        return view('livewire.department.department-index', [
            'departments' => $departments
        ])->layout('layouts.main');
    }
}
