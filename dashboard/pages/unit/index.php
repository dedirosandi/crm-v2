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
                        <?php if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") { ?>
                        <?php } else { ?>
                            <a href="?pages=unit&act=create" class="btn btn-outline-success"> Tambah Unit</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="row gallery">
                            <?php
                            $GetUnit = query("SELECT * FROM tb_unit");
                            foreach ($GetUnit as $unit) {
                                $unit_is = $unit["id"];
                                // $GetGallery = query("SELECT * FROM tb_unit_gallery WHERE unit_is ='$unit_is'");
                                $status = $unit["status"];
                                $imageUrl = $unit["picture"];
                                $iconImage = ($status === "sold") ? "sold.png" : "";
                                $dummyImageUrl = "no-image.png"; // Ganti dengan URL gambar dummy sesuai kebutuhan

                            ?>

                                <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                    <div class="row justify-content-between mt-2 mb-2">
                                        <div class="col-6">
                                            <b><?= $unit["type"]; ?> </b>
                                        </div>
                                        <div class="col-6 col-sm-6 equal-width">
                                            <?php if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") { ?>

                                            <?php   } else { ?>
                                                <form id="logout-form" action="?pages=unit&act=delete" method="post">
                                                    <input name="unit_is" class="form-control form-control-lg" type="text" value="<?= $unit["id"]; ?>" hidden>
                                                    <input class='btn btn-block btn-sm btn-danger' type="button" value="X" onclick="showConfirmation()">
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <a href="?pages=unit&act=show&unit_is=<?= $unit["id"]; ?>" class="image-container">
                                        <img class="w-100 active rounded" src="../storage/image-unit/<?= empty($imageUrl) ? $dummyImageUrl : $imageUrl; ?>">
                                        <?php if ($status === "sold") : ?>
                                            <img class=" sold-icon" src="../assets/images/img/<?= $iconImage ?>" alt="Sold">
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php }
                            if (empty($unit["id"])) { ?>
                                <?php include_once "pages/error/404.php" ?>
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
        width: 100px;
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