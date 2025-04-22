<?php
// Start session to track user information
session_start();
// Include database connection file
require_once 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Connect to the database
$conn = db_connect();
$user_id = $_SESSION['user_id'];

// Fetch tools belonging to this user
$sql = "SELECT id, name, ToolCondition, cost FROM tools WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add authorship metadata and link CSS and JS files -->
    <link rel="stylesheet" href="styles.css">
    <title>Main Page</title>
</head>

<body>
    <header>
        <nav>
            <a class=nav id=nav-home href="dashboard.php">Home</a>
            <div class="nav-center">
                <input type="text" placeholder="Search.." id="search-bar">
            </div>
            <div class="divider"></div>
            <div class="dropdown">
                <button class="dropbtn">Menu</button>
                <div class="dropdown-content">
                    <a href="userpage.php">Profile</a>
                    <button id="buttonDarkMode" onclick="toggleDarkMode();">Light / Dark Mode</button>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <!--  Add Tool  -->
    <button onclick="document.getElementById('AddToolModal').style.display='block'" class="add-tool-btn">
        Add Tool
    </button>

    <!--  Remove Tool  -->
    <button form="removeform" class="remove-tool-btn">
        Removing Tool
    </button>

    <!--  Add Tool Form  -->
    <div id="AddToolModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('AddToolModal').style.display='none'">&times;</span>
            <form action="add_tool.php" method="POST" class="modal-form">
                <h2>Add a New Tool</h2>

                <label for="name">Tool Name</label>
                <input type="text" id="name" name="name" required>

                <label for="condition">Condition</label>
                <input type="text" id="condition" name="condition" required>

                <label for="cost">Cost ($)</label>
                <input type="number" id="cost" name="cost" step="0.01" required>

                <button type="submit">Add Tool</button>
            </form>
        </div>
    </div>

    <!--  Remove Tool Form  -->
    <form action="remove_tool.php" method="POST" id="removeform" class="modal-form">
        <table>
            <tr>
                <th class="id-col"></th>
                <th class="name-col">Name</th>
                <th class="condition-col">Condition</th>
                <th class="cost-col">Cost</th>
            </tr>
            <tr></tr>

            <?php while ($tool = $result->fetch_assoc()): ?>
                <tr>
                    <td><input type="checkbox" name="tool_ids[]" value="<?php echo htmlspecialchars($tool['id']); ?>"></td>
                    <td><?php echo htmlspecialchars($tool['name']); ?></td>
                    <td><?php echo htmlspecialchars($tool['ToolCondition']); ?></td>
                    <td><?php echo htmlspecialchars($tool['cost']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </form>


    <script>
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('AddToolModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        document.getElementById('search-bar').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('form#removeform table tr');

            rows.forEach((row, index) => {
                // Skip the table header
                if (index === 0) return;

                const nameCell = row.querySelectorAll('td')[1];
                if (!nameCell) return;

                const name = nameCell.textContent.toLowerCase();
                row.style.display = name.includes(searchValue) ? '' : 'none';
            });
        });

        window.addEventListener("DOMContentLoaded", () => {
            const darkModeSetting = localStorage.getItem("darkMode");
            if (darkModeSetting === "enabled") {
                document.body.classList.add("dark-mode");
            }
        });
    </script>

    <script src="js/script.js"></script>

</body>

</html>