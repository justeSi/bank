<?php require __DIR__.'/view/header.php';?>
<h1>Naujo vartotojo pridėjimas į sistemą</h1>
<form class="add-acc-form" action="<?= URL ?>?route=nauja" method="POST">
    <div class="acc-data">
        <label for="id">ID: </label>
        <input type="text" name="id" value="<?= id() ?>" readonly>

    </div>
    <div class="acc-data">
        <label for="fname">Vardas: </label>
        <input type="text" name="fname" value="">

    </div>
    <div class="acc-data">
        <label for="lname">Pavardė: </label>
        <input type="text" name="lname" value="">

    </div>
    <div class="acc-data">
        <label for="ak">Asmens kodas: </label>
        <input type="text" name="ak" value="">
    </div>
    <div class="acc-data">
        <label for="acc">Sąskaitos numeris: </label>
        <input type="text" name="acc" value="<?php accNr() ?>" readonly>
    </div>
    <div>
        <button type="submit" class="add-acc">Įvesti</button>
    </div>

</form>
<?php require __DIR__.'/view/footer.php';

?>