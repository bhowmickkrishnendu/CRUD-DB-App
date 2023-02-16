<!DOCTYPE html>
<html>
<head>
  <title>Krishnendu's CRUD App.</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>CRUD Application by Krishnendu Bhowmick</h1>

  <form method="post" action="crud.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="place">Place:</label>
    <input type="text" id="place" name="place" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="contact_number">Contact Number:</label>
    <input type="text" id="contact_number" name="contact_number" required><br><br>

    <button type="submit" name="create">Add Record</button>
  </form>

  <br>

  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Place</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
        include 'crud.php';
        $records = displayRecords($pdo);
        foreach ($records as $record) {
          echo "<tr>";
          echo "<td>" . $record['name'] . "</td>";
          echo "<td>" . $record['place'] . "</td>";
          echo "<td>" . $record['email'] . "</td>";
          echo "<td>" . $record['contact_number'] . "</td>";
          echo "<td>";
          echo "<a href='edit.php?id=" . $record['id'] . "'>Edit</a> ";
          echo "<a href='crud.php?delete=true&id=" . $record['id'] . "'>Delete</a>";
          echo "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>

<div class="server-info">
  <h1>Server Info</h1>
  <label>Hostname:</label>
  <p><?php echo gethostname(); ?></p>
  <br>
  <label>IP Address:</label>
  <p><?php echo $_SERVER['SERVER_ADDR']; ?></p>
</div>
<footer>
  <span>&copy; Krishnendu Bhowmick 2023</span> - All Rights Reserved
</footer>
</body>
</html>
