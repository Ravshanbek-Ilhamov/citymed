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
                <div class="card-header d-flex align-items-center">
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
                                    <input type="text" wire:model="name" class="form-control" placeholder="Enter direction name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-check mt-3">
                                    <input type="checkbox" wire:model="is_active" class="form-check-input" id="isActiveCheckbox">
                                    <label class="form-check-label" for="isActiveCheckbox">Is Active</label>
                                    @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-secondary" wire:click="resetForm">Cancel</button>
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
                                        <td>{{ $direction->is_active ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <i class="fas fa-edit text-primary" style="cursor: pointer; margin-right: 10px;" wire:click="edit({{ $direction->id }})"></i>
                                            <i class="fas fa-trash-alt text-danger" style="cursor: pointer;"></i>
                                        </td>
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
