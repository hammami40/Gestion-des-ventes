<?php
try {
    $cnx=new PDO('mysql:host=localhost;dbname=ventes','root','');
    $cnx->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
   
}
 catch (PDOexception $e) {
    echo "impossible de se connecter à la basde de données:",$e->getmessage();
    exit();
}






?>