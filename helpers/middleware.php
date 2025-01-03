<?php
session_start();
$authRoutes = [
    "login.php",
    "signup.php"
];

$userRoutes = [
    "index.php",
    "vehicleDetails.php",
];

$adminRoutes = [
    "dashboard.php",
    "cars.php",
    "categories.php"
];

$currentPage = basename($_SERVER["PHP_SELF"]);

$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// if the user already auth and and the current page is an auth page
// redirect him to the home page
if ($role && in_array($currentPage, $authRoutes)) {
    header("location: index.php");
}

//  if the user is not loged in and the page is admin page or user page
// redirect him to login page
if (!$role && (in_array($currentPage, $userRoutes) || in_array($currentPage, $adminRoutes))) {
    header("location: login.php");
    exit;
}
if ($role == "user" && in_array($currentPage, $adminRoutes)) {
    header("location: index.php");
}
