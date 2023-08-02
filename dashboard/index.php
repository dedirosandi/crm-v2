<?php
// Memulai session
session_start();

// Cek apakah pengguna sudah login (sesi login aktif)
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== "login") {
    // Jika belum login, redirect kembali ke halaman login
    $_SESSION["notification"] = "Anda belum login !!!";
    header("location: ../");
    exit;
}
