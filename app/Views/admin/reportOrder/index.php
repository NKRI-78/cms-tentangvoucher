<?php

use Config\Services;

$request = Services::request();
?>

<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>
<style>
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

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">List Order</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                            <!-- <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "pending" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/pending") ?>">Pending</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "confirmed" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/confirmed") ?>">Konfirmasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "packing" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/packing") ?>">Diproses</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "shipping" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/shipping") ?>">Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "delivered" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/delivered") ?>">Tiba di Tujuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "done" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/done") ?>">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $request->uri->getSegment(4) == "cancel" ? "active" : "" ?>" href="<?= base_url("/admin/reportOrder/status/cancel") ?>">Dibatalkan</a>
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content  -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/admin'); ?>
<script>
    // ConfirmedProduct = async (buyerId) => {
    //     console.log(buyerId, 'id');
    //     let data = new FormData();

    //     data.append('buyerId', buyerId);

    //     $('#btnConfirm').text('Loading...');
    //     await $.ajax({
    //         type: "POST",
    //         url: `${baseUrl}/admin/reportOrder/confirmed`,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: data,
    //         success: function(response) {
    //             toastr.success('update Status order success');
    //             // setInterval(function() {
    //             //     location.href = `${baseUrl}/admin/officialStore`;
    //             // }, 1500);
    //             setTimeout(function() {
    //                 location.reload();
    //             }, 1500);
    //         },
    //         error: function(err) {
    //             toastr.error('something went wrong');
    //             $('#btnConfirm').text('Confirmed');
    //         }
    //     });
    // }

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
                            location.reload();
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

    // DetailOrder = async (orderId) => {
    //     // $("#imageBanner").removeAttr("src");
    //     $('#voucherDigital').modal('show');
    //     await $.ajax({
    //         type: "GET",
    //         url: `${baseUrl}/admin/reportOrder/detail/${orderId}`,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: data,
    //         success: function(response) {
    //             var data = JSON.parse(response);
    //         },
    //         error: function(err) {
    //             toastr.error('something went wrong');
    //         }
    //     });
    // }

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
                    location.reload();
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
</script>