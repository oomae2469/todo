<?php
require_once("functions.php");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TODO</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand mb-0 h1">TODO</span>
    </div>
</nav>
<div class="container mt-4">
    <?php if ($message !== "") : ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" roll="alert">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-md-12">
            <form action="todo_add.php" method="POST" class="form">
                <div class="input-group mb-2">
                    <input type="text" name="task" id="task" class="form-control">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>