<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entered Data - Horizon Petrol Pump</title>
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
        }

        header img {
            height: 100px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        h2 {
            margin-top: 0;
            color: #8B0000; /*Red Color */
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        section {
            margin-bottom: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #34a38c;
            color: #fff;
        }
        th:first-child, td:first-child {
            padding-left: 20px;
        }
        td {
            vertical-align: top;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .no-data {
            text-align: center;
            color: #777;
        }
        .delete-btn {
            padding: 5px 10px;
            background-color: #ff5252;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #34a38c;
        }
        .search-bar {
            margin-bottom: 10px;
        }
        .search-bar input {
            padding: 5px;
            width: calc(100% - 120px);
        }
        .search-bar button {
            padding: 5px 10px;
            background-color: #8B0000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #34a38c;
        }
    </style>
</head>
<body>
<header>
        <img src="\HorizonPetrolPump/horizon-logo.png.png" alt="Horizon Petrol Pump Logo">
        <h1>Horizon Petrol Pump</h1>
        <h4>Head Rajkan Tehsil Yazman District Bahawalpur</h4>
    </header>
    <main>
        <section id="Employees-Section">
            <h2>Employee Details</h2>
            <div class="search-bar">
                <form method="POST" action="">
                    <input type="text" name="employee_search" placeholder="Search by Employee ID">
                    <button type="submit" name="search_employee">Search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "petrol_pump";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Handle deleting an item from database
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
                        $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
                        $sql_delete = "DELETE FROM Employees WHERE employee_id='$employee_id'";

                        if (mysqli_query($conn, $sql_delete)) {
                            echo "<script>alert('Employee deleted successfully');</script>";
                        } else {
                            echo "Error: " . $sql_delete . "<br>" . mysqli_error($conn);
                        }
                    }

                    // Handle employee search
                    $search_employee_query = "";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_employee'])) {
                        $employee_search = mysqli_real_escape_string($conn, $_POST['employee_search']);
                        $search_employee_query = " WHERE employee_id='$employee_search'";
                    }

                    // Fetch and display employee data
                    $sql = "SELECT * FROM Employees" . $search_employee_query;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["employee_id"] . "</td>";
                            echo "<td>" . $row["employee_name"] . "</td>";
                            echo "<td>" . $row["employee_phone"] . "</td>";
                            echo "<td>" . $row["employee_address"] . "</td>";
                            echo "<td>" . $row["employee_position"] . "</td>";
                            echo "<td>" . $row["employee_salary"] . "</td>";
                            echo "<td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='employee_id' value='" . $row["employee_id"] . "'>
                                        <button type='submit' name='delete' class='delete-btn'>Delete</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='no-data'>No employee data available</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <section id="Petrol-Inventory-Section">
            <h2>Petrol Inventory</h2>
            <div class="search-bar">
                <form method="POST" action="">
                    <input type="date" name="petrol_search" placeholder="Search by Date">
                    <button type="submit" name="search_petrol">Search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantity in Liters</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "petrol_pump";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Handle petrol inventory search
                    $search_petrol_query = "";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_petrol'])) {
                        $petrol_search = mysqli_real_escape_string($conn, $_POST['petrol_search']);
                        $search_petrol_query = " WHERE date='$petrol_search'";
                    }

                    // Fetch and display petrol inventory data
                    $sql = "SELECT * FROM Petrol_Inventory" . $search_petrol_query;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["quantity_in_liters"] . "</td>";
                            echo "<td>" . $row["total_price"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='no-data'>No Inventory available</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <section id="Diesel-Inventory-Section">
            <h2>Diesel Inventory</h2>
            <div class="search-bar">
                <form method="POST" action="">
                    <input type="date" name="diesel_search" placeholder="Search by Date">
                    <button type="submit" name="search_diesel">Search</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantity in Liters</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "petrol_pump";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Handle diesel inventory search
                    $search_diesel_query = "";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_diesel'])) {
                        $diesel_search = mysqli_real_escape_string($conn, $_POST['diesel_search']);
                        $search_diesel_query = " WHERE date='$diesel_search'";
                    }

                    // Fetch and display diesel inventory data
                    $sql = "SELECT * FROM Diesel_Inventory" . $search_diesel_query;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["quantity_in_liters"] . "</td>";
                            echo "<td>" . $row["total_price"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='no-data'>No Inventory available</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Similar sections for vehicles, fuel types, and transactions -->
    </main>
</body>
</html>
