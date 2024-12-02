
    <?php
    include "header.php";
    session_start();
    $vente=[];
    if(isset($_SESSION["tab_vente"])){
        $vente=$_SESSION["tab_vente"];
    }
$tab_prod=[];
$req="select * from produits order by id desc";
$prods=$cnx->query($req)->fetchAll(PDO::FETCH_OBJ);
foreach ($prods as $prod) {
$tab_prod[]=["id"=>$prod->id,"nom"=>$prod->nom,"prix"=>$prod->prix];
}

if(isset($_POST["new"])){
unset($_SESSION["tab_vente"]);
header("location:vente.php");
}

if(isset($_POST["send"])){
    $id=$_POST['produit'];
    //recupérer nom du produit
    $prod=$cnx->query("select * from produits where id='$id'")->fetch(PDO::FETCH_OBJ);
    $nom=$prod->nom;
    $prix=$_POST["prix"];
    $qte=$_POST["qte"];
    $montant=$prix*$qte;
    $vente[]=["id"=>$id,"nom"=>$nom,"prix"=>$prix,"qte"=>$qte,"montant"=>$montant];
    $_SESSION["tab_vente"]=$vente;
    header("location:vente.php");
    
}
if(isset($_POST["valide"])){
    //insérer un ticket
echo "bonjour";
    $date=date("Y-m-d H:i:s");
    $req1="insert into tickets(date) value('$date')";
    $cnx->exec($req1);
    $ticket_id = $cnx->lastInsertId();
    //insertion des ligne_tickets
    foreach ($_SESSION['tab_vente'] as $vente) {
        $produit_id=$vente["id"];
        $qte=$vente['qte'];
        $prix=$vente['prix'];
        $req2="insert into ligne_tickets(produit_id,ticket_id,qte,prix) values($produit_id,$ticket_id,$qte,$prix)";
        $cnx->exec($req2);
    }
    unset($_SESSION['tab_vente']);
    header("location:vente.php");

}
?>
<div class="container pt-5">
<h1 class="pt-4"><center>Ticket de caisse</center></h1>
<form  method='post' action=''>

<div class="row">
<div class="col-3">
<label for="produit" >Produit</label>
<select class="form-select" name="produit" required>
  <option selected></option>
  <?php
    foreach ($tab_prod as $prod) {
    echo "<option value=".$prod['id'].">".$prod["nom"]."</option>";
    }

?>
  
</select>
</div>
  <div class="col-2">
    <label for="prix" >Prix</label>
    <input type="number"  class="form-control" name="prix" value="1" min="1" required>
  </div>
  <div class="col-2">
    <label for="qte" >Quantité</label>
    <input type="number" class="form-control" name="qte" value="1" min="1" required>
  </div>
  <div class="col-2">
    <label for="qte" >Total</label>
    <input type="number" class="form-control" readonly disable name="total">
  </div>
  <div class="col-2">
  <label for="btn" class=" d-block">&nbsp;</label>
  <button type="submit" class="btn btn-success mb-3 btn-sm" name="send">Ajouter</button>
  <button type="button" class="btn btn-warning mb-3 btn-sm">Annuler</button>
</div>
</div>

</form>
<hr>

<form method="post" action="vente.php">
<button type="button" name="print" class="btn btn-info btn-sm" onclick="window.print()">Imprimer</button>
<button type="submit" name="new" class="btn btn-success btn-sm">Nouveau Ticket</button>
<button type="submit" name="valide" class="btn btn-primary btn-sm">Valider vente</button>

</form>
<hr>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Montant</th>
            <th>Actions</th>
        </tr>
    </thead>

<tbody>
    <?php
    foreach ($vente as $v) {
        echo "<tr>
            <td>".$v["nom"]."</td>
            <td>".$v["prix"]."</td>
            <td>".$v["qte"]."</td>
            <td>".$v["montant"]."</td>
            <td>
            <button class='btn btn-warning btn-sm'>Update</button>
            <button type='button 'name='delete' class='btn btn-danger btn-sm'>Delete</button>
        </td>
        </tr>";
    }
    ?>
</tbody>

</table>

</div>
<?php
include "footer.php";
?>