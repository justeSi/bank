<?php require __DIR__.'/view/header.php';
$data= getData();?>
<?php foreach ($data as $key => $value) : ?>
<?php if($_GET['id'] == $data[$key]['id']) : ?>
<table>
    <tr>
        <th>
            <h1>Lėšų nuskaičiavimas/ pavedimas</h1>
        </th>
    </tr>
    <tr>
        <td>
            <h2><?=$data[$key]['vardas']?> <?=$data[$key]['pavarde']?></h2>
        </td>
    </tr>
    <tr>
        <td>
            <h2><?=$data[$key]['likutis']?> Eur.</h2>
        </td>
    </tr>
    <form action="<?= URL ?>?route=nuskaiciuoti&id=<?= $data[$key]['id'] ?>" method="post">

        <td class="add-amount">
        <label for="">Suma: <input type="text" step="0.01" name="nuskaiciuoti"></label>
            <button class="btn" type="submit">Nuskaičiuoti</button>
    </form>
    </td>

</table>

<?php endif; ?>
<?php endforeach; ?>
<?php require __DIR__.'/view/footer.php';?>