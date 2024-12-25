<div>
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
                <a href="#">Nurses</a>
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
                        <div class="card-title">Add Nurse</div>
                        <button wire:click="cancel" class="btn btn-primary btn-round">Back</button>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" wire:model.blur="first_name"
                                    required>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" wire:model.blur="last_name" required>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

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
                                <input type="date" class="form-control" id="date_of_birth" wire:model.blur="date_of_birth"
                                    required>
                                @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model.blur="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                    id="phone_number" wire:model.blur="phone_number" required placeholder="+998XXXXXXXXX">
                                @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" wire:model.blur="address" required>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="salary_types" class="form-label">Salary Type</label>
                                <select class="form-select" wire:model.blur="salary_type" id="salary_types">
                                    <option value="kpi+fixed" selected>KPI + Fixed</option>
                                    <option value="kpi">KPI</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                                @error('salary_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="services" class="form-label">Service Selection</label>
                                <select class="form-select" wire:model="selectedServices" id="services" multiple>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedServices')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="from_time" class="form-label">From</label>
                                        <input type="time" class="form-control" id="from_time" wire:model.blur="from_time"
                                            required>
                                        @error('from_time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="to_time" class="form-label">To</label>
                                        <input type="time" class="form-control" id="to_time" wire:model.blur="to_time"
                                            required>
                                        @error('to_time')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="profile_picture"
                                    wire:model.blur="profile_picture">
                                @if ($profile_picture && file_exists(storage_path('app/public/' . $profile_picture)))
                                <img style="border-radius: 50%; width: 80px; height: 80px"
                                    src="{{ asset('storage/' . $profile_picture) }}" alt=" Profile Picture ">
                                @endif
                                @error('profile_picture')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="is_active" class="form-label">Active</label>
                                <select class="form-select" id="is_active" wire:model.blur="is_active" required>
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nurse available days <span
                                        class="text-danger">*</span></label>
                                <div class="d-flex gap-3">
                                    @foreach (['Sun', 'Mon', 'Tue', 'Wen', 'Thu', 'Fri', 'Sat'] as $day)
                                    <div class="form-check">
                                        <input type="checkbox" wire:model="working_days" value="{{ $day }}" id="{{ $day }}"
                                            class="form-check-input">
                                        <label class="form-check-label" for="{{ $day }}">{{ $day }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                @if ($editingForm)
                    <div class="row">
                        <div class="col-md-12">
                            <button wire:click="update" type="submit" class="btn btn-primary btn-round">Update</button>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <button wire:click="store" type="submit" class="btn btn-primary btn-round">Submit</button>
                        </div>
                    </div>
                @endif
                </div>
                @else
                <div
                    class="card-header d-flex justify-content-between align-items-center bg-light border-bottom shadow-sm py-3 px-4 rounded-top">
                    <h5 class="card-title text-primary m-0">Nurses</h5>

                    <div class="row mb-0" style="width: 50%;">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start"
                                    style="border-color: #ced4da;">
                                    <i class="fa fa-search text-muted"></i>
                                </span>
                                <input type="search" wire:model.live.debounce.500ms="search"
                                    class="form-control border-start-1  ps-2"
                                    placeholder="Search nurses by name, email..." style="border-color: #ced4da;">
                            </div>
                        </div>
                    </div>

                    <button wire:click="SetcreateForm" class="btn btn-primary d-flex btn-round align-items-center"
                        style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Nurse</span>
                    </button>
                </div>

                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Full Name & Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nurses as $nurse)
                            <tr>
                                <td>{{ $nurse->id }}</td>
                                <td>
                                    @if ($nurse->profile_picture && file_exists(storage_path('app/public/' .
                                    $nurse->profile_picture)))
                                    <img class="rounded-circle" src="{{ asset('storage/' . $nurse->profile_picture) }}"
                                        width="50" height="50">
                                    @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px; background-color: #007bff; color: white; font-weight: bold;">
                                        {{ strtoupper(substr($nurse->first_name, 0, 1)) }}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <!-- Full Name and Email layout -->
                                    <div class="d-flex flex-column">
                                        <a href="#" wire:click="SetDeatailingNurse({{ $nurse->id }})"
                                            class="text-decoration-none">
                                            <span style="font-weight: bold; color: #4A90E2;">
                                                {{ $nurse->first_name }} {{ $nurse->last_name }}
                                            </span>
                                        </a>
                                        <span style="font-size: 0.9rem; color: #6c757d;">
                                            {{ $nurse->email }}
                                        </span>
                                    </div>
                                </td>
                                <td>{{ $nurse->phone_number }}</td>
                                <td>
                                    <div class="form-button-action justify-content-around align-items-center gap-1">
                                        <button wire:click.prevent="SeteditForm({{ $nurse->id }})" type="button"
                                            class="btn btn-sm btn-primary" title="Edit Task">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button wire:click="prepareDelete({{ $nurse->id }})"
                                            class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <!-- Delete Confirmation Modal -->
                                        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this nurse?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="deleteConfirmed" data-bs-dismiss="modal">
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
                            {{ $nurses->links('vendor.livewire.bootstrap') }}
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