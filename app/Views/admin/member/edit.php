<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Member</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Fullname:</label>
                                        <input type="text" class="form-control" id="fullname" value="<?= $member->fullname ?>">
                                    </div>
                                    <?php if ($member->user_type == "partnership") { ?>
                                        <div class="form-group col-md-12">
                                            <label hidden>No Member:</label>
                                            <input type="text" class="form-control" id="no_member" value="<?= $member->no_member ?>" hidden>
                                        </div>
                                    <?php } else { ?>
                                        <div class="form-group col-md-12">
                                            <label>No Member:</label>
                                            <input type="text" class="form-control" id="no_member" value="<?= $member->no_member ?>">
                                        </div>
                                    <?php } ?>
                                    <div class="form-group col-md-12">
                                        <label>Address:</label>
                                        <textarea id="address" class="form-control"><?= $member->address ?></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateUser('<?= $member->user_id ?>')" id="updateUser" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/admin'); ?>