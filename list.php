<?php
if(isset($_GET['token'])){
    if($_GET['token'] == '22432243'){
        include 'dbconfig.php';
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIST</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
   <div class="container mt-5">
    <table class="table table-striped">
        <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Link</th>
      <th scope="col">File</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $sql = "SELECT * FROM `files` LIMIT 100";
        $result = mysqli_query($conn, $sql);
        while($row = $result->fetch_assoc()) {
            echo '<tr>
                <th scope="row">'.$row['id'].'</th>
                <td><a href="'.$row['link'].'">'.$row['link'].'</a></td>
                <td>'.$row['filename'].'</td>
                <td>'.$row['date'].'</td>
          </tr>';
        }
    ?>
    
  </tbody>
</table>
   </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>


<?php
    }
}else{
    echo('Access Denied!');
}