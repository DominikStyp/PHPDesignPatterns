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
    function sendTo(DeviceI $fromDevice, DeviceI $targetDevice, $message); //sends messages between connected devices
    function sendToId(DeviceI $fromDevice, $toDeviceId, $message); //same as above but gets device id as second parameter
    /**
     * @param $deviceId
     * @return DeviceI
     */
    function getDeviceById($deviceId);
}
// Colleague
interface DeviceI {
   function connect(MediatorI $mediator); //connects to the router (mediator)
   function disconnect(); //we don't need to pass Mediator here, cause device stores reference to it
   function isConnected();
   function getFeedback($msg); //gets feedback from the mediator (router)
   function sendTo($deviceId, $message); //sends message to other device which is connected to the router
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

    function isIdConnectedCheck($deviceId){
        if(!isset($this->devices[$deviceId])){
            throw new \Exception("Device $deviceId isn't connected");
        }
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
        $this->isIdConnectedCheck($fromId);
        $this->isIdConnectedCheck($toId);
        $this->devices[$toId]->getFeedback("Device <b>$toId</b>, you have a message from <b>$fromId</b>: <i>$message</i>");
    }

    function sendToId(DeviceI $fromDevice, $toDeviceId, $message){
        /**
         * @var DeviceI
         */
        $this->isIdConnectedCheck($fromDevice->getId());
        $this->isIdConnectedCheck($toDeviceId);
        $targetDevice = $this->getDeviceById($toDeviceId);
        $this->sendTo($fromDevice, $targetDevice, $message);
    }

    function getDeviceById($deviceId){
        return isset($this->devices[$deviceId]) ? $this->devices[$deviceId] : null;
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
    /**
     * @var MediatorI
     */
    protected $mediator;
    function connect(MediatorI $mediator) {
        $this->mediator = $mediator;
        $this->mediator->connect($this);
    }
    function disconnect() {
        $this->mediator->disconnect($this);
        $this->mediator = null;
    }
    function isConnected(){
        return !empty($this->mediator);
    }
    /**
     * Gets messages from the mediator (Router)
     * @param $msg
     */
    function getFeedback($msg) {
        echo "<b>{$this->getId()}</b>, Router sends message: <p style=\"font-size:13px;\">&nbsp;&nbsp;&nbsp;&nbsp;$msg</p>";
    }
    function sendTo($deviceId, $message){
        if(!$this->isConnected()){
            throw new \Exception("Device $deviceId is not connected!");
        }
        $this->mediator->sendToId($this,$deviceId,$message);
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
// here message goes: phone -> router -> laptop
$phone->sendTo("DrDooms_laptop", "Hello Dr Doom!!!");
$laptop->disconnect();
//Exception! DrDooms laptop was just destroyed, and disconnected
$phone->sendTo("DrDooms_laptop", "Dr Doom! Are you still there?");