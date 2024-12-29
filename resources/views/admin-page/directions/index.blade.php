<div>
    <div class="page-header">
        <h3 class="fw-bold mb-3">Directions</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Directions</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">All Directions</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-cetern">
                    <h3>Directions</h3>
                    <button class="btn btn-primary btn-round ms-auto" wire:click="$set('showForm', true)">
                        <i class="fa fa-plus"></i> Add Direction
                    </button>
                </div>

                <div class="card-body">
                    @if ($showForm)
                        <div>
                            <h5>{{ $editMode ? 'Edit Direction' : 'Add New Direction' }}</h5>
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" wire:model="name" class="form-control"
                                        placeholder="Enter direction name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success btn-round">Save</button>
                                    <button type="button" class="btn btn-secondary btn-round"
                                        wire:click="resetForm">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @else
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
                                @foreach ($directions as $direction)
                                    <tr>
                                        <td>{{ $direction->id }}</td>
                                        <td>{{ $direction->name }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="flexSwitchCheckChecked_{{ $direction->id }}"
                                                    name="is_active_{{ $direction->id }}" value="1"
                                                    {{ $direction->is_active ? 'checked' : '' }}
                                                    wire:click="updateStatus({{ $direction->id }}, $event.target.checked)">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckChecked_{{ $direction->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-button-action d-flex align-items-center" style="gap: 4px;">
                                                <button wire:click.prevent="edit({{ $direction->id }})" type="button"
                                                    class="btn btn-sm btn-primary" title="Edit Direction">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button wire:click="prepareDelete({{ $direction->id }})"
                                                    class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>


                                        <!-- Delete Confirmation Modal -->
                                        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this direction?
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

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
