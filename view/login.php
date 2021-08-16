<?php require __DIR__.'/header.php'?>
<div class="login-wrapper">
    <div class="inner-login-wrapper">
        <form class="login" action="<?= URL ?>?route=login" method="post">
            <label for="name"></label> 
                <input type="text" name="name" placeholder = "Vartotojo vardas">
            <label for="pass"></label> 
                <input type="password" name="pass" placeholder = "Slaptažodis">
            
            <button type="submit" class="log-btn clearfix"> Prisijungti</button>
        </form>
    </div>
</div>
<?php require __DIR__.'/footer.php'?>