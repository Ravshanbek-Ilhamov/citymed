<div>
    <div class="row">
        <div class="col-md-12">
                <div class="container my-4">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <h3 class="fw-bold">Doctor Details</h3>
                        <div class="d-flex ms-auto">
                            <a href="/doctors" wire:navigate class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    
                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            @if($doctor->profile_picture && file_exists(storage_path('app/public/' . $doctor->profile_picture)))
                                <img src="{{ asset('storage/'.$doctor->profile_picture) }}" 
                                     class="rounded-circle" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px; background-color: #007bff; color: white; font-weight: bold; font-size: 32px;">
                                    {{ strtoupper(substr($doctor->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-primary">Dr. {{$doctor->first_name}}</h5>
                            <p class="mb-1 text-muted">
                                <i class="fas fa-envelope me-2"></i> {{$doctor->email}}
                            </p>
                            <span class="badge bg-{{$doctor->is_active ? 'success' : 'danger'}}">
                                {{ $doctor->is_active ? 'Active' : 'Inactive' }}
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
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cases</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Patients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Schedules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Payrolls</a>
                    </li>
                </ul>
            
                <!-- Overview Section -->
                <div class="card">
                    <div class="card-body row">
                        <div class="col-md-6 mb-3">
                            <p><strong>Full Name: </strong>{{$doctor->first_name}} {{$doctor->last_name}}</p>
                            <p><strong>Username: </strong>{{$doctor->username}}</p>
                            <p><strong>Full Name: </strong>{{$doctor->first_name}} {{$doctor->last_name}}</p>
                            <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($doctor->birth_of_date)->age }}</p>
                            <p><strong>Address: </strong>{{$doctor->address}}</p>
                            <p><strong>Gender: </strong>{{$doctor->gender}}</p>
                            <p><strong>Email: </strong>{{$doctor->email}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Phone Number: </strong>{{$doctor->phone_number}}</p>
                            <p><strong>Specialization: </strong>{{$doctor->direction->name}}</p>
                            <p><strong>Years of Experience: </strong>{{$doctor->years_of_experience}}</p>
                            <p><strong>Per Patient Time: </strong>{{$doctor->per_patient_time}}</p>
                            <p><strong>Working Hours: </strong>{{$doctor->working_hours}}</p>
                            <p><strong>Consultation Fee: </strong>{{$doctor->consultation_fee}}</p>
                            <p><strong>BIO: </strong>{{$doctor->bio}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
