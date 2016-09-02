<?php
/**
 * User: Dominik
 * Date: 2016-09-02
 * Time: 08:30
 */
interface PricingStrategyI {
    public function getPizzaPrice($price);
    public function getStrategyInfo();
}
class NormalStrategy implements PricingStrategyI{

    public function getPizzaPrice($price) {
        return $price;
    }

    public function getStrategyInfo() {
        return "Order in normal days is 100% of the base price <br />";
    }
}
class NightStrategy implements PricingStrategyI{

    public function getPizzaPrice($price) {
        return $price * 1.2; // 120%
    }
    public function getStrategyInfo() {
        return "Order between 22:00-6:00 is 120% of the base price <br />";
    }
}
class HolidayStrategy implements PricingStrategyI{

    public function getPizzaPrice($price) {
        return $price * 2;
    }
    public function getStrategyInfo() {
        return "Order in holidays is 200% of the base price <br />";
    }
}

class PizzaNormal {
    /** @var PricingStrategyI */
    private $strategy;
    private $price;
    public function __construct($price){
        $this->price = $price;
        $this->strategy = $this->chooseStrategy();
    }

    /**
     * @return PricingStrategyI
     */
    private function chooseStrategy(){
        $day = (int)date("N");
        $hour = (int)date("H");
        if($hour > 21 || $hour < 6){
            return new NightStrategy();
        }
        if($day > 5){
            return new HolidayStrategy();
        }
        return new NormalStrategy();
    }

    public function setPricingStrategy(PricingStrategyI $strategy){
        $this->strategy = $strategy;
    }
    public function getPizzaPrice(){
        return $this->strategy->getPizzaPrice($this->price);
    }
    public function getPricingInfo(){
        return $this->strategy->getStrategyInfo();
    }
}

///////// example ///////////
$pizza = new PizzaNormal(20);
echo $pizza->getPricingInfo(), "Price for the pizza {$pizza->getPizzaPrice()} USD";

/// but wait a minute... there are holidays now
/// no problem, we can change strategy without modifying PizzaNormal class
$pizza->setPricingStrategy(new HolidayStrategy());
echo "<br />Whooops... sorry there are holidays now <br />";
echo $pizza->getPricingInfo(), "Price for the pizza {$pizza->getPizzaPrice()} USD";

