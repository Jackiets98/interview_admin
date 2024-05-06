<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr"
    data-theme="theme-default"
    data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/"
    data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel"
    data-template="vertical-menu-theme-default-light">

@include('layout.header')

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-2">Orders</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-2 me-1 display-6">{{ $totalOrderPlaced }}</h4>
                                </div>
                                <p class="mb-0">Total Placed</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <div class="mdi mdi-clipboard-list-outline mdi-24px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-2">Customers</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-2 me-1 display-6">{{ $totalCustomer }}</h4>
                                </div>
                                <p class="mb-0">Total Active</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded">
                                    <div class="mdi mdi-account-check-outline mdi-24px scaleX-n1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" id="error-alert">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title" style="margin-bottom: -20px">Customers</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-users table">
                    <thead class="table-light">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    @foreach ($customerList as $customer)
                    <tbody>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->location }}</td>
                        <td>
                            @if ($customer->status == '1')
                                <span class="badge badge-pill badge-success">Active</span>
                            @elseif ($customer->status == '0')
                                <span class="badge badge-pill badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{url('/viewCustomer/'.$customer->id)}}" class="btn btn-sm btn-info"><i class="fa fa-address-card"> View Details</i></a>
                        </td>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <!-- Offcanvas to add new Customer -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Customer</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                    <form action="{{ route('createCustomer') }}" class="add-new-user pt-0" method="POST" id="addCustomer">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <!-- First Name -->
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" placeholder="Please Insert Customer's First Name"
                                        name="customerFirstName" required />
                                    <label for="add-user-fullname">First Name <span style="color: red;">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Last Name -->
                                <div class="form-floating form-floating-outline mb-4">
                                    <input type="text" class="form-control" placeholder="Please Insert Customer's Last Name"
                                        name="customerLastName" required />
                                    <label>Last Name <span style="color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control"
                                placeholder="Please Insert Customer's Location" name="customerLocation" required />
                            <label>Location <span style="color: red;">*</span></label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control phone-mask"
                                placeholder="Please Insert Customer's Phone No" name="customerContact" required />
                            <label>Contact <span style="color: red;">*</span></label>
                        </div>
                        <button type="submit" class="btn btn-success me-sm-3 me-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->

    @include('layout.footer')


    <script>
        // Remove success alert after 3 seconds
        setTimeout(function() {
            document.getElementById('success-alert').remove();
        }, 3000);

        // Remove error alert after 3 seconds
        setTimeout(function() {
            document.getElementById('error-alert').remove();
        }, 3000);
    </script>

    </body>

</html>
