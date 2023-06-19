<?php include('../../config/server.php'); ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Szókincs hozzáadás</title>

     <!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</head>
<body>
 <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <form class="p-5 rounded shadow" style="max-width: 30rem; width: 100%"
    method="POST"
    action="szokincsadd.php">

    <h1 class="text-center display-6 pb-4">Magyar-Angol Szókincs játék szó hozzáadása</h1>
     <?php include('../../config/errors.php'); ?>
    <div class="mb-3">
        <label for="huw"
            class="form-label">Szó magyarul</label>  
         <input type="text" 
        class="form-control" 
        name="hun_word" 
        id="huw">

    <div class="mb-3">
        <label for="enw" 
        class="form-label">Szó angolul</label>
        <input type="text" 
        class="form-control" 
        name="eng_word"
        id="enw">
    </div>
    <button type="submit" 
        class="btn btn-primary" name="addword">Hozzáadás</button>
        <button type="submit" 
        class="btn btn-primary" name="wordback">Vissza</button>
    </form>
 </div>
</body>
</html>