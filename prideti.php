<?php require __DIR__.'/view/header.php';
    $data= getData();?>

<?php foreach ($data as $key => $value) : ?>

<?php if($_GET['id'] == $data[$key]['id']) : ?>
<div class=" acc_data">
    <table>
        <tr>
            <th>
                <h1>Sąskaitos papildymas</h1>
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

        <form action="<?= URL ?>?route=prideti&id=<?= $data[$key]['id'] ?>" method="post">

            <td class="add-amount">
                <label for="">Suma: <input type="text" name="add" class = "plius-minus"></label>
                    <button type="submit" class="btn">Pridėti</button>
        </form>
        </td>

    </table>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php require __DIR__.'/view/footer.php';?>