<?php
/**
 * User: Dominik
 * Date: 2016-08-31
 * Time: 06:29
 */
interface MessageI {
    public function getMessage();
    public function setMessage($message);
}

class Message implements MessageI{
    /**
     * @var string
     */
    private $message;
    public function __construct($message){
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }
}

class MessageBolder implements MessageI {
    /**
     * @var MessageI
     */
    private $message;
    public function __construct(MessageI $message){
        $this->message = $message;
    }

    public function getMessage() {
        return "<b> {$this->message->getMessage()} </b>";
    }

    public function setMessage($message) {
        $this->message->setMessage($message);
    }
}

class MessageColorer implements MessageI {
    /**
     * @var MessageI
     */
    private $message;
    private $color;
    public function __construct(MessageI $message, $color){
        $this->message = $message;
        $this->color = $color;
    }

    public function getMessage() {
        return "<span style=\"color:{$this->color}\"> {$this->message->getMessage()} </span>";
    }

    public function setMessage($message) {
        $this->message->setMessage($message);
    }
}

/////////////// example ////////////
/**
 * @var MessageI
 */
$message = new MessageColorer(new MessageBolder(new Message("Hello world")), "red");
echo $message->getMessage(), "<br />";
// thanks to nested method invocations we can set primary message to the other, and echo new decorated message
$message->setMessage("Hello again, hope you like decorators");
echo $message->getMessage(), "<br />";