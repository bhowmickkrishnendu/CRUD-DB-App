<?php
// Establish a connection to the database
include 'db.php';
error_reporting(0);

// Define functions for CRUD operations

function displayRecords($pdo) {
  $stmt = $pdo->query("SELECT * FROM contacts");
  return $stmt->fetchAll();
}

function createRecord($pdo) {
  $name = $_POST['name'];
  $place = $_POST['place'];
  $email = $_POST['email'];
  $contact_number = $_POST['contact_number'];

  $stmt = $pdo->prepare("INSERT INTO contacts (name, place, email, contact_number) VALUES (?, ?, ?, ?)");
  $stmt->execute([$name, $place, $email, $contact_number]);
}

function updateRecord($pdo) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $place = $_POST['place'];
  $email = $_POST['email'];
  $contact_number = $_POST['contact_number'];

  $stmt = $pdo->prepare("UPDATE contacts SET name=?, place=?, email=?, contact_number=? WHERE id=?");
  $stmt->execute([$name, $place, $email, $contact_number, $id]);
}

function deleteRecord($pdo) {
  $id = $_GET['id'];

  $stmt = $pdo->prepare("DELETE FROM contacts WHERE id=?");
  $stmt->execute([$id]);
}

// Handle CRUD operations based on user input

if (isset($_POST['create'])) {
  createRecord($pdo);
  // Redirect back to index.php to avoid form resubmission
  header('Location: index.php');
  exit();
}

if (isset($_POST['update'])) {
  updateRecord($pdo);
  // Redirect back to index.php to avoid form resubmission
  header('Location: index.php');
  exit();
}

if (isset($_GET['delete'])) {
  deleteRecord($pdo);
  // Redirect back to index.php to avoid form resubmission
  header('Location: index.php');
  exit();
}
?>
