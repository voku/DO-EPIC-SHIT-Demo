<?php

// GET routes

// home
$app->get(
  '/', function () use ($app) {
    $app->render('tpl_index.twig', array('page_template' => 'tpl_index', 'page_id' => 1));
  }
)->name('home');
