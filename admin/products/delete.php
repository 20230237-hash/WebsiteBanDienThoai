<?php
include("../../config/database.php");
include("../check_admin.php");

$id = intval($_GET['id']);

$conn->query("DELETE FROM products WHERE id=$id");

header("Location:list.php");
