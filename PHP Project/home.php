<?php
// Start the session
session_start();

// Define the page title
$page_title = "Homepage";

// Include any necessary PHP files (e.g., database connection, functions)
// include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="./CSS/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <h1>Welcome to My Website</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
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
            <h2>Welcome to Our Website</h2>
            <p>This is the homepage of our website. Feel free to explore!</p>

           

            <!-- Example of dynamic content -->
            <section>
                <h3>Latest News</h3>
                <?php
                // Example: Fetch and display news from a database
                // $news = fetch_latest_news(); // Assume this function fetches news from a database
                $news = [
                    ["title" => "New Feature Released", "content" => "We have just launched a new feature!"],
                    ["title" => "Website Update", "content" => "Our website has been updated with a new design."],
                ];

                foreach ($news as $item) {
                    echo '<article>';
                    echo '<h4>' . htmlspecialchars($item['title']) . '</h4>';
                    echo '<p>' . htmlspecialchars($item['content']) . '</p>';
                    echo '</article>';
                }
                ?>
            </section>
        </div>
    </main>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> My Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>