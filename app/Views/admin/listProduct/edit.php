<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    /* .dz-image>img {
        width: 182px;
    } */

    .dz-image>img {
        width: 182px;
        height: auto;
    }

    .dz-details .dz-size {
        display: none;
    }

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

    /* .dropzone-item {
        display: block;
    } */

    .dropzone-toolbar .dropzone-delete {
        cursor: pointer;
        display: inline-block;
        color: red;
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

<?php
function formatRupiah($amount)
{
    return number_format($amount, 0, ',', '.');
}
?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="productId" value="<?= $product->id ?>" hidden>
                                    <input type="text" id="imageIds" value="<?= htmlspecialchars(json_encode(array_column($product->pictures, 'id')), ENT_QUOTES, 'UTF-8') ?>" hidden>
                                    <input type="text" id="imagePath" value="<?= htmlspecialchars(json_encode(array_column($product->pictures, 'link')), ENT_QUOTES, 'UTF-8') ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Nama Produk:</label>
                                        <input type="text" class="form-control" id="title" placeholder="Nama Produk" value="<?= $product->name ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Harga:</label>
                                        <input type="text" class="form-control" id="price" placeholder="Harga Produk" value="<?= formatRupiah($product->price) ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stok:</label>
                                        <input type="number" class="form-control" id="stock" placeholder="Stok Produk" value="<?= $product->stock ?>">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>Kode Voucher:</label>
                                        <input type="text" class="form-control" id="voucherCode" placeholder="Kode Voucher" value="<?= $product->voucher_code ?>">
                                    </div> -->
                                    <div class="form-group col-md-6">
                                        <label>Tanggal Berakhir:</label>
                                        <input type="text" class="form-control" id="dateExpire" placeholder="Tanggal Berakhir" value="<?= date("m/d/Y", strtotime($product->expire)) ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Categori Produk:</label>
                                        <select class="form-control" id="category" name="category">
                                            <option disabled selected>Pilih Categori</option>
                                            <option value="DIGITAL" <?= $product->type == 'DIGITAL' ? 'selected' : '' ?>>DIGITAL</option>
                                            <option value="FISIK" <?= $product->type == 'FISIK' ? 'selected' : '' ?>>FISIK</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Deskripsi:</label>
                                        <textarea id="description" class="form-control custom" placeholder="Isi Deskripsi"><?= $product->description ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <div class="form-group row">

                                            <!--begin::Col-->
                                            <div class="col-lg-10">
                                                <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_3">
                                                    <div class="dropzone-panel mb-lg-0 mb-2" style="display: flex; gap: 0.5rem;">
                                                        <a id="upload-image-button" class="dropzone-select btn btn-sm me-2 custom-btn"><i class="ri-add-line"></i>Insert Image</a>
                                                        <!-- <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a> -->
                                                        <span class="form-text text-muted">Maximum of 5 image uploads.</span>
                                                    </div>

                                                    <div class="dropzone-items wm-200px" style="display: flex; margin-top: 1rem;">
                                                        <div class="dropzone-item">
                                                            <div style="display: flex !important; align-items: center; margin-top: 1rem; margin-right: 2rem;">
                                                                <div class="dropzone-toolbar" style="font-size: 2.5rem;">
                                                                    <span class="dropzone-delete" data-dz-remove><i class="ri ri-close-line"></i></span>
                                                                </div>
                                                                <div class="dropzone-file" style="display: flex; align-items: center;">
                                                                    <div class="dropzone-filename" title="some_image_file_name.jpg" style="display: grid;">
                                                                        <img data-dz-thumbnail style="width: 100px; height: 100px; object-fit: cover; border: 1.5px solid #000; border-radius: 10px;" />
                                                                        <span data-dz-name class="image-name">some_image_file_name.jpg</span>
                                                                        <!-- <strong>(<span data-dz-size>340kb</span>)</strong> -->
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
                                <button type="button" onclick="UpdateProduct()" id="updateNews" class="btn btn-custom" style="float: right;">Update</button><br>
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
<script>
    $("#dateExpire").datepicker({
        dateFormat: "yy/mm/dd",
        startDate: new Date(),
        autoclose: true,
        orientation: "bottom auto"
    });

    Dropzone.autoDiscover = false;

    UpdateProduct = async () => {
        let data = new FormData();

        var productId = $("#productId").val();
        var title = $("#title").val();
        var price = $("#price").val().replace(/\./g, '');
        var stock = $("#stock").val();
        var voucherCode = $("#voucherCode").val();
        var category = $("#category").val();
        var dateExpire = $("#dateExpire").val();
        var description = $("#description").val();
        var oldImagePaths = JSON.parse($("#imagePath").val() || "[]");

        // if (!title) {
        //     toastr.error('Title is required');
        //     return;
        // }

        // if (!price || isNaN(price)) {
        //     toastr.error('Valid price is required');
        //     return;
        // }

        // if (!stock || isNaN(stock)) {
        //     toastr.error('Stock must be a valid number');
        //     return;
        // }


        // if (!voucherCode || isNaN(voucherCode)) {
        //     toastr.error('Voucher code must be a valid number');
        //     return;
        // }

        // if (!dateExpire) {
        //     toastr.error('Weight must be a valid number');
        //     return;
        // }

        // if (!category) {
        //     toastr.error('Category is required');
        //     return;
        // }

        // if (!description) {
        //     toastr.error('Deskripsi is required');
        //     return;
        // }

        // if (myDropzone.files.length === 0) {
        //     toastr.error('The image cannot be empty');
        //     return;
        // }

        data.append('productId', productId);
        data.append('title', title);
        data.append('price', price);
        data.append('stock', stock);
        data.append('category', category);
        data.append('voucherCode', voucherCode);
        data.append('dateExpire', dateExpire);
        data.append('description', description);
        data.append('oldImagePaths', oldImagePaths);

        console.log(myDropzone.files, 'cek img');

        // myDropzone.files.forEach((file, index) => {
        //     data.append(`images[${index}]`, file);
        // });

        myDropzone.files.forEach((file, index) => {
            if (file instanceof File) {
                // Tambahkan gambar baru
                data.append(`images[${index}]`, file);
            } else {
                // Tambahkan gambar lama (gunakan URL sebagai placeholder)
                data.append(`images[${index}]`, file.url);
            }
        });

        $("#updateNews").prop('disabled', true);
        $("#updateNews").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/product/update`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                console.log(response, 'edit');
                toastr.success('update product success');
                setInterval(function() {
                    location.href = `${baseUrl}/admin/officialStore/status/confirmed`;
                }, 1500);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#updateNews").text('Submit');
            }
        });
    }

    // function deleteImage(fileId) {
    //     let data = new FormData();

    //     let imageId = fileId;

    //     data.append('imageId', imageId);

    //     $.ajax({
    //         type: "POST",
    //         url: `${baseUrl}/admin/product/deleteImage`,
    //         data: data,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(response) {
    //             console.log(response, 'aa');
    //             console.log('Image deleted successfully', response);
    //             // window.location.reload()
    //         },
    //         error: function(err) {
    //             console.error('Error deleting image', err);
    //         }
    //     });
    // }

    const priceInput = document.getElementById('price');

    priceInput.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^,\d]/g, '');

        let parts = value.split(',');
        let integerPart = parts[0];
        let decimalPart = parts[1];

        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        this.value = decimalPart !== undefined ? integerPart + ',' + decimalPart : integerPart;

        this.value = this.value;
        // this.value = 'Rp ' + this.value;
    });

    const id = "#kt_dropzonejs_example_3";
    const dropzone = document.querySelector(id);

    // Menyiapkan elemen template preview
    var previewNode = dropzone.querySelector(".dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    // Inisialisasi Dropzone dengan opsi yang diinginkan
    var myDropzone = new Dropzone("#kt_dropzonejs_example_3", {
        url: `${baseUrl}/admin/product/post`,
        parallelUploads: 5,
        maxFilesize: 1,
        previewTemplate: previewTemplate,
        previewsContainer: "#kt_dropzonejs_example_3 .dropzone-items",
        clickable: "#kt_dropzonejs_example_3 .dropzone-select",
        maxFiles: 5,
        autoProcessQueue: false
    });

    const imageId = JSON.parse(document.getElementById('imageIds').value);
    const imagePath = JSON.parse(document.getElementById('imagePath').value);

    const imageFiles = imageId.map((id, index) => ({
        id: id,
        path: imagePath[index]
    }));

    // Fungsi untuk mengupdate status tombol upload
    function updateButtonState() {
        const button = document.getElementById('upload-image-button');
        const acceptedFilesCount = myDropzone.files.length;
        const existingFilesCount = imageFiles.length;

        const totalFiles = acceptedFilesCount + existingFilesCount;

        // Periksa apakah total file lebih dari 4
        if (totalFiles >= 5) {
            button.classList.add('btn-disabled');
            button.style.pointerEvents = 'none';
        } else {
            button.classList.remove('btn-disabled');
            button.style.pointerEvents = 'auto';
        }
    }

    imageFiles.forEach((file) => {
        const mockFile = {
            name: file.path.split('/').pop(),
            url: file.path,
            id: file.id,
            // Jika Anda memiliki ukuran file, tambahkan properti `size`
            // size: 12345
        };

        // Emit Dropzone events untuk menampilkan preview
        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, file.path);
        myDropzone.emit("complete", mockFile);

        // Tambahkan mockFile ke array files Dropzone secara manual
        myDropzone.files.push(mockFile);

        // Set up event untuk menghapus gambar lama
        mockFile.previewElement.querySelector("[data-dz-remove]").addEventListener("click", function() {
            imageFiles.splice(imageFiles.indexOf(file), 1);
            updateButtonState();
        });
    });

    updateButtonState();

    // Event listener untuk menampilkan preview gambar
    myDropzone.on("addedfile", function(file) {
        const dropzoneItems = document.querySelectorAll('.dropzone-item');
        dropzoneItems.forEach(dropzoneItem => {
            dropzoneItem.style.display = '';
        });

        // Hitung total file yang ada termasuk file yang sudah ada dan yang baru ditambahkan
        const totalFiles = myDropzone.files.length + imageFiles.length;

        // Jika total file lebih dari 5, hapus file yang paling baru ditambahkan
        if (totalFiles > 5) {
            myDropzone.removeFile(file);
            alert("Jumlah maksimal gambar adalah 5. Gambar terbaru yang ditambahkan akan dihapus.");
        }

        updateButtonState();

        file.previewElement.querySelector("[data-dz-remove]").addEventListener("click", function() {
            // deleteImage(file.id);
            updateButtonState();
        });
    });

    // Event listener saat file dihapus
    myDropzone.on("removedfile", function(file) {
        // Update status tombol upload saat gambar dihapus
        updateButtonState();
    });

    // Event listener untuk mengupdate progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.width = progress + "%";
        });
    });

    // Event listener ketika file mulai dikirim
    myDropzone.on("sending", function(file) {
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.opacity = "1";
        });
    });

    // Event listener ketika upload selesai
    myDropzone.on("complete", function(progress) {
        const progressBars = document.querySelectorAll('.dz-complete');

        setTimeout(function() {
            progressBars.forEach(progressBar => {
                progressBar.querySelector('.progress-bar').style.opacity = "0";
                progressBar.querySelector('.progress').style.opacity = "0";
            });
        }, 300);
    });

    // Event listener untuk menampilkan preview gambar
    myDropzone.on("thumbnail", function(file, dataUrl) {
        var dropzoneItem = file.previewElement;
        var imgElement = dropzoneItem.querySelector("img");
        if (imgElement) {
            imgElement.src = dataUrl;
        }
    });

    $('#title').on('input', function() {
        let inputValue = $(this).val();
        let capitalizedValue = inputValue.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
        $(this).val(capitalizedValue);
    });
</script>