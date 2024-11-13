<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>
<?php

use Config\Services;

$request = Services::request();
?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }

    textarea.custom {
        overflow: hidden;
        resize: none;
        min-height: 130px;
        /* Atur tinggi minimal */
        line-height: normal;
    }

    .nav-tabs .nav-item .nav-link {
        color: #000;
        padding: 10px 15px;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-item .nav-link:hover {
        border-bottom: 3px solid #27793a;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: #3DA956 !important;
        border-bottom: 3px solid #3DA956 !important;
    }

    .btn-custom {
        background-color: #007bff;
        color: #ffffff;
    }

    .btn-custom:hover {
        background-color: #045ab6;
        color: #ffffff;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <?php if (!$store): ?>
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Data Store</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="new-user-info">

                                <div style="display: flex;justify-content: center;">
                                    <a href="<?= base_url("/admin/officialStore/create") ?>" type="button" class="btn btn-primary">Buka Toko</a>
                                </div>

                                <h5>hello</h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <a href="#" style="text-decoration: none; color: inherit;">
                    <div class="card card-custom" style="background-color: #496989; cursor: default !important;">
                        <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
                            <div class="custome-card">
                                <h3 class="card-title textValue" style="color: #fff !important;">Total Toko Saya:</h3>
                                <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #fff !important;"><?= 'Rp.' . number_format($revenue, 0, ',', '.') ?></h4>
                            </div>
                            <i class="ri-coins-line" style="font-size: 5rem; margin-top: -2rem; color: #fff;"></i>
                        </div>
                    </div>
                </a>

                <a href="<?= base_url("/admin/product") ?>" style="text-decoration: none; color: inherit;">
                    <div class="card card-custom" style="background-color: #ADBC9F;">
                        <div class="card-body" style="display: flex; justify-content: space-between; margin-top: 1rem;">
                            <div class="custome-card">
                                <h3 class="card-title textValue" style="color: #fff !important;">Produk:</h3>
                                <h4 class="card-subtitle mb-2 text-muted textValue" style="color: #fff !important;"><?= $produk ?></h4>
                            </div>
                            <i class="ri-shopping-bag-line" style="font-size: 5rem; margin-top: -2rem; color: #fff;"></i>
                        </div>
                    </div>
                </a>

                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Daftar Pesanan</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "confirmed" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/confirmed") ?>">
                                        Konfirmasi
                                        <?php if (!empty($statusCount['confirmed'])) : ?>
                                            <span class="badge badge-danger"><?= $statusCount['confirmed'] ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "packing" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/packing") ?>">
                                        Diproses
                                        <?php if (!empty($statusCount['packing'])) : ?>
                                            <span class="badge badge-danger"><?= $statusCount['packing'] ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "shipping" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/shipping") ?>">Dikirim</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "delivered" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/delivered") ?>">
                                        Tiba di Tujuan
                                        <?php if (!empty($statusCount['delivered'])) : ?>
                                            <span class="badge badge-danger"><?= $statusCount['delivered'] ?></span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "done" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/done") ?>">Selesai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $request->uri->getSegment(4) == "cancel" ? "active" : "" ?>" href="<?= base_url("/admin/officialStore/status/cancel") ?>">Dibatalkan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent-2">
                                <div class="tab-pane fade show active">
                                    <div class="table-responsive">
                                        <table id="dataOrder" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">No Invoice</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Buyer</th>
                                                    <th scope="col">Kode Resi</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($order != "") { ?>
                                                    <?php foreach ($order as $row) : ?>
                                                        <tr>
                                                            <td><?= $no++ ?></td>
                                                            <td><?= $row['order_number'] ?></td>
                                                            <td>Rp. <?= number_format($row['price']) ?></td>
                                                            <td><?= $row['data']['shipping_address']['name'] ?? $row['data']['email_buyer'] ?></td>
                                                            <td><?= $row['data']['no_tracking'] ?? "-" ?></td>
                                                            <td><?php switch ($row['type']) {
                                                                    case "ECOMMERCE_DIGITAL":
                                                                        echo "DIGITAL";
                                                                        break;
                                                                    case "ECOMMERCE_FISIK":
                                                                        echo "FISIK";
                                                                        break;
                                                                }  ?>
                                                            </td>
                                                            <td>
                                                                <?php switch ($row['status']) {
                                                                    case null:
                                                                        echo "<div class='badge badge-pill btn-warning'>Pending</div>";
                                                                        break;
                                                                    case "ON_PROCESS":
                                                                        echo "<div class='badge button-confirm'>Packing</div>";
                                                                        break;
                                                                    case "DELIVERY":
                                                                        echo "<div class='badge badge-pill badge-info'>Delivery</div>";
                                                                        break;
                                                                    case "DELIVERED":
                                                                        echo "<div class='badge badge-pill badge-secondary'>Delivered</div>";
                                                                        break;
                                                                    case "FINISHED":
                                                                        echo "<div class='badge badge-pill badge-success'>Done</div>";
                                                                        break;
                                                                    case "CANCEL":
                                                                        echo "<div class='badge badge-pill badge-danger'>Cancel</div>";
                                                                        break;
                                                                }  ?>
                                                            </td>
                                                            <td>
                                                                <div class="send-panel">
                                                                    <?php if ($row['status'] === null) { ?>
                                                                        <button onclick="ConfirmedProduct('<?= $row['id'] ?>')" id="btnConfirm" type="button" class="btn btn-custom">Konfirmasi</button>
                                                                    <?php } ?>
                                                                    <?php if ($row['type'] === 'ECOMMERCE_DIGITAL' && $row['status'] === "ON_PROCESS") { ?>
                                                                        <button onclick="CodeVoucher('<?= $row['id'] ?>')" id="btnConfirm" type="button" class="btn btn-custom">Kirim Kode Voucher</button>
                                                                    <?php } ?>
                                                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DetailOrder('<?= $row['id'] ?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Image"> <i class="ri-list-check-2 text-primary"></i></a> </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Data Product</h4>
                            </div>
                            <a href="<?= base_url("/admin/product/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table id="data" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col">Categori</th>
                                            <!-- <th scope="col">Kode Voucher</th> -->
                                            <th scope="col">Harga</th>
                                            <th scope="col">&emsp;Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Toko Saya <?= $store->name ?></h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="tab-content" id="myTabContent-2">
                                <input type="hidden" id="latitude" value="<?= $store->address->latitude ?>" hidden>
                                <input type="hidden" id="longitude" value="<?= $store->address->longitude ?>" hidden>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="display: flex; gap: 5.9rem;">
                                        <div>
                                            <h4 style="font-weight: 700;">Nama Toko:</h4>
                                            <h5><?= $store->name ?></h5>
                                        </div>
                                        <div>
                                            <h4 style="font-weight: 700;">Kota:</h4>
                                            <h5><?= $store->address->city ?></h5>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="<?= base_url("/admin/officialStore/edit") ?>" type="button" class="btn btn-primary">Edit Toko</a>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem;">
                                    <h4 style="font-weight: 700;">Alamat Toko:</h4>
                                    <h5><?= $store->address->detail_address ?></h5>
                                </div>
                                <div class="form-group" style="margin-top: 1rem;">
                                    <div id="map" style="height: 200px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="iq-card-body">
                    <div class="modal fade" id="detailReportOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="margin-bottom: 0.5rem;">
                                        <div class="col-md-12 header-detail">
                                            <label class="label">No. Invoice</label>
                                            <span class="text-invoice" id="invoice"></span>
                                        </div><br>
                                        <div class="col-md-12 header-detail">
                                            <label class="label">Tanggal Pembelian</label>
                                            <span class="text" id="date"></span>
                                        </div>
                                        <div class="col-md-12 header-detail">
                                            <label class="label">Kategori Produk</label>
                                            <span class="text" id="resi"></span>
                                        </div>
                                        <div class="col-md-12 header-detail" id="noResi">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="product-container" id="productContainer">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-bottom">
                                        <div class="col-md-4">
                                            <label class="label">Pembeli :</label>
                                            <div class="text" id="buyer"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="label">Metode Pembayaran :</label>
                                            <div class="text" id="payment"></div>
                                        </div>
                                        <div class="col-md-4" id="shipping">
                                            <label class="label">Pengiriman :</label>
                                            <div class="text" id="shippingCode"></div>
                                        </div>
                                    </div>
                                    <!-- <div class="row text-bottom">
                                        </div> -->
                                    <!-- <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="text-pengiriman">Info Pengiriman</h5>
                                                <label class="label">Kurir :</label><br>
                                                <span class="kurir" id="kurir"></span> - <span class="kurir" id="code-kurir"></span>
                                                <br>
                                                <label class="label">Address :</label><br>
                                                <span class="address" id="address"></span><br>
                                                <span class="address-detail" id="address-detail"></span>
                                            </div>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="modal fade" id="voucherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kirim Kode Voucher</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalBodyContent">
                                    <div class="form-group col-md-12">
                                        <!-- <label>Kode Voucher:</label> -->
                                        <textarea id="description" class="form-control custom" placeholder="Masukkan kode voucher"></textarea>
                                    </div>
                                    <div style="text-align: end;">
                                        <button id="btnSubmit" onclick="submitVoucher()" type="button" class="btn btn-custom" style="width: 10%;">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/product'); ?>
<script>
    $('#dataOrder').DataTable({
        // scrollX: true,
        paggination: true,
        searching: true
    });

    function ConfirmedProduct(buyerId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Pesanan ini akan diterima!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, terima!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            $('#btnConfirm').text('Loading...');
            if (result.isConfirmed) {
                let data = new FormData();

                data.append('buyerId', buyerId);
                $.ajax({
                    type: "POST",
                    url: `${baseUrl}/admin/reportOrder/confirmed`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        toastr.success('update Status order success');
                        setTimeout(function() {
                            // location.reload();
                            window.top.location.href = `${baseUrl}/admin/officialStore/status/packing`;
                        }, 1500);
                    },
                    error: function(err) {
                        // Handle error
                        console.error('Error:', err);
                        toastr.error('something went wrong');
                        $('#btnConfirm').text('Konfirmasi');
                    }
                });
            }
            $('#btnConfirm').text('Konfirmasi');
        });
    }

    DetailOrder = async (orderId) => {
        $("#imageBanner").removeAttr("src");
        $('#detailReportOrder').modal('show');
        await $.ajax({
            type: "GET",
            url: `${baseUrl}/admin/reportOrder/detail/${orderId}`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data, 'cek');

                let nameBuyer = data.body.data.shipping_address ? data.body.data.shipping_address.name : data.body.data.email_buyer;

                let category;
                switch (data.body.type) {
                    case 'ECOMMERCE_DIGITAL':
                        category = "DIGITAL";
                        break;
                    case 'ECOMMERCE_FISIK':
                        category = "FISIK";
                        break;
                    default:
                        category = "Tidak diketahui";
                }

                $("#invoice").html(data.body.order_number);
                $("#date").html(moment(data.body.created_at).format('DD MMMM YYYY, HH:mm:ss'));
                $("#buyer").html(nameBuyer);
                $("#payment").html(data.body.payment.name);
                $("#resi").html(category);
                if (data.body.type === 'ECOMMERCE_FISIK') {
                    $("#noResi").html(`<label class="label">No. Resi</label><span class="text">${data.body.data.no_tracking}</span>`);
                    $("#noResi").show();
                } else {
                    $("#noResi").hide();
                }

                if (data.body.type === 'ECOMMERCE_FISIK') {
                    $("#shippingCode").html(`${data.body.data.shipping.code} - ${formatRupiah(data.body.data.shipping.cost)}`);
                    $("#shipping").show();
                } else {
                    $("#shipping").hide();
                }

                $("#productContainer").empty();

                var totalOrderPrice = 0;

                var dataProduct = data.body.items.map(element => {

                    var totalProductPrice = element.quantity * element.price;
                    var formattedProductPrice = formatRupiah(totalProductPrice);
                    var orderItemPrice = formatRupiah(element.price);
                    let picture = element.product.pictures !== null ? element.product.pictures[0].link : `${baseUrl}/public/assets/images/image-default.png`

                    var productHtml = `
                        <div class="product">
                            <div class="section-satu">
                                <div class="image-product">
                                    <img class="img-product" src="${picture}" alt="image">
                                </div>
                                <div class="text-product">
                                    <label class="text-product">${element.product.name}</label><br>
                                    <label class="text-product">${element.quantity} x ${orderItemPrice}</label><br>
                                    
                                </div>
                            </div>
                            <div class="section-dua">
                                <h5>Total Harga</h5>
                                <label class="label">${formattedProductPrice}</label>
                            </div>
                        </div>
                    `;
                    $("#productContainer").append(productHtml);
                });
                // var formattedTotalOrderPrice = formatRupiah(totalOrderPrice);

                // Tampilkan total keseluruhan di luar loop
                // $("#totalOrderPrice").html(formattedTotalOrderPrice);
            },
            error: function(err) {
                toastr.error('something went wrong');
            }
        });
    }

    function CodeVoucher(id) {
        document.getElementById('btnConfirm').setAttribute('data-id', id);
        // Menampilkan modal
        $('#voucherModal').modal('show');
    }

    function submitVoucher() {
        let data = new FormData();

        const voucherId = document.getElementById('btnConfirm').getAttribute('data-id');
        const voucherCode = document.getElementById('description').value;

        data.append('voucherId', voucherId);
        data.append('voucherCode', voucherCode);

        $('#btnSubmit').text('Loading...');
        $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/reportOrder/submitVoucher`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                toastr.success('send code voucher success');
                setTimeout(function() {
                    // location.reload();
                    window.top.location.href = `${baseUrl}/admin/officialStore/status/delivered`;
                }, 1500);
            },
            error: function(err) {
                // Handle error
                console.error('Error:', err);
                toastr.error('something went wrong');
                $('#btnSubmit').text('Submit');
            }
        });
    }

    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return `Rp ${formatted}`;
    }

    let selectedLatitude = parseFloat(document.getElementById("latitude").value) || -6.200000;
    let selectedLongitude = parseFloat(document.getElementById("longitude").value) || 106.816666;

    window.initMap = function() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            zoom: 13,
            mapTypeControl: false,
        });

        const marker = new google.maps.Marker({
            position: {
                lat: selectedLatitude,
                lng: selectedLongitude
            },
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: false,
        });

        // Pastikan input untuk autocomplete ada di halaman HTML
        const input = document.getElementById("pac-input");
        if (input) {
            const autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            });

            // Bind autocomplete to map bounds
            autocomplete.bindTo("bounds", map);

            autocomplete.addListener("place_changed", () => {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                if (place.geometry && place.geometry.location) {
                    selectedLatitude = place.geometry.location.lat();
                    selectedLongitude = place.geometry.location.lng();

                    // Update latitude and longitude in input fields
                    document.getElementById("latitude").value = selectedLatitude;
                    document.getElementById("longitude").value = selectedLongitude;

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                }
            });
        }

        google.maps.event.addListener(marker, 'dragend', function(event) {
            selectedLatitude = event.latLng.lat();
            selectedLongitude = event.latLng.lng();

            document.getElementById("latitude").value = selectedLatitude;
            document.getElementById("longitude").value = selectedLongitude;
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initMap();
    });
</script>