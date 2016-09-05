<?php
/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 13:31
 */
namespace DesignPatterns\Mediator;

// Mediator
interface MediatorI {
    function connect(DeviceI $device);
    function disconnect(DeviceI $device);
    function sendTo(DeviceI $fromDevice, DeviceI $targetDevice, $message);
}
// Colleague
interface DeviceI {
   function connect(MediatorI $mediator);
   function disconnect(MediatorI $mediator);
   function getFeedback($msg);
   function sendTo(MediatorI $mediator, DeviceI $device, $message);
   function getId();
}

class Router implements MediatorI {
    /**
     * @var DeviceI[]
     */
    private $devices;

    /**
     * Connects device to the router
     * @param DeviceI $device
     */
    function connect(DeviceI $device) {
        $id = $device->getId();
        $this->devices[$id] = $device;
        // send message to the specific device
        $device->getFeedback("Hello <b>$id</b>, currently connected devices: <b>{$this->getConnectedDevices()}</b>");
    }

    /**
     * Disconnects device from the router
     * @param DeviceI $device
     */
    function disconnect(DeviceI $device) {
        $id = $device->getId();
        unset ($this->devices[$id]);
        // send message to the specific device
        $device->getFeedback("Goodbye <b>$id</b>, currently connected devices: <b>{$this->getConnectedDevices()}</b>");
    }

    /**
     * Sends messages between devices
     * @param DeviceI $fromDevice
     * @param DeviceI $targetDevice
     * @param $message
     */
    function sendTo(DeviceI $fromDevice, DeviceI $targetDevice, $message){
        $fromId = $fromDevice->getId();
        $toId = $targetDevice->getId();
        if(isset($this->devices[$toId])){
            $this->devices[$toId]->getFeedback("Device <b>$toId</b>, you have a message from <b>$fromId</b>: <i>$message</i>");
        }
    }
    function getConnectedDevices(){
        $str = "";
        foreach($this->devices as $dev){
            $str .= $dev->getId() . ", ";
        }
        return $str;
    }

}

abstract class AbstractDevice implements DeviceI {
    function connect(MediatorI $mediator) {
        $mediator->connect($this);
    }
    function disconnect(MediatorI $mediator) {
        $mediator->disconnect($this);
    }

    /**
     * Gets messages from the mediator (Router)
     * @param $msg
     */
    function getFeedback($msg) {
        echo "<b>{$this->getId()}</b>, Router sends message: <p style=\"font-size:13px;\">&nbsp;&nbsp;&nbsp;&nbsp;$msg</p>";
    }
    function sendTo(MediatorI $mediator, DeviceI $device, $message){
        $mediator->sendTo($this,$device,$message);
    }
}

class Laptop extends AbstractDevice {
    function getId() {
        return "DrDooms_laptop";
    }
}
class CellPhone extends AbstractDevice {
    function getId() {
        return "Hulks_phone";
    }
}
class Fridge extends AbstractDevice {
    function getId() {
        return "TonyStarks_fridge";
    }
}

////////// example /////////
// here we define our mediator
$router = new Router();
// here we define our devices which will connect to the mediator
$laptop = new Laptop();
$phone  = new CellPhone();
$fridge = new Fridge();

$laptop->connect($router);
$phone->connect($router);
$fridge->connect($router);
$fridge->disconnect($router);
// here messege goes: phone -> router -> laptop
$phone->sendTo($router, $laptop, "Hello laptop!");