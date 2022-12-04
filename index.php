<?php 
    session_start();
    
    
    if (!isset($_SESSION["treasure_1"]))
    {
        $_SESSION["treasure_1"] = rand(0,9);
    }   
    if (!isset($_SESSION["treasure_2"]))
    {
        $tmp = rand(0,9);
        if($tmp == $_SESSION["treasure_1"] && $_SESSION["treasure_1"]!=9){
            ++$tmp;
        }
        elseif($_SESSION["treasure_1"]==9){
            --$tmp;
        }
        $_SESSION["treasure_2"] = $tmp;
    }      
    if (!isset($_SESSION["tentativi"]))
    {
        $_SESSION["tentativi"] = 3;
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>Caccia al Tesos</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Trova il tesoro!</div>
        <div class="cell_tentativi"><?php echo "<h1>".$_SESSION["tentativi"]."</h1>"?></div>
        <div class="cell_button">
            <form action="" method="post">
                <button type="submit" class="treasure" value="0" name="btn" id="0"></button>
                <button type="submit" class="treasure" value="1" name="btn" id="1"></button>
                <button type="submit" class="treasure" value="2" name="btn" id="2"></button>
                <button type="submit" class="treasure" value="3" name="btn" id="3"></button>
                <button type="submit" class="treasure" value="4" name="btn" id="4"></button>
                <button type="submit" class="treasure" value="5" name="btn" id="5"></button>
                <button type="submit" class="treasure" value="6" name="btn" id="6"></button>
                <button type="submit" class="treasure" value="7" name="btn" id="7"></button>
                <button type="submit" class="treasure" value="8" name="btn" id="8"></button>
                <button type="submit" class="treasure" value="9" name="btn" id="9"></button>
            </form>
        </div>
        <div class="cell_res"><?php if($_POST){Game();}?></div>
    </div>
</body>
</html>

<?php
    
   function Game(){
    if (isset($_POST["btn"]))
    {
        if($_SESSION["tentativi"]<=0){
            echo "Hai finito i tentativi! Sei ostinato deh";

            session_unset();
            session_destroy();
        }
        elseif(isset($_SESSION["treasure_1"]) && $_SESSION["treasure_1"]==$_POST["btn"]){
            IsWin();
            exit();
        }
        elseif(isset($_SESSION["treasure_2"]) && $_SESSION["treasure_2"]==$_POST["btn"]){
            IsWin();
            exit();
        }
        else{
            IsLost();
            exit();
        }
    }
   }

   function IsWin(){
        NextTry();
        if( $_SESSION["tentativi"]==0){
            echo "Hai vinto ma ti sono rimasti " . $_SESSION["tentativi"] . " tentativi. Partita conclusa!";

            session_unset();
            session_destroy();
        }
        else{
            echo "Hai vinto, hai altri " . $_SESSION["tentativi"] . " tentativi. Prova di nuovo!";
        }
   }

   function IsLost()
   {
        NextTry();
        if( $_SESSION["tentativi"]==0){
            echo "Hai " . $_SESSION["tentativi"] . " tentativi. Hai perso :(";

            session_unset();
            session_destroy();
        }
        else{
            echo "Non hai trovato il tesoro, hai altri " . $_SESSION["tentativi"] . " tentativi. Prova di nuovo!";
        }
   }
   
   function NextTry(){
        if(isset($_SESSION["tentativi"])){
            --$_SESSION["tentativi"];
        }
    }
?>