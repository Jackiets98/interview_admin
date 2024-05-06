<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr"
    data-theme="theme-default"
    data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/"
    data-base-url="index.html" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

<!-- Content wrapper -->
<div class="content-wrapper">
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
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Profile
                    </div>
                    <div class="card-body">
                        @foreach ($adminDetails as $admin)
                        <form action="{{ url('/updateProfile/'.$admin->id  ) }}" id="updateProfile" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" name="firstName" class="form-control" value="{{ $admin->first_name }}"/>
                                <label>First Name</label>
                              </div>

                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" name="lastName" class="form-control" value="{{ $admin->last_name }}"/>
                                <label>Last Name</label>
                              </div>

                            <div class="form-floating form-floating-outline mb-4">
                                <input type="email" name="email" class="form-control" value="{{ $admin->email }}"/>
                                <label>Email</label>
                              </div>

                                <div class="input-group input-group-merge mb-4">
                                  <div class="form-floating form-floating-outline">
                                    <input type="password" name="password" id="passwordInput" class="form-control" />
                                    <label>Password (Optional)</label>
                                  </div>
                                  <span class="input-group-text cursor-pointer" id="togglePasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
                                </div>

                                <div class="input-group input-group-merge mb-4">
                                  <div class="form-floating form-floating-outline">
                                    <input type="password" name="confirmPassword" id="passwordConfirmInput" class="form-control" />
                                    <label>Confirm Password (Optional)</label>
                                  </div>
                                  <span class="input-group-text cursor-pointer" id="toggleConfirmPasswordVisibility"><i class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    <!-- Footer-->
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
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.getElementById("updateProfile");
        var password = form.elements["password"];
        var confirmPassword = form.elements["confirmPassword"];

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Passwords don't match");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener("input", validatePassword);
        confirmPassword.addEventListener("input", validatePassword);

        form.addEventListener("submit", function (event) {
            if (password.value !== confirmPassword.value) {
                event.preventDefault(); // Prevent form submission
                // Optionally, you can display an alert or error message here.
            }
        });
    });
</script>

    </body>

</html>
