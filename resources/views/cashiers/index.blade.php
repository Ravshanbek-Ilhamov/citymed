<div>
    <div>
        <!-- Bootstrap 5 CSS (via CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-wnpl6i29aAODbXc6Qtz7Aj0ZbCTDWCMnPS5nufY+OsWlWb/wl5U5YhQ/QHWGdVH1" crossorigin="anonymous">

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
                    <a href="/cashiers">Cashiers</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if (session('message'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($createForm || $editingForm)

                        <div class="card-header"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="card-title btn-round ">Add Cashier</div>
                            <button wire:click="cancel" class="btn btn-primary btn-round ms-auto">Back</button>
                        </div>

                        <div class="card-body">
                            <!-- Row 1: Name -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name"
                                        wire:model.blur="first_name" required>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name"
                                        wire:model.blur="last_name" required>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="date_of_birth"
                                        wire:model.blur="date_of_birth" required>
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Row 4: Contact Information -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="tel"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" wire:model.blur="phone_number" required
                                        placeholder="+998XXXXXXXXX">
                                    @error('phone_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" wire:model.blur="address"
                                        required>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="profile_picture"
                                        wire:model.blur="profile_picture">
                                    @if ($profile_picture and file_exists(storage_path('app/public/' . $profile_picture)))
                                        <img style="border-radius: 50%; width: 80px; height: 80px"
                                            src="{{ asset('storage/' . $profile_picture) }}" alt="Profile Picture">
                                    @endif
                                    @error('profile_picture')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" wire:model.blur="email"
                                        required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label for="salary_type" class="form-label">Salary type</label>
                                    <select class="form-select" id="salary_type" wire:model="salary_type" required>
                                        <option value="" selected>Select Salary type</option>
                                        <option value="kpi">KPI</option>
                                        <option value="fixed">FIXED</option>
                                        <option value="kpi+fixed">KPI+FIXED</option>
                                    </select>
                                    @error('salary_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <label for="from_time" class="form-label">From</label>
                                    <input type="time" class="form-control" id="from_time" wire:model="from_time"
                                        required>
                                </div>

                                <div class="col-md-2">
                                    <label for="to_time" class="form-label">To</label>
                                    <input type="time" class="form-control" id="to_time" wire:model="to_time"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    @error('from_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('to_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>
                            <label class="form-label fw-semibold">Cashier Available Days <span
                                    class="text-danger">*</span></label>
                            <div class="d-flex gap-3">
                                @foreach (['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'] as $day)
                                    <div class="form-check">
                                        <input type="checkbox" wire:model="working_days.{{ $day }}"
                                            id="{{ $day }}" class="form-check-input">
                                        <label class="form-check-label"
                                            for="{{ $day }}">{{ $day }}</label>
                                    </div>
                                @endforeach
                            </div>


                            @if ($editingForm)
                                <div class="row">
                                    <div class="col-md-12">
                                        <button wire:click="update" type="submit"
                                            class="btn btn-primary btn-round ms-auto">Update</button>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <button wire:click="store" type="submit"
                                            class="btn btn-primary btn-round ms-auto">Submit</button>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-light border-bottom shadow-sm py-3 px-4 rounded-top">
                                <!-- Card Title -->
                                <h5 class="card-title text-primary m-0">Cashiers</h5>

                                <!-- Search Bar -->
                                <div class="row mb-0" align="center" style="width: 50%;">
                                    <div class="col">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white border-end-0 rounded-start"
                                                style="border-color: #ced4da;">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                            <input type="search" wire:model.live.debounce.500ms="search"
                                                class="form-control border-start-1  ps-2"
                                                placeholder="Search cashiers  by name or specialization..."
                                                style="border-color: #ced4da;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Add Button -->
                                <button wire:click="SetcreateForm"
                                    class="btn btn-primary d-flex align-items-center btn-round "
                                    style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Add cashier</span>
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
                                            <th scope="col">Salary type</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cashiers as $cashier)
                                            <tr>
                                                <td>{{ $cashier->id }}</td>
                                                <td>
                                                    @if ($cashier->profile_picture && file_exists(storage_path('app/public/' . $cashier->profile_picture)))
                                                        <img class="rounded-circle"
                                                            src="{{ asset('storage/' . $cashier->profile_picture) }}"
                                                            width="50" height="50">
                                                    @else
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                            style="width: 50px; height: 50px; background-color: #007bff; color: white; font-weight: bold;">
                                                            {{ strtoupper(substr($cashier->first_name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <!-- Full Name and Email layout -->
                                                    <div class="d-flex flex-column">
                                                        <a href="#"
                                                            wire:click="SetDeatailingcashiers({{ $cashier->id }})"
                                                            class="text-decoration-none">
                                                            <span style="font-weight: bold; color: #4A90E2;">
                                                                {{ $cashier->first_name }} {{ $cashier->last_name }}
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>{{ $cashier->phone_number }}</td>
                                                <td>{{ $cashier->salary_type }}</td>
                                                <td>
                                                    <div
                                                        class="form-button-action justify-content-around align-items-center gap-1">
                                                        <button wire:click.prevent="SeteditForm({{ $cashier->id }})"
                                                            type="button" class="btn btn-sm btn-primary"
                                                            title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button wire:click="prepareDelete({{ $cashier->id }})"
                                                            class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                        <!-- Delete Confirmation Modal -->
                                                        <div wire:ignore.self class="modal fade" id="deleteModal"
                                                            tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this cashier?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                        <button type="button" class="btn btn-danger"
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
                                        {{-- {{ $cashiers->links('vendor.livewire.bootstrap') }} --}}
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
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

        <script>
            $("#displayNotif").on("click", function() {
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous">
        </script>

    </div>
</div>
