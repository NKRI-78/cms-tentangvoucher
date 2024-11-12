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
                            <h4 class="card-title">Edit Banner</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" value="<?= $banner->id ?>" id="bannerId" hidden>
                                    <input type="text" id="bannerOldImage" name="banner_old_image" value="<?= $banner->link_image ?>" hidden>

                                    <div class="form-group col-md-6">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" id="name" value="<?= $banner->title ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Link Tautan:</label>
                                        <input type="text" class="form-control" id="post_link" value="<?= $banner->link_banner ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image:</label>
                                        <input type="file" class="dropify" id="imageBanner" data-default-file="<?= $banner->link_image ?>" data-height="200" />
                                    </div>
                                </div>
                                <br><button type="button" onclick="UpdateBanner()" id="updateBanner" class="btn btn-custom" style="float: right;">Update</button><br>
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
<?= view('js/banner'); ?>