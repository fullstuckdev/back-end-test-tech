<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Companies</h1>
    </div>
    <div class="row">
        <div class="card  mx-auto">
            <div>
                @if (session()->has('department-message'))
                    <div class="alert alert-success">
                        {{ session('department-message') }}
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
                                <div class="col" wire:loading>
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <button wire:click="showDepartmentModal" class="btn btn-primary">
                           Tambahkan Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table" wire:loading.remove>
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Email</th>
                            <th scope="col">Company Address</th>
                            <th scope="col">Company Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $department)
                            <tr>
                                <th scope="row">{{ $department->id }}</th>
                                <td>{{ $department->company_name }}</td>
                                <td>{{ $department->company_email }}</td>
                                <td>{{ $department->company_address }}</td>
                                <td>{{ $department->company_phone }}</td>

                                <td>
                                    <button wire:click="showEditModal({{ $department->id }})"
                                        class="btn btn-success">Edit</button>
                                    <button wire:click="deleteDepartment({{ $department->id }})"
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
                {{ $departments->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @if ($editMode)
                            <h5 class="modal-title" id="departmentModalLabel">Edit Department</h5>
                        @else
                            <h5 class="modal-title" id="departmentModalLabel">Data Companies</h5>

                        @endif
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row">
                                <label for="company_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                                <div class="col-md-6">
                                    <input id="company_name" type="text"
                                        class="form-control @error('company_name') is-invalid @enderror"
                                        wire:model.defer="company_name">

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="company_email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>

                                <div class="col-md-6">
                                    <input id="company_email" type="text"
                                        class="form-control @error('company_email') is-invalid @enderror"
                                        wire:model.defer="company_email">

                                    @error('company_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                               <div class="form-group row">
                                <label for="company_address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Company Address') }}</label>

                                <div class="col-md-6">
                                    <input id="company_address" type="text"
                                        class="form-control @error('company_address') is-invalid @enderror"
                                        wire:model.defer="company_address">

                                    @error('company_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                               <div class="form-group row">
                                <label for="company_phone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Company Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="company_phone" type="text"
                                        class="form-control @error('company_phone') is-invalid @enderror"
                                        wire:model.defer="company_phone">

                                    @error('company_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Keluar</button>
                        @if ($editMode)
                            <button type="button" class="btn btn-primary" wire:click="updateDepartment">Update
                                Department</button>
                        @else
                            <button type="button" class="btn btn-primary" wire:click="storeDepartment">Simpan Data</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
