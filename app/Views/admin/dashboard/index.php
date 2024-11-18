<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>
<style>
  .total:hover {
    background-color: #2f4a66 !important;
    border: #2f4a66 2px solid !important;
  }

  .produk:hover {
    background-color: #6f825d !important;
    border: #6f825d 2px solid !important;
  }

  .member:hover {
    background-color: #ad874c !important;
    border: #ad874c 2px solid !important;
  }

  .store:hover {
    background-color: #a95858 !important;
    border: #a95858 2px solid !important;
  }
</style>

<!--  Content  -->
<div id="content-page" class="content-page">
  <div class="container-fluid mb-5">
    <div class="row">

      <a href="<?= base_url("/admin/dashboard/detailTransaction") ?>" style="text-decoration: none; color: inherit;">
        <div class="card card-custom" style="background-color: #fff; border: #496989 2px solid;">
          <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
            <div class="custome-card">
              <h3 class="card-title textValue" style="color: #496989 !important;">Total Semua Toko:</h3>
              <!-- <h6 style="color: #fff !important; margin-top: -1.1rem;">(Semua Toko)</h6> -->
              <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #496989 !important;"><?= 'Rp.' . number_format($revenue, 0, ',', '.') ?></h4>
              <!-- <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #fff !important;"><?= 'Rp.' . number_format($revenue, 0, ',', '.') . '(' . $revenueTotal . ')' ?></h4> -->
            </div>
            <i class="ri-coins-line" style="font-size: 5rem; margin-top: -2rem; color: #496989;"></i>
          </div>
          <div class="card-footer total" style="background-color: #496989; margin-top:5rem; border: #496989 2px solid; width: 21rem; margin-left: -2px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <h5 style="color: #fff; font-weight:600;">Lihat detail <i class="ri-arrow-right-circle-line"></i></h5>
          </div>
        </div>
      </a>

      <a href="<?= base_url("/admin/listProduct") ?>" style="text-decoration: none; color: inherit;">
        <div class="card card-custom" style="background-color: #fff; border: #ADBC9F 2px solid;">
          <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
            <div class="custome-card">
              <h3 class="card-title textValue" style="color: #ADBC9F !important;">Semua Produk:</h3>
              <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #ADBC9F !important;"><?= $produk ?></h4>
            </div>
            <i class="ri-shopping-bag-line" style="font-size: 5rem; margin-top: -2rem; color: #ADBC9F;"></i>
          </div>
          <div class="card-footer produk" style="background-color: #ADBC9F; margin-top:5rem; border: #ADBC9F 2px solid; width: 21rem; margin-left: -2px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <h5 style="color: #fff; font-weight:600;">Lihat detail <i class="ri-arrow-right-circle-line"></i></h5>
          </div>
        </div>
      </a>

      <a href="<?= base_url("/admin/member") ?>" style="text-decoration: none; color: inherit;">
        <div class="card card-custom" style="background-color: #fff; border: #E8B86D 2px solid;">
          <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
            <div class="custome-card">
              <h3 class="card-title textValue" style="color: #E8B86D !important;">Member:</h3>
              <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #E8B86D !important;"><?= $member ?></h4>
            </div>
            <i class="ri-user-3-line" style="font-size: 5rem; margin-top: -2rem; color: #E8B86D;"></i>
          </div>
          <div class="card-footer member" style="background-color: #E8B86D; margin-top:5rem; border: #E8B86D 2px solid; width: 21rem; margin-left: -2px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <h5 style="color: #fff; font-weight:600;">Lihat detail <i class="ri-arrow-right-circle-line"></i></h5>
          </div>
        </div>
      </a>

      <a href="<?= base_url("/admin/listStore") ?>" style="text-decoration: none; color: inherit;">
        <div class="card card-custom" style="background-color: #fff; border: #CA7373 2px solid;">
          <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
            <div class="custome-card">
              <h3 class="card-title textValue" style="color: #CA7373 !important;">Total Toko:</h3>
              <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #CA7373 !important;"><?= $store ?></h4>
            </div>
            <i class="ri-store-2-line" style="font-size: 5rem; margin-top: -2rem; color: #CA7373;"></i>
          </div>
          <div class="card-footer store" style="background-color: #CA7373; margin-top:5rem; border: #CA7373 2px solid; width: 21rem; margin-left: -2px; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
            <h5 style="color: #fff; font-weight:600;">Lihat detail <i class="ri-arrow-right-circle-line"></i></h5>
          </div>
        </div>
      </a>

      <!-- <div class="col-lg-12" style="text-align: center; padding: 218px; opacity: 0.3;">
        <img src="<?= base_url('public/assets/images/logo-voucher.png') ?>" alt="logo-dashboard" style="width: 434px;">
      </div> -->

    </div>
  </div>
</div>
<!-- End Content  -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>