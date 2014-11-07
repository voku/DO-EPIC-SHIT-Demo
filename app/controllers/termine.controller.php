<?php

// GET routes

$app->get(
  '/termine', function () use ($app) {
    $app->render('tpl_termine.twig', array('page_template' => 'tpl_termine', 'page_id' => 2));
  }
)->name('home');
