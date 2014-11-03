<?php

/**
 * Object model mapping for relational table `tickets`
 */
class Model_Ticket extends Model_Base
{

  /**
   * get all
   *
   * @param bool $isBean
   *
   * @return array
   */
  public function getAll($isBean = false)
  {
    if ($isBean !== false) {
      $return = R::findAll('tickets');
    } else {
      $return = R::getAll('SELECT * FROM tickets');
    }

    return $return;
  }

  /**
   * lifecycle hooks
   */
  public function dispense()
  {
    parent::dispense();
    $this->bean->role = $this->beanType;
  }

}
