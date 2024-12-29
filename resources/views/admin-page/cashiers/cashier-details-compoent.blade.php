<div>
    <div class="row">
        <div class="col-md-12">
                <div class="container my-4">
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <h3 class="fw-bold">Cashier Details</h3>
                        <div class="d-flex ms-auto">
                            <a href="/cashier" wire:navigate class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                    
                <div class="card mb-4">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            @if($cashier->profile_picture && file_exists(storage_path('app/public/' . $cashier->profile_picture)))
                                <img src="{{ asset('storage/'.$cashier->profile_picture) }}" 
                                     class="rounded-circle" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 80px; height: 80px; background-color: #007bff; color: white; font-weight: bold; font-size: 32px;">
                                    {{ strtoupper(substr($cashier->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-1 fw-bold text-primary">{{$cashier->first_name}} {{$cashier->last_name}}</h5>
                            <p class="mb-1 text-muted">
                                <i class="fas fa-phone me-2"></i> {{$cashier->phone_number}}
                            </p>
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
                            <p><strong>Full Name: </strong>{{$cashier->first_name}} {{$cashier->last_name}}</p>
                            <p><strong>Age:</strong> 
                                {{ (int) \Carbon\Carbon::parse($cashier->date_of_birth)->diffInYears(\Carbon\Carbon::now()) }}
                            </p>
                            <p><strong>Address: </strong>{{$cashier->address}}</p>
                            <p><strong>Gender: </strong>{{$cashier->gender}}</p>
                            <p><strong>Email: </strong>{{$cashier->email}}</p>
                            <p><strong>Salary Type: </strong>{{$cashier->salary_type}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p><strong>Phone Number: </strong>{{$cashier->phone_number}}</p>
                            <p><strong>Working Hours: </strong>{{$cashier->working_hours}}</p>
                            <p><strong>Working Days: </strong>{{$cashier->working_days}}</p>
                            <p><strong>Salary: </strong>{{$cashier->salary ?? 'N/A'}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
