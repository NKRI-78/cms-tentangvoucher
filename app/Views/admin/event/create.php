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
                            <h4 class="card-title">Add Event</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">

                                <div class="row">
                                    <!-- <div class="form-group col-md-12">
                                        <label>Paid:</label>
                                        <select id="paid" class="form-control">
                                            <option value="">Select</option>
                                            <option value="true">Yes</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div> -->
                                    <!-- <div class="form-group col-md-12" style="display: none;" id="paid-form">
                                        <label>Price:</label>
                                        <input type="number" class="form-control" id="price" placeholder="Event Price">
                                    </div> -->
                                    <div class="form-group col-md-12">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Event Date Start:</label>
                                        <input type="text" class="form-control" id="eventDateStart" placeholder="Event Date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Event Date End:</label>
                                        <input type="text" class="form-control" id="eventDateEnd" placeholder="Event Date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Start:</label>
                                        <input type="time" class="form-control" id="start">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>End:</label>
                                        <input type="time" class="form-control" id="end">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Picture (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" style="z-index: 0;" id="picture" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Location:</label>
                                        <textarea id="location" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Description:</label>
                                        <textarea id="description" class="form-control"></textarea>
                                    </div>
                                </div>
                                <button type="button" onclick="CreateEvent()" id="createEvent" class="btn btn-custom" style="float: right;">Submit</button><br>
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