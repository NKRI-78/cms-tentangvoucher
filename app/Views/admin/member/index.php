<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?= base_url('public/assets/css/member.css') ?>">

<style>
    /* styling css to fixedcolumns */
    .tbody-member {
        overflow: hidden !important;
        height: 100% !important;
        background-color: white;
    }

    .DTFC_LeftBodyLiner {
        top: -12px !important;
        overflow-y: hidden !important;
    }

    .btn-delete {
        background-color: #f14336;
        color: #fff;
    }

    .btn-delete:hover {
        background-color: #c82333;
        color: #fff;
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
                            <h4 class="card-title">Data Member</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="member" class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 2%;z-index:1;background-color: white;">No</th>
                                        <th style="width: 10%;z-index:1;background-color: white;">Username</th>
                                        <th scope="col" style="width: 10%;">Email</th>
                                        <th scope="col" style="width: 10%;">Telepon</th>
                                        <th scope="col" style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-member">
                                    <?php $no = 1; ?>
                                    <?php if (isset($member->data) && is_array($member->data) && count($member->data) > 0) : ?>
                                        <?php foreach ($member->data as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= htmlspecialchars($row->username) ?></td>
                                                <td><?= htmlspecialchars($row->email) ?></td>
                                                <td><?= htmlspecialchars($row->phone_number) ?></td>
                                                <td>
                                                    <button onclick="DeleteMember(<?= $row->id ?>)" class="btn btn-delete btn-sm">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="9">No members found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="modalreject" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box">
                                        <i class="material-icons">&#xE5CD;</i>
                                    </div>
                                    <h4 class="modal-title w-100">Apakah Anda Yakin?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-footer justify-content-center">

                                    <button type="button" id="btnsave" class="btn btn-primary">ya</button>
                                    <button type="button" id="btncancel" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<?= view('js/admin'); ?>

<script>
    // $("#validation").show();
    // function Delete(userId) {
    //     $.ajax({
    //         type: "GET",
    //         url: `${baseUrl}/admin/member/delete/${userId}`,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: data,
    //         success: function(response) {
    //             toastr.success('Hapus Member Berhasil');

    //             setInterval(function() {
    //                 location.reload();
    //             }, 1000);
    //         },
    //         error: function(err) {
    //             toastr.error('Hapus Member Gagal');
    //         }
    //     });
    // }

    // $(".switch").each(function(index) {


    //     var role = $("#role" + index).val();
    //     var status = $("#status" + index).val();

    //     if (role == "member") {
    //         $("#togBtn" + index).trigger("click");
    //     }


    //     $("#togBtn" + index).on('change', function() {
    //         if ($(this).is(':checked')) {
    //             switchStatus = $(this).is(':checked');

    //             let data = new FormData();
    //             var userId = $("#userId" + index).val();
    //             alert(userId)

    //             data.append('userId', userId);

    //             if (role == "partnership") {
    //                 $.ajax({
    //                     type: "POST",
    //                     url: `${baseUrl}/admin/member/partnership`,
    //                     cache: false,
    //                     contentType: false,
    //                     processData: false,
    //                     data: data,
    //                     success: function(response) {

    //                         toastr.success('success');
    //                         location.reload();
    //                     },
    //                     error: function(err) {
    //                         toastr.error('something went wrong');
    //                     }
    //                 });
    //             } else {

    //                 $.ajax({
    //                     type: "POST",
    //                     url: `${baseUrl}/admin/member/approval`,
    //                     cache: false,
    //                     contentType: false,
    //                     processData: false,
    //                     data: data,
    //                     success: function(response) {

    //                         toastr.success('success');
    //                         location.reload();
    //                     },
    //                     error: function(err) {
    //                         toastr.error('something went wrong');
    //                     }
    //                 });
    //             }

    //         } else {

    //             if (role != "partnership") {
    //                 $("#modalreject").modal('show');

    //                 $("#btnsave").on('click', function() {
    //                     switchStatus = $(this).is(':checked');

    //                     let data = new FormData();
    //                     var userId = $("#userId" + index).val();

    //                     data.append('userId', userId);


    //                     $.ajax({
    //                         type: "POST",
    //                         url: `${baseUrl}/admin/member/rejected`,
    //                         cache: false,
    //                         contentType: false,
    //                         processData: false,
    //                         data: data,
    //                         success: function(response) {
    //                             toastr.success('success');
    //                             location.reload();
    //                         },
    //                         error: function(err) {
    //                             toastr.error('something went wrong');
    //                         }
    //                     });
    //                 });
    //                 $("#btncancel").on('click', function() {
    //                     $.ajax({
    //                         type: "POST",
    //                         url: `${baseUrl}/admin/member/approval`,
    //                         cache: false,
    //                         contentType: false,
    //                         processData: false,
    //                         data: data,
    //                         success: function(response) {

    //                             toastr.success('success');
    //                             location.reload();
    //                         },
    //                         error: function(err) {
    //                             toastr.error('something went wrong');
    //                         }
    //                     });

    //                 });
    //             } else {
    //                 let data = new FormData();
    //                 var userId = $("#userId" + index).val();

    //                 data.append('userId', userId);

    //                 $.ajax({
    //                     type: "POST",
    //                     url: `${baseUrl}/admin/member/partnership`,
    //                     cache: false,
    //                     contentType: false,
    //                     processData: false,
    //                     data: data,
    //                     success: function(response) {

    //                         toastr.success('success');
    //                         location.reload();
    //                     },
    //                     error: function(err) {
    //                         toastr.error('something went wrong');
    //                     }
    //                 });
    //             }
    //         }
    //     });
    // });

    function DeleteMember(id) {
        console.log(id, 'cek id');
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Member ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: `${baseUrl}/admin/member/delete/${id}`,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Approved!',
                            text: 'Member telah berhasil dihapus.',
                            timer: 3000,
                            showConfirmButton: "Ok"
                        }).then(() => {
                            window.location.reload();
                            Data();
                        });
                    },
                    error: function(err) {
                        // Handle error
                        console.error('Error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Approved Failed!',
                            text: 'Ada masalah saat menghapus member tersebut. Silakan coba lagi nanti.',
                            timer: 3000,
                            showConfirmButton: "Ok"
                        });
                    }
                });
            }
        });
    }
</script>