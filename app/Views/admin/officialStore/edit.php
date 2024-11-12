<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Store</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <input type="hidden" id="latitude" value="<?= $store->address->latitude ?>" hidden>
                            <input type="hidden" id="longitude" value="<?= $store->address->longitude ?>" hidden>
                            <input type="hidden" id="photoOld" value="<?= $store->link_photo ?>" hidden>
                            <input type="hidden" id="bannerOld" value="<?= $store->link_banner ?>" hidden>

                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Banner Toko:</label>
                                        <input type="file" class="dropify" id="imageStore" data-height="200" data-default-file="<?= $store->link_banner ?>" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Profile:</label>
                                        <input type="file" class="dropify" id="imageProfile" data-height="200" data-default-file="<?= $store->link_photo ?>" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Name Toko" value="<?= $store->name ?>">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                                <label>Email:</label>
                                                <input type="text" class="form-control" id="email" placeholder="Email Toko" value="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Phone:</label>
                                                <input type="number" class="form-control" id="phone" placeholder="Phone Toko" value="">
                                            </div> -->
                                    <div class="form-group col-md-6">
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" id="pac-input" placeholder="Alamat Toko" value="<?= $store->address->detail_address ?>" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Provinsi:</label>
                                        <select class="form-control" id="province" name="province">
                                            <option disabled selected>Select Province</option>
                                            <?php foreach ($province as $row) : ?>
                                                <option value="<?= htmlspecialchars($row->name) ?>" <?= ($row->name == htmlspecialchars($store->address->province)) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kota:</label>
                                        <select class="form-control" id="city" name="city">
                                            <!-- <option disabled selected><?= htmlspecialchars($store->address->city) ?></option> -->
                                            <?php foreach ($city as $row) : ?>
                                                <option value="<?= htmlspecialchars($row->name) ?>" <?= ($row->name == htmlspecialchars($store->address->city)) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kecamatan:</label>
                                        <select class="form-control" id="district" name="district">
                                            <!-- <option disabled selected><?= htmlspecialchars($store->address->district) ?></option> -->
                                            <?php foreach ($district as $row) : ?>
                                                <option value="<?= htmlspecialchars($row->name) ?>" <?= ($row->name == htmlspecialchars($store->address->district)) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($row->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kelurahan:</label>
                                        <select class="form-control" id="subdistrict" name="subdistrict">
                                            <option disabled selected><?= htmlspecialchars($store->address->sub_district) ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kode Pos:</label>
                                        <input type="text" class="form-control" id="posCode" placeholder="Kode Pos" value="<?= $store->address->postal_code ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div id="map" style="height: 400px; width: 100%;"></div>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateStore()" id="updateStore" class="btn btn-custom" style="float: right;">Update</button><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/store'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('description');

        // Fungsi untuk memperbesar tinggi berdasarkan isi
        textarea.addEventListener('input', function() {
            this.style.height = 'auto'; // Reset tinggi terlebih dahulu
            this.style.height = (this.scrollHeight) + 'px'; // Atur tinggi sesuai dengan scroll height
        });

        // Memastikan textarea disesuaikan saat halaman dimuat
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    });
</script>