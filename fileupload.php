
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    // $conn;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=expttut", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the file data from the form
            if (isset($_FILES['fileup'])) {
                $file = $_FILES['fileup'];
        
                // Check for errors
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    die("File upload error: " . $file['error']);
                }
        
                // Get file name and temporary location
                $fileName = basename($file['name']); // Secure the file name
                $tmpName = $file['tmp_name']; // Temporary location of the uploaded file
        
                // Define the target directory to store the uploaded file
                $targetDir = "uploads/"; // Ensure this directory exists and is writable
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true); // Create the directory if it doesn't exist
                }
        
                $targetFile = $targetDir . $fileName; // Target file path
        
                // Move the uploaded file to the target directory
                if (move_uploaded_file($tmpName, $targetFile)) {
                    echo "File '$fileName' uploaded successfully to $targetFile.<br>";
                } else {
                    echo "Failed to move the uploaded file.<br>";
                }
            } else {
                echo "No file uploaded.<br>";
            }
        
            // Get the name input from the form
            if (isset($_POST['name'])) {
                $name = htmlspecialchars($_POST['name']); // Sanitize input to prevent XSS
                echo "Name entered: $name<br>";
            } else {
                echo "No name provided.<br>";
            }
        } else {
            echo "Invalid request method. Use POST to submit data.";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    

   

?>

