<?php
// ~~~~~~~~~~~~~~~~~~ Duomenų konvertavimas iš JSON į sąrašą ~~~~~~~~~~~~~~
function getData() : array
{
    if (!file_exists(__DIR__.'/data.json')) {
        $data = [];
        $data = json_encode($data);
        file_put_contents(__DIR__.'/data.json', $data);
    }
    return json_decode(file_get_contents(__DIR__.'/data.json'), 1);
}
// ~~~~~ Tikrinami duomenys ir įrašomi į JSON DB ~~~~~~~~~~~~~~~~~~~
function setData() : void
{   
    $data = json_decode(file_get_contents(__DIR__.'/data.json'), 1);

    $mas= [
        'id' => $_POST['id'],
        'vardas' => ucfirst(strtolower($_POST['fname'])),
        'pavarde' => ucfirst(strtolower($_POST['lname'])),
        'a.k.' => $_POST['ak'],
        'sask. Nr' => $_POST['acc'],
        'likutis' => 0
        ];

    if ((isset($_POST['fname']) && validName($_POST['fname']) ?? 1)
        && (isset($_POST['ak']) && validAk($_POST['ak']) ?? 1)
        &&(isset($_POST['lname']) && validName($_POST['lname']) ?? 1)
        ){

        $data[] = $mas;
        $keys = array_column($data, 'pavarde');
        array_multisort($keys, SORT_ASC, $data);
        $data = json_encode($data);
        file_put_contents(__DIR__.'/data.json', $data);
        addMessage('succsess', 'Vartotojas sėkmingai pridėtas');
    }
    header('Location:' .URL);
    die;
}
// ~~~~~~~~~~~~~~~~~~ Tikrinamas vardo ilgis ~~~~~~~~~~~~~~~~~~~
function validName($name)
{   
    if ((strlen($name) < 3))  {
        addMessage('error', 'Vartotojas nesukurtas, nes vardas/pavardė turi būti ilgesni');
        return 0;
    } elseif (( preg_match('/[0-9]/', $name) == 1)) {
        addMessage('error', 'Varde/pavardėje skaitmenys neleidziami');
        return 0;
    } else {
        return 1;
    }
}
// ~~~~~~~~~~~~~~~~~~ Asmens kodo validacija ~~~~~~~~~~~~~~~~~~~
function validAk($ak){
    $data = getData();
    if (strlen($ak) == 11 && is_numeric($ak)) {
        $id[] = $ak;
        $lastNr = $id[10];
        $sum = $id[0]*1 + $id[1]*2 + $id[2]*3 + $id[3]*4 + $id[0]*5 + $id[4]*6 + $id[5]*7 + $id[6]*8 + $id[7]*9 + $id[8]*1;
        $sum2 = $id[0]*3  + $id[1]*4 + $id[2]*5 + $id[3]*6 + $id[4]*7 + $id[5]*8 + $id[6]*9 + $id[7]*1 + $id[8]*2 + $id[9]*3;

        foreach ($data as $value) {
            if ($ak == $value['a.k.']) {
                addMessage('error', 'Vartotojas su tokiu asmens kodu jau yra sistemoje');
                return  0;
                }
            }
        
    }
    else {
        addMessage('error', 'Asmens kodas neatitinka nustatytų LR taisyklių');
        return 0;
    }
}
// ~~~~~~~~~~~~~~~~~~ Generuojama "unikali" banko sąskaita ~~~~~~~~~~~~~~~~~~~
function accNr() 
{
    $str = 'LT0100666';
    foreach (range(1, 10) as $nr) {
        $str .= rand(0, 9);
    }
    echo $str;
}
// ~~~~~~~~~~~~~~~~~~ Generuojamas "unikalus" ID ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function id() : string
{   $id = '';
    foreach (range(1, 1) as $nr) {
        $id = rand(1000000000, 9999999999);
    }
    return $id;
}

// ~~~~~~~~~~~~~~~~~~ Router'is ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function router()
{
    $route = $_GET['route'] ?? '';
    if ('GET' == $_SERVER['REQUEST_METHOD'] && '' === $route) 
    {
        access();
        goAcc();
    }

    elseif ('GET' == $_SERVER['REQUEST_METHOD'] && 'nauja' == $route) 
    {   
        access();
        goNewAcc();
    }

    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'nauja' == $route) 
    {   
        access();
        setData();
        
    }

    elseif ('GET' == $_SERVER['REQUEST_METHOD'] && 'prideti' == $route) 
    {
        access();
        add();
    }

    elseif ('GET' == $_SERVER['REQUEST_METHOD'] && 'nuskaiciuoti' == $route) 
    {
        access();
        pageTakeAmount();
    }
    
    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'delete' == $route && isset($_GET['id'])) {
        deleteAcc($_GET['id']);
    }

    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'prideti' == $route && isset($_GET['id'])) {
        addAmount($_GET['id']);
    }

    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'nuskaiciuoti' == $route && isset($_GET['id'])) {
        takeAmount($_GET['id']);
    }

    elseif ('GET' == $_SERVER['REQUEST_METHOD'] && 'login' == $route) {
        if (isLogged()) {
            header('Location: '.URL);
            die;
        }
        displayLogin();
    }

    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'login' == $route) {
        if (isLogged()) {
            header('Location: '.URL);
            die;
        }
        userLoged();
    }

    elseif ('POST' == $_SERVER['REQUEST_METHOD'] && 'logout' == $route) {
        logout();
        

    }

    else 
    {
        echo 'Page not found 404';
        die;
    }
}
// ~~~~~~~~~~~~~~~~~~ Puslapių adresai ~~~~~~~~~~~~~~~~~~~
function goAcc(){
    require __DIR__.'/acc.php';
    
}

function goNewAcc(){
    require __DIR__.'/add_new.php';
}

function add()
{
    require __DIR__.'/prideti.php';
}

function pageTakeAmount()
{
    require __DIR__.'/nuskaiciuoti.php';
}

function displayLogin()
{
    require __DIR__ . '/view/login.php';
}
// ~~~~~~~~~~~~~~~~~~ Vartotojo trynimas iš sistemos ~~~~~~~~~~~~~~~~~~~
function deleteAcc(int $id)
{
    $data = getData();
    foreach ($data as $index => $info) {
        if ($id == $info['id']) {
            if ($info['likutis'] == 0) {
                unset($data[$index]);
                addMessage('succsess', 'Vartotojas sėkmingai pašalintas iš sistemos');
                break;
            }
            else {
                addMessage('error', 'Sąskaitos, kurioje yra pinigų ištrinti negalima');
            }
        }
    }
    $data = json_encode($data);
    file_put_contents(__DIR__.'/data.json', $data);
    header('Location:' .URL);
    die;
    
}
// ~~~~~~~~~~~~~~~~~~ Pinigų įnešimas į vartotojo sąskaitą ~~~~~~~~~~~~~~~~~~~
function addAmount(int $id)
{
    $data = getData();
    foreach ($data as &$value) {
        if ($id == $value['id']) {
            if ( (!is_numeric($_POST['add']) ) ) {
                addMessage('error', 'Negalimas veiksmas');
                break;
            }
            else {
                $value['likutis'] += round((float)$_POST['add'],2);
                addMessage('succsess', 'Sąskaita papildyta');
                break;
            }
        }
    }
    $data = json_encode($data);
    file_put_contents(__DIR__.'/data.json', $data);
    header('Location: '.URL);
    die;
    
}
// ~~~~~~~~~~~~~~~~~~ Nuskaičiavimas nuo vartotojo sąskaitos ~~~~~~~~~~~~~~~~~~~
function takeAmount(int $id)
{   
    $data = getData();
    
    foreach ($data as &$value) {
        if ($id == $value['id']) {
            if (((float)$value['likutis'] - (float)$_POST['nuskaiciuoti']) < 0) {
                addMessage('error', 'Sąskaitoje nepakankamas likutis operacijai įvykdyti');
                break;
            }
            elseif (is_numeric($_POST['nuskaiciuoti'])){
                $value['likutis'] -= round((float)$_POST['nuskaiciuoti'], 2);
                addMessage('succsess', 'Pinigai nuskaičiuoti');
                break;
                
            }
            else {addMessage('error', 'Negalimas veiksmas');
                break;
            }
        }
    }
    $data = json_encode($data);
    file_put_contents(__DIR__.'/data.json', $data);
    header('Location: '.URL);
    die;
}
// ~~~~~~~~~~~~~~~~ Prisijungimo tikrinimas ~~~~~~~~~~~~~~~~~~~~~~~~~~~
function userLoged()
{
    $users = json_decode(file_get_contents(__DIR__.'/users.json'), 1);
    $name = $_POST['name'] ?? '';
    $pass = md5($_POST['pass']) ?? '';

    foreach ($users as $user) {
        if ($user['name'] == $name) {
            if ($user['pass'] == $pass) {
                $_SESSION['login'] = 1;
                $_SESSION['name'] = $name;
                addMessage('succsess', 'Sėkmingai prisijungta');
                header('Location: '.URL);
                die;
            }
        }
    }
    addMessage('error', 'Vartotojo vardas arba slaptažodis neteisingas');
    header('Location: '.URL.'?route=login');
    die;
}
// ~~~~~~~~~~~~~ Peradresavimas jei neprisijungus~~~~~~~~~~~~~~~~~~~~~
function access()
{
    if (!isset($_SESSION['login']) || $_SESSION['login'] != 1) {

        header('Location: '.URL.'?route=login');
        die;
    }
}
function isLogged()
{
    return isset($_SESSION['login']) && $_SESSION['login'] == 1;
}

function logout()
{
    unset($_SESSION['login'], $_SESSION['name']);
    header('Location: '.URL.'?route=login');
    die;
}
// ~~~~~~~~~~~~~~~~~~~ Pranešimai ~~~~~~~~~~~~~~~~~~~~~
function addMessage(string $type, string $msg) : void
{
    $_SESSION['msg'][] = ['type' => $type, 'msg' => $msg];
}

function clearMessages() : void
{
    $_SESSION['msg'] = [];
}

function showMessages() : void
{
    $messages = $_SESSION['msg'];
    clearMessages();
    require __DIR__ . '/view/notes.php';
}
// ~~~~~~~~~~~~ Prisijungti / atsijungti ~~~~~~~~~~~~~~~~~~~~~~~~~
function display_login()
{
    $display = 'inline';
    if (isLogged()){
        $display = 'none';
    }
    return $display;
}

function display_logout()
{
    $display = 'none';
    if (isLogged()){
        $display = 'inline';
    }
    return $display;
}
// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
?>