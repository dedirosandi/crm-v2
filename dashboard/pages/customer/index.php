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
                <a href="?pages=customer&act=create" class="btn btn-outline-success"> Input Customer Baru</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. Order</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No.HP/Tlp</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Unit</th>
                            <th>Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!isset($_SESSION["login"]) || $_SESSION["user_is"] == "admin") { ?>
                            <?php $GetCustomer = query("SELECT 
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
                        LEFT JOIN tb_user user ON customer.sales_is = user.id"); ?>
                        <?php } elseif (!isset($_SESSION["login"]) || $_SESSION["user_is"] == "sales") { ?>
                            <?php $GetCustomer = query("SELECT 
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
                        LEFT JOIN tb_user user ON customer.sales_is = user.id WHERE sales_is = $user_id"); ?>
                        <?php } ?>
                        <?php foreach ($GetCustomer as $customer) { ?>
                            <tr>
                                <td><?= $customer["customer_no_order"]; ?></td>
                                <td><?= $customer["customer_name"]; ?></td>
                                <td><?= $customer["customer_address"]; ?></td>
                                <td><?= $customer["customer_phone"]; ?></td>
                                <td><?= $customer["customer_id_card"]; ?></td>
                                <td><?= $customer["customer_email"]; ?></td>
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