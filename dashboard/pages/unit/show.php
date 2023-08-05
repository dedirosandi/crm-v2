<?php
$title = "Detail Unit";
$unit_is = $_GET["unit_is"];
$GetUnit = query("SELECT tb_unit.*, COALESCE(tb_unit_gallery.id, '') AS gallery_id, COALESCE(tb_unit_gallery.image, '') AS gallery_image 
                 FROM tb_unit LEFT JOIN tb_unit_gallery ON tb_unit.id = tb_unit_gallery.unit_is 
          WHERE tb_unit.id = '$unit_is'");
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
                        <a href="?pages=unit" class="btn btn-success"> <i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php
                                        // Menandai item pertama sebagai active
                                        $active_class = "active";

                                        foreach ($GetUnit as $data) {

                                            // URL gambar yang akan ditampilkan
                                            $image_url = (!empty($data['gallery_image'])) ? $data['gallery_image'] : 'no-image.png';
                                        ?>
                                            <div class="carousel-item <?php echo $active_class; ?>">
                                                <img src="../storage/image-unit/<?php echo $image_url; ?>" class="d-block w-100" alt="...">
                                            </div>
                                        <?php
                                            // Setelah item pertama, hapus class "active" untuk item selanjutnya
                                            $active_class = "";
                                        }
                                        ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>



                            </div>
                            <div class="col-4 rounded" style="overflow-y: scroll; height: 670px;">
                                <div class="row">
                                    <div class="col-12 mb-5 image-container mt-5">
                                        <button class="btn btn-success button" data-bs-toggle="modal" data-bs-target="#add-image<?= $GetUnit[0]["id"]; ?>"><i class="bi bi-plus-square-dotted"></i></button>
                                        <?php include_once "create-image-modal.php" ?>
                                    </div>
                                    <?php
                                    foreach ($GetUnit as $data) {
                                    ?>
                                        <?php
                                        if (!empty($data["gallery_image"])) {
                                        ?>
                                            <div class="col-12 mb-3 image-container">
                                                <img src="../storage/image-unit/<?= $data["gallery_image"] ?>" class="rounded img-thumbnail" alt="...">
                                                <form id="logout-form" action="?pages=unit&act=delete-image" method="post">
                                                    <input name="id" class="form-control form-control-lg" type="text" value="<?= $data["gallery_id"] ?>" hidden>
                                                    <input class='btn btn-sm btn-danger button' type="button" value="Hapus" onclick="showConfirmation()">
                                                </form>
                                                <!-- <button class="btn btn-danger button"><i class="bi bi-trash-fill"></i></button> -->
                                            </div>
                                        <?php } else { ?>
                                            <img src="../storage/image-unit/no-image.png" class="rounded" alt="...">
                                        <?php } ?>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <b>Detail Lengkap Unit</b>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label>Tipe Unit</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["type"]; ?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Blok Unit</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["block"]; ?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Lokasi Unit</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["location"]; ?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Kelebihan Lahan</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["excess_land"]; ?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Stok Unit</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["unit_stock"]; ?>">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Status Unit</label>
                                    </div>
                                    <div class="col-lg-9 form-group">
                                        <input class="form-control" readonly value="<?= $GetUnit[0]["status"]; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->
</div>
<style>
    .form-control {
        border: none;
        /* Menghapus batas pada elemen input */
        border-bottom: 1px solid #ccc;
        /* Menambahkan garis bawah pada elemen input */
        border-radius: 0;
        /* (Opsional) Menghapus border-radius untuk tampilan yang lebih lurus */
        padding: 5px 0;
        /* (Opsional) Atur jarak atas dan bawah agar lebih rapi */
    }

    .form-control:focus {
        outline: none;
        box-shadow: none;
        /* Menghapus garis tepi (outline) saat elemen input mendapatkan fokus */
    }
</style>
<style>
    .image-container {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .button {
        position: absolute;
        width: 100px;
        /* Sesuaikan ukuran image sesuai kebutuhan */
        /* height: 30px; */
        /* Sesuaikan ukuran image sesuai kebutuhan */
        top: 50%;
        /* Posisikan vertikal di tengah */
        left: 50%;
        /* Posisikan horizontal di tengah */
        transform: translate(-50%, -50%);
        /* Geser image ke tengah */
    }
</style>