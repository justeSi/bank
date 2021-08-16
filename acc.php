<?php require __DIR__.'/view/header.php';?>


<form action="<?= URL ?>" method="post">
    <?php $data = getData(); ?>

    <table>
        <div>
            <h1>Sąskaitos apžvalga / operacijos / trynimas</h1>
        </div>
        <tr>
            <th>Vartotojo id</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Asmens kodas</th>
            <th>Sąskaita</th>
            <th>Likutis </th>

        </tr>

        <?php foreach ($data as $key => $value) : ?>
        <tr>
            <td><?= $data[$key]['id'] ?></td>
            <td><?= $data[$key]['vardas'] ?></td>
            <td><?= $data[$key]['pavarde'] ?></td>
            <td><?= $data[$key]['a.k.'] ?></td>
            <td><?= $data[$key]['sask. Nr'] ?></td>
            <td><?= $data[$key]['likutis'] ?> Eur.</td>
        <tr>
            <td><a class="add" href="<?= URL ?>?route=prideti&id=<?= $data[$key]['id'] ?>">Pridėti</a> </td>
            <td><a class="minus" href="<?= URL ?>?route=nuskaiciuoti&id=<?= $data[$key]['id'] ?>">Nuskaiciuoti</a>
            </td>

</form>


<td>
    <form action="<?= URL ?>?route=delete&id=<?= $data[$key]['id'] ?>" method="post">
        <button type="submit" class="delete">Ištrinti</button>
    </form>
</td>


</tr>
</tr>
<?php endforeach ?>
</table>

<?php require __DIR__.'/view/footer.php';?>