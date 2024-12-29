<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous">
    </script>
    {{-- <style>
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
            text-decoration-color: #6f6bff;
            /* Blue underline */
        }
    </style>
    <div class="page-header">
        <ul class="breadcrumbs mb-3">
            <li class="nav-item">
                <a wire:navigate href="/medicine-category">Medicine Categories</a>
            </li>
            <li class="nav-item">
                <a wire:navigate href="/medicine-suppliers">Medicine Suppliers</a>
            </li>
            <li class="nav-item active">
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
    </div> --}}
    <div class="page-header">
        {{-- <h3 class="fw-bold mb-3">Tables</h3> --}}
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
                <a href="#">WareHouses</a>
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
                    <div class="card-title">Add WareHouse</div>
                    <button wire:click="cancel" class="btn btn-primary btn-round">Back</button>
                </div>

                <div class="card-body">
                    <!-- Row 1: Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">WareHouse Name</label>
                            <input type="text" class="form-control" id="name" wire:model.blur="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" wire:model.blur="code" required>
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 2: Category and Description -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" id="login" wire:model.blur="login" required>
                            @error('login') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" wire:model.blur="password"
                                required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 3: Batch Number and Quantity -->
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="nurse_id" class="form-label">Select Nurse:(Nullable)</label>
                            <select class="form-select"  wire:model.blur="nurse_id" id="nurse_id">
                                <option value= "null" selected>Select Nurse </option>
                                @foreach ($nurses as $nurse) 
                                    <option value="{{ $nurse->id }}">{{ $nurse->first_name }} {{ $nurse->last_name}}</option>
                                @endforeach
                            </select>
                            @error('nurse_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" wire:model.blur="capacity" required>
                            @error('capacity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="note" class="form-label">Note (Nullable)</label>
                            <textarea class="form-control" wire:model.blur="note" id="note" cols="30"
                                rows="2"></textarea>
                            @error('note') <span class="text-danger">{{ $message }}</span> @enderror
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
            </div>
            @else

            <div
                class="card-header d-flex justify-content-between align-items-center bg-light border-bottom shadow-sm py-3 px-4 rounded-top">
                <!-- Card Title -->
                <h5 class="card-title text-primary m-0">WareHouses</h5>

                <!-- Search Bar -->
                <div class="row mb-0" style="width: 50%;">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start"
                                style="border-color: #ced4da;">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input type="search" wire:model.live.debounce.500ms="search"
                                class="form-control border-start-1  ps-2"
                                placeholder="Search warehouses by name,nurse name..." style="border-color: #ced4da;">
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <button wire:click="SetcreateForm" class="btn btn-primary d-flex btn-round align-items-center"
                    style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;">
                    <i class="fas fa-user-plus"></i>
                    <span>Add WareHouse</span>
                </button>
            </div>

            <div class="card-body">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name & Code</th>                            
                            <th scope="col">Nurse</th>
                            {{-- <th scope="col">Note</th> --}}
                            <th scope="col">Capacity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                        <tr>
                            <td class="text-center">{{$warehouse->id}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="#" wire:click.prevent="setDetailingWarehouse({{$warehouse->id}})"
                                        class="text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#detailModal">
                                        <span style="font-weight: bold; color:#4A90E2;">
                                            {{ ucfirst($warehouse->name) }}
                                        </span>
                                    </a>
                                    <span style="font-size: 0.9rem; color: #6c757d;">
                                        {{$warehouse->code}}
                                    </span>
                                </div>
                            </td>
                            {{-- <td class="text-center">{{$warehouse->notes}}</td> --}}
                            <td class="justify-content-center">{{ $warehouse->nurse ? $warehouse->nurse->first_name . ' ' . $warehouse->nurse->last_name : 'N/A'}}</td>
                            <td class="justify-content-center">{{$warehouse->capacity}}</td>
                            <td class="justify-content-center">
                                <span wire:click="switchWerehouseSatus({{$warehouse->id}})"
                                    class="badge bg-{{$warehouse->status == 'active' ? 'success' : 'danger'}}"
                                    style="font-size: 0.9rem;">
                                    {{ucfirst($warehouse->status)}}
                            </td>
                            </span>
                            <td>
                                <div class="form-button-action d-flex align-items-center gap-1">
                                    <button wire:click.prevent="distributeWarehouse({{ $warehouse->id }})" type="button" class="btn btn-sm btn-warning"
                                        title="Distribute">
                                        <i style="font-size: 0.9rem;" class="fas fa-bezier-curve"></i>
                                    </button>
                                    <button wire:click.prevent="SeteditForm({{ $warehouse->id }})" type="button"
                                        class="btn btn-sm btn-primary" title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button wire:click="prepareDelete({{ $warehouse->id }})"
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
                                                    Are you sure you want to delete this warehouse?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-round"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger btn-round"
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
                        {{ $warehouses->links('vendor.livewire.bootstrap') }}
                    </tbody>

                    <!-- WareHouse Details Modal -->
                    <div wire:ignore.self class="modal fade" id="detailModal" tabindex="-1"
                        aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">
                                        WareHouse Details
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($selectedWarehouse)
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <strong>Name:</strong> {{ $selectedWarehouse->name }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Code:</strong> {{ $selectedWarehouse->code }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Login:</strong> {{ $selectedWarehouse->login }}
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <strong>Capacity:</strong> {{ $selectedWarehouse->capacity }}
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <strong>Status:</strong> {{$selectedWarehouse->status}}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Medicines:</strong> {{$selectedWarehouse->medicines->pluck('name')->implode(', ')}}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Note:</strong> {{ $selectedWarehouse->notes }}
                                        </div>
                                    </div>
                                    @else
                                    <p>No medicine details to display.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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

{{-- <script>
    // Mobiscroll options and initialization
            function initializeMultiSelect() {
                mobiscroll.setOptions({
                    locale: mobiscroll.localeEn,
                    theme: 'ios',
                    themeVariant: 'light'
                });
        
                mobiscroll.select('#demo-multiple-select', {
                    inputElement: document.getElementById('demo-multiple-select-input')
                });
            }
        
            // Reinitialize Mobiscroll after Livewire updates
            document.addEventListener('livewire:load', function () {
                initializeMultiSelect();
            });
        
            document.addEventListener('livewire:updated', function () {
                initializeMultiSelect();
            });
</script> --}}

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