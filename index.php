<?php
session_start();

if(isset($_POST['submit'])) {
    // Udana walidacja - tak - flaga
    $success = true;
    $item = '';


    // sprawdzam name

    $name = $_POST['name'];
//    $name = trim($name);

    // sprawdzam dlugosc imienia
    if ((strlen($name) < 3) || (strlen($name) > 15)) {
        $success = false;
        $_SESSION['e_name'] = "Imię musi posiadać od 3 do 15 znaków";
    }

    if (!preg_match("/^[a-żA-Ż ]*$/", $name)) {
        $success = false;
        $_SESSION['e_name'] = "Imię może składać się tylko z liter";
    } else {

    }

    // sprawdzam nazwisko

    $surname = $_POST['surname'];

    // sprawdzam dlugosc imienia

    if ((strlen($surname) < 3) || (strlen($surname) > 20)) {
        $success = false;
        $_SESSION['e_surname'] = "Nazwisko musi posiadać od 3 do 20 znaków";
    }

    if (!preg_match("/^[a-żA-Ż ]*$/", $surname)) {
        $success = false;
        $_SESSION['e_surname'] = "Nazwisko może składać tylko się z liter";
    }

    // sprawdzam email

    $email = $_POST['email'];
    $checkEmail = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';

    if (!preg_match($checkEmail, $email)) {
        $success = false;
        $_SESSION['e_mail'] = "popraw wartość email";
    }

    // pesel

    $pesel = $_POST['pesel'];
    $strLenPesel = strlen($pesel);

    // sprawdzenie czy pesel ma 11 cyfr
            $regPesel = '/^[0-9]{11}$/';
            $reg = !preg_match($regPesel, $pesel);
            if ($reg) {
                $success = false;
                $_SESSION['e1_pesel'] = "numer pesel powinień składać się z 11 cyfr";
            }

    // czy data urodzenia jest zgodna z peselem

            $born = $_POST['born'];
            $born = substr($born, 2);
            $born = str_replace('-', '', $born);

            $peselSix = substr($pesel, 0, 6);

            if($born != $peselSix)
            {
                $success = false;
                $_SESSION['e_pesel'] = "sprawdź poprawność numeru pesel";
            }

    // sprawdzenie płci po imieniu z 10 cyfrą peselu

        function sexChecker($name)
        {
            $name = strtolower($name);
            $lastLetter = @$name[strlen($name) - 1];
            if ($name == "kuba") {
                $nameReturn = "M";
            } elseif ($name == 'beatrycze') {
                $nameReturn = "K";
            } elseif ($lastLetter != 'a') {
                $nameReturn = "M";
            } else {
                $nameReturn = "K";
            }
            return $nameReturn;
        }

            // 10 cyfra peselu okresla płeć

            if($strLenPesel === 11)

                $Man = [1, 3, 5, 7, 9];
                if (@in_array($pesel[9], $Man))
                {
                    $sexPesel = "M";
                } else {
                    $sexPesel = "K";
            }


                if(@sexChecker($name) != $sexPesel OR $strLenPesel != 11)
            {
                $success = false;
                $_SESSION['e_pesel'] = "sprawdź poprawność numeru pesel";
            }


      //sprawdzenie kodowania PESELU

        function isValidPesel($pesel)
        {
            $a = substr($pesel, 0, 1);
            $b = substr($pesel, 1, 1);
            $c = substr($pesel, 2, 1);
            $d = substr($pesel, 3, 1);
            $e = substr($pesel, 4, 1);
            $f = substr($pesel, 5, 1);
            $g = substr($pesel, 6, 1);
            $h = substr($pesel, 7, 1);
            $i = substr($pesel, 8, 1);
            $j = substr($pesel, 9, 1);
            $checksum = substr($pesel, 10, 1);

            $result = $a + 3 * $b + 7 * $c + 9 * $d + $e + 3 * $f + 7 * $g + 9 * $h + $i + 3 * $j;

            $check = 10 - substr($result, -1, 1);

            if (substr($result, -1, 1) == 0)
                $check = 0;

            if ($check == $checksum) {
                $success = true;


            } else {
                $success = false;


            }
            return $success;
        }

        if (isValidPesel($pesel) == false)
        {
            $success = false;
            $_SESSION['e_pesel'] = "sprawdź poprawność numeru pesel";
        };

            // kolejność wyświetlania błędów zwiazanych z peselem

                if(isset($_SESSION['e1_pesel']) && isset($_SESSION_['e_pesel']))
                {
                    unset($_SESSION['e1_pesel']);
                    var_dump($success);
                }

            if(isset($_SESSION['e1_pesel']))
            {
                $_SESSION['e_pesel'] = $_SESSION['e1_pesel'];
                unset($_SESSION['e1_pesel']);
            }



    // zapamietaj podane dane

    $_SESSION['fr_name'] = $name;
    $_SESSION['fr_surname'] = $surname;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_pesel'] = $pesel;
    $_SESSION['fr_born'] = $_POST['born'];

    $_SESSION['fr2_name'] = $name;
    $_SESSION['fr2_surname'] = $surname;
    $_SESSION['fr2_email'] = $email;
    $_SESSION['fr2_pesel'] = $pesel;
    $_SESSION['fr2_born'] = $_POST['born'];

    @$_SESSION['item'] = $_POST['item'];

    $born = $_POST['born'];
//    var_dump($_SESSION);


    // SUKCES WSZYSTKO PRZESZŁO !!!

    if(isset($_POST['submit']) && $success == true)
    {
        header('Location:order.php');
    }


}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/main.css">

    <title>formularz zamówienia</title>
</head>
<body>

<div class="container">


    <div>
        <h1 style="text-align: center">Formularz zakupu</h1>
    </div>

    <form class="form-horizontal" method="POST">

        <div class="form-group">
            <label class="col-sm-2 control-label">Imię</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="John" name="name" value="<?php
                if (isset($_SESSION['fr_name']))
                {
                    echo $_SESSION['fr_name'];
                    unset($_SESSION['fr_name']);
                }
?>
"  />
<?php

if (isset($_SESSION['e_name']))
{
    echo '<div class = "error">'.$_SESSION['e_name'].'</div>';
    unset($_SESSION['e_name']);
}
?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nazwisko</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="surname" placeholder="Snow" name="surname" value="
<?php
                if (isset($_SESSION['fr_surname']))
                {
                    echo $_SESSION['fr_surname'];
                    unset($_SESSION['fr_surname']);
                }
                ?>
"  />
                <?php

                if (isset($_SESSION['e_surname']))
                {
                    echo '<div class = "error">'.$_SESSION['e_surname'].'</div>';
                    unset($_SESSION['e_surname']);
                }
                ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="john.snow@gameofthrones.com" name="email" value="<?php
               if (isset($_SESSION['fr_email']))
                {
                    echo $_SESSION['fr_email'];
                    unset($_SESSION['fr_email']);
                }?>
"  />
                <?php

                if (isset($_SESSION['e_mail']))
                {
                    echo '<div class = "error">'.$_SESSION['e_mail'].'</div>';
                    unset($_SESSION['e_mail']);
                }
                ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">PESEL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pesel"  placeholder="80061611317" name="pesel" value="<?php
                if (isset($_SESSION['fr_pesel']))
                {
                    echo $_SESSION['fr_pesel'];
                    unset($_SESSION['fr_pesel']);
                }
                ?>
"  />
                <?php

                if (isset($_SESSION['e_pesel']))
                {
                    echo '<div class = "error">'.$_SESSION['e_pesel'].'</div>';
                    unset($_SESSION['e_pesel']);
                }
                ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Data urodzenia</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="born" placeholder="date" name="born" value="<?php
                if (isset($_SESSION['fr_born']))
                {
                    echo $_SESSION['fr_born'];
                    unset ($_SESSION['fr_born']);
                }

                ?>" />

            </div>
        </div >
        <div style="text-align: center">
            <a href="delete.php" class="btn btn-default" >
                <div id="button" >USUŃ DANE</div></a>

        </div>


        <div>
            <h1 style="text-align: center">Wybierz produkt</h1>
        </div>

        <div class="items">
            <div style="text-align: center">
                <img src="jpg/mouse.jpg" width="200" height="150" style="text-align: left">
                <br />
                <input type="radio" name="item" id="mouse" value="myszka" required> Mysz Komputerowa MX201 - 99 PLN<br><br>

            </div>
            <div style="text-align: center">
                <img src="jpg/headphones.jpg" width="200" height="150" style="text-align: left">
                <br />
                <input type="radio" name="item" id="headphones" value="słuchawki"
                > Słuchawki bezprzewodowe Bluetooth - 294,63 PLN <br>
                <br />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8" style="text-align: center" >
                <button type="submit" name = 'submit' class="btn btn-default">KUP PRODUKT</button>
            </div>
        </div>

    </form>

    <form action="delete.php">

    </form>

</div>


<hr>
<div id="footer">
    <?php
    require_once('tools/counter.php');
    ?>
</div>





<script src="jquery.js"></script>


<script src="tools/slider.js"></script>

</body>
</html>

