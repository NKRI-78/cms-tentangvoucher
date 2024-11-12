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
                            <h4 class="card-title">Edit News</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="new-user-info">
                            <form enctype="multipart/form-data">
                                <div class="row">
                                    <input type="text" id="newsId" value="<?= $news->id ?>" hidden>
                                    <input type="text" id="imageOld" value="<?= $news->imageUrl ?>" hidden>
                                    <div class="form-group col-md-6">
                                        <label>Title:</label>
                                        <input type="text" class="form-control" id="title" value="<?= $news->title ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Link:</label>
                                        <input type="text" class="form-control" id="link" value="<?= $news->link ?>">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Image (Recommendation Size 700 x 525):</label>
                                        <input type="file" class="dropify" id="imageNews" data-default-file="<?= $news->imageUrl ?>" data-height="200" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Content:</label>
                                        <div class="form-group">
                                            <textarea id="froalaContent"><?= $news->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="UpdateNews()" id="updateNews" class="btn btn-custom" style="float: right;">Update</button><br>
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
<?= view('js/news'); ?>