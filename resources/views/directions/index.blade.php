<div>
    <div class="page-header">
        <h3 class="fw-bold mb-3">Directios</h3>
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
            <a href="#">Directions</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="#">All Directions</a>
        </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="d-flex align-items-center">
                <h3>Directions</h3>
                <button
                  class="btn btn-primary btn-round ms-auto"
                  data-bs-toggle="modal"
                  data-bs-target="#addRowModal"
                >
                  <i class="fa fa-plus"></i>
                  Add Direction
                </button>
              </div>
            </div>
            <div class="card-body">
                <!-- Modal -->
                <div
                class="modal fade"
                id="addRowModal"
                tabindex="-1"
                role="dialog"
                aria-hidden="true"
                data-backdrop="false"
                >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold"> New</span>
                                    <span class="fw-light"> Direction </span>
                                </h5>
                                <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                                >
                            </div>
                            <div class="modal-body">
                                <p class="small">
                                    Create new Direction. Please fill all fields properly!
                                </p>
                                <form wire:submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Name</label>
                                                <input
                                                    wire:model="name"
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Fill name"
                                                />
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-check">
                                                <input
                                                    wire:model="is_active"
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    id="isActiveCheckbox"
                                                />
                                                <label class="form-check-label" for="isActiveCheckbox">
                                                    Is Active
                                                </label>
                                                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="submit"  class="btn btn-primary">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
            <script>
                Livewire.on('closeModal', () => {
                    let modal = new bootstrap.Modal(document.getElementById('addRowModal'));
                    modal.hide();
                });
            </script>
            @endpush
            
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Direction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="update">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input wire:model="name" type="text" class="form-control" id="name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-check">
                                    <input wire:model="is_active" type="checkbox" class="form-check-input" id="isActiveCheckbox">
                                    <label class="form-check-label" for="isActiveCheckbox">Is Active</label>
                                    @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Is Active</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($directions as $direction)
                        <tr>
                            <td>{{ $direction->id }}</td>
                            <td>{{ $direction->name }}</td>
                            <td>{{ $direction->is_active ? 'Yes' : 'No' }}</td>
                            <td>
                                <!-- Edit Button -->
                                <i class="fas fa-edit text-primary"
                                wire:click="edit({{ $direction->id }})"
                                style="cursor: pointer; margin-right: 10px;">
                                </i>
                             
                
                                <!-- Delete Button -->
                                <i class="fas fa-trash-alt text-danger"
                                   wire:click="delete({{ $direction->id }})"
                                   style="cursor: pointer;">
                                </i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('showEditModal', () => {
            console.log('Show edit modal event received');
            let modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        });

        Livewire.on('hideEditModal', () => {
            console.log('Hide edit modal event received');
            let modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.hide();
        });
        Livewire.on('hideCreateModal', () => {
            console.log('Hide edit modal event received');
            let modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.hide();
        });
    });
    
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
    

    
</div>