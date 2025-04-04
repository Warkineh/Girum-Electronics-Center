<?php
session_start();

$page_title = "Homepage";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="./CSS/styles.css"> 
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <h1>Welcome to Group 8 Website</h1>
            <nav>
                <ul>
                    <li><a href="../Project/ProG8.html">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Logout</a></li>
                
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content Section -->
    <main>
        <div class="container">
            <h2 class="welcome">Welcome to Our Website</h2>
            <p>This is the homepage of our website!</p>

           

            <!-- Group 8 members -->
            <section>
                <h3 class="thead">Group Members</h3>
                
        
    
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Warkineh Lemma</td>
            <td>UGR/14112/15</td>
        </tr>
        <tr>
            <td>Lemma Kechinu</td>
            <td>UGR/13841/15</td>
        </tr>
        <tr>
            <td>Nuhamin Sileshi</td>
            <td>UGR/13968/15</td>
        </tr>
        <tr>
            <td>Eyasu Yohannes</td>
            <td>UGR/13682/15</td>
        </tr>
        <tr>
            <td>Muzeyen Hussein</td>
            <td>UGR/13938/15</td>
        </tr>
        <tr>
            <td>Israel Belete</td>
            <td>UGR/14482/15</td>
        </tr>
    </tbody>
</table>

            </section>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Group 8 Website. All rights reserved.</p>
        </div>
    </footer>
    <script <script src="../JS/script.js"></script>


</body>
</html>