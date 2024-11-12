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
                            <h4 class="card-title">Data News</h4>
                        </div>
                        <a href="<?= base_url("/admin/news/create") ?>" class="btn mb-3 btn-primary" style="margin-top: 15px;"><i class="ri-add-circle-line"></i>Add</a>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table id="data" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">&emsp;Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $items_per_page = 10;

                                    // Nomor halaman saat ini (dari URL)
                                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                    // Hitung nomor awal
                                    $start_number = ($page_number - 1) * $items_per_page + 1;

                                    // Inisialisasi nomor awal untuk loop
                                    $no = $start_number;

                                    if ($news != "") { ?>
                                        <?php foreach ($news as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->title ?></td>
                                                <td>
                                                    <div class="send-panel">
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url("admin/news/edit/$row->id") ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit News"> <i class="ri-edit-line text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a onclick="DetailNews('<?= $row->id ?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail"> <i class="ri-list-check-2 text-primary"></i></a> </label>
                                                        <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="<?= base_url("admin/news/delete/$row->id") ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete News"> <i class="ri-delete-bin-line text-primary"></i></a> </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- <nav class="pt-3">
                            <ul class="pagination justify-content-end">
                                <li class="page-item <?= $pagination['previous'] ? '' : 'disabled' ?>">
                                    <a class="page-link" href="<?= $pagination['previous'] ? base_url('admin/news?page=' . $pagination['previous']) : '#' ?>">Previous</a>
                                </li>

                                <?php
                                $size = 5;
                                $currentPage = $pagination['current'];
                                $totalPages = $pagination['total'];

                                $startPage = max(1, $currentPage - floor($size / 2));
                                $endPage = min($totalPages, $startPage + $size - 1);

                                if ($startPage > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="' . base_url('admin/news?page=1') . '">1</a></li>';
                                    if ($startPage > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '"><a class="page-link" href="' . base_url('admin/news?page=' . $i) . '">' . $i . '</a></li>';
                                }

                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="' . base_url('admin/news?page=' . $totalPages) . '">' . $totalPages . '</a></li>';
                                }
                                ?>

                                <li class="page-item <?= $pagination['next'] ? '' : 'disabled' ?>">
                                    <a class="page-link" href="<?= $pagination['next'] ? base_url('admin/news?page=' . $pagination['next']) : '#' ?>">Next</a>
                                </li>
                            </ul>
                        </nav> -->
                    </div>

                    <div class="iq-card-body">
                        <div class="modal fade" id="detailNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail News</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" class="img-fluid" id="imageNews" alt="image" style="width: 100%; height: auto; max-height: 250px;">
                                        <br><br>
                                        <div id="contentNews" style="color: #000;"></div>
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
<?= view('js/news'); ?>