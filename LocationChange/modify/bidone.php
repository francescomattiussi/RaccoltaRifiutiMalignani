<!-- --------------------------------------- Form ------------------------------------------------------------ -->
<form action="Modify.php" method="get">
  <div class="mb-3">
    <input type="text" class="form-control" name="tipoRifiuti" value="<?php print $tipologia; ?>"><br>
    <input type="hidden" name="bidone" value="<?php print $_GET['bidone']; ?>">
    <select name="fkLocazione" class="form-select form-select-lg" aria-label="Default select example">
      <option selected>Seleziona un punto di raccolta</option>
      <?php
        $sql = "SELECT * FROM tblLocazione;";
        $result = $connessione->query($sql);
        while($row = $result->fetch_assoc()){
          if ($row['Descrizione'] == $punto) {
            print "<option selected='selected' value='".$row['pkID']."'>".$row['Descrizione']."</option>";
          } else {
            print "<option value='".$row['pkID']."'>".$row['Descrizione']."</option>";
          }
        }
      ?>
    </select><br>
    <input type="submit" value="Modifica Bidone" class="btn btn-dark">
  </div>
</form>