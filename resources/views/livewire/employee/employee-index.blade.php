<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('employee-message'))
                    <div class="alert alert-success">
                        {{ session('employee-message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-row align-items-center">
                                <div class="col">
                                    <input type="search" wire:model="search" class="form-control mb-2"
                                        id="inlineFormInput" placeholder="Pencarian...">
                                </div>
                                <div class="col">
                                    <select wire:model="selectedDepartmentId" class="form-control mb-2">
                                        <option value="">Pilih Companies</option>

                                        @foreach (App\Models\Department::all() as $department)
                                            <option value="{{ $department->id }}">{{ $department->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col" wire:loading>
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <button wire:click="showEmployeeModal" class="btn btn-primary">
                            Tambahkan Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">#Id</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Department</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                        @forelse ($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->fullname }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <button wire:click="showEditModal({{ $employee->id }})"
                                        class="btn btn-success">Edit</button>
                                    <button wire:click="deleteEmployee({{ $employee->id }})"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th>No Results</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{ $employees->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @if ($editMode)
                            <h5 class="modal-title" id="employeeModalLabel">Edit Employee</h5>
                        @else
                            <h5 class="modal-title" id="employeeModalLabel">Create Employee</h5>

                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="fullname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fullname" type="text"
                                        class="form-control @error('fullname') is-invalid @enderror"
                                        wire:model.defer="fullname">

                                    @error('fullname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                
                        
                            <div class="form-group row">
                    <label for="company_fk" class="col-md-4 col-form-label text-md-right">{{ __('Companies') }}</label>

                                <div class="col-md-6">
                                    <select wire:model.defer="company_fk" class="custom-select">
                                        <option selected>Choose</option>

                                        @foreach (App\Models\Department::all() as $department)
                                            <option value="{{ $department->id }}">{{ $department->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_fk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="department"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                                <div class="col-md-6">
                                    <input id="department" type="text"
                                        class="form-control @error('department') is-invalid @enderror"
                                        wire:model.defer="department">

                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror"
                                        wire:model.defer="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                              <div class="form-group row">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        wire:model.defer="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                  
                       
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        @if ($editMode)
                            <button type="button" class="btn btn-primary" wire:click="updateEmployee">Update
                                Employee</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="storeEmployee">Store
                                Employee</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
