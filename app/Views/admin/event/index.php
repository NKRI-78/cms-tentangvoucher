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
                            <h4 class="card-title">Data Event</h4>
                        </div>
                        <a href="<?= base_url("/admin/event/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="data-event" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">&emsp;&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="iq-card-body">
                        <div class="modal fade" id="detailEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Event</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="img-fluid" src="" id="imageEvent" alt="image" style="width: 100%; height: auto; max-height: 250px;">
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Event Start Date:</label>
                                                <div id="startDate"></div>
                                                <label>Event End Date:</label>
                                                <div id="endDate"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Start and End Time:</label>
                                                <div id="startEnd"></div>
                                            </div>
                                        </div><br>
                                        <label>Description:</label>
                                        <div id="description"></div><br>
                                        <label>Location:</label>
                                        <div id="location"></div>
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
<?= view('js/event'); ?>