<?php
$title = "User";
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
                                    <form action="?pages=user&act=status-process&id=<?= $user["id"]; ?>" method="post" id="status-form">
                                        <select name="status_is" class="form-select status-select" onchange="submitForm()">
                                            <option value="1" <?= $user["status_is"] == 1 ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="0" <?= $user["status_is"] == 0 ? 'selected' : ''; ?>>Nonaktif</option>
                                        </select>
                                    </form>
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
    function submitForm() {
        document.getElementById("status-form").submit();
    }
</script>