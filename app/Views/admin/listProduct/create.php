<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 300px !important;
    }

    .dz-error-message {
        display: none !important;
    }

    .dz-error-mark {
        display: none !important;
    }

    .dz-button {
        display: none !important;
    }

    .dropzone-toolbar .dropzone-delete {
        cursor: pointer;
        display: inline-block;
        color: red;
        /* margin-left: -3.5rem; */
    }

    .dropzone-delete {
        position: absolute;
        margin-top: -6rem;
        margin-left: 6rem;
    }

    .custom-btn {
        background-Color: #007bff !important;
        color: #fff !important;
    }

    .custom-btn:hover {
        background-Color: #295F98 !important;
        color: #fff !important;
    }

    .image-name {
        display: inline-block;
        max-width: 150px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 14px;
        color: #333;
    }

    .btn-disabled {
        background-color: #adcdef !important;
        color: white !important;
        pointer-events: none;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nama Produk:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Nama Produk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Harga:</label>
                                        <input type="text" class="form-control" id="price" placeholder="Harga Produk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stok:</label>
                                        <input type="number" class="form-control" id="stock" placeholder="Stok Produk">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>Kode Voucher:</label>
                                        <input type="text" class="form-control" id="voucherCode" placeholder="Kode Voucher">
                                    </div> -->
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Berakhir:</label>
                                        <input type="text" class="form-control" id="dateExpire" placeholder="Tanggal Berakhir">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Categori Produk:</label>
                                        <select class="form-control" id="category" name="category">
                                            <option disabled selected>Pilih Categori</option>
                                            <option value="DIGITAL">DIGITAL</option>
                                            <option value="FISIK">FISIK</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Deskripsi:</label>
                                        <textarea id="description" class="form-control custom" placeholder="Isi Deskripsi"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <div class="form-group row">
                                            <!--begin::Label-->
                                            <!-- <label class="col-lg-2 col-form-label text-lg-right">Upload Files:</label> -->
                                            <!--end::Label-->

                                            <!--begin::Col-->
                                            <div class="col-lg-10">
                                                <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3">
                                                    <div class="dropzone-panel mb-lg-0 mb-2" style="display: flex; gap: 0.5rem;">
                                                        <a id="upload-image-button" class="dropzone-select btn btn-sm me-2 custom-btn"><i class="ri-add-line"></i>Insert Image</a>
                                                        <!-- <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a> -->
                                                        <span class="form-text text-muted">Maximum of 5 image uploads.</span>
                                                    </div>

                                                    <div class="dropzone-items wm-200px" style="display: flex; margin-top: 1rem;">
                                                        <div class="dropzone-item" style="display:none ">
                                                            <div style="display: flex !important; align-items: center; margin-top: 1rem; margin-right: 2rem;">
                                                                <div class="dropzone-toolbar" style="font-size: 2.5rem;">
                                                                    <span class="dropzone-delete" data-dz-remove><i class="ri ri-close-line"></i></span>
                                                                </div>
                                                                <div class="dropzone-file" style="display: flex; align-items: center;">
                                                                    <div class="dropzone-filename" title="some_image_file_name.jpg" style="display: grid;">
                                                                        <img data-dz-thumbnail style="max-width: 100px; max-height: 100px; object-fit: cover; border: 1.5px solid #000; border-radius: 10px;" />
                                                                        <span data-dz-name class="image-name">some_image_file_name.jpg</span>
                                                                        <strong>(<span data-dz-size>340kb</span>)</strong>
                                                                    </div>

                                                                    <!-- <div class="dropzone-error" data-dz-errormessage></div> -->
                                                                </div>
                                                                <div class="dropzone-progress">
                                                                    <div class="progress">
                                                                        <div
                                                                            class="progress-bar bg-primary"
                                                                            role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end::Col-->
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateProduct()" id="createProduct" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/product'); ?>
<script>
    $("#dateExpire").datepicker({
        dateFormat: "yy/mm/dd",
        startDate: new Date(),
        autoclose: true,
        orientation: "bottom auto"
    });
</script>