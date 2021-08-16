<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank App</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Open Sans', sans-serif;

    }

    .container {
        width: 90%;
        margin: 0 auto;

    }

    div {
        margin: 15px;
        display: grid;
    }

    ul,
    .exit {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background: #497333;
        background: -webkit-radial-gradient(left, #497333, #A7CC73);
        background: -moz-radial-gradient(left, #497333, #A7CC73);
        background: radial-gradient(to right, #497333, #A7CC73);
        font-size: 1.2rem;
        font-weight: 700;
    }

    .login-wrapper {
        background: #497333;
        background: -webkit-radial-gradient(left, #497333, #A7CC73);
        background: -moz-radial-gradient(left, #497333, #A7CC73);
        background: radial-gradient(to right, #497333, #A7CC73);
    }

    li .exit {
        font-size: 1.2rem;
        font-weight: 700;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: #fff;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li:hover {
        background-color: #abc9a1;
    }

    .acc-data {
        display: inline;
        font-family: inherit;
        width: 100%;
        border: 0;
        border-bottom: 2px solid grey;
        outline: 0;
        font-size: 1.3rem;
        color: #060606;
        padding: 7px 0;
        background: transparent;
        transition: border-color 0.2s;
    }

    .acc-data input {
        float: right;
    }

    .acc-data label,
    .add-acc-form {
        margin: 20px;
        padding: 20px;
        font-weight: 700;
    }

    table {
        margin-top: 3%;
        border-collapse: collapse;
        width: 100%;
    }

    table a {
        text-decoration: none;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    th {
        background: linear-gradient(to bottom, #40782b 5%, #77a809 100%);
        color: #fff;
    }


    .add {
        box-shadow: inset 0px 1px 0px 0px #4078ff;
        background: linear-gradient(to bottom, #40782b 5%, #77a809 100%);
        background-color: #89c403;
        border-radius: 6px;
        border: 1px solid #74b807;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 15px;
        font-weight: bold;
        padding: 6px 24px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #528009;
        text-align: center;
    }

    .add:hover {
        background: linear-gradient(to bottom, #77a809 5%, #89c403 100%);
        background-color: #77a809;
    }

    .minus {
        box-shadow: inset 0px 1px 0px 0px #fce2c1;
        background: linear-gradient(to bottom, #b57310 5%, #fb9e25 100%);
        background-color: #ffc477;
        border-radius: 6px;
        border: 1px solid #eeb44f;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 15px;
        font-weight: bold;
        padding: 6px 24px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #cc9f52;
    }

    .minus:hover {
        background: linear-gradient(to bottom, #fb9e25 5%, #ffc477 100%);
        background-color: #fb9e25;
    }

    .delete {
        box-shadow: inset 0px 1px 0px 0px #f5978e;
        background: linear-gradient(to bottom, #a60d0d 5%, #c62d1f 100%);
        background-color: #f24537;
        border-radius: 6px;
        border: 1px solid #d02718;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Arial;
        font-size: 15px;
        font-weight: bold;
        padding: 6px 24px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #810e05;
        text-align: center;
    }

    .delete:hover {
        background: linear-gradient(to bottom, #c62d1f 5%, #f24537 100%);
        background-color: #c62d1f;
        ;
    }

    input[type=password],
    input[type=text] {
        display: inline-block;
        border: none;
        background-color: #f3f3f3;
        color: #060606;
        font-size: 1.1rem;
        border-radius: 5px;
        padding: 7px;

    }

    input[type=password]:active,
    input[type=password]:focus,
    input[type=text]:active,
    input[type=text]:focus {
        outline: none;
    }

    input[type=submit]:hover,
    input[type=submit]:active {
        box-shadow: 0 0 3px #7C7C7C;
    }

    .exit {

        background: none !important;
        border: none;
        text-decoration: underline;
        cursor: pointer;
        display: block;
        color: white;
        text-align: center;
        padding: 16px 16px;
        text-decoration: none;
        font-size: .9rem;

    }

    .login label {
        display: grid;
        width: 30%;
        height: 100%;
        font-size: 1.5rem;
        padding: .2rem;
        margin-bottom: 3rem;

    }

    .notes {
        width: 100%;
        height: 50px;
        text-align: center;
        font-weight: 700;
        
    }

    .error {
        width: 100%;
        height: 25px;
        background: #f7514510;
        box-shadow: 0 0 3px #f75145;
        animation: showMsg 0s ease-in 5s forwards;
    }

    .succsess {
        width: 100%;
        height: 25px;
        background: #48f76210;
        box-shadow: 0 0 3px #48f762;
        animation: showMsg 0s ease-in 3s forwards;
    }

    @keyframes showMsg {
        to {
            width: 0;
            height: 0;
            overflow: hidden;
        }
    }

    form {
        display: grid;
        place-self: center;
    }

    .login-wrapper {
        width: 60%;
        margin: 3rem;
        box-shadow: 0 0 3px #7C7C7C;
    }

    .log-btn {
        margin-top: 3rem;
    }

    .log-btn,
    .add-acc {
        box-shadow: 3px 4px 0px 0px #899599;
        background: linear-gradient(to bottom, #ededed 5%, #bab1ba 100%);
        background-color: #ededed;
        border-radius: 15px;
        border: 1px solid #d6bcd6;
        display: inline-block;
        cursor: pointer;
        color: #3a8a9e;
        font-family: Arial;
        font-size: 17px;
        padding: 7px 25px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #e1e2ed;
    }

    .log-btn:hover,
    .add-acc {
        background: linear-gradient(to bottom, #bab1ba 5%, #ededed 100%);
        background-color: #bab1ba;
    }

    .clearfix {
        overflow: auto;
    }

    .add-acc {
        width: 50%;
        place-self: center;
    }

    .btn {
        margin-left: 2%;
        width: 15%;
        background: #00594B;
        border-radius: 15px;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 700;
        padding: 5px 10px 5px 10px;
        text-decoration: none;
    }

    .btn:hover {
        background: #f6f6f6;
        color: #060606;
        text-decoration: none;

    }

    table .add-amount {
        padding-top: 3%;
    }

    h1 {
        text-align: center;
        text-transform: uppercase;
        padding: 3%;
    }

    .login-wrapper {
        display: grid;
        place-self: center;
    }

    .inner-login-wrapper {
        background: url(https://images.pexels.com/photos/7111579/pexels-photo-7111579.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center;
        box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        padding: 3%;
        padding-bottom: 5%;
    }

    .display_login {
        display: <?=display_login() ?>;
    }

    .display_logout {
        display: <?=display_logout() ?>;
    }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li>
                <a href="<?= URL ?>?route=nauja">Sukurti naują sąskaitą</a>
            </li>
            <li>
                <a href="<?=URL?>">Peržiūrėti sąskaitas</a>
            </li>
            <li class="display_login">
                <a href="<?=URL?>?route=login"> Prisijungti </a>
            </li>
            <li class="display_logout">
                <form action="<?= URL ?>?route=logout" method="post">
                    <button type="submit" class="exit"> Atsijungti </button>
                </form>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class= "notes"><?php showMessages() ?></div>