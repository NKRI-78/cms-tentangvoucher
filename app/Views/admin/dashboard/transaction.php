<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Detail Transaction</h4>
                        </div>
                        <!-- <a href="<?= base_url("/admin/banner/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a> -->
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="data" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 4%;">No</th>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col" style="width: 10%;">Telepon</th>
                                        <th scope="col" style="width: 10%;">Jumlah</th>
                                        <th scope="col" style="width: 10%;">Type</th>
                                        <th scope="col" style="width: 10%;">Status</th>
                                        <th scope="col">Tanggal</th>
                                        <!-- <th scope="col">&emsp;&emsp;Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="iq-card-body">
                        <div class="modal fade" id="detailBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Image Banner</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" class="img-fluid" id="imageBanner" alt="image" style=" width: 100%; height: auto; max-height: 250px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<script>
    var table = $('#data').DataTable({
        // scrollX: true,
    });

    async function Data() {

        table.clear().draw();

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/dashboard/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: false,
            success: function(response) {
                var res = JSON.parse(response);
                var no = 1;

                let dataFilter = res.body.sort((a, b) => {
                    return new Date(b.created_at) - new Date(a.created_at); // Mengurutkan descending berdasarkan created_at
                });

                var dataRows = dataFilter.map(element => {
                    console.log(element, 'cek');

                    let statusText;
                    switch (element.status) {
                        case null:
                            statusText = "<div class='badge badge-pill btn-warning'>Pending</div>";
                            break;
                        case "ON_PROCESS":
                            statusText = "<div class='badge button-confirm'>Packing</div>";
                            break;
                        case "DELIVERY":
                            statusText = "<div class='badge badge-pill badge-info'>Delivery</div>";
                            break;
                        case "DELIVERED":
                            statusText = "<div class='badge badge-pill badge-secondary'>Delivered</div>";
                            break;
                        case "FINISHED":
                            statusText = "<div class='badge badge-pill badge-success'>Done</div>";
                            break;
                        case "CANCEL":
                            statusText = "<div class='badge badge-pill badge-danger'>Cancel</div>";
                            break;
                    }

                    let type;
                    switch (element.type) {
                        case "ECOMMERCE_FISIK":
                            type = "Fisik";
                            break;
                        case "ECOMMERCE_DIGITAL":
                            type = "Digital";
                            break;
                    }

                    const formatRupiah = (amount) => {
                        return amount ? new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0
                        }).format(amount) : "-";
                    };

                    let date = new Date(element.created_at).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    return [
                        no++,
                        element.order_number ? element.order_number : "-",
                        element.data.shipping_address ? element.data.shipping_address.name : element.data.email_buyer,
                        element.data.shipping_address ? element.data.shipping_address.phone_number : "-",
                        element.total_price ? formatRupiah(element.total_price) : "-",
                        element.type ? type : "-",
                        element.status ? statusText : "-",
                        element.created_at ? date : "-",
                    ]
                });

                table.rows.add(dataRows).draw();
            },
            error: function(err) {
                $(".loader-table").css({
                    "display": "none"
                });
                console.log(err);
            }
        });
    }

    Data();
</script>