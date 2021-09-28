<?php
require_once "vendor/autoload.php";
use App\Message;

$writer = new \Port\Csv\CsvWriter();
$file = new \SplFileObject('app/messages.csv');
$delimiter = ";";
$reader = new \Port\Csv\CsvReader($file, $delimiter);
if(isset($_POST['send'])){
    header('localhost:8000');
    $message = new Message($_POST['name'], $_POST['message']);    ;
    $writer->setStream(fopen('app/messages.csv', "a"));
    $writer->writeItem([$message->getSender(), $message->getText()]);
    $writer->finish();
    header("Location: /");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatroom</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        textarea {
            resize: none;
        }
        form {
            float: bottom;
            width: 35%;
        }
        input.w3-btn {
            float: right;
        }
    </style>
</head>
<body>
    <?php foreach($reader as $message): ?>
    <p><?php echo "$message[0] says: $message[1]"?></p>
    <?php endforeach; ?>
    <form method="post" class="w3-container w3-card-4 w3-light-grey">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>
        <label>
            <textarea cols="50" rows="5" placeholder="Enter message here..." name="message"></textarea>
        </label>
        <input class="w3-btn w3-blue" type="submit" name="send" value="Send">
    </form>
</body>
</html>

