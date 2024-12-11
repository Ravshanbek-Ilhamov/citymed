<div>
    <div class="page-header">
        <h3 class="fw-bold mb-3">Services</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="/statistics"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="/direction" wire:navigate>Directions</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="/service" wire:navigate>Services</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Services</h4>
                    <button class="btn btn-primary btn-sm float-end" wire:click="toggleAddForm">
                        {{ $showAddForm ? 'Back to List' : 'Add Service' }}
                    </button>
                </div>

                @if($showAddForm)
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label for="name" class="form-label">Service Name</label>
                                <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter service name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="direction_id" class="form-label">Direction</label>
                                <select id="direction_id" wire:model="direction_id" class="form-control">
                                    <option value="">-- Select Direction --</option>
                                    @foreach($directions as $direction)
                                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                    @endforeach
                                </select>
                                @error('direction_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label for="doctor_id" class="form-label">Doctor</label>
                              <select id="doctor_id" wire:model="doctor_id" class="form-control">
                                  <option value="">-- Select Doctor --</option>
                                  @foreach($doctors as $doctor)
                                      <option value="{{ $doctor->id }}">{{ $doctor->first_name }}</option>
                                  @endforeach
                              </select>
                              @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
                          </div>
                          
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="is_active" wire:model="is_active" class="form-check-input">
                                <label for="is_active" class="form-check-label">Is Active</label>
                            </div>
                            <button type="submit" class="btn btn-success">Add Service</button>
                        </form>
                    </div>
                    @elseif($showEditForm)
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            <div class="mb-3">
                                <label for="name" class="form-label">Service Name</label>
                                <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter service name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="direction_id" class="form-label">Direction</label>
                                <select id="direction_id" wire:model="direction_id" class="form-control">
                                    <option value="">-- Select Direction --</option>
                                    @foreach($directions as $direction)
                                        <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                    @endforeach
                                </select>
                                @error('direction_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="doctor_id" class="form-label">Doctor</label>
                                <select id="doctor_id" wire:model="doctor_id" class="form-control">
                                    <option value="">-- Select Doctor --</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->first_name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" id="is_active" wire:model="is_active" class="form-check-input">
                                <label for="is_active" class="form-check-label">Is Active</label>
                            </div>
                            <button type="submit" class="btn btn-success">Update Service</button>
                        </form>
                    </div>
                @else
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Direction</th>
                                    <th>Name</th>
                                    <th>Is Active</th>
                                    <th>Doctor</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($services as $service)
                                  <tr>
                                      <td>{{ $service->id }}</td>
                                      <td>{{ $service->direction ? $service->direction->name : 'No Direction' }}</td>
                                      <td>{{ $service->name }}</td>
                                      <td>
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked_{{ $service->id }}" name="is_active_{{ $service->id }}" value="1" {{ $service->is_active ? 'checked' : '' }} wire:click="updateStatus({{ $service->id }}, $event.target.checked)">
                                          <label class="form-check-label" for="flexSwitchCheckChecked_{{ $service->id }}"></label>
                                        </div>
                                      </td>
                                      </td>
                                      
                                      <td>{{ $service->doctor ? $service->doctor->first_name : 'No Doctor Assigned' }}</td>
                                      <td>
                                        <div class="form-button-action d-flex align-items-center" style="gap: 4px;">
                                            <button
                                                wire:click.prevent="edit({{ $service->id }})"
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                title="Edit Direction">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                    
                                            <button 
                                                wire:click="prepareDelete({{ $service->id }})" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this service?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-danger" 
                                                        wire:click="deleteConfirmed"
                                                        data-bs-dismiss="modal">
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
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
