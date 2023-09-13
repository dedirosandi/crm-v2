<?php
$title = "Customer";
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
                <?php if (!isset($_SESSION["login"]) || $_SESSION["user_is"] !== "sales") { ?>
                <?php } else { ?>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-3">
                                <a href="?pages=customer&act=create" class="btn btn-outline-success"> Input Customer Baru</a>
                            </div>
                            <input type="text" name="pages" value="customer" hidden>
                            <input type="text" name="act" value="show-filter" hidden>
                            <div class="col-3">
                                <input class="form-control" type="date" name="start" id="start" required>
                            </div>
                            <div class="col-3">
                                <input class="form-control" type="date" name="end" id="end" required>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-success btn-block">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Nama</th>
                            <th>No.HP/Tlp</th>
                            <th>Unit</th>
                            <th>Sales</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = "SELECT 
                        customer.no_order AS customer_no_order, 
                        customer.name AS customer_name, 
                        customer.address AS customer_address, 
                        customer.phone AS customer_phone, 
                        customer.id_card AS customer_id_card, 
                        customer.email AS customer_email, 
                        unit.type AS unit_type, 
                        user.name AS user_name
                        FROM tb_customer customer
                        LEFT JOIN tb_unit unit ON customer.unit_is = unit.id
                        LEFT JOIN tb_user user ON customer.sales_is = user.id";
                        if ($_SESSION["user_is"] == "sales") {
                            $query .= " WHERE sales_is = $user_id";
                        } else {
                        }
                        $result = query($query);
                        foreach ($result as $customer) { ?>
                            <tr>
                                <td><?= $customer["customer_no_order"]; ?></td>
                                <td><?= $customer["customer_name"]; ?></td>
                                <td><?= $customer["customer_phone"]; ?></td>
                                <td><?= $customer["unit_type"]; ?></td>
                                <td><?= $customer["user_name"]; ?></td>
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<script>
    const startInput = document.getElementById("start");
    const endInput = document.getElementById("end");

    startInput.addEventListener("change", function() {
        endInput.min = startInput.value; // Set tanggal minimal di input "end"
    });
</script>