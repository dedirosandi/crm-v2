<?php
$title = "User";
if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "admin") {
    // Jika belum login, redirect kembali ke halaman login
    $_SESSION["notification_color"] = "red";
    $_SESSION["notification"] = "Anda tidak diizinkan !!!";
    header("location: ../");
    exit;
}
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable</h3>
                <p class="text-subtitle text-muted">A sortable, searchable, paginated table without dependencies thanks to simple-datatables</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="?pages=user&act=create" class="btn btn-outline-success"> Tambah User</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Sebagai</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $GetUser = query("SELECT * FROM tb_user");
                        foreach ($GetUser as $user) {
                        ?>
                            <tr>
                                <td><?= $user["name"]; ?></td>
                                <td><?= $user["email"]; ?></td>
                                <td><?= $user["user_is"]; ?></td>
                                <td>
                                    <select name="status_is" class="form-select status-select" data-user-id="<?= $user["id"]; ?>" <?= $user["user_is"] == 'admin' ? 'disabled' : ''; ?>>
                                        <option value="1" <?= $user["status_is"] == 1 ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="0" <?= $user["status_is"] == 0 ? 'selected' : ''; ?>>Nonaktif</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>


<script>
    $(document).ready(function() {
        $(".status-select").change(function() {
            var id = $(this).data("user-id"); // Mengambil nilai data-user-id
            var status = $(this).val();
            // console.log(id)

            $.ajax({
                url: "?pages=user&act=status-process", // Ganti ini dengan URL yang sesuai
                method: "POST",
                data: {
                    id: id,
                    status_is: status
                },
                success: function(response) {
                    $_SESSION["notification"] = "Perubahan Status berhasil !!!";
                    $_SESSION["notification_color"] = "green";
                    header("location:?pages=user");
                    exit();
                },
                error: function() {
                    $_SESSION["notification"] = "Perubahan Status gagal !!!";
                    $_SESSION["notification_color"] = "red";
                    header("location:?pages=user");
                    exit();
                }
            });
        });
    });
</script>