<link rel="stylesheet" type="text/css" href="styleedit.css">
<?php
// Establish a connection to the database
include 'db.php';
error_reporting(0);

// Retrieve record to edit based on the ID passed in the URL parameter
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id=?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

// Handle form submission for updating a record
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $place = $_POST['place'];
  $email = $_POST['email'];
  $contact_number = $_POST['contact_number'];

  $stmt = $pdo->prepare("UPDATE contacts SET name=?, place=?, email=?, contact_number=? WHERE id=?");
  $stmt->execute([$name, $place, $email, $contact_number, $id]);

  // Redirect back to index.php to avoid form resubmission
  header('Location: index.php');
  exit();
}
?>

<h1>Edit Record</h1>

<form method="post">
  <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
  <label>Name:</label>
  <input type="text" name="name" value="<?php echo $contact['name']; ?>">
  <br>
  <label>Place:</label>
  <input type="text" name="place" value="<?php echo $contact['place']; ?>">
  <br>
  <label>Email:</label>
  <input type="text" name="email" value="<?php echo $contact['email']; ?>">
  <br>
  <label>Contact Number:</label>
  <input type="text" name="contact_number" value="<?php echo $contact['contact_number']; ?>">
  <br>
  <input type="submit" name="update" value="Update">
</form>
<footer>
  <span>&copy; Krishnendu Bhowmick 2023</span> - All Rights Reserved
</footer>