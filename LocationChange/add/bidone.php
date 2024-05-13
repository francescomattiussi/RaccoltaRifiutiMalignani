
<!-- --------------------------------------- Form ------------------------------------------------------------ -->
<form action="Add.php?page=Bidone" method="get">
    <div class="mb-3">
      <input type="text" class="form-control" name="tipoRifiuti" placeholder="Inserisci la tipologia di rifiuto"><br>
      <select name="fkLocazione" class="form-select form-select-lg" aria-label="Default select example">
        <option selected>Seleziona un punto di raccolta</option>
        <?php
          $sql = "SELECT * FROM tblLocazione;";
          $result = $connessione->query($sql);
          while($row = $result->fetch_assoc()){
            print "<option value='".$row['pkID']."'>".$row['Descrizione']."</option>";
          }
        ?>
      </select><br>
      <input type="submit" value="Inserisci Bidone" class="btn btn-dark">
    </div>
  </form>