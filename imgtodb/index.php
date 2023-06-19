<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <header>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "images";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM `images`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['data'] ).'"/>';
              }
            } else {
              echo "0 results";
            }
            $conn->close();
            ?>            
        </header>
        <form method="post" enctype="multipart/form-data" action="insert_image.php">
            <input type="file" name="image" required>
            <input type="submit" >
        </form>
    </body>
</html>
