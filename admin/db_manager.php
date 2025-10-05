<?php
include "../backend/db_connect.php";

// Create table
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_table'])) {
    $table_name = $_POST['table_name'];
    $columns = $_POST['columns'];
    $types = $_POST['types'];

    if (!empty($table_name) && !empty($columns)) {
        $cols = [];
        foreach ($columns as $i => $col) {
            if (!empty($col)) {
                $cols[] = "`$col` " . $types[$i];
            }
        }
        $cols_sql = implode(", ", $cols);
        $sql = "CREATE TABLE `$table_name` (id INT AUTO_INCREMENT PRIMARY KEY, $cols_sql)";

        if ($conn->query($sql) === TRUE) {
            $message = "✅ Table '$table_name' created successfully!";
        } else {
            $message = "❌ Error: " . $conn->error;
        }
    } else {
        $message = "⚠️ Table name and at least one column required.";
    }
}

// Delete table
if (isset($_POST['delete_table'])) {
    $del_table = $_POST['delete_table'];
    if ($conn->query("DROP TABLE `$del_table`") === TRUE) {
        $message = "🗑️ Table '$del_table' deleted successfully!";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}

// List all tables
$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Manager</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { color: #2c3e50; }
        .form-section { background: #f9f9f9; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .columns { margin-bottom: 10px; }
        input, select { padding: 5px; margin: 5px; }
        button { padding: 6px 12px; margin-top: 10px; cursor: pointer; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .msg { margin: 10px 0; padding: 10px; border-radius: 6px; background: #eef; }
    </style>
    <script>
        function addColumnField() {
            const container = document.getElementById('columns-container');
            const div = document.createElement('div');
            div.classList.add('columns');
            div.innerHTML = `
                <input type="text" name="columns[]" placeholder="Column Name" required>
                <select name="types[]">
                    <option value="VARCHAR(100)">VARCHAR(100)</option>
                    <option value="INT">INT</option>
                    <option value="TEXT">TEXT</option>
                    <option value="DATE">DATE</option>
                    <option value="TIMESTAMP">TIMESTAMP</option>
                </select>
            `;
            container.appendChild(div);
        }
    </script>
</head>
<body>

    <h2>📊 Database Manager (Skillpro)</h2>
    <?php if (!empty($message)) echo "<div class='msg'>$message</div>"; ?>

    <!-- Create Table Form -->
    <div class="form-section">
        <h3>Create New Table</h3>
        <form method="post">
            <input type="text" name="table_name" placeholder="Table Name" required><br>
            <div id="columns-container">
                <div class="columns">
                    <input type="text" name="columns[]" placeholder="Column Name" required>
                    <select name="types[]">
                        <option value="VARCHAR(100)">VARCHAR(100)</option>
                        <option value="INT">INT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="DATE">DATE</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select>
                </div>
            </div>
            <button type="button" onclick="addColumnField()">+ Add Column</button><br>
            <button type="submit" name="create_table">Create Table</button>
        </form>
    </div>

    <!-- Existing Tables -->
    <div class="form-section">
        <h3>Existing Tables</h3>
        <?php if (count($tables) > 0): ?>
            <table>
                <tr><th>Table Name</th><th>Action</th></tr>
                <?php foreach ($tables as $t): ?>
                    <tr>
                        <td><?= $t ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <button type="submit" name="delete_table" value="<?= $t ?>" onclick="return confirm('Delete table <?= $t ?>?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No tables found.</p>
        <?php endif; ?>
    </div>

</body>
</html>