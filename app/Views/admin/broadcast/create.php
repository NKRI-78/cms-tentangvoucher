<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>

<style>
    .custom {
        line-height: normal;
        height: 130px !important;
    }
</style>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Add Broadcast</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="title" class="form-control" id="title" placeholder="Title Broadcast">
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label>Dikirim kepada:</label>
                                        <select class="form-control" id="role">
                                            <option value="" disabled selected>Pilih penerima</option>
                                            <option value="STUDENT">Siswa</option>
                                            <option value="USER">Public Viewer</option>
                                            <option value="PARENT">Orang Tua</option>
                                            <option value="">All</option>
                                        </select>
                                    </div> -->
                                    <div class="form-group col-md-6">
                                        <label>Dikirim kepada:</label>
                                        <div id="role">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="role_all" value="ALL">
                                                <label class="form-check-label" for="role_all">Pilih Semua</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_user" value="2">
                                                <label class="form-check-label" for="role_user">Public Viewer</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_student" value="3">
                                                <label class="form-check-label" for="role_student">Siswa</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_parent" value="4">
                                                <label class="form-check-label" for="role_parent">Orang Tua</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_alumni" value="5">
                                                <label class="form-check-label" for="role_alumni">Alumni</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Message:</label>
                                        <textarea id="message" class="form-control custom"></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateBroadcast()" id="broadcast" class="btn btn-custom" style="float: right;">Submit</button><br>
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
<?= view('js/broadcast'); ?>