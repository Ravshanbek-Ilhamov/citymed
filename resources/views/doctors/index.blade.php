<div>
    <!-- Bootstrap 5 CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wnpl6i29aAODbXc6Qtz7Aj0ZbCTDWCMnPS5nufY+OsWlWb/wl5U5YhQ/QHWGdVH1" crossorigin="anonymous">
     
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
            <a href="#">Doctors</a>
        </li>
        </ul>
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
                        <div class="card-title">Add Doctor</div>
                        <button wire:click="cancel" class="btn btn-primary">Back</button>
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

                    <!-- Row 2: Username and Password -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" wire:model.blur="username" required>
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" wire:model.blur="password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 3: Gender and Date of Birth -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" wire:model.blur="gender" required>
                                <option value="" disabled selected>Select Gender</option>
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" wire:model.blur="email" required>
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" wire:model.blur="phone_number" required>
                            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 5: Address -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" wire:model.blur="address" required>
                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 6: Specialization and Experience -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="specialization" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="specialization" wire:model.blur="specialization" required>
                            @error('specialization') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="years_of_experience" class="form-label">Years of Experience</label>
                            <input type="number" class="form-control" id="years_of_experience" wire:model.blur="years_of_experience" required>
                            @error('years_of_experience') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 7: Working Hours -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="working_hours" class="form-label">Working Hours</label>
                            <input type="text" class="form-control" id="working_hours" wire:model.blur="working_hours" required>
                            @error('working_hours') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="consultation_fee" class="form-label">Consultation Fee</label>
                            <input type="number" class="form-control" id="consultation_fee" wire:model.blur="consultation_fee" required>
                            @error('consultation_fee') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 8: Profile Picture and Bio -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" wire:model.blur="profile_picture">
                            @if ($profile_picture)
                                <img style="border-radius: 50%; width: 80px; height: 80px" src="{{ asset('storage/' . $profile_picture)}}" alt=" Profile Picture ">
                            @endif
                            @error('profile_picture') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" wire:model.blur="bio" rows="2"></textarea>
                            @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 9: Active Status -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="is_active" class="form-label">Active</label>
                            <select class="form-select" id="is_active" wire:model.blur="is_active" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="per_patient_time" class="form-label">Per Patient Time (Minutes)</label>
                            <input type="number" class="form-control" id="per_patient_time" wire:model.blur="per_patient_time" rows="2">
                            @error('per_patient_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 10: Submit Button -->
                    @if ($editingForm)
                        <div class="row">
                            <div class="col-md-12">
                                <button wire:click="update" type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>  
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <button wire:click="store" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div> 

                    @endif
               
                @else

                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;"> 
                    <div class="card-title">Doctors</div>
                    <button wire:click="SetcreateForm" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
                </div>
                 
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Full Name & Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Specialization</th>
                                <th scope="col">Per Patient Time</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                            <tr>
                                <td>{{$doctor->id}}</td>
                                <td>
                                    <img class="rounded-circle"
                                         src="{{ asset('storage/' . $doctor->profile_picture) }}" 
                                         alt="Profile Picture" width="50" height="50">
                                </td>
                                <td>
                                    <!-- Full Name and Email layout -->
                                    <div class="d-flex flex-column">
                                        <a href="#" wire:click="SetDeatailingDoctor({{$doctor->id}})" class="text-decoration-none">
                                            <span style="font-weight: bold; color: #4A90E2;">
                                                {{$doctor->first_name}} {{$doctor->last_name}}
                                            </span>
                                        </a>
                                        <span style="font-size: 0.9rem; color: #6c757d;">
                                            {{$doctor->email}}
                                        </span>
                                    </div>
                                </td>
                                <td>{{$doctor->phone_number}}</td>
                                <td>{{$doctor->specialization}}</td>
                                <td>{{$doctor->per_patient_time}} minutes</td>
                                <td>
                                    <div class="form-button-action d-flex justify-content-around align-items-center gap-1">
                                        <button
                                            wire:click="SeteditForm({{$doctor->id}})"
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button
                                            wire:click="delete({{$doctor->id}})"
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            title="Remove">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            {{ $doctors->links('vendor.livewire.bootstrap') }}
                        </tbody>
                    </table>
                    
                </div>     

                @endif


            </div>
        </div>
    </div>
    
    <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <!-- Kaiadmin JS -->
        <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
        <!-- Kaiadmin DEMO methods, don't include it in your project! -->
        <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
    <!--   Core JS Files   -->
    
    <script>
        $("#displayNotif").on("click", function () {
            var placementFrom = $("#notify_placement_from option:selected").val();
            var placementAlign = $("#notify_placement_align option:selected").val();
            var state = $("#notify_state option:selected").val();
            var style = $("#notify_style option:selected").val();
            var content = {};

            content.message =
            'Turning standard Bootstrap alerts into "notify" like notifications';
            content.title = "Bootstrap notify";
            if (style == "withicon") {
            content.icon = "fa fa-bell";
            } else {
            content.icon = "none";
            }
            content.url = "index.html";
            content.target = "_blank";

            $.notify(content, {
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign,
            },
            time: 1000,
            });
        });
    </script>
    <!-- Bootstrap 5 JS Bundle (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous"></script>

</div>