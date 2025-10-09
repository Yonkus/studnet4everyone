<?php

include 'utils.php';

/*
 * Prüfen, ob screen "internet" existiert
 */

$isScreenRunning = isScreenRunning();
?>

<html lang="de">
    <head>
        <title>STUDNET4EVERYONE</title>
        <meta charset="UTF-8">
        <style>
            body{
                font-size: 2em;
                text-align: center;
                font-family: Consolas,monaco,monospace;
            }
            input{
                width: 100%;
            }
            table{
                margin-left: auto;
                margin-right: auto;
                font-size: 1em;
            }
            table tr td:empty{
                width: 5%;
            }
        </style>
    </head>
    <body>
        <h1>STUDNET4EVERYONE</h1>
        <form method="POST" action="toggle.php">
            <input type="hidden" name="action" value="<?php echo $isScreenRunning? "turnoff" : "turnon"; ?>">
            <table>
                <tr>
                    <td>Status:</td>
                    <td></td>
                    <td>
                        <p style='color: <?php echo $isScreenRunning? "#00FF00" : "#FF0000"; ?>;'>
                            <?php echo $isScreenRunning? "INTERNET AN" : "INTERNET AUS"; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Passwort:</td>
                    <td></td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="<?php echo $isScreenRunning? "AUSSCHALTEN" : "ANSCHALTEN"; ?>">
                    </td>
                </tr>
            </table>
            <?php
                if(isset($_GET['error']) && $_GET['error'] == '1'){
            ?>
                <p style="color:#FF0000">Passwort falsch</p>
            <?php
                }
            ?>
        </form>
    </body>
</html>