<?php
require 'config.php';
session_start();


$user_id = $_SESSION['user_id'];
$role = '';

$sql = "SELECT role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($role);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>360 CodeCart by URVEESH</title>
</head>
<body>
    <header>
    <nav>
            <a href="index.php">Home</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="cart.php">Cart</a>
                <a href="orderDetails.php">Order History</a>
                <?php if ($role === 'admin'): ?>
                    <a href="coursesRegister.php">Register Courses</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a> 
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <br>
        <h1>Welcome to 360 CodeCart by URVEESH</h1>
        <p id="pparaa">Welcome to 360 CodeCart, your one-stop destination for mastering programming and tech skills!<br> Whether you're starting your journey in software development or aiming to advance your expertise, we offer a diverse range of courses tailored to your learning needs.<br> Explore our curated collection of courses in Java, Python, Web Development, Mobile App Development, Machine Learning, and more.<br> Each course is designed to equip you with practical skills and industry insights, ensuring you stay ahead in today's fast-paced tech world. <br>Join thousands of learners worldwide who are transforming their careers with 360 CodeCart. Start your learning journey today!</p>
        <div class="courses">
            <?php
            $sql = "SELECT * FROM courses";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<div id='linkkk' class='course'>
                        <img src='" . $row['image'] . "' alt='" . $row['name'] . "'>
                        <h3>" . $row['name'] . "</h3>
                        <p>" . $row['description'] . "</p>
                        <p>Rs. " . $row['price'] . "</p>
                        <a id='viewde' href='product.php?id=" . $row['id'] . "'>View Details</a>
                      </div>";
            }
            ?>
        </div>
        <section id="contact-us">
        <h2>Contact us on the following platforms through the given links:</h2>
        <br>
        <div>
            <p id="aboutMe">
                <ul id="Contact">
                    <li id="paraa">Phone no.: +91 6204871800</li>
                    <li><a href="mailto:srivastava.urveesh@gmail.com"><i class="bi bi-envelope-open"></i> Email us</a></li>
                    <li><a href="https://www.linkedin.com/in/urveesh-raj-srivastava-b7501626a"><i class="bi bi-linkedin"></i> Connect with us on <b>Linkedin</b></a></li>
                    <li><a href="https://github.com/Urveeshraj"><i class="bi bi-github"></i> Go to our <b>Github</b></a></li>
                    <li><a href="https://www.instagram.com/urveesh.raj?igsh=MWZtdXd0YnhuZm4="><i class="bi bi-instagram"></i> Follow us on <b>Instagram</b></a></li>
                </ul>
            </p>
        </div>
    </section>
    </main>
    <footer>
        <p>&copy; 2024 360 CodeCart by URVEESH</p>
    </footer>
</body>
</html>
