<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous">
    </script>
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
            {{-- <li class="nav-item"> --}}
                {{-- <a wire:navigate href="/medicines/closeToExpire">Close To Expire</a> --}}
            {{-- </li> --}}
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
                    <div class="card-title">Add Medicine</div>
                    <button wire:click="cancel" class="btn btn-primary btn-round">Back</button>
                </div>

                <div class="card-body">
                    <!-- Row 1: Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="name" wire:model.blur="name" required>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" wire:model.blur="category_id" required>
                                <option value="" selected>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 2: Category and Description -->
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label for="quantity_in_stock" class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" id="quantity_in_stock"
                                wire:model.blur="quantity_in_stock" required>
                            @error('quantity_in_stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="minimum_stock_level" class="form-label">Minimum Stock Level</label>
                            <input type="number" class="form-control" id="minimum_stock_level"
                                wire:model.blur="minimum_stock_level" required>
                            @error('minimum_stock_level') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 3: Batch Number and Quantity -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="batch_number" class="form-label">Batch Number</label>
                            <input type="text" class="form-control" id="batch_number" wire:model.blur="batch_number"
                                required>
                            @error('batch_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="is_prescription_required" class="form-label">Prescription Required</label>
                            <select class="form-control" id="is_prescription_required"
                                wire:model.blur="is_prescription_required" required>
                                <option value="1" selected>Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_prescription_required') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 4: Minimum Stock Level and Price -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="selling_price" class="form-label">Selling Price</label>
                            <input type="number" class="form-control" id="selling_price" wire:model.blur="selling_price"
                                required>
                            @error('selling_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="purchase_price" class="form-label">Purchase Price</label>
                            <input type="number" class="form-control" id="purchase_price"
                                wire:model.blur="purchase_price" required>
                            @error('purchase_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 5: Selling Price and Discount -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="supplier_id" class="form-label">Supplier</label>
                            <select class="form-control" id="supplier_id" wire:model.blur="supplier_id" required>
                                <option value="" selected>Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->first_name . ' ' .
                                    $supplier->last_name }}</option>
                                @endforeach
                            </select>
                            @error('supplier_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="manufacturer_name" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="manufacturer_name"
                                wire:model.blur="manufacturer_name" required>
                            @error('manufacturer_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 7: Country of Origin and Manufacture Date -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="manufacture_date" class="form-label">Manufacture Date</label>
                            <input type="date" class="form-control" id="manufacture_date"
                                wire:model.blur="manufacture_date" required>
                            @error('manufacture_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" id="expiry_date" wire:model.blur="expiry_date"
                                required>
                            @error('expiry_date') <span class="text-danger">{{ $message }}</span> @enderror
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
                <h5 class="card-title text-primary m-0">Medicines</h5>

                <!-- Search Bar -->
                <div class="row mb-0" style="width: 50%;">
                    <div class="col">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start"
                                style="border-color: #ced4da;">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input type="search" wire:model.live.debounce.500ms="search"
                                class="form-control border-start-1  ps-2" placeholder="Search medicines by name..."
                                style="border-color: #ced4da;">
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <button wire:click="SetcreateForm" class="btn btn-primary d-flex btn-round align-items-center"
                    style="gap: 0.5rem; background-color: #007bff; border-color: #007bff;">
                    <i class="fas fa-user-plus"></i>
                    <span>Add Medicine</span>
                </button>
            </div>
                        {{-- @php
                            dd($medicines);
                        @endphp --}}
            <div class="card-body">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name & Manufacturer</th>
                            <th scope="col">Category</th>
                            <th scope="col">Quantity in Stock</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col" wire:click="sortByExpiry" >Expiry Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $medicine)
                        <tr>
                            <td class="text-center">{{$medicine->id}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="#" wire:click.prevent="setDetailingMedicine({{$medicine->id}})"
                                        class="text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#medicineDetailsModal">
                                        <span
                                            style="font-weight: bold; color: {{$wareHouseMedicine->where('medicine_id', $medicine->id)->sum('quantity') <= $medicine->minimum_stock_level ? 'red' : '#4A90E2'}};">
                                            {{ strtoupper($medicine->name[0]) }}{{ substr($medicine->name, 1) }}
                                        </span>
                                    </a>
                                    <span style="font-size: 0.9rem; color: #6c757d;">
                                        {{$medicine->manufacturer_name}}
                                    </span>
                                </div>
                            </td>
                            <td class="text-center">{{ucfirst($medicine->category->name)}}</td>
                            <td class="text-center"
                                style="color: {{$wareHouseMedicine->where('medicine_id', $medicine->id)->sum('quantity') <= $medicine->minimum_stock_level ? 'red' : ''}};">
                                {{$wareHouseMedicine->where('medicine_id', $medicine->id)->sum('quantity') ?? 0}}
                            </td>
                            <td class="text-center">${{$medicine->selling_price}}</td>
                            <td class="text-center">{{$medicine->expiry_date}}</td>
                            <td>
                                <div class="form-button-action d-flex align-items-center gap-1">
                                    <button wire:click.prevent="SeteditForm({{ $medicine->id }})" type="button"
                                        class="btn btn-sm btn-primary" title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button wire:click="prepareDelete({{ $medicine->id }})"
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
                                                    Are you sure you want to delete this medicine?
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
                        {{ $medicines->links('vendor.livewire.bootstrap') }}
                    </tbody>

                    <!-- Medicine Details Modal -->
                    <div wire:ignore.self class="modal fade" id="medicineDetailsModal" tabindex="-1"
                        aria-labelledby="medicineDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="medicineDetailsModalLabel">
                                        Medicine Details
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($selectedMedicine)
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <strong>Name:</strong> {{ $selectedMedicine->name }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Category:</strong> {{ $selectedMedicine->category->name }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Batch Number:</strong> {{ $selectedMedicine->batch_number }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Manufacturer:</strong> {{ $selectedMedicine->manufacturer_name }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Quantity in Stock:</strong> {{ $selectedMedicine->quantity_in_stock
                                            }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Minimum Stock Level:</strong> {{
                                            $selectedMedicine->minimum_stock_level }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Purchase Price:</strong> ${{ $selectedMedicine->purchase_price }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Selling Price:</strong> ${{ $selectedMedicine->selling_price }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Supplier:</strong> {{ $selectedMedicine->supplier->first_name . ' '
                                            . $selectedMedicine->supplier->last_name }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Manufacture Date:</strong> {{ $selectedMedicine->manufacture_date }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Expiry Date:</strong> {{ $selectedMedicine->expiry_date }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>Prescription Required:</strong>
                                            {{ $selectedMedicine->is_prescription_required ? 'Yes' : 'No' }}
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <strong>WareHouses:</strong> {{
                                            $selectedMedicine->warehouse->pluck('name')->implode(', ') }} 
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