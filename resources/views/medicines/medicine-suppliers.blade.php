<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous"></script>
    <style>
        .breadcrumbs {
            display: flex;
            gap: 20px;
            padding: 0;
            list-style: none;
            font-size: 18px;
            font-weight: 500;
            color: #606060;
        }

        .breadcrumbs li a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease-in-out;
        }

        .breadcrumbs li a:hover {
            color: #000;
        }

        .breadcrumbs .active a {
            color: #000;
            text-decoration: underline;
            text-underline-offset: 5px;
            text-decoration-color: #6f6bff; /* Blue underline */
        }

    </style>
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-item">
                <a wire:navigate href="/medicine-category">Medicine Categories</a>
            </li>
            <li class="nav-item active">
                <a wire:navigate href="/medicine-suppliers">Medicine Suppliers</a>
            </li>
            <li class="nav-item">
                <a wire:navigate href="/medicines">Medicines</a>
            </li>
            <li class="nav-item">
                <a wire:navigate href="#">Purchase Medicine</a>
            </li>
            <li class="nav-item">
                <a wire:navigate href="#">Used Medicine</a>
            </li>
            <li class="nav-item">
                <a wire:navigate href="#">Medicine Bills</a>
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
                        <div class="card-title">Add Supplier</div>
                        <button wire:click="cancel" class="btn btn-primary btn-round">Back</button>
                    </div>

                    <div class="card-body">
                        <!-- Row 1: Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="name" wire:model.blur="first_name" required>
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name2" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="name2" wire:model.blur="last_name" required>
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Row 2: Email and Phone Number -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model.blur="email" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
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
                        </div>

                        <!-- Row 3: Address and Company Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" wire:model.blur="address" required>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="Companyname" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="Companyname" wire:model.blur="company_name" required>
                                @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Row 4: Country and Price -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" wire:model.blur="country" required>
                                @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contact" class="form-label">Contanct Person Name</label>
                                <input type="text" class="form-control" id="contact" wire:model.blur="contact_person" required>
                                @error('contact_person') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <!-- Row 10: Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                @if ($editingForm)
                                    <button wire:click="update" type="submit" class="btn btn-primary btn-round">Update</button>
                                @else
                                    <button wire:click="store" type="submit" class="btn btn-primary btn-round">Submit</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @else

                <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom shadow-sm py-3 px-4 rounded-top">
                    <!-- Card Title -->
                    <h5 class="card-title text-primary m-0">Suppliers</h5>
                
                    <!-- Search Bar -->
                    <div class="row mb-0" style="width: 50%;">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 rounded-start" style="border-color: #ced4da;">
                                    <i class="fa fa-search text-muted"></i>
                                </span>
                                <input 
                                    type="search" 
                                    wire:model.live.debounce.500ms="search" 
                                    class="form-control border-start-1  ps-2" 
                                    placeholder="Search suppliers by name, email, company name..." 
                                    style="border-color: #ced4da;"
                                >
                            </div>
                        </div>
                    </div>
                
                    <!-- Add Button -->
                    <button 
                        wire:click="SetcreateForm" 
                        class="btn btn-primary d-flex btn-round align-items-center"
                        style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;"
                     >
                        <i class="fas fa-user-plus"></i>
                        <span>Add Supplier</span>
                    </button>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name & Email</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Contact Person</th>
                                {{-- <th scope="col">Country</th> --}}
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medicineSuppliers as $medicineSupplier)
                                <tr>
                                    <td>{{$medicineSupplier->id}}</td>
                                    <td>
                                        <!-- Full Name and Email layout -->
                                        <div class="d-flex flex-column">
                                            <a href="#" wire:click="SetDeatailingSupplier({{$medicineSupplier->id}})" class="text-decoration-none">
                                                <span style="font-weight: bold; color: #4A90E2;">
                                                    {{$medicineSupplier->first_name}} {{$medicineSupplier->last_name}}
                                                </span>
                                            </a>
                                            <span style="font-size: 0.9rem; color: #6c757d;">
                                                {{$medicineSupplier->email}}
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{$medicineSupplier->company_name}}</td>
                                    <td>{{$medicineSupplier->address}}</td>
                                    <td>{{$medicineSupplier->phone_number}}</td>
                                    <td>{{$medicineSupplier->contact_person}}</td>
                                    {{-- <td>{{$medicineSupplier->country}}</td> --}}
                                    <td>
                                        <div class="form-button-action d-flex justify-content-around align-items-center gap-1">
                                            <button
                                                wire:click.prevent="SeteditForm({{ $medicineSupplier->id }})"
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button 
                                                wire:click="prepareDelete({{ $medicineSupplier->id }})" 
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
                                                            Are you sure you want to delete this doctor?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-round" data-bs-dismiss="modal">Cancel</button>
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-danger btn-round" 
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
                            {{ $medicineSuppliers->links('vendor.livewire.bootstrap') }}
                        </tbody>
                    </table>
                </div>     
                @endif
            </div>
        </div>
    </div>
    
        <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
        <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
        
        <script src="https://cdn.mobiscroll.com/5.22.2/js/mobiscroll.jquery.min.js"></script>
        <script>
            // Ensure Mobiscroll options are set
            mobiscroll.setOptions({
                locale: mobiscroll.localeEn, // Set language
                theme: 'ios', // Choose theme
                themeVariant: 'light' // Light theme
            });

            // Initialize the multi-select widget
            mobiscroll.select('#demo-multiple-select', {
                inputElement: document.getElementById('demo-multiple-select-input'), // Link input to select
                touchUi: true // Enable touch-friendly UI
            });

            // Handle Livewire updates
            document.addEventListener('livewire:load', function () {
                mobiscroll.select('#demo-multiple-select', {
                    inputElement: document.getElementById('demo-multiple-select-input'),
                    touchUi: true
                });
            });

            document.addEventListener('livewire:updated', function () {
                mobiscroll.select('#demo-multiple-select', {
                    inputElement: document.getElementById('demo-multiple-select-input'),
                    touchUi: true
                });
            });
        </script>
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
                delay: 3000,
                });
            });
        </script>
</div>