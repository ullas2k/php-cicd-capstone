<?php
include 'db.php';

$conn->query("CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
)");

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $conn->query("INSERT INTO employees(name) VALUES('$name')");
}

$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>ABC Technologies</title>
</head>
<body>

<h2>Employee Portal</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Employee Name" required>
    <button type="submit">Save</button>
</form>

<hr>

<h3>Employees</h3>

<?php while($row = $result->fetch_assoc()){ ?>
    <p><?php echo $row['name']; ?></p>
<?php } ?>

</body>
</html>