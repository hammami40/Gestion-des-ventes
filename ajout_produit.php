<?php include "header.php";
if(isset($_POST["new"])){
    $nom=$_POST["nom"];
    $prix_achat=$_POST["prix_achat"];
    $prix=$_POST["prix"];
    $req="insert into produits(nom,prix_achat,prix) values ('$nom',$prix_achat,$prix)";
    $cnx->exec($req);
    header("location:listpr.php");
}
?>
<form method="POST" action="ajout_produit.php">
<div class="row">
<div class="col">
  <label for="nom" class="form-label">Produit</label>
  <input type="text" autocomplete="off" class="form-control" id="nom" name ="nom" placeholder="Nom Produit">
</div>
<div class="col">
  <label for="prix_achat" class="form-label">Prix Achat</label>
  <input type="number" autocomplete="off" class="form-control" id="prix_achat" name="prix_achat" placeholder="Prix Achat">
</div>
<div class="col">
  <label for="prix" class="form-label">Prix </label>
  <input type="number" autocomplete="off" class="form-control" id="prix" name="prix" placeholder="Prix">
</div>
<div class="col">
<label for="btn" class="form-label"> &nbsp;</label><br/>
<button type="submit" name="new" class="btn btn-success btn-sm">Ajouter</button>
<button type="button" class="btn btn-warning btn-sm">Annuler</button>
</div>
</div>
</form>

<?php include "footer.php";