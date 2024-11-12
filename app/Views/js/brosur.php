<script>
    var table = $('#data').DataTable({
        scrollX: true,
    });

    async function Data() {

        table.clear().draw();

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/presentasi/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: false,
            success: function(response) {
                var res = JSON.parse(response);
                var no = 1;

                var dataRows = res.body.map(element => {

                    return [
                        no++,
                        element.title ? element.title : "-",
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

    // `<div class="send-panel"> 
    //     <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="${baseUrl}/admin/banner/edit/${element.id}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Event"><i class="ri-edit-line text-primary"></i></a></label>&nbsp;
    //     <label class="ml-2 mb-0 iq-bg-primary rounded"><a onclick="DetailBanner('${element.id}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail"> <i class="ri-list-check-2 text-primary"></i></a> </label>&nbsp;
    //     <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DeleteBanner(${element.id})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Event"> <i class="ri-delete-bin-line text-primary"></i></a></label>
    // </div>`

    async function CreateBrosur() {
        var data = new FormData();

        var title = $("#title").val();
        // var type = $("#type").val();
        var link = $("#link").val();
        var file = $('#fileDokumen')[0].files[0];

        // Validasi input
        if (!title || !file) {
            return Swal.fire({
                title: 'Error!',
                text: 'Semua field harus diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        // Validasi format file
        var validFormats = ['png', 'jpg', 'jpeg'];
        var fileExtension = file.name.split('.').pop().toLowerCase();
        if (!validFormats.includes(fileExtension)) {
            return Swal.fire({
                title: 'Format Tidak Valid!',
                text: 'Hanya file png/jpg yang diperbolehkan!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        data.append('title', title);
        // data.append('type', type);
        data.append('link', link);
        data.append('file', file);

        $("#createBrosur").text('Loading...');
        try {
            let response = await $.ajax({
                type: "POST",
                url: `${baseUrl}/admin/brosur/post`,
                cache: false,
                contentType: false,
                processData: false,
                data: data
            });
            toastr.success('Create brosur success');
            setInterval(function() {
                window.top.location.href = `${baseUrl}/admin/brosur`;
            }, 1500);
        } catch (err) {
            console.log(err);
            toastr.error('Something went wrong');
            $("#createBrosur").text('Submit');
        }
    }

    async function EditBrosur() {
        var data = new FormData();

        var modulId = $("#modulId").val();
        var title = $("#title").val();
        var type = $("#type").val();
        var link = $("#link").val();
        var fileOld = $("#fileOld").val();
        var file = $('#fileDokumen')[0].files[0];

        // Validasi input
        if (!title || !type ) {
            return Swal.fire({
                title: 'Error!',
                text: 'Semua field harus diisi!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        // Validasi format file
        if (file) {
            var validFormats = ['png', 'jpg', 'jpeg'];
            var fileExtension = file.name.split('.').pop().toLowerCase();

            if (!validFormats.includes(fileExtension)) {
                return Swal.fire({
                    title: 'Format Tidak Valid!',
                    text: 'Hanya file png/jpeg yang diperbolehkan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
            data.append('file', file); // Tambahkan file baru
        } else {
            data.append('file', fileOld); // Gunakan file lama jika file baru tidak ada
        }

        data.append('title', title);
        data.append('type', type);
        data.append('link', link);
        data.append('file', file);
        data.append('modulId', modulId);
        data.append('fileOld', fileOld);

        $("#editPresentasi").text('Loading...');
        try {
            let response = await $.ajax({
                type: "POST",
                url: `${baseUrl}/admin/brosur/update`,
                cache: false,
                contentType: false,
                processData: false,
                data: data
            });
            toastr.success('Edit brosur success');
            setInterval(function() {
                window.top.location.href = `${baseUrl}/admin/brosur`;
            }, 1500);
        } catch (err) {
            console.log(err);
            toastr.error('Something went wrong');
            $("#editPresentasi").text('Submit');
        }
    }

    function DeleteModul(modulId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Brosur ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: `${baseUrl}/admin/brosur/delete/${modulId}`,
                    success: function(response) {
                        console.log(response, 'delete');
                        Swal.fire(
                            'Dihapus!',
                            'Brosur berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(err) {
                        // Handle error
                        console.error('Error:', err);
                    }
                });
            }
        });
    }
</script>