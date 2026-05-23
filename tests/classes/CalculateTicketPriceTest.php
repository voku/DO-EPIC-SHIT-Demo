<?php

use MyApp\Helper\CalculateTicketPrice;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: menadwork-user
 * Date: 04.11.2014
 * Time: 01:40
 */

class CalculateTicketPriceTest extends TestCase
{

  /**
   * @var CalculateTicketPrice
   */
  protected $calc;

  protected function setUp(): void
  {
    parent::setUp();
    $this->calc = new CalculateTicketPrice();
  }

  public function testAdd()
  {

    $this->calc->add(1);
    $this->calc->add(2);

    $this->assertEquals(15, $this->calc->getPrice());
  }
}
