<?php

// Include patient model
require_once('../models/patient_model.php');

// Function to retrieve patient profile information
function viewPatientProfile() {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Get patient profile information
    $profile_info = getPatientProfile($_SESSION['user_id']);

    // Return profile information
    return $profile_info;
}

// Function to retrieve patient appointments
function viewPatientAppointments() {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Get patient appointments
    $appointments = getPatientAppointments($_SESSION['user_id']);

    // Return appointments
    return $appointments;
}

// Function to retrieve patient lab reports
function viewPatientLabReports() {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Get patient lab reports
    $lab_reports = getPatientLabReports($_SESSION['user_id']);

    // Return lab reports
    return $lab_reports;
}

// Function to retrieve patient billing information
function viewPatientBilling() {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // Get patient billing information
    $billing_info = getPatientBilling($_SESSION['user_id']);

    // Return billing information
    return $billing_info;
}

?>
