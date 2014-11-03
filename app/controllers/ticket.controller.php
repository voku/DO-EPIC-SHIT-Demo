<?php

// GET routes

$app->get(
  '/buy_overview', function () use ($app) {

    $tickets = new Model_Ticket();
    $data = array();
    $data['tickets'] = $tickets->getAll();

    $app->render('tpl_buy_overview.twig', array('data' => $data));
  }
)->name('tickets');

$app->get(
  '/tickets', function () use ($app) {
    $app->render('tpl_tickets.twig');
  }
)->name('tickets');

// POST routes

// buy
$app->post(
  '/tickets', function () use ($app) {
    $tickets = R::dispense('tickets');

    $ticketsPost = $app->request->post('ticket');
    $tickets->email = $ticketsPost['email'];
    $tickets->password = $ticketsPost['password'];
    $tickets->repassword = $ticketsPost['repassword'];
    $tickets->repassword = $ticketsPost['repassword'];
    $tickets->firstname = $ticketsPost['firstname'];
    $tickets->lastname = $ticketsPost['lastname'];
    $tickets->tel = $ticketsPost['tel'];
    $tickets->address = $ticketsPost['address'];
    $tickets->zip = $ticketsPost['zip'];
    $tickets->ip = $app->request->getIp();

    // start transaction
    R::begin();
    try {
      R::store($tickets);
      R::commit();
      $app->flash('success', 'Nice to hear from you!');
    }
    catch (Exception $e) {
      R::rollback();
      $app->flash('error', 'Oops... seems something goes wrong.');
    }

    $app->redirect($app->request->getReferrer());
  }
)->name('ticket_buy');

