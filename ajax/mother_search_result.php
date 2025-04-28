<?php
include("../src/conn.php"); // sax relative path

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT * FROM mothers WHERE mother_name LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['mother_name']}</td>
                <td>{$row['date_of_birth']}</td>
                <td>{$row['address']}</td>
                <td>{$row['blood_type']}</td>
                <td>{$row['medical_history']}</td>
                <td>{$row['Massage']}</td>
                
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found.</td></tr>";
    }
}
?>