
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    // $conn;
    try {experiment10
        $conn = new PDO("mysql:host=$servername;dbname=expttut", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve form data and sanitize
            $name = $_POST['uname'];
            $address = $_POST['add'];
            $mobile =$_POST['mobile'];
            $college =$_POST["college"];
    
            // Check if the mobile value is numeric
            if (!ctype_digit($mobile)) {
                throw new Exception("Invalid mobile number. Only numeric values are allowed.");
            }
    
            // Insert data into the database
            // $qry = "INSERT INTO userTable(username, collegName, mobile, address) VALUES (:name, :mobile, :college, :add)";
            $sql = "INSERT INTO userTable (username, collegName, mobile, address) VALUES (:name, :mobile, :college, :add)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':mobile', $mobile);
            $stmt->bindParam(':college', $college);
            $stmt->bindParam(':add', $address);
        
            if( $stmt->execute()){
                echo "Data created"."<br>";
                $sql = "SELECT * FROM userTable";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($results as $row) {
                    echo "Name: " . $row['username'] . ", Address: " . $row['address'] . ", Mobile: " . $row['mobile'] . ", College: " . $row['collegeName']."<br>";
                }
            }else{
                echo "Not created";
            }
            $conn = null;
 
        } else {
            echo "Invalid request method.";
        }    
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    

   

?>

