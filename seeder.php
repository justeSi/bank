<?php

$users = [
    ['name' => 'Juste', 'email' => 'juste@email.com', 'pass' => md5('asd')],
    ['name' => 'Admin', 'email' => 'admin@email.com', 'pass' => md5('qwe')],
    ['name' => 'Briedis', 'email' => 'briedis@email.com', 'pass' => md5('zxc')],
];
$users = json_encode($users);
file_put_contents(__DIR__.'/users.json', $users);