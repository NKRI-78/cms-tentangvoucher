<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<!--  Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">List User Join</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="detailJoin" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">ID Member</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php $i = 0; ?>
                                    <?php $b = 0; ?>
                                    <?php $c = 0; ?>
                                    <?php if (isset($eventJoin)) { ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($eventJoin as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="<?= getenv('API_MEDIA') . $row->profile_pic ?>" alt="profile"></td>
                                                <td><?= $row->fullname ?></td>
                                                <td><?= $row->email_address ?></td>
                                                <td><?= $row->phone_number ?></td>
                                                <td><?= $row->id_member ?></td>
                                                <td>
                                                    <?php switch ($row->present) {
                                                        case true:
                                                            echo "<div class='badge badge-pill badge-success'>Present</div>";
                                                            break;
                                                        case false:
                                                            echo "<div class='badge badge-pill badge-danger'>Not Present</div>";
                                                            break;
                                                    }  ?>
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
</div>
<!-- End Content  -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/admin'); ?>

<script>
    $(".switch").each(function(index) {

        if ($("#present" + index).val() == 1) {
            $("#togBtn" + index).trigger("click");
        }

        $("#togBtn" + index).on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked'); // yes

                let data = new FormData();
                var userId = $("#userId" + index).val();

                data.append('userId', userId);

                $.ajax({
                    type: "POST",
                    url: `${baseUrl}/admin/event/eventJoinPresent`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        toastr.success('success');
                        location.reload();
                    },
                    error: function(err) {
                        toastr.error('something went wrong');
                    }
                });

            } else {
                switchStatus = $(this).is(':checked'); // no

                let data = new FormData();
                var userId = $("#userId" + index).val();

                data.append('userId', userId);

                $.ajax({
                    type: "POST",
                    url: `${baseUrl}/admin/event/eventJoinNotPresent`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    success: function(response) {
                        toastr.success('success');
                        location.reload();
                    },
                    error: function(err) {
                        toastr.error('something went wrong');
                    }
                });
            }
        });
    });
</script>