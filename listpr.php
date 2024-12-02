<?php
require "header.php";
if(isset($_GET['action']) && $_GET['action']=="delete" && $_GET['id']>0){
    $cnx->exec("delete from produits where id=".$_GET['id']);
    header("location:listpr.php");
}

if(isset($_POST["modif"])){
    $id=$_POST["id"];
$nom=$_POST["nom"];
$prix_achat=$_POST["prix_achat"];
$prix=$_POST["prix"];
$req="update produits set nom='$nom',prix_achat=$prix_achat,prix=$prix where id=$id";
echo $req;
$cnx->exec($req);
header("location:listpr.php");
}

?>
<div class="container">
    <h1><center>Liste des Produits</center></h1>

    
<table class="table table-striped table-bordered" id="listprod">
  <thead>
    <tr>
      <th scope="col">Nom Produit</th>
      <th scope="col">Prix Achat</th>
      <th scope="col">Prix</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $req="select * from produits";
    $lproduits=$cnx->query($req)->fetchAll(PDO::FETCH_OBJ);
    foreach ($lproduits as $pr) {
    echo "<tr>
      <td>".$pr->nom."</td>
      <td>".$pr->prix_achat."</td>
      <td>".$pr->prix."</td>
      
      <td>    <button type='button' onclick=\"modifprod('$pr->nom',$pr->prix_achat,$pr->prix,$pr->id)\" class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal'>Modifier</button>
      <a href='listpr.php?action=delete&id=$pr->id'><button class='btn btn-danger' onclick=\"return confirm('etes vous sure de supprimer?')\">Supprimer</button></a>
    </tr>";
}
    ?>



  </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier Produit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="listpr.php">
<div >
<div >
<input type="hidden" id="id" name ="id"  id="id">
  <label for="nom" class="form-label">Produit</label>
  <input type="text" autocomplete="off" class="form-control" id="nom" name ="nom" placeholder="Nom Produit">
</div>
<div >
  <label for="prix_achat" class="form-label">Prix Achat</label>
  <input type="number" autocomplete="off" class="form-control" id="prix_achat" name="prix_achat" placeholder="Prix Achat">
</div>
<div >
  <label for="prix" class="form-label">Prix </label>
  <input type="number" autocomplete="off" class="form-control" id="prix" name="prix" placeholder="Prix">
</div>
<div >


</div>
</div>
<div class="modal-footer">
      <button type="submit" name="modif" class="btn btn-success btn-sm">Enregistrer</button>
      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
    </div>
</form>
      </div>
      
    </div>
  </div>
</div>



<?php require "footer.php";?>




