<?php

// GET routes

// home
$app->get(
  '/', function () use ($app) {
    $app->render('tpl_index.twig');
  }
)->name('home');
