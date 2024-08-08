<?php
include '../includes/config.php';
include '../includes/Database.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    // $cv_file_path = $_FILES['cv_file_path']['name'];
    // $description = $_POST['description'];
    // $image = $_FILES['image']['name'];
    // $target = UPLOAD_PATH . basename($image);

    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
            if ($role == 'employer') {
                $query = "INSERT INTO employers (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $username, $email, $hashed_password);
    
            } elseif ($role == 'employee') {
                $query = "INSERT INTO employees (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $username, $email, $hashed_password);
    
            }
        
            if ($stmt->execute()) {
                $success = 'Registration successful!';
                $userId = $conn->insert_id;
                session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_name'] = $username;
                $_SESSION['user_role'] = $role;

                if ($role == 'employer') {
                    header('Location: ../employers/dashboard.php');
                }
                if ($role == 'employee') {
                    header('Location: ../employees/dashboard.php');
                }

                exit;
            } else {
                $error = 'Error: ' . $stmt->error;
            }

            // Close statement
            $stmt->close();
        
    }
}

// Close database connection
$db->close();
?>

<?php include '../includes/head.php'; ?>

<body style="background-image: linear-gradient(to right, #6fbae2, #7168c9);">
  <?php include '../includes/header.php'; ?>

  <?php if ($error || $success): ?>
    <div id="popup-message" class="popup-message-overlay">
        <div class="popup-message-box">
            <button id="close-popup" class="close-btn">&times;</button>
            <div class="popup-message-content">
                <?php if ($error): ?>
                    <div class="error"><?= htmlspecialchars($error); ?></div>
                <?php elseif ($success): ?>
                    <div class="success"><?= htmlspecialchars($success); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
  <?php endif; ?>

  <section class="container">
    <div class="row">
        <div class="col-12 col-md-6 bsb-tpl-bg-fallout">
            <div class="d-flex flex-column justify-content-between p-md-4 p-xl-5">
                <h3 class="m-0 ">Welcome!</h3>
                <img src="../assets/image/fallout-thumbsup.png" alt="Login Image" class="img-fluid mx-auto my-4">
            </div>
            <center>
            <p class="mb-0 ">
                Already had an account ?
                <a href="login.php" class="link-secondary text-decoration-none"> 
                    Log in here 
                </a>
            </p>
            </center>
        </div>

        <div class="col-12 col-md-6 bsb-tpl-bg-lotion ">
            <div class="p-3 p-md-4 p-xl-5">
                <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <h3>Register</h3>
                    </div>
                </div>
            </div>       

            <form method="POST" class="card-body" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="form-group">
                    <label class="form-label" for="username">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="employee">Employee</option>
                        <option value="employer">Employer</option>
                    </select>    
                </div>
                <button type="submit" class="btn btn-primary mb-1">Register</button>
                <hr class="mb-0 border-secondary-subtle">
            </form>
            </div>
        </div>
    </div>

</section>

<?php include '../includes/foot.php'; ?>
</body>
</html>
