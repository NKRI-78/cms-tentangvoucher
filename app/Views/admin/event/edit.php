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
                            <h4 class="card-title">Edit Event</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="eventId" value="<?= $event->id ?>" hidden>
                                    <input type="text" id="OldImage" name="event_old_image" value="<?= $event->imageUrl ?>" hidden>

                                    <div class="form-group col-md-12">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" value="<?= $event->title ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Event Date Start:</label>
                                        <input type="text" class="form-control" id="eventDateStart" value="<?= date("Y/m/d", strtotime($event->startDate)) ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Event Date End:</label>
                                        <input type="text" class="form-control" id="eventDateEnd" value="<?= date("Y/m/d", strtotime($event->endDate)) ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Start:</label>
                                        <input type="time" class="form-control" id="start" value="<?= $event->start ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>End:</label>
                                        <input type="time" class="form-control" id="end" value="<?= $event->end ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Picture (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" style="z-index: 0;" id="picture" name="picture" data-default-file="<?= $event->imageUrl ?>" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Location:</label>
                                        <textarea id="location" class="form-control"><?= $event->address ?></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description:</label>
                                        <textarea id="description" class="form-control"><?= $event->description ?></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateEvent()" id="updateEvent" class="btn btn-custom" style="float: right;">Update</button><br>
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
<?= view('js/event'); ?>
<script>
    $("#eventDateStart").datepicker({
        dateFormat: "yy/mm/dd"
    });

    $("#eventDateEnd").datepicker({
        dateFormat: "yy/mm/dd"
    });
</script>