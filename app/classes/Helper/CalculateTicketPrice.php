<?php namespace MyApp\Helper;

/**
 * Created by PhpStorm.
 * User: menadwork-user
 * Date: 04.11.2014
 * Time: 01:32
 */

class CalculateTicketPrice {
  protected $plan = array();
  protected $price = 0;

  public function __construct()
  {
    $this->plan[1] = 5;
    $this->plan[2] = 10;
    $this->plan[3] = 12.5;
    $this->plan[4] = 17.5;
  }

  /**
   * add ticket(s)
   *
   * @param int $planKey
   * @param int $number
   */
  public function add($planKey = 0, $number = 1) {
    $this->price += ($this->plan[$planKey] * $number);
  }

  /**
   * @return array
   */
  public function getPlan()
  {
    return $this->plan;
  }

  /**
   * @param array $plan
   */
  public function setPlan($plan)
  {
    $this->plan = $plan;
  }

  /**
   * @return int
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * @param int $price
   */
  public function setPrice($price)
  {
    $this->price = $price;
  }


}
