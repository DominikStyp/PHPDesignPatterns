<?php
/**
 * User: Dominik
 * Date: 2016-09-02
 * Time: 05:16
 */

/**
 *
 * Most important thing in Bridge Pattern is to have at least 2 related interfaces,
 * which are to decouple Logger and Sender implementations.
 *
 */
interface MessageSenderI {
    public function send($title, $message);
}
interface LoggerI {
    public function log($message, MessageSenderI $senderI);
}

class MessageSenderEmail implements MessageSenderI {
    public function send($title, $message) {
        echo "&gt;&gt;&gt; <u>Sending E-mail: $title, $message </u><br />";
    }
}
class MessageSenderSMS implements MessageSenderI {
    public function send($title, $message) {
        echo "&gt;&gt;&gt; <i>Sending SMS: $title, $message </i><br />";
    }
}

class ErrorLoggerTxt implements LoggerI {
    public function log($message, MessageSenderI $sender){
        $date = date("Y-m-d H:i:s");
        $message = "Message $message (logged $date)\n";
        $sender->send("Error", $message);
    }
}
class ErrorLoggerHTML implements LoggerI {
    public function log($message, MessageSenderI $sender){
        $date = date("Y-m-d H:i:s");
        $message = "<p><b>$message</b> [$date]</p>";
        $sender->send("Error", $message);
    }
}

////////// example ////////
// message is urgent so we need to send it via SMS
(new ErrorLoggerTxt())->log("Admin account has been deleted!!!", new MessageSenderSMS());
// message is not urgent
(new ErrorLoggerTxt())->log("User account has been deleted.", new MessageSenderEmail());
//// ... but we need to change the logger to HTML .... no problem
// urgent
(new ErrorLoggerHTML())->log("Server just shut down!!!", new MessageSenderSMS());
// not urgent
(new ErrorLoggerHTML())->log("Restarting server.", new MessageSenderEmail());