<script>
    var table = $('#data').DataTable({
        scrollX: true
    });

    async function Data() {

        table.clear().draw();

        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/broadcast/getData`,
            cache: false,
            contentType: false,
            processData: false,
            data: false,
            success: function(response) {

                var res = JSON.parse(response);
                var no = 1;

                function mapToValue(text) {
                    if (!text) return "-";

                    return text
                        .split(', ')
                        .map(word => {
                            switch (word.toLowerCase()) {
                                case 'all':
                                    return 'Semua user';
                                case 'user':
                                    return 'Public Viewer';
                                case 'student':
                                    return 'Siswa';
                                case 'parent':
                                    return 'Orang Tua';
                                case 'alumni':
                                    return 'Alumni';
                                default:
                                    return word;
                            }
                        })
                        .join(', ');
                }

                var dataRows = res.data.map(element => {

                    return [
                        no++,
                        element.title ? capitalizeFirstLetter(element.title) : "-",
                        element.message ? capitalizeFirstLetter(element.message) : "-",
                        element.to ? mapToValue(element.to) : "-",
                        element.createdAt ? moment(element.createdAt).format('DD MMMM YYYY') : "-",
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

    function capitalizeFirstLetter(string) {
        const words = string.split(' ');
        const output = words.map(word => {
            const firstLetter = word.substring(0, 1).toUpperCase();
            const rest = word.substring(1);

            return `${firstLetter}${rest}`
        })

        return output.join(' ')
    }

    document.getElementById('role_all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.role-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('role_all').checked;
        });
    });

    // Fungsi untuk ceklis individual
    document.querySelectorAll('.role-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            let allChecked = true;
            document.querySelectorAll('.role-checkbox').forEach(function(box) {
                if (!box.checked) {
                    allChecked = false;
                }
            });
            document.getElementById('role_all').checked = allChecked;
        });
    });

    CreateBroadcast = async () => {
        let data = new FormData();
        var title = $("#title").val();
        var message = $("#message").val();
        // var role = $("#role").val();

        var roles = [];
        $('#role input[type="checkbox"]:checked').each(function() {
            roles.push($(this).val());
        });

        if (title == "") {
            toastr.warning('title cannot be empty!');
            return
        }

        if (message == "") {
            toastr.warning('message cannot be empty!');
            return
        }

        if (roles.length === 0) {
            toastr.warning('Please select at least one recipient!');
            return;
        }

        data.append('title', title);
        data.append('message', message);
        // data.append('role', role);
        data.append('role', roles.join(','));

        $("#broadcast").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/admin/broadcast/post`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                setInterval(function() {
                    toastr.success('send broadcast success');
                    location.href = `${baseUrl}/admin/broadcast`;
                }, 2000);
            },
            error: function(err) {
                toastr.error('something went wrong');
                $("#broadcast").text('Submit');
            }
        });
    }
</script>