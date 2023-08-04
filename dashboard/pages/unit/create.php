<?php
$title = "Form Tambah Unit";
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Tambah Unit</h3>
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
                        <a href="?pages=unit" class="btn btn-outline-success"> Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="?pages=unit&act=create-process" method="post" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Tipe Unit</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="type" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Blok Unit</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="block" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Lokasi Unit</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="location" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Kelebihan Lahan</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="text" class="form-control" name="excess_land" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Stok Unit</label>
                                        </div>
                                        <div class="col-lg-9 form-group">
                                            <input type="number" class="form-control" name="unit_stock" required>
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