<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr"
    data-theme="theme-default"
    data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/"
    data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel"
    data-template="vertical-menu-theme-default-light">

@include('layout.header')

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Customer / </span> Account
        </h4>

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

        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        @foreach ($userDetails as $user)
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded mb-3 mt-4"
                                        src="{{ asset('assets/img/avatars/unknown_profile.png') }}" height="120"
                                        width="120" alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-3 border-bottom mb-3">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Location:</span>
                                        <span>{{ $user->location }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Phone No:</span>
                                        <span>{{ $user->contact }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Status:</span>
                                        @if ($user->status == '1')
                                            <span class="badge bg-label-success rounded-pill">Active</span>
                                        @else
                                            <span class="badge bg-label-danger rounded-pill">Suspended</span>
                                        @endif
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                        data-bs-toggle="modal">Edit</a>
                                    @if ($user->status == '1')
                                        <a href="{{ route('customer.status.update', ['id' => $user->id, 'status' => '0']) }}"
                                            class="btn btn-outline-danger">Suspend</a>
                                    @elseif ($user->status == '0')
                                        <a href="{{ route('customer.status.update', ['id' => $user->id, 'status' => '1']) }}"
                                            class="btn btn-outline-success">Activate</a>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /User Card -->

            </div>
            <!--/ User Sidebar -->


            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- User Tabs -->
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i
                                class="mdi mdi-truck-cargo-container mdi-20px me-1"></i>Orders</a></li>
                </ul>
                <!--/ User Tabs -->

                <!-- Project table -->
                <div class="card mb-4">
                    <h5 class="card-header">Order List</h5>
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project">
                            <thead class="table-light">
                                <tr>
                                    <th>Order Date</th>
                                    <th>Item Code</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($orderList as $order)
                                <tbody>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->item_code }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>
                                        @if ($order->status == '0')
                                            <span class="badge badge-pill badge-info">To Be Delivered</span>
                                        @elseif ($order->status == '1')
                                            <span class="badge badge-pill badge-warning">Delivering</span>
                                        @elseif ($order->status == '2')
                                            <span class="badge badge-pill badge-success">Delivered</span>
                                        @elseif ($order->status == '3')
                                            <span class="badge badge-pill badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/viewReceipt/' . $order->id . '/' . $order->customer_id) }}" class="btn btn-sm btn-info view-details-btn">
                                            <i class="fa fa-address-card"></i> View Receipt
                                        </a>
                                    </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                <!-- /Project table -->

            </div>
            <!--/ User Content -->
        </div>

        <!-- Modal -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Edit Customer Information</h3>
                        </div>
                        @foreach ($userDetailsForEditing as $userDetails)
                            <form action="{{ url('/customerUpdate/' . $userDetails->id) }}" class="row g-4"
                                method="POST">
                                @csrf
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="customerFirstName" class="form-control"
                                            value="{{ $userDetails->first_name }}" />
                                        <label for="modalEditUserFirstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="customerLastName" class="form-control"
                                            value="{{ $userDetails->last_name }}" />
                                        <label for="modalEditUserLastName">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="customerLocation" class="form-control"
                                            value="{{ $userDetails->location }}" />
                                        <label for="modalEditUserName">Location</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="customerPhone" class="form-control"
                                            value="{{ $userDetails->contact }}" />
                                        <label>Contact No</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="customerStatus" class="form-select">
                                            <option value="1"
                                                {{ $userDetails->status == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ $userDetails->status == '0' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                        <label for="modalEditUserStatus">Status</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->


        @include('layout.footer')

        <script>
            document.getElementById('togglePasswordVisibility').addEventListener('click', function() {
                var passwordInput = document.getElementById('passwordInput');
                var eyeIcon = this.querySelector('i');

                // Toggle password visibility
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('mdi-eye-off-outline');
                    eyeIcon.classList.add('mdi-eye-outline');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('mdi-eye-outline');
                    eyeIcon.classList.add('mdi-eye-off-outline');
                }
            });
        </script>

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
