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
            <span class="text-muted fw-light">Warehouse / </span> Item
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
                        @foreach ($productDetails as $product)
                            <div class="user-avatar-section">
                                <div class=" d-flex align-items-center flex-column">
                                    <img class="img-fluid rounded mb-3 mt-4"
                                        src="{{ asset('assets/img/avatars/unknown_profile.png') }}" height="120"
                                        width="120" alt="User avatar" />
                                    <div class="user-info text-center">
                                        <h4>{{ $product->item_code }}</h4>
                                    </div>
                                </div>
                            </div>
                            <h5 class="pb-3 border-bottom mb-3">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Name:</span>
                                        <span>{{ $product->name }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Price:</span>
                                        <span>RM {{ $product->default_price }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Quantity:</span>
                                        <span>{{ $product->quantity }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Status:</span>
                                        @if ($product->status == '1')
                                            <span class="badge bg-label-success rounded-pill">In Stock</span>
                                        @else
                                            <span class="badge bg-label-danger rounded-pill">Out of Stock</span>
                                        @endif
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                        data-bs-toggle="modal">Edit</a>
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
                                class="mdi mdi-currency-usd mdi-20px me-1"></i>Customer's Price</a></li>
                </ul>
                <!--/ User Tabs -->

                <!-- Project table -->
                <div class="card mb-4">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        <div class="col-6">Customer's Price List</div>
                        <div class="col-6 text-end">
                            <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#createCustomPrice"
                                data-bs-toggle="modal">Add</a>
                        </div>
                    </h5>
                    <div class="table-responsive mb-3">
                        <table class="table datatable-project">
                            <thead class="table-light">
                                <tr>
                                    <th>Customer</th>
                                    <th class="text-nowrap">Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($customPriceList as $item)
                                <tbody>
                                    <td>{{ $item->first_name }}</td>
                                    <td>RM {{ number_format($item->price, 2) }}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <span class="badge badge-pill badge-success">Ongoing</span>
                                        @elseif ($item->status == '0')
                                            <span class="badge badge-pill badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td><button class="btn btn-sm btn-info view-details-btn"
                                            data-id="{{ $item->id }}"><i class="fa fa-address-card"></i> View
                                            Details</button></td>
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
                            <h3 class="mb-2">Edit Product Information</h3>
                        </div>
                        @foreach ($productDetailsForEditing as $productDetails)
                            <form action="{{ url('/itemUpdate/' . $productDetails->id) }}" class="row g-4"
                                method="POST">
                                @csrf
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="productItemCode" class="form-control"
                                            value="{{ $productDetails->item_code }}" />
                                        <label for="modalEditUserFirstName">Item Code</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="productName" class="form-control"
                                            value="{{ $productDetails->name }}" />
                                        <label for="modalEditUserLastName">Name</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="productPrice" class="form-control"
                                            value="{{ $productDetails->default_price }}" />
                                        <label for="modalEditUserName">Price</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="productQuantity" class="form-control"
                                            value="{{ $productDetails->quantity }}" />
                                        <label for="modalEditUserEmail">Quantity</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select name="productStatus" class="form-select">
                                            <option value="1"
                                                {{ $productDetails->status == '1' ? 'selected' : '' }}>In Stock
                                            </option>
                                            <option value="0"
                                                {{ $productDetails->status == '0' ? 'selected' : '' }}>Out Of Stock
                                            </option>
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

        <!-- Modal -->
        <!-- Add Customer Price Modal -->
        <div class="modal fade" id="createCustomPrice" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Set Custom Price</h3>
                        </div>
                        <form action="{{ url('/addCustomPrice/' . $id) }}" class="row g-4" method="POST">
                            @csrf
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
                                <input type="number" name="customPrice" class="form-control" step="0.01" />
                                <label for="modalEditUserLastName">Price</label>
                            </div>
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focToggle" id="noneFOCRadio"  value="noneFOC" checked>
                                    <label class="form-check-label" for="noneFOCRadio">
                                        None
                                    </label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focToggle" id="focAfterRadio"  value="focAfter">
                                    <label class="form-check-label" for="focAfterRadio">
                                        Free Of Charge After (Unit)
                                    </label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focToggle" id="focEveryRadio"  value="focEvery">
                                    <label class="form-check-label" for="focEveryRadio">
                                        Free Of Charge Every (Unit)
                                    </label>
                                </div>
                            </div>
                            <div class="col-12" id="focAfterInput">
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="numberOfUnitFreeAfter" class="form-control" />
                                        <label for="modalEditUserName">Number of Unit Free</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="focAfter" class="form-control" />
                                        <label for="modalEditUserName">Free Of Charge After (Unit)</label>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-12" id="focEveryInput" style="display: none;">
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="numberOfUnitFreeEvery" class="form-control" />
                                        <label for="modalEditUserName">Number of Unit Free</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="focEvery" class="form-control" />
                                        <label for="modalEditUserName">Free Of Charge Every (Unit)</label>
                                    </div>
                                </div>
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
        <!--/ Add Customer Price Modal -->

        <!-- Modal -->
        <!-- Edit Customer Price Modal -->
        <div class="modal fade" id="editCustomPrice" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Edit Details</h3>
                        </div>
                        <form action="{{ url('/updateCustomPrice') }}" class="row g-4" method="POST">
                            @csrf

                            <input type="hidden" name="customPriceID" class="form-control" id="customPriceID" />

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
                                <input type="number" name="customPrice" class="form-control" step="0.01" />
                                <label for="modalEditUserLastName">Price</label>
                            </div>
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focEditToggle" id="noneEditFOCRadio"  value="noneEditFOC" checked>
                                    <label class="form-check-label" for="noneEditFOCRadio">
                                        None
                                    </label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focEditToggle" id="focEditAfterRadio"  value="focEditAfter">
                                    <label class="form-check-label" for="focEditAfterRadio">
                                        Free Of Charge After (Unit)
                                    </label>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="focEditToggle" id="focEditEveryRadio"  value="focEditEvery">
                                    <label class="form-check-label" for="focEditEveryRadio">
                                        Free Of Charge Every (Unit)
                                    </label>
                                </div>
                            </div>
                            <div class="col-12" id="focEditAfterInput">
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="numberOfUnitEditFreeAfter" class="form-control" max="100" />
                                        <label for="modalEditUserName">Number of Unit Free</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="focEditAfter" class="form-control" />
                                        <label for="modalEditUserName">Free Of Charge After (Unit)</label>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-12" id="focEditEveryInput" style="display: none;">
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="numberOfUnitEditFreeEvery" class="form-control" />
                                        <label for="modalEditUserName">Number of Unit Free</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="focEditEvery" class="form-control" />
                                        <label for="modalEditUserName">Free Of Charge Every (Unit)</label>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="form-floating form-floating-outline">
                                <select name="customStatus" class="form-select">
                                  <option value="1" >Ongoing</option>
                                  <option value="0" >Cancelled</option>
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
            $('.view-details-btn').click(function() {
                var id = $(this).data('id');

                // Set the value of the input field
                $('#customPriceID').val(id);

                // Send AJAX request to fetch details
                $.ajax({
                    url: '/getCustomPriceDetails/' + id, // Replace '/getDetails/' with your actual route
                    type: 'GET',
                    success: function(response) {
                        // Update modal content with fetched details
                        $('select[name="customer"]').val(response.customer_id); // Assuming you have a customer_id in the response
                        $('input[name="customPrice"]').val(response.price);
                        $('input[name="focEditEvery"]').val(response.foc_every_unit);
                        $('input[name="numberOfUnitEditFreeEvery"]').val(response.foc_every_amount);
                        $('input[name="focEditAfter"]').val(response.foc_after_unit);
                        $('input[name="numberOfUnitEditFreeAfter"]').val(response.foc_after_amount);
                        $('select[name="customStatus"]').val(response.status);
                        // Open the modal
                        $('#editCustomPrice').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });
            });
        </script>

<script>
    $(document).ready(function() {
        // Initially hide the input fields
        $('#focAfterInput').hide();
        $('#focEveryInput').hide();

        // Trigger click event on the "None" radio button
        $('#noneFOCRadio').click(function() {
            $('#focAfterInput').hide();
            $('#focEveryInput').hide();
        });

        // Show/hide the input fields based on the selected radio button
        $('input[name="focToggle"]').change(function() {
            if ($(this).val() == 'focAfter') {
                $('#focAfterInput').show();
                $('#focEveryInput').hide();
            } else if ($(this).val() == 'focEvery') {
                $('#focAfterInput').hide();
                $('#focEveryInput').show();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initially hide the input fields
        $('#focEditAfterInput').hide();
        $('#focEditEveryInput').hide();

        // Trigger click event on the "None" radio button
        $('#noneEditFOCRadio').click(function() {
            $('#focEditAfterInput').hide();
            $('#focEditEveryInput').hide();
        });

        // Show/hide the input fields based on the selected radio button
        $('input[name="focEditToggle"]').change(function() {
            if ($(this).val() == 'focEditAfter') {
                $('#focEditAfterInput').show();
                $('#focEditEveryInput').hide();
            } else if ($(this).val() == 'focEditEvery') {
                $('#focEditAfterInput').hide();
                $('#focEditEveryInput').show();
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
            $(document).ready(function() {
                // Initially hide the input fields based on the radio button selection
                $('input[name="focEditToggle"]').change(function() {
                    if ($(this).val() == 'noneEditFOC') {
                        $('#focEditAfterInput').hide();
                        $('#focEditEveryInput').hide();
                        // Set the values of input fields to 0
                        $('input[name="numberOfUnitEditFreeEvery"]').val(0);
                        $('input[name="focEditEvery"]').val(0);
                        $('input[name="numberOfUnitEditFreeAfter"]').val(0);
                        $('input[name="focEditAfter"]').val(0);
                    } else if ($(this).val() == 'focEditAfter') {
                        $('#focEditAfterInput').show();
                        $('#focEditEveryInput').hide();
                    } else if ($(this).val() == 'focEditEvery') {
                        $('#focEditAfterInput').hide();
                        $('#focEditEveryInput').show();
                    }
                });
            });
        </script>

        </body>

</html>
