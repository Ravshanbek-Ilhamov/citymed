<div>
    <div class="page-header">
        <h3 class="fw-bold mb-3">Services</h3>
        <ul class="breadcrumbs mb-3">
        <li class="nav-home">
            <a href="/statistics">
            <i class="icon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="/direction"wire:navigate>Directions</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="/service" wire:navigate>Services</a>
        </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <div class="card-title">All Services</div>
            <div class="d-flex align-items-center">
                <button
                  class="btn btn-primary btn-round ms-auto"
                  data-bs-toggle="modal"
                  data-bs-target="#addRowModal"
                >
                  <i class="fa fa-plus"></i>
                  Add Service
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
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header border-0">
                      <h5 class="modal-title">
                        <span class="fw-mediumbold"> New</span>
                        <span class="fw-light"> Row </span>
                      </h5>
                      <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="small">
                        Create a new row using this form, make sure you
                        fill them all
                      </p>
                      <form>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group form-group-default">
                              <label>Name</label>
                              <input
                                id="addName"
                                type="text"
                                class="form-control"
                                placeholder="fill name"
                              />
                            </div>
                          </div>
                          <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                              <label>Position</label>
                              <input
                                id="addPosition"
                                type="text"
                                class="form-control"
                                placeholder="fill position"
                              />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group form-group-default">
                              <label>Office</label>
                              <input
                                id="addOffice"
                                type="text"
                                class="form-control"
                                placeholder="fill office"
                              />
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer border-0">
                      <button
                        type="button"
                        id="addRowButton"
                        class="btn btn-primary"
                      >
                        Add
                      </button>
                      <button
                        type="button"
                        class="btn btn-danger"
                        data-dismiss="modal"
                      >
                        Close
                      </button>
                    </div>
                  </div>
                </div>
            </div>
            
            <div class="card-body">
                
            <table class="table table-striped mt-3">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Direction Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Is_active</th>
                    <th scope="col">Doctor Name</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->direction->name}}</td>
                            <td>{{$service->name}}</td>
                            <td>{{$service->is_active}}</td>
                            <td>{{$service->doctor_id}}</td>
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