<?php

session_start();

//var_dump($_SESSION);

// dane do myszki

if($_SESSION['item'] === 'myszka') {
    $cena = "99";
    $itemName = "Mysz Komputerowa MX201";
}

// dane do klawiatura
if($_SESSION['item'] === 'słuchawki')
{
    $cena = "294,63";
    $itemName = "Słuchawki bezprzewodowe Bluetooth";
}


if(!isset($_SESSION['item']))
{
    header('Location:index.php');
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

    <title>potwierdź zakup</title>
</head>
<body>

<div class="container">


    <div>
        <h1 style="text-align: center">Potwierdzenie danych do zakupu</h1>
    </div>

    <p>Przed zakupem sprawdź poniższe dane</p>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Dane</th>
            <th></th>
            <th>Cena</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Imię nazwisko :</td>
            <td><?php echo $_SESSION['fr2_name']." ".$_SESSION['fr2_surname']; ?></td>
            <td></td>

        </tr>
        <tr>
            <td>Email :</td>
            <td><?php echo $_SESSION['fr2_email']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Produkt :</td>
            <td><?php echo $itemName ?></td>
            <td><?php echo $cena." PLN" ?></td>
        </tr>
        </tbody>
    </table>


        <div>
            <form action="https://ssl.dotpay.pl/test_payment/" id="dotpay_redirection_form" method="POST"
                  enctype="application/x-www-form-urlencoded" >
                <input type="hidden" name="id" value="783208">
                <input type="hidden" name="amount" value="<?php echo $cena ?>">
                <input type="hidden" name="currency" value="PLN">
                <input type="hidden" name="description" value="Płatność za zamówienie 01/2018 <?php echo $itemName."-".$_SESSION['fr2_surname']; ?>">
                <input type="hidden" name="control" value="control_parent">

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8" style="text-align: center" style="line-height: 10px"  >
                        <button type="submit" name = 'submit' class="btn btn-default">ZAPŁAĆ </button>
                    </div>
                </div>
        </div>

            </form>


<br>
<div>
    <form action="index.php">

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8" style="text-align: center" style="line-height: 10px"   >
                <button type="submit" name = 'submit' class="btn btn-default">NOWE ZAMÓWIENIE </button>
            </div>
        </div>
    </form>
</div>
</div>

<?php

unset($_SESSION['item']);
?>

<hr>

<div id="footer">
    <?php
    require_once('tools/counter.php');
    ?>
</div>

</body>
</html>

