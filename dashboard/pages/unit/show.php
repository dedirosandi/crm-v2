<?php
$title = "Detail Unit";
$unit_is = $_GET["unit_is"];
$GetUnit = query("SELECT * FROM tb_unit WHERE id='$unit_is'")[0];
$image_url = (!empty($GetUnit['picture'])) ? $GetUnit['picture'] : 'no-image.png';
// $GetUnit = query("SELECT tb_unit.*, COALESCE(tb_unit_gallery.id, '') AS gallery_id, COALESCE(tb_unit_gallery.image, '') AS gallery_image 
//                  FROM tb_unit LEFT JOIN tb_unit_gallery ON tb_unit.id = tb_unit_gallery.unit_is 
//           WHERE tb_unit.id = '$unit_is'");
// $title = 'Detail ' . $GetUnit[0]['type'];

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
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <a href="?pages=unit" class="btn btn-success"> <i class="bi bi-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <img src="../storage/image-unit/<?= $image_url; ?>" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <b>Detail Lengkap Unit</b>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="?pages=unit&act=edit-process" method="post" id="unitForm" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label>Tipe Unit</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="hidden" class="form-control" name="id" value="<?= $GetUnit["id"]; ?>">
                                                <input type="text" class="form-control" name="type" value="<?= $GetUnit["type"]; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Blok Unit</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="text" class="form-control" name="block" value="<?= $GetUnit["block"]; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Lokasi Unit</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="text" class="form-control" name="location" value="<?= $GetUnit["location"]; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Kelebihan Lahan</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="text" class="form-control" name="excess_land" value="<?= $GetUnit["excess_land"]; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Stok Unit</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="number" class="form-control" name="unit_stock" value="<?= $GetUnit["unit_stock"]; ?>">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Status Unit</label>
                                            </div>
                                            <div class="col-lg-9 form-group">
                                                <input type="text" class="form-control" name="status" value="<?= $GetUnit["status"]; ?>" readonly>
                                            </div>

                                            <?php if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") { ?>
                                            <?php } else { ?>
                                                <div class="col-lg-3">
                                                    <label>Gambar Unit</label>
                                                </div>
                                                <div class="col-lg-9 form-group">
                                                    <input class="form-control" type="file" name="picture">
                                                </div>
                                                <div class="col-lg-8">
                                                    <button type="button" class="btn btn-danger" id="batalButton" style="display: none;">Batal Ubah Unit</button>
                                                    <button type="submit" class="btn btn-success" id="ubahButton" style="display: none;">Proses Ubah Unit</button>
                                                    <button type="button" class="btn btn-success" id="editButton">Edit Unit</button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButton = document.getElementById("editButton");
        const ubahButton = document.getElementById("ubahButton");
        const batalButton = document.getElementById("batalButton");
        const unitForm = document.getElementById("unitForm");
        const formElements = unitForm.elements;

        // Inisialisasi: Semua elemen input menjadi readonly
        disableFormFields();

        editButton.addEventListener("click", function() {
            editButton.style.display = "none";
            ubahButton.style.display = "inline-block";
            batalButton.style.display = "inline-block";
            enableFormFields();
        });

        batalButton.addEventListener("click", function() {
            editButton.style.display = "inline-block";
            ubahButton.style.display = "none";
            batalButton.style.display = "none";
            disableFormFields();
        });

        function enableFormFields() {
            for (let i = 0; i < formElements.length; i++) {
                if (formElements[i].type !== "button") {
                    formElements[i].removeAttribute("readonly");
                    formElements[i].removeAttribute("disabled");
                }
            }
        }

        function disableFormFields() {
            for (let i = 0; i < formElements.length; i++) {
                if (formElements[i].type !== "button") {
                    formElements[i].setAttribute("readonly", true);
                    formElements[i].setAttribute("disabled", true);
                }
            }
        }
    });
</script>