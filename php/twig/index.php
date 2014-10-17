<?php

include __DIR__ . "/vendor/twig/twig/lib/Twig/Autoloader.php";

//register autoloader
Twig_Autoloader::register();

//loader for template files
$loader = new Twig_Loader_Filesystem('templates');

//twig instance
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
));

//load template file
$template = $twig->loadTemplate('index.html');

//render a template
echo $template->render(array('title' => 'Welcome to Twig template'));
