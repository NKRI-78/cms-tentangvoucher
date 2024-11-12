<?= view('layouts/header'); ?>
<?= view('layouts/wrapper'); ?>
<?= view('layouts/navbar'); ?>


<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div style="display: flex; justify-content:space-between; align-items: center;">
                    <h4 class="card-title" style="font-weight: 700;">Daftar Toko</h4>
                    <!-- <a href="<?= base_url("/admin/studentGeneration/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a> -->
                </div>

                <div id="card-container" class="row">
                    <!-- Card akan diisi oleh JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tableModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Stok</th>
                            <th>Categori</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="modalTableBody">
                        <!-- Data tabel akan diisi di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- <div class="iq-card-body">
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" class="img-fluid" id="modalImage" alt="image" style=" width: 100%; height: auto; max-height: 250px; object-fit: scale-down;">
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="iq-card-body">
    <div class="modal fade" id="detailBanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" class="img-fluid" id="imageBanner" alt="image" style=" width: 100%; height: auto; max-height: 250px;">
                    <h4 id="name" style="margin-top: 1rem; margin-bottom: 1rem;"></h4>
                    <h5>Link banner: <a href="" id="link" style="color: #0056b3 !important;"></a></h5>
                    
                </div>
            </div>
        </div>
    </div>
</div> -->

<?= view('layouts/footer'); ?>
<?= view('layouts/script'); ?>
<?= view('js/listStore'); ?>