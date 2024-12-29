<div>
    <div>
        <!-- Bootstrap 5 CSS (via CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wnpl6i29aAODbXc6Qtz7Aj0ZbCTDWCMnPS5nufY+OsWlWb/wl5U5YhQ/QHWGdVH1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
      
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tables</h3>
            <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/patients">Patients</a>
            </li>
            </ul>
        </div>
        <div class="card-header">
            <div class="card-category">
              <a
                class="link"
                href="http://bootstrap-notify.remabledesigns.com/"
                ></a
              >
            </div>
        </div>
        
    
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>                 
                    @endif
    
                    @if ($createForm || $editingForm)
                        
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;"> 
                            <div class="card-title btn-round ms-auto">Add Patient</div>
                            <button wire:click="cancel" class="btn btn-primary btn-round ms-auto">Back</button>
                        </div>
    
                        <div class="card-body">
                        <!-- Row 1: Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" wire:model.blur="first_name" required>
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" wire:model.blur="last_name" required>
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
    
                        <!-- Row 3: Gender and Date of Birth -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" wire:model.blur="gender" required>
                                    <option value="" selected>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" wire:model.blur="date_of_birth" required>
                                @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
    
                        <!-- Row 4: Contact Information -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input 
                                    type="tel" 
                                    class="form-control @error('phone_number') is-invalid @enderror" 
                                    id="phone_number" 
                                    wire:model.blur="phone_number" 
                                    required 
                                    placeholder="+998XXXXXXXXX"
                                >
                                @error('phone_number') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" wire:model.blur="address" required>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
    

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{-- @dd($patient->profile_image) --}}
                                <label for="profile_image" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" name="profile_image" wire:model.blur="profile_image">
                                @if ($profile_image and file_exists(storage_path('app/public/' . $profile_image)))
                                    <img style="border-radius: 50%; width: 80px; height: 80px" src="{{ asset('storage/' . $profile_image) }}" alt="Profile Picture">
                                @endif
                                @error('profile_image') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="blood_type" class="form-label">Blood type</label>
                                <select class="form-select" id="blood_type" wire:model.blur="blood_type" required>
                                    <option value="" selected>Select Blood type</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                                @error('blood_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        <div class="col-md-6">
                            <label for="payment_status" class="form-label">Payment Status</label>
                            <select class="form-select" id="payment_status" wire:model.blur="payment_status" required>
                                <option value="" selected>Select status</option>
                                <option value="1">Paid</option>
                                <option value="0">Unpaid</option>
                            </select>
                            @error('payment_status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Row 10: Submit Button -->
                        @if ($editingForm)
                            <div class="row">
                                <div class="col-md-12">
                                    <button wire:click="update" type="button" class="btn btn-primary btn-round ms-auto mt-3 notify-action-update">Update</button>
                                </div>
                            </div>  
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <button wire:click="store" type="button" class="btn btn-primary btn-round ms-auto mt-3 notify-action-create">Submit</button>
                                </div>
                            </div> 
                        @endif
                   
                    @else
    
                    <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom shadow-sm py-3 px-4 rounded-top">
                        <!-- Card Title -->
                        <h5 class="card-title text-primary m-0">Patients</h5>
                    
                        <!-- Search Bar -->
                        <div class="row mb-0" align="center" style="width: 50%;">
                            <div class="col">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 rounded-start" style="border-color: #ced4da;">
                                        <i class="fa fa-search text-muted"></i>
                                    </span>
                                    <input 
                                        type="search" 
                                        wire:model.live.debounce.500ms="search"  
                                        class="form-control border-start-1  ps-2" 
                                        placeholder="Search patients  by name..." 
                                        style="border-color: #ced4da;"
                                    >
                                </div>
                            </div>
                        </div>
                    
                        <!-- Add Button -->
                        <button 
                            wire:click="create" 
                            class="btn btn-primary d-flex align-items-center btn-round "
                            style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;"
                        >
                            <i class="fas fa-user-plus"></i>
                            <span>Add Patient</span>
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped mt-3 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                {{-- @dd($patients) --}}
                                <tr>
                                    <td>{{$patient->id}}</td>
                                    <td>
                                        @if($patient->profile_image && file_exists(storage_path('app/public/' . $patient->profile_image)))
                                            <img class="rounded-circle"
                                                 src="{{ asset('storage/' . $patient->profile_image) }}"
                                                 width="50" height="50">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px; background-color: #007bff; color: white; font-weight: bold;">
                                                {{ strtoupper(substr($patient->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Full Name and Email layout -->
                                        <div class="d-flex flex-column">
                                            <a href="#" wire:click="SetDeatailingpatients({{$patient->id}})" class="text-decoration-none">
                                                <span style="font-weight: bold; color: #4A90E2;">
                                                    {{$patient->first_name}} {{$patient->last_name}}
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{$patient->phone_number}}</td>
                                    <td>{{$patient->address}}</td>
                                    <td>
                                        <span class="badge {{ $patient->payment_status ? 'badge-success' : 'badge-danger' }}" style="font-size: 14px">
                                            {{ $patient->payment_status ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </td>
                                    

                                    <td>
                                        <div class="form-button-action justify-content-around align-items-center gap-1">
                                            <button
                                                wire:click.prevent="edit({{ $patient->id }})"
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button 
                                            wire:click="prepareDelete({{ $patient->id }})" 
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        
                                        <!-- Delete Confirmation Modal -->
                                        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this patient?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button 
                                                            class="btn btn-danger notify-action-delete"
                                                            type="button" 
                                                            wire:click="deleteConfirmed"
                                                            data-bs-dismiss="modal">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{ $patients->links('vendor.livewire.bootstrap') }}
                            </tbody>
                        </table>
                    </div>     
                    @endif
                </div>
            </div>
        </div>
        @livewireScripts
            <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
            <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
            <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/js/bootstrap-notify.min.js"></script>

            <script>
                document.addEventListener('livewire:load', function () {
                    function showNotification(title, message, type) {
                        $.notify({
                            icon: `fas fa-${type === 'success' ? 'check' : type === 'info' ? 'info' : 'exclamation-triangle'}`,
                            title: title,
                            message: message
                        },{
                            type: type,
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            animate: {
                                enter: 'animate__animated animate__fadeInDown',
                                exit: 'animate__animated animate__fadeOutUp'
                            },
                            delay: 3000
                        });
                    }
            
                    window.addEventListener('patient-created', () => {
                        showNotification('Patient Created', 'A new patient has been added.', 'success');
                    });
            
                    window.addEventListener('patient-updated', () => {
                        showNotification('Patient Updated', 'Patient information has been updated.', 'info');
                    });
            
                    window.addEventListener('patient-deleted', () => {
                        showNotification('Patient Deleted', 'Patient has been removed from the database.', 'warning');
                    });
            
                    $(".notify-action-create, .notify-action-update , .notify-action-delete").on("click", function (e) {
                        e.preventDefault();
                        
                        let action = $(this).hasClass('notify-action-create') ? 'create' : 'update';
                        let message = action === 'create' ? 'Creating patient...' : 'Updating patient...';
                        let type = action === 'create' ? 'success' : 'info';
            
                        $.notify({
                            message: message,
                            title: `Action Initiated`,
                            icon: `fas fa-${type === 'success' ? 'check' : 'info'}`
                        },{
                            type: type,
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            time: 1000,
                            delay: 1000 
                        });
                    });
                });
            </script>
        <!-- Bootstrap 5 JS Bundle (via CDN) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous"></script>
    
    </div>
</div>
