<?php
// Start the session to access session data
session_start();

// Check if the user is logged in by checking the session
if (!isset($_SESSION['user_name'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: src/pages/login.php");
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Papart's Inventory Management</title>
  <link href="./bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
  <!-- Wrapper -->
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <aside class="bg-dark text-white" id="sidebar-wrapper" style="height: auto;">
        <?php include('src/component/sidebar.php') ?>
    </aside>   
    


        <div class="w-100">
            <!-- Topbar -->
            <header class="bg-light border-bottom " id="topbar">
                <?php include('src/component/topbar.php') ?>
            </header>

            <!-- Main Content -->
            <main id="page-content-wrapper" class="p-4">
            <?php
                switch ($page) {
                    case 'home':
                        include('src/pages/home.php');
                        break;
                    case 'products':
                        include('src/pages/products.php');
                        break;
                    case 'editItem':
                        include('src/pages/edit_item.php');
                        break;
                    case 'inbox':
                        include('src/pages/inbox.php');
                        break;
                    case 'reports':
                        include('src/pages/reports.php');
                        break;
                    case 'addItem':
                        include('src/pages/add_item.php');
                        break;
                    case 'editItem2':
                        include('src/pages/editItem2.php');
                        break;
                    default:
                        echo "<p>Page not found.</p>";
                        break;
                }
                ?>
              
            </main>
        </div>
  </div>

  <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/script/home.js"></script>
</body>
</html>
