<div>
    <div class="row">
        <div class="col-md-12">
                <div class="container my-4">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <h3 class="fw-bold">Worker Details</h3>
                        <div class="d-flex ms-auto">
                            <a href="/workers" wire:navigate class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    
                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            @if($worker->profile_image && file_exists(storage_path('app/public/' . $worker->profile_image)))
                                <img src="{{ asset('storage/'.$worker->profile_image) }}" 
                                     class="roun1ed-circle" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px; background-color: #007bff; color: white; font-weight: bold; font-size: 32px;">
                                    {{ strtoupper(substr($worker->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-primary">{{$worker->first_name}}  {{$worker->last_name}}</h5>

                            <p class="mb-1 text-muted">
                                <i class="fas fa-phone me-2"></i> {{$worker->phone_number}}
                            </p>
                            <span class="badge bg-{{$worker->is_active ? 'success' : 'danger'}}">
                                {{ $worker->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    
                    </div>
                </div>
            
                <!-- Quick Stats -->
                <div class="row text-center mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">1</h5>
                                <p class="text-muted mb-0">Total Cases</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">1</h5>
                                <p class="text-muted mb-0">Patients</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="fw-bold text-primary">2</h5>
                                <p class="text-muted mb-0">Total Appointments</p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Overview</a>
                </ul>
            
                <!-- Overview Section -->
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Full Name: </strong>{{$worker->first_name}} {{$worker->last_name}}</p>
                            <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($worker->date_of_birth)->age }}</p>
                            <p><strong>Address: </strong>{{$worker->address}}</p>
                            <p><strong>Gender: </strong>{{$worker->gender}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Phone Number: </strong>{{$worker->phone_number}}</p>
                            <p><strong>Working Hours: </strong>{{$worker->working_hours}}</p>
                            <p><strong>Job: </strong>{{$worker->specialization}}</p>
                            <p><strong>Salary type: </strong>{{$worker->salary_type}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
