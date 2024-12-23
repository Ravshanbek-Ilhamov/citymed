<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-wlpxaVfwE0jaufrGrO2BTKqfnKtvsLJwAnfhEZHY4f2FHOuRLqheNOzQ5W2E6Z7m" crossorigin="anonymous">
    </script>
    {{-- <h3 class="fw-bold mb-3">Distributed WareHouses</h3> --}}
    {{-- <div class="page-header">
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
    </div> --}}

    {{-- @php
        dd($warehouse->medicines);
    @endphp --}}


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @if (session('message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                {{-- @if ($createForm || $editingForm) --}}

                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="card-title">Distribute {{$warehouse->name}}</div>
                    <button wire:click="cancel" class="btn btn-primary btn-round">Back</button>
                </div>

                <div class="card-body">
                    <!-- Row 1: Name -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Distributing Warehouse</label>
                            <input type="text" class="form-control" id="name" wire:model.blur="name"disabled>
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="form-label">Select warehouse to distribute </label>

                            <select class="form-select" wire:model.blur="warehouse_id" id="warehouse_id">
                                <option value="null" selected>Select WareHouse </option>
                                @foreach ($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                @endforeach
                            </select>

                            {{-- <input type="text" class="form-control" id="code" wire:model.blur="code" required> --}}
                            @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <!-- Row 2: Category and Description -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="login" class="form-label">Select Medicine</label>

                            <select wire:change="medicineSelected($event.target.value)" class="form-select" wire:model.blur="medicine_id" id="medicine_id">
                                <option value="null" selected>Select Medicine </option>
                                @foreach ($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                @endforeach
                            </select>

                            @error('medicine_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity Max: {{$maxValue}}</label>
                            <input type="number" class="form-control"  id="quantity" wire:model.blur="quantity" min="1" max="{{$maxValue}}" required>
                            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Row 10: Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button wire:click="distribute" type="submit" class="btn btn-primary btn-round">Distribute</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
<script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

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