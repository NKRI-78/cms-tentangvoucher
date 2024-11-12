<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Create Store</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="posCode" hidden>
                                    <input type="hidden" id="latitude" hidden>
                                    <input type="hidden" id="longitude" hidden>

                                    <div class="form-group col-md-6">
                                        <label>Banner Toko:</label>
                                        <input type="file" class="dropify" id="imageStore" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Profile:</label>
                                        <input type="file" class="dropify" id="imageProfile" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Nama Toko">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Phone:</label>
                                        <input type="number" class="form-control" id="phone" placeholder="Phone Store">
                                    </div> -->
                                    <div class="form-group col-md-6">
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" id="pac-input" placeholder="Address Store">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Provinsi:</label>
                                        <select class="form-control" id="province" name="category">
                                            <option disabled selected>Pilih Provinsi</option>
                                            <?php foreach ($province as $row) : ?>
                                                <option value="<?= htmlspecialchars($row->name) ?>">
                                                    <?= htmlspecialchars($row->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kota:</label>
                                        <select class="form-control" id="city" name="category">
                                            <option disabled selected>Pilih Kota</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kecamatan:</label>
                                        <select class="form-control" id="district" name="district">
                                            <option disabled selected>Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kelurahan:</label>
                                        <select class="form-control" id="subdistrict" name="subdistrict">
                                            <option disabled selected>Pilih Kelurahan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Kode Pos:</label>
                                        <input type="text" class="form-control" id="posCodeCreate" placeholder="Kode Pos" value="">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div id="map" style="height: 400px; width: 100%;"></div>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateStore()" id="createStore" class="btn btn-custom" style="float: right;">Submit</button><br>
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