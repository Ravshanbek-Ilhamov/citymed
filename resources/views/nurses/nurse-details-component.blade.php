<div>
    <div class="row">
        <div class="col-md-12">
            <div class="container my-4">
                <div class="d-flex justify-content-between mb-4 align-items-center">
                    <h3 class="fw-bold">Nurse Details</h3>
                    <div class="d-flex ms-auto">
                        <a href="/nurses" wire:navigate class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            @if ($nurse->profile_picture && file_exists(storage_path('app/public/' . $nurse->profile_picture)))
                                <img src="{{ asset('storage/' . $nurse->profile_picture) }}" class="rounded-circle"
                                    style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px; background-color: #007bff; color: white; font-weight: bold; font-size: 32px;">
                                    {{ strtoupper(substr($nurse->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-primary">{{ $nurse->first_name }}</h5>
                            <p class="mb-1 text-muted">
                                <i class="fas fa-envelope me-2"></i> {{ $nurse->email }}
                            </p>
                            <span class="badge bg-{{ $nurse->is_active ? 'success' : 'danger' }}">
                                {{ $nurse->is_active ? 'Active' : 'Inactive' }}
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
                        <p><strong>Full Name: </strong>{{ $nurse->first_name }} {{ $nurse->last_name }}</p>
                        <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($nurse->date_of_birth)->age }}</p>
                        <p><strong>Address: </strong>{{ $nurse->address }}</p>
                        <p><strong>Gender: </strong>{{ $nurse->gender }}</p>
                        <p><strong>Email: </strong>{{ $nurse->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p><strong>Phone Number: </strong>{{ $nurse->phone_number }}</p>
                        <p><strong>Working Hours: </strong>{{ $nurse->working_hours }}</p>
                        <p><strong>Working Days: </strong>{{ $nurse->working_days }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
