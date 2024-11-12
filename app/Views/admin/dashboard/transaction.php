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
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
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

                var dataRows = res.body.payments.map(element => {
                    
                    let statusText;
                    switch (element.status) {
                        case 'PAID':
                            statusText = "<div class='badge badge-pill badge-success'>PAID</div>";
                            break;
                        case 1:
                            statusText = "Menunggu Setujui";
                            break;
                        case 2:
                            statusText = "Ditolak";
                            break;
                        case 3:
                            statusText = "Sudah jadi siswa";
                            break;
                        default:
                            statusText = "Status tidak diketahui"; // Untuk menangani status yang tidak terduga
                    }

                    const formatRupiah = (amount) => {
                        return amount ? new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(amount) : "-";
                    };

                    let date = new Date(element.createdAt).toLocaleDateString('id-ID', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    return [
                        no++,
                        element.User ? element.User.name : "-",
                        element.User ? element.User.phone : "-",
                        element.amount ? formatRupiah(element.amount) : "-",
                        element.PaymentGetOneOrder.type ? element.PaymentGetOneOrder.type : "-",
                        element.status ? statusText : "-",
                        element.createdAt ? date : "-",
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