<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.pixinvent.com/materialize-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="vertical-menu-theme-default-light">

@include('layout.header')


      <!-- Content wrapper -->
      <div class="content-wrapper">

        <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y">


<div class="row invoice-preview">
  <!-- Invoice -->
  <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
    <div class="card invoice-preview-card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
          <div class="mb-xl-0 pb-3">
            <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
              <span class="app-brand-logo demo"><span>
                <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="width: 50px; height:50px">
</span>
</span>
              <span class="h4 mb-0 app-brand-text fw-bold">Logistics</span>
            </div>
            <p class="mb-1">123, Jalan Street 123</p>
            <p class="mb-1">Kuala Lumpur, Malaysia</p>
            <p class="mb-0">+601 01234657</p>
          </div>
          <div>
            <h4 class="fw-medium">INVOICE #{{ $deliveryInvoice }}</h4>
            <div class="mb-1">
              <span>Date Issues:</span>
              <span>{{ $formattedDate }}</span>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="my-3">
            <h6 class="pb-2">Invoice To:</h6>
            @foreach ($customerInfo as $item)
            <p class="mb-1">{{ $item->first_name }} {{ $item->last_name }}</p>  
            <p class="mb-1">{{ $item->location }}</p> 
            <p class="mb-1">+60{{ $item->contact }}</p> 
            @endforeach
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-borderless m-0">
          <thead class="border-top">
            <tr>
              <th>Item Code</th>
              <th>Description</th>
              <th>Cost</th>
              <th>Qty</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-nowrap text-heading">{{ $deliveryDetails->item_code }}</td>
              <td>{{ $deliveryDetails->name }}</td>
              <td>RM {{ number_format($deliveryDetails->price, 2) }}</td>
              <td>{{ $deliveryDetails->quantity }}</td>
              <td>RM {{ number_format($finalDeliveryPrice, 2) }}</td>
            </tr>
            @if($addOnList != [])
            @foreach ($addOnList as $addOn)
            <tr>
                <td class="text-nowrap text-heading">{{$addOn->item_code}}</td>
                <td class>{{$addOn->name}}</td>
                <td class>RM {{ number_format($addOn->price, 2) }}</td>
                <td class>{{$addOn->a_quantity}}</td>
                <td class>RM {{ number_format($addOn->final_price, 2) }}</td>
              </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-md-0 mb-3">
          </div>
          <div class="col-md-6 d-flex justify-content-md-end mt-2">
            <div class="invoice-calculations">
              <hr />
              <div class="d-flex justify-content-between">
                <span class="w-px-150">Total:</span>
                <h6 class="mb-0 pt-1">RM {{ number_format($totalPrice, 2) }}</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <span class="fw-medium text-heading">Note:</span>
            <span>This receipt is generated automatically. Thank You!</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Invoice -->

  <!-- Invoice Actions -->
  <div class="col-xl-3 col-md-4 col-12 invoice-actions">
    <div class="card">
      <div class="card-body">
        <a class="btn btn-outline-secondary d-grid w-100 mb-3" target="_blank" href="{{ url('/printReceipt/'.$id.'/'.$customerID) }}">
          Print
        </a>
      </div>
    </div>
  </div>
  <!-- /Invoice Actions -->
</div>

<!-- Offcanvas -->
<!-- /Offcanvas -->

          </div>
          <!-- / Content -->

          <!-- Footer -->
@include('layout.footer')

</body>

</html>
