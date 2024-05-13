
<!-- --------------------------------------- Form ------------------------------------------------------------ -->
  <form action="Modify.php" method="get">
    <div class="mb-3">
      <input type="text" class="form-control" name="descrizione" placeholder="Modifica la descrizione della locazione"><br>
      <input type="hidden" name="location" value="<?php print $_GET['location']; ?>">
      <input type="submit" value="Modifica" class="btn btn-dark">
    </div>
  </form>