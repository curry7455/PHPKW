<?php
$animals = [
    'Koala',

    'Jellyfish',

    'Salamander',

    'Tarsier',

    'Narwhal',


];

$task = [//title, due, assigned_to, completed
    'title' => 'dishes',
    'due' => 'tomorrow',
    'assigned_to' => 'me',
    'completed' => false

];
require 'functions.php';
if (checkAge(17)){
    echo 'Come on in!';
}
else {
    echo 'Sorry, you are not old enough.';
}

require 'index.view.php';