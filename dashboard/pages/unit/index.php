<?php
$title = "Unit";
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Unit</h3>
                <p class="text-subtitle text-muted">Super simple photo gallery</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?pages=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Unit List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="?pages=unit&act=create" class="btn btn-outline-success"> Tambah Unit</a>
                    </div>
                    <div class="card-body">
                        <div class="row gallery">
                            <?php
                            $GetUnit = query("SELECT * FROM tb_unit LEFT JOIN tb_unit_gallery ON tb_unit.id = tb_unit_gallery.unit_is");
                            foreach ($GetUnit as $unit) {
                                $status = $unit["status"];
                                $imageUrl = $unit["image"];
                                $iconImage = ($status === "sold") ? "sold.png" : "";
                                $dummyImageUrl = "../assets/images/img/no-image.png"; // Ganti dengan URL gambar dummy sesuai kebutuhan

                            ?>
                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <div class="row justify-content-between mt-2 mb-2">
                                        <div class="col-6">
                                            <b><?= $unit["type"]; ?> </b>
                                        </div>
                                        <div class="col-6 col-sm-6 equal-width">
                                            <a href="?pages=unit&act=show&id_unit=<?= $unit["id"]; ?>" class="btn btn-sm btn-success"><i class="bi bi-eye-fill"></i></a>
                                        </div>
                                    </div>
                                    <a href="#" class="image-container" data-bs-toggle="<?= empty($imageUrl) ? "" : "modal"; ?>" data-bs-target="#galleryModal">
                                        <img height="500px" width="333px" class="active rounded" src="<?= empty($imageUrl) ? $dummyImageUrl : $imageUrl; ?>" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        <?php if ($status === "sold") : ?>
                                            <img class="sold-icon" src="../assets/images/img/<?= $iconImage ?>" alt="Sold">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<style>
    .image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .sold-icon {
        position: absolute;
        width: 150px;
        /* Sesuaikan ukuran gambar sesuai kebutuhan */
        /* height: 30px; */
        /* Sesuaikan ukuran gambar sesuai kebutuhan */
        top: 50%;
        /* Posisikan vertikal di tengah */
        left: 50%;
        /* Posisikan horizontal di tengah */
        transform: translate(-50%, -50%);
        /* Geser gambar ke tengah */
    }

    .equal-width {
        width: 22%;
    }
</style>



<!-- modal -->
<div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalTitle">
                    Our Gallery Example
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#Gallerycarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1633008808000-ce86bff6c1ed?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=870&q=80" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1632951634308-d7889939c125?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw0M3x8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://images.unsplash.com/photo-1632949107130-fc0d4f747b26?ixid=MnwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3OHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#Gallerycarousel" role="button" type="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#Gallerycarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>