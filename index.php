<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petrol_pump";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horizon Petrol Pump</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
        }
        header img {
            height: 100px;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        header h4 {
            margin: 5px 0 0 0;
            font-size: 18px;
            font-weight: normal;
        }
        .view-data-btn {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            padding: 10px 20px;
            background-color: #d22720;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .view-data-btn:hover {
            background-color: #34a38c;
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        section {
            margin-bottom: 20px;
        }
        h2 {
            margin-top: 0;
            color: #8B0000; /*Red Color */
        }
        
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="date"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #34a38c; /* Green Color */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <img src="\HorizonPetrolPump/horizon-logo.png.png" alt="Horizon Petrol Pump Logo">
        <h1>Horizon Petrol Pump</h1>
        <h4>Head Rajkan Tehsil Yazman District Bahawalpur</h4>
        <a href="data_display.php" class="view-data-btn">Check Records</a>
    </header>
    <main>
        <section id="Employees-section">
            <h2>Employee Details</h2>
            <form id="customer-form" action="index.php" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="phone" placeholder="Phone" required>
                <input type="text" name="address" placeholder="Address" required>
                <input type="text" name="employee_position" placeholder="Position" required>
                <input type="text" name="employee_salary" placeholder="Salary" required>
                <button type="submit" name="add_employee">Add Employee</button>
            </form>
            <?php
            if (isset($_POST['add_employee'])) {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $position = $_POST['employee_position'];
                $salary = $_POST['employee_salary'];
                $sql = "INSERT INTO Employees (employee_name, employee_phone, employee_address, employee_position, employee_salary) VALUES ('$name', '$phone', '$address', '$position', '$salary')";
                if ($conn->query($sql) === TRUE) {
                    echo "Employee added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
        </section>

        <section id="Petrol_Inventory">
            <h2>Petrol Inventory</h2>
            <form id="fuel-form" action="index.php" method="post">
                <input type="date" name="date" placeholder="Date" required>
                <input type="text" name="quantity" placeholder="Quantity" required>
                <input type="text" name="total_price" placeholder="Total Price" required>
                <button type="submit" name="add_petrol_inventory">Add Petrol Inventory</button>
            </form>
            <?php
            if (isset($_POST['add_petrol_inventory'])) {
                $date = $_POST['date'];
                $quantity = $_POST['quantity'];
                $total_price = $_POST['total_price'];
                $sql = "INSERT INTO Petrol_Inventory (date, quantity_in_liters, total_price) VALUES ('$date', '$quantity', '$total_price')";
                if ($conn->query($sql) === TRUE) {
                    echo "Inventory added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
        </section>

        <section id="Diesel_Inventory-section">
            <h2>Diesel Inventory</h2>
            <form id="transaction-form" action="index.php" method="post">
                <input type="date" name="date" placeholder="Date" required>
                <input type="text" name="quantity" placeholder="Quantity" required>
                <input type="text" name="total_price" placeholder="Total Price" required>
                <button type="submit" name="add_diesel_inventory">Add Diesel Inventory</button>
            </form>
            <?php
            if (isset($_POST['add_diesel_inventory'])) {
                $date = $_POST['date'];
                $quantity = $_POST['quantity'];
                $total_price = $_POST['total_price'];
                $sql = "INSERT INTO Diesel_Inventory (date, quantity_in_liters, total_price) VALUES ('$date', '$quantity', '$total_price')";
                if ($conn->query($sql) === TRUE) {
                    echo "Inventory added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
        </section>
    </main>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
