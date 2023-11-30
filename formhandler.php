<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
     $username = $_POST["username"];
     $password = $_POST["password"];
    
                                                                                      
     try {
        
        require_once "connectdb.php";
        $query = "INSERT INTO users(username, password) VALUES (?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $password]);
        $pdo = null;
        $stmt = null;
        header("Location: ../register.php");
        die();


     } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
     }
} else {
    header("Location: ../register.php");
}



