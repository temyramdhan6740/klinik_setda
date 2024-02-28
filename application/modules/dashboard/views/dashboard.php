 <!-- Content -->
 <div class="container-xxl flex-grow-1 container-p-y">
     <div class="row">
         <div class="col-lg-8 mb-4 order-0">
             <div class="card">
                 <div class="d-flex align-items-end row">
                     <div class="col-sm-7">
                         <div class="card-body">
                             <h5 class="card-title text-primary">Selamat Datang {{$_SESSION['username']}}! 🎉</h5>
                             <p class="mb-4">
                                 Untuk Saat ini Dashboard dari Email Blast sedang dalam masa Pengembangan.
                                 <br>
                             <div>Salam Hangat dari kami SIMRS.</div>
                             </p>
                         </div>
                     </div>
                     <div class="col-sm-5 text-center text-sm-left">
                         <div class="card-body pb-0 px-0 px-md-4">
                             <img src="<?= base_url('assets/sneat/assets/img/illustrations/man-with-laptop-light.png') ?>"
                                 height="140" alt="View Badge User"
                                 data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                 data-app-light-img="illustrations/man-with-laptop-light.png" />
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-lg-4 mb-4 order-0">
             <div class="card">
                 <div class="card-body">
                     <div class="card-title d-flex align-items-start justify-content-between">
                         <div class="avatar flex-shrink-0">

                             <img src="<?= base_url('assets/sneat/assets/img/icons/unicons/cc-warning.png') ?>"
                                 alt="Credit Card" class="rounded">
                         </div>
                         <span class="badge bg-label-danger rounded-pill">
                             <b><small class="text-end text-center">Hari Ini</small></b>
                         </span>
                     </div>
                     <span class="fw-semibold d-block mb-1">Email Gagal Terkirim</span>
                     <h3 class="card-title mb-2">{{ $mailFailed }}</h3>
                     @php
                     $classcolorup = 'text-success';
                     $classcolordown = 'text-danger';
                     @endphp
                     <span class="badge bg-label-danger"> <small><b>Akumulasi Email Gagal
                                 Terkirim Elektif</b></small> </span>
                 </div>
             </div>
         </div>

         <!-- Total Revenue -->
         <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
             <div class="card">
                 <div class="row row-bordered g-0">
                     <div class="col-md-8">
                         <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                         <!-- <div id="totalRevenueChart" class="px-2"></div>  -->

                     </div>
                     <div class="col-md-4">
                         <div class="card-body">
                             <div class="text-center">
                                 <div class="dropdown">
                                     <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                         id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                         aria-expanded="false">
                                         {{ $tahun[0]->tahun }}
                                     </button>
                                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                         @foreach ($tahun as $item_tahun)
                                         <a class="dropdown-item"
                                             href="javascript:void(0);">{{ $item_tahun->tahun }}</a>
                                         @endforeach
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="growthChart"></div>
                         <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

                         <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                             <div class="d-flex">
                                 <div class="me-2">
                                     <span class="badge bg-label-primary p-2"><i
                                             class="bx bx-dollar text-primary"></i></span>
                                 </div>
                                 <div class="d-flex flex-column">
                                     <small>2022</small>
                                     <h6 class="mb-0">{{ $mailSuccess }}</h6>
                                 </div>
                             </div>
                             <div class="d-flex">
                                 <div class="me-2">
                                     <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                 </div>
                                 <div class="d-flex flex-column">
                                     <small>2021</small>
                                     <h6 class="mb-0"> {{ $mailSuccessLastMonth }}</h6>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--/ Total Revenue -->

         <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
             <div class="row">
                 <div class="mb-4">
                     <div class="card">
                         <div class="card-body">
                             <div class="card-title d-flex align-items-start justify-content-between">
                                 <div class="avatar flex-shrink-0">
                                     <img src="<?= base_url('assets/sneat/assets/img/icons/unicons/cc-primary.png') ?>"
                                         alt="Credit Card" class="rounded" />
                                 </div>
                                 <span class="badge bg-label-info rounded-pill">
                                     <b><small class="text-end text-center">Bulan Ini</small></b>
                                 </span>
                             </div>
                             <span class="fw-semibold d-block mb-1">Email Terkirim</span>
                             <h3 class="card-title mb-2">{{ $mailSuccess }}</h3>
                             @php
                             $classcolorup = 'text-success';
                             $classcolordown = 'text-danger';
                             @endphp
                             <small
                                 class="@if ($mailSuccess > $mailSuccessLastMonth) text-success @else text-danger @endif fw-semibold">
                                 @if ($mailSuccess > $mailSuccessLastMonth)
                                 <i class='bx bx-up-arrow-alt'></i> +
                                 @else
                                 <i class='bx bx-down-arrow-alt'></i> -
                                 @endif
                                 {{ $mailComparePercentage }} %
                             </small>
                             <span class="badge bg-label-primary rounded-pill"> <small><b>Bulan Lalu</b></small> </span>
                         </div>
                     </div>
                 </div>
                 <div class="mb-4">
                     <div class="card">
                         <div class="card-body">
                             <div class="card-title d-flex align-items-start justify-content-between">
                                 <div class="avatar flex-shrink-0">
                                     <img src="<?= base_url('assets/sneat/assets/img/icons/unicons/cc-success.png') ?>"
                                         alt="Credit Card" class="rounded" />
                                 </div>
                                 <span class="badge bg-label-secondary rounded-pill">
                                     <b><small class="text-end text-center">Total</small></b>
                                 </span>
                             </div>
                             <span class="fw-semibold d-block mb-1">Email Terkirim</span>
                             <h3 class="card-title mb-2">{{ $totalEmails }}</h3>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- / Content -->