<?php

use MyApp\Helper\CalculateTicketPrice;

// GET routes

$app->get(
  '/tickets', function () use ($app) {
    $app->render('tpl_tickets.twig', array('page_template' => 'tpl_tickets'));
  }
)->name('tickets');

$app->get(
  '/tickets/:plan+', function ($plan) use ($app) {
    $app->render('tpl_tickets.twig', array('page_template' => 'tpl_tickets', 'plan' => $plan));
  }
)->name('ticket_plan');

// POST routes

// buy
$app->post(
'/tickets', function () use ($app) {

    $tickets = R::dispense('tickets');

    $plan = $_POST['plan'];
    $calc = new CalculateTicketPrice();
    foreach ($plan as $yourPlan => $yourCount) {
      $calc->add($yourPlan, $yourCount);
    }

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
    $tickets->plan1 = $plan[1];
    $tickets->plan2 = $plan[2];
    $tickets->plan3 = $plan[3];
    $tickets->plan4 = $plan[4];
    $tickets->price_total = $calc->getPrice();

    // start transaction
    R::begin();
    try {
      R::store($tickets);
      R::commit();
      $app->flash('success', 'Deine Bestellung wurde gespeichert!');
    }
    catch (Exception $e) {
      R::rollback();
      $app->flash('error', 'Oops... seems something goes wrong.');
    }

    $app->redirect($app->request->getReferrer());
  }
)->name('ticket_buy');

