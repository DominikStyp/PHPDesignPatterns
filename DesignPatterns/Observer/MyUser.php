<?php
require_once 'SubjectTrait.php';

class MyUser implements SplSubject {
    /**
     * Here we don't want to care about storing/adding/removing observers code!
     * Code regarding observers should be the same in every class.
     * The best way to achieve that and be able to inherit from parent class at the same time
     * is to use traits for that purpose
     *
     */
    use SubjectTrait;

    private $email;

    public function setEmail($email) {
        $this->email = $email;
        $this->notify();
    }

    public function getEmail() {
        return $this->email;
    }
}

class EmailObserver implements SplObserver {
    public function update(SplSubject $subject) {
        $email = $subject->getEmail();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<b>Warning!!! Wrong e-mail: $email </b><br />";
        } else {
            echo "<b>Cool, your e-mail $email seems valid </b><br />";
        }
    }

}
$observer = new EmailObserver();

$user = new MyUser();
$user->attach($observer);
$user->setEmail("bla@bla@.com");  // Error
$user->setEmail("asd@some.domain.com");  // OK
$user->detach($observer);
$user->setEmail("bla@bla@.com"); // observer detached, no effect
