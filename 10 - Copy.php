<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV to HTML</title>
</head>
<body>
    <h2>CSV File Contents</h2>
    <table border="1">
        <tr>
            
            <!-- Add more table headers if your CSV has more columns -->
        </tr>
        <?php
        // Path to your CSV file
        $csvFile = '10.csv';

        // Read the CSV file
        $csvData = file_get_contents($csvFile);

        // Parse CSV data
        $rows = explode("\n", $csvData);

        foreach ($rows as $row) {
            echo "<tr>";
            $columns = str_getcsv($row);
            foreach ($columns as $column) {
                echo "<td>" . htmlspecialchars($column) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
