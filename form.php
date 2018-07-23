<?php

foreach ($_POST as $a )
{
    printf($a);
    echo "<br />";
}

var_dump($_POST);

$name = $_POST['name'];
$surname = $_POST['surname'];

echo $surname;


$str = $_POST['born'];
$str = substr($str, 2);
$str = str_replace('-', '', $str);
echo $str;


if (ctype_alpha($name))
{
    echo "ok";
}
else
{
    echo '<p>Nieprawidłowe dane! Skrypt wymaga podania adresu e-mail!</p>';
}



// konstrukcja wyrażenia regularnego
// poprawność imienia oraz nazwiska
$sprawdz = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';

// ereg() sprawdza dopasowanie wzorca do ciągu
// zwraca true jeżeli tekst pasuje do wyrażenia


//if(preg_match("@^[a-żA-Ż]{3,15}$@", $name))
//{
//    echo "OK";
//} else {
//    echo "Błąd";
//}

//$a = preg_match("@^[a-żA-Ż]$@", $name);
//
//if (!preg_match("/^[a-zA-Z ]*$/",$name))
//var_dump($a);

if (!preg_match("/^[a-żA-Ż ]*$/",$name))
{   $success = false;
    $_SESSION['e_name'] = "Imię może składać się tylko z liter";
    echo $_SESSION['e_name']."<br>";

}

if (isset($_POST['item']))
{
    echo "ON";
}
else
{
    echo "off";
}



//var_dump($_POST['item']);
//if($_POST['item'] == 'on')
//{
//    echo "true";
//}else
//{
//    echo "off";
//}

