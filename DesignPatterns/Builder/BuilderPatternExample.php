<?php
/**
 * User: Dominik
 * Date: 2016-09-01
 * Time: 02:48
 * I've omitted getters and setters in this class, because whole setup logic is moved to the builder.
 */
class Address {
    public $street;
    public $postalCode;
    public $city;
    public $country;
    public $person;
}

/**
 * Class AbstractAddressBuilder
 * All fields and methods that Address object needs should be defined in abstract builder.
 * Concrete builders are just to distinct different types of inputs, and address formats
 */
abstract class AbstractAddressBuilder {
     protected abstract function getPerson();
     protected abstract function getStreet();
     protected abstract function getPostalCode();
     protected abstract function getCity();
     protected abstract function getCountry();

     /**
      * That's the main builder method, which constructs and sets up the object.
      * This pattern is similar to Factory
      * @return Address
      */
     public function build(){
         $address = new Address();
         $address->person = $this->getPerson();
         $address->street = $this->getStreet();
         $address->postalCode = $this->getPostalCode();
         $address->city = $this->getCity();
         $address->country = $this->getCountry();
         return $address;
     }
 }

 class AddressBuilderUS extends AbstractAddressBuilder {

     private $addressString;
     private $addressLines;

     /**
      * @param $addressString
      * Example:
      * <code>
      *   James Brown
      *   650 Oak Valley St.
      *   Hollis, NY 11423
      * </code>
      */
     public function __construct($addressString){
         $this->addressString = $addressString;
         $this->addressLines = explode("\n", $addressString);
     }

     protected function getPerson() {
         return trim($this->addressLines[0]);
     }

     protected function getStreet() {
         return trim($this->addressLines[1]);
     }

     protected function getPostalCode() {
         return preg_replace("#.*?(\d{5})#","$1", $this->addressLines[2]);
     }

     protected function getCity() {
         return preg_replace("#(.*?),.*#","$1", $this->addressLines[2]);
     }

     protected function getCountry() {
         return "US";
     }
 }

///////// example /////////
$addressString =<<<text
James Newton
650 Oak Valley St.
Hollis, NY 11423
text;

$address = (new AddressBuilderUS($addressString))->build();

$output = <<<html
<?xml version="1.0"?>
<address>
  <person>{$address->person}</person>
  <street>{$address->street}</street>
  <city>{$address->city}</city>
  <country>{$address->country}</country>
  <postalCode>{$address->postalCode}</postalCode>
</address>
html;

echo "<pre>", htmlspecialchars($output), "</pre>";


