<?php
$title = "Form Input Cutomer Baru";
// Fungsi untuk menghasilkan nomor SPR/PSC2
function generateSPRNumber()
{
    $prefix = 'SPR/PSC2/';
    $date = date('dmY');
    $random_number = mt_rand(1000, 9999);

    $spr_number = $prefix . $date . $random_number;
    return $spr_number;
}

// Panggil fungsi untuk menghasilkan nomor SPR/PSC2
$generated_spr_number = generateSPRNumber();


?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Input Customer Baru</h3>
                <p class="text-subtitle text-muted">Multiple form layouts, you can use</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="?pages=dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Tambah Unit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="?pages=customer" class="btn btn-outline-success"> Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="?pages=customer&act=create-process" method="post" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>No. Pesanan</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="no_order" readonly value="<?= $generated_spr_number; ?>">
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Tanggal Pemesanan</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="date" class="form-control" name="date_order" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Nama Pemesan</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Masukan Nama..." required>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>No. NIK</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="number" class="form-control" name="id_card" placeholder="Masukan Nomor NIK..." required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>No. HP/Tlp</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="number" class="form-control" name="phone" placeholder="Masukan Nomor HP..." required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="email" class="form-control" name="email" placeholder="Masukan Alamat Email..." required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Alamat Lengkap</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <textarea class="form-control" name="address" id="" cols="15" rows="10" required placeholder="Masukan alamat..."></textarea>
                                        </div>

                                        <div class="col-lg-3">
                                            <label>Unit</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <select name="unit_is" class="choices form-select">
                                                <option value="" selected>Pilih ...</option>
                                                <?php
                                                $GetUnitReady = query("SELECT * FROM tb_unit WHERE unit_stock > 0");
                                                foreach ($GetUnitReady as $unit) { ?>
                                                    <option value="<?= $unit["id"]; ?>"><?= $unit["type"]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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