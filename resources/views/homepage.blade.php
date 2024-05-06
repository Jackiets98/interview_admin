<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="index.html" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')

      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row gy-4">

  <!-- Statistics Total Order -->
  <div class="col-lg-6 col-sm-6">
    <div class="card h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
          <div class="avatar">
            <div class="avatar-initial bg-label-primary rounded">
              <i class="mdi mdi-cart-plus mdi-24px"></i>
            </div>
          </div>
        </div>
        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
          <h5 class="mb-2">{{ $totalOrder }}</h5>
          <p class="mb-lg-2 mb-xl-3">Total Orders</p>
        </div>
      </div>
    </div>
  </div>
  <!--/ Statistics Total Order -->

  <!-- Sessions line chart -->
  <div class="col-lg-6 col-sm-6">
    <div class="card h-100">
      <div class="card-header pb-0">
        <div class="d-flex align-items-end mb-1 flex-wrap gap-2">
          <h4 class="mb-0 me-2">$38.5k</h4>
          <p class="mb-0 text-success">+62%</p>
        </div>
        <span class="d-block mb-2 text-body">Sessions</span>
      </div>
      <div class="card-body pt-0">
        <div id="sessions"></div>
      </div>
    </div>
  </div>
  <!--/ Sessions line chart -->

  <!-- Total Transactions & Report Chart -->
  <div class="col-12 col-xl-12">
    <div class="card h-100">
      <div class="row">
        <div class="col-md-7 col-12 order-2 order-md-0">
          <div class="card-header">
            <h5 class="mb-0">Total Transactions</h5>
          </div>
          <div class="card-body">
            <div id="totalTransactionChart"></div>
          </div>
        </div>
        <div class="col-md-5 col-12 border-start">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h5 class="mb-1">Report</h5>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="totalTransaction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-dots-vertical mdi-24px"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalTransaction">
                  <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                  <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  <a class="dropdown-item" href="javascript:void(0);">Update</a>
                </div>
              </div>
            </div>
            <p class="mb-0 text-body">Last month transactions $234.40k</p>
          </div>
          <div class="card-body pt-3">
            <div class="row">
              <div class="col-6 border-end">
                <div class="d-flex flex-column align-items-center">
                  <div class="avatar">
                    <div class="avatar-initial bg-label-success rounded">
                      <div class="mdi mdi-trending-up mdi-24px"></div>
                    </div>
                  </div>
                  <p class="my-2">This Week</p>
                  <h6 class="mb-0">+82.45%</h6>
                </div>
              </div>
              <div class="col-6">
                <div class="d-flex flex-column align-items-center">
                  <div class="avatar">
                    <div class="avatar-initial bg-label-primary rounded">
                      <div class="mdi mdi-trending-down mdi-24px"></div>
                    </div>
                  </div>
                  <p class="my-2">This Week</p>
                  <h6 class="mb-0">-24.86%</h6>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <div class="d-flex justify-content-around flex-wrap gap-2">
              <div>
                <p class="mb-1">Performance</p>
                <h6 class="mb-0">+94.15%</h6>
              </div>
              <div>
                <button class="btn btn-primary" type="button">view report</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Transactions & Report Chart -->
</div>

          </div>
          <!-- / Content -->

          <!-- Footer -->
                    <!-- Footer-->
@include('layout.footer')

</body>

</html>
