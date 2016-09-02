<?php

/**
 * User: Dominik
 * Date: 2016-09-02
 * Time: 02:41
 */
class ShopOrder {
    /**
     * @var LoginChecker
     */
    private $loginChecker;
    /**
     * @var PaymentChecker
     */
    private $paymentChecker;
    /**
     * @var ProductsAvailabilityChecker
     */
    private $productsAvailabilityChecker;
    /**
     * @var DeliveryManager
     */
    private $deliveryManager;

    public function __construct() {
        $this->loginChecker = new LoginChecker();
        $this->paymentChecker = new PaymentChecker();
        $this->productsAvailabilityChecker = new ProductsAvailabilityChecker();
        $this->deliveryManager = new DeliveryManager();
    }

    public function order($productId, $userId, $deliveryType) {
        if (!$this->loginChecker->isLoggedIn($userId)) {
            throw new Exception("You're not logged in");
        }
        if (!$this->loginChecker->canBuy($userId)) {
            throw new Exception("You have no rights tu buy.");
        }
        if (!$this->productsAvailabilityChecker->isInStorage($productId)) {
            throw new Exception("Product with id: $productId is unavailable");
        }

        echo "<br />Your order is complete. Delivery cost is: " . $this->deliveryManager->countDeliveryCost($deliveryType, $productId);
        if (!$this->paymentChecker->hasPayedForProduct($userId, $productId)) {
            echo "<br />You haven't paid for the product yet! As soon as you do, product will be sent to your delivery address.";
        }

    }
}

class LoginChecker {

    public function isLoggedIn($userId) {
        return true;
    }

    public function canBuy($userId) {
        return true;
    }
}

class PaymentChecker {

    public function hasPayedForProduct($userId, $productId) {
        return true;
    }
}

class ProductsAvailabilityChecker {

    private function isProductInDatabase($productId) {
        return true;
    }

    public function isInStorage($productId) {
        if (!$this->isProductInDatabase($productId)) {
            throw new Exception("Product isn't defined in our database");
        }
        return true;
    }
}

class DeliveryManager {

    private function getDeliveryCostByTypeAndWeight($deliveryType, $weight) {
        $cost = 0;
        switch ($deliveryType) {
            case 1 :
                $cost = 10.22;
                if ($weight > 10) {
                    $cost += 10;
                }
                break;
            case 2 :
                $cost = 11.33;
                if ($weight > 10) {
                    $cost += 20;
                }
                break;
            case 3 :
                $cost = 0;
                break;
            default:
                throw new Exception("Unknown delivery type!");
        }
        return $cost;
    }

    private function getProductWeight($productId) {
        return 0.5;
    }

    public function countDeliveryCost($deliveryType, $productId) {
        $weight = $this->getProductWeight($productId);
        $cost = $this->getDeliveryCostByTypeAndWeight($deliveryType, $weight);
        return $cost;
    }
}

////////////////////// example /////////////
$shopOrder = new ShopOrder();
$shopOrder->order(1, 33, 2);