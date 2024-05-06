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
            <span class="text-muted fw-light">Driver / </span> Account
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
                                        <span class="fw-medium text-heading me-2">Identification No:</span>
                                        <span>{{ $user->ic }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Vehicle Plate No:</span>
                                        <span>{{ $user->plate_no }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Phone No:</span>
                                        <span>{{ $user->contact }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Race:</span>
                                        <span>{{ $user->race }}</span>
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
                                        <a href="{{ route('driver.status.update', ['id' => $user->id, 'status' => '0']) }}"
                                            class="btn btn-outline-danger">Suspend</a>
                                    @elseif ($user->status == '0')
                                        <a href="{{ route('driver.status.update', ['id' => $user->id, 'status' => '1']) }}"
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
                                class="mdi mdi-truck-cargo-container mdi-20px me-1"></i>Delivery</a></li>
                </ul>
                <!--/ User Tabs -->

                <!-- Project table -->
                <div class="card mb-4">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        <div class="col-6">Delivery List</div>
                        <div class="col-6 text-end">
                            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#createDelivery"
                                data-bs-toggle="modal">Add</a>
                        </div>
                    </h5>
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($deliveryList as $delivery)
                                <tbody>
                                    <td>{{ $delivery->date }}</td>
                                    <td>{{ $delivery->first_name }} {{ $delivery->last_name }}</td>
                                    <td>{{ $delivery->item_code }} - {{ $delivery->name }}</td>
                                    <td>
                                        @if ($delivery->status == '0')
                                            <span class="badge badge-pill badge-info">To Be Delivered</span>
                                        @elseif ($delivery->status == '1')
                                            <span class="badge badge-pill badge-warning">Delivering</span>
                                        @elseif ($delivery->status == '2')
                                            <span class="badge badge-pill badge-success">Delivered</span>
                                        @elseif ($delivery->status == '3')
                                            <span class="badge badge-pill badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info view-details-btn"
                                            data-id="{{ $delivery->id }}"><i class="fa fa-address-card"></i> View
                                            Details</button></td>
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
                            <h3 class="mb-2">Edit Driver Information</h3>
                        </div>
                        @foreach ($userDetailsForEditing as $userDetails)
                            <form action="{{ url('/driverUpdate/' . $userDetails->id) }}" class="row g-4" method="POST">
                                @csrf
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="driverFirstName" class="form-control"
                                            value="{{ $userDetails->first_name }}" />
                                        <label for="modalEditUserFirstName">First Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="driverLastName" class="form-control"
                                            value="{{ $userDetails->last_name }}" />
                                        <label for="modalEditUserLastName">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="driverIC" class="form-control"
                                            value="{{ $userDetails->ic }}" />
                                        <label for="modalEditUserName">Identification No</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="driverPlateNo" class="form-control"
                                            value="{{ $userDetails->plate_no }}" />
                                        <label for="modalEditUserEmail">Vehicle Plate No</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="driverPhone" class="form-control"
                                            value="{{ $userDetails->contact }}" />
                                        <label>Contact No</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="driverRace" class="form-select">
                                            <option value="chinese"
                                                {{ $userDetails->race == 'chinese' ? 'selected' : '' }}>Chinese
                                            </option>
                                            <option value="malay"
                                                {{ $userDetails->race == 'malay' ? 'selected' : '' }}>Malay</option>
                                            <option value="indian"
                                                {{ $userDetails->race == 'indian' ? 'selected' : '' }}>Indian</option>
                                        </select>
                                        <label>Race</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="driverStatus" class="form-select">
                                            <option value="1"
                                                {{ $userDetails->status == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0"
                                                {{ $userDetails->status == '0' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                        <label for="modalEditUserStatus">Status</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group input-group-merge mb-4">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="driverPassword" id="passwordInput"
                                                class="form-control" />
                                            <label>Password (Optional)</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer" id="togglePasswordVisibility"><i
                                                class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="input-group input-group-merge mb-4">
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="driverConfirmPassword"
                                                id="passwordConfirmInput" class="form-control" />
                                            <label>Confirm Password (Optional)</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer"
                                            id="toggleConfirmPasswordVisibility"><i
                                                class="mdi mdi-eye-off-outline"></i></span>
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


        <!-- Modal -->
        <!-- Create Delivery Modal -->
        <div class="modal fade" id="createDelivery" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Delivery Information</h3>
                        </div>
                        <form action="{{ url('/createDelivery/' . $id) }}" class="row g-4" method="POST">
                            @csrf
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select name="deliveryCustomer" class="form-select" required>
                                        <option disabled selected>-Please Select Customer-</option>
                                        @foreach ($customerList as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }}
                                                {{ $customer->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="modalEditUserFirstName">Customer</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select name="deliveryProduct" class="form-select" onchange="updateQuantityInput()" required>
                                        <option disabled selected>-Please Select Product-</option>
                                        @foreach ($productList as $product)
                                            <option value="{{ $product->id }}" data-quantity="{{ $product->quantity }}">{{ $product->item_code }} -
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="modalEditUserFirstName">Product</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" name="deliveryQuantity" class="form-control" min="1" required/>
                                    <label for="modalEditUserName">Quantity</label>
                                </div>
                                <span id="quantityError" style="display: none; color: red;">Quantity exceeds maximum available</span>
                            </div>
                            <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="deliveryOrderDate" class="form-control" />
                                        <label for="modalEditUserName">Order Date</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="date" name="deliveryDate" class="form-control"
                                            min="{{ date('Y-m-d') }}" />
                                        <label for="modalEditUserName">Delivery Date</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select name="deliveryStatus" class="form-select" required>
                                        <option disabled selected>-Please Select Status-</option>
                                        <option value="0">To Be Delivered</option>
                                        <option value="1">Delivering</option>
                                        <option value="2">Delivered</option>
                                        <option value="3">Cancelled</option>
                                    </select>
                                    <label for="modalEditUserEmail">Delivery Status</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- Modal -->
        <!-- Edit Customer Price Modal -->
        <div class="modal fade" id="editDelivery" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Edit Details</h3>
                        </div>
                        <form action="{{ url('/updateDelivery') }}" class="row g-4" method="POST">
                            @csrf

                            <input type="hidden" name="deliveryID" class="form-control" id="deliveryID" />

                            <div class="form-floating form-floating-outline">
                                <select name="customer" class="form-select" required>
                                    <option selected disabled>-Please Select Customer-</option>
                                    @foreach ($customerList as $customer)
                                        @if ($customer->status == 1)
                                            <option value="{{ $customer->id }}"
                                                {{ old('customer') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->first_name }} {{ $customer->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="modalEditUserFirstName">Customer</label>
                            </div>
                            <div class="form-floating form-floating-outline">
                                <select name="product" class="form-select" required>
                                    <option selected disabled>-Please Select Product-</option>
                                    @foreach ($productList as $product)
                                        @if ($product->status == 1)
                                            <option value="{{ $product->id }}"
                                                {{ old('product') == $product->id ? 'selected' : '' }}>
                                                {{ $product->item_code }} - {{ $product->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="modalEditUserFirstName">Product</label>
                            </div>
                            <div class="form-floating form-floating-outline">
                                <input type="number" name="deliveryEditQuantity" class="form-control" />
                                <label for="modalEditUserName">Quantity</label>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" name="deliveryEditOrderDate" class="form-control" />
                                            <label for="modalEditUserName">Order Date</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating form-floating-outline">
                                            <input type="date" name="deliveryEditDate" class="form-control"
                                                min="{{ date('Y-m-d') }}" />
                                            <label for="modalEditUserName">Delivery Date</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <div class="form-floating form-floating-outline">
                                <select name="deliveryEditStatus" class="form-select">
                                  <option value="0" >To Be Delivered</option>
                                  <option value="1" >Delivering</option>
                                  <option value="2" >Delivered</option>
                                  <option value="3" >Cancelled</option>
                                </select>
                                <label for="modalEditUserStatus">Status</label>
                              </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Customer Price Modal -->


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
            document.getElementById('toggleConfirmPasswordVisibility').addEventListener('click', function() {
                var passwordInput = document.getElementById('passwordConfirmInput');
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
            document.addEventListener("DOMContentLoaded", function() {
                var form = document.getElementById("addDriver");
                var password = form.elements["driverPassword"];
                var confirmPassword = form.elements["driverConfirmPassword"];

                function validatePassword() {
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity("Passwords don't match");
                    } else {
                        confirmPassword.setCustomValidity('');
                    }
                }

                password.addEventListener("input", validatePassword);
                confirmPassword.addEventListener("input", validatePassword);

                form.addEventListener("submit", function(event) {
                    if (password.value !== confirmPassword.value) {
                        event.preventDefault(); // Prevent form submission
                        // Optionally, you can display an alert or error message here.
                    }
                });
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

<script>
    $('.view-details-btn').click(function() {
        var id = $(this).data('id');

        // Set the value of the input field
        $('#deliveryID').val(id);

        // Send AJAX request to fetch details
        $.ajax({
            url: '/getDeliveryDetails/' + id, // Replace '/getDetails/' with your actual route
            type: 'GET',
            success: function(response) {
                // Update modal content with fetched details
                $('select[name="customer"]').val(response.customer_id); // Assuming you have a customer_id in the response
                $('select[name="product"]').val(response.product_id);
                $('input[name="deliveryEditDate"]').val(response.date);
                $('input[name="deliveryEditOrderDate"]').val(response.order_date);
                $('input[name="deliveryEditQuantity"]').val(response.quantity);
                $('select[name="deliveryEditStatus"]').val(response.status);
                // Open the modal
                $('#editDelivery').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });
</script>

<script>
    function updateQuantityInput() {
        var select = document.querySelector('select[name="deliveryProduct"]');
        var quantityInput = document.querySelector('input[name="deliveryQuantity"]');
        var selectedOption = select.options[select.selectedIndex];
        var maxQuantity = selectedOption.getAttribute('data-quantity');

        quantityInput.min = 1; // Set minimum quantity to 1 by default
        quantityInput.max = maxQuantity; // Set maximum quantity based on selected product

        // If the current quantity input value is greater than the updated maximum, reset it to 1
        if (parseInt(quantityInput.value) > maxQuantity) {
            quantityInput.value = 1;
        }
    }

    // Validate quantity on form submit
    document.querySelector('form').addEventListener('submit', function(event) {
        var quantityInput = document.querySelector('input[name="deliveryQuantity"]');
        var maxQuantity = parseInt(quantityInput.max);
        var enteredQuantity = parseInt(quantityInput.value);

        if (enteredQuantity > maxQuantity) {
            event.preventDefault(); // Prevent form submission
            document.getElementById('quantityError').style.display = 'block'; // Show error message
        } else {
            document.getElementById('quantityError').style.display = 'none'; // Hide error message
        }
    });
</script>

        </body>

</html>
