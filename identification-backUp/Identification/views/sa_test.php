<?php
include __ROOT__."/views/header.html";
?>

<div class="container">
    <h1>Tester la méthode addGroups</h1>
    <form>
      <div class="form-group">
        <label for="groupName">Nom du groupe :</label>
        <input type="text" class="form-control" id="groupName" placeholder="Entrez un nom de groupe">
      </div>
      <div class="form-group">
        <label for="groupDesc">Description du groupe :</label>
        <input type="text" class="form-control" id="groupDesc" placeholder="Entrez une description de groupe">
      </div>
      <div class="form-group">
        <label for="groupSelect">Options de groupe :</label>
        <select class="form-control" id="groupSelect">
          <option value="">Sélectionnez une option</option>
          <optgroup label="Options fonctionnelles">
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </optgroup>
          <optgroup label="Options erronées">
            <option value="4">Option 4</option>
            <option value="5">Option 5</option>
            <option value="6">Option 6</option>
          </optgroup>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Tester</button>
    </form>
  </div>