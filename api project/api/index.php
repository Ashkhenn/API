<?php
include('controller/response_controller.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TASK API</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="" method="post">
        <button class="submit" name="action" action="submit">Import</button>
        <span id="result">Количество: <?= $count; ?>, Добавлено: <span id="added"><?= $ar; ?></span></span>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(function () {
            $(".submit").click(function () {
                $.ajax({
                    url: "controller/response_controller.php",
                    method: "post",
                    data: {
                        action: "submit"
                    },
                    success: function (result) {
                        
                        if (result["status"] == "success") {
                           
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>
