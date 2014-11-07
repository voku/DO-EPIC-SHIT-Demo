<?php

// GET routes

$app->get(
  '/orders', function () use ($app) {

    $tickets = new Model_Ticket();
    $data = array();
    $data['tickets'] = $tickets->getAll();

    $app->render('tpl_orders.twig', array('page_template' => 'tpl_orders', 'data' => $data));
  }
)->name('tickets');
