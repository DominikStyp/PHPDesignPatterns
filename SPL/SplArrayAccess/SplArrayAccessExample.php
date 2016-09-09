<?php
/**
 * User: Dominik
 * Date: 2016-09-09
 * Time: 19:39
 */
namespace SPL\SplArrayAccess;

class EntityLikeArray implements \ArrayAccess {

    protected function getterName($arrProp){
        return "get".ucfirst($arrProp);
    }
    protected function setterName($arrProp){
        return "set".ucfirst($arrProp);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset) {
        return method_exists($this,$this->getterName($offset));
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset) {
        $method = $this->getterName($offset);
        return $this->{$method}();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value) {
        $method = $this->setterName($offset);
        $this->{$method}($value);
        return;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset) {
        $method = $this->setterName($offset);
        $this->{$method}(null);
        return;
    }
}

class User extends EntityLikeArray {
    private $name;
    private $surname;
    private $email;
    private $likesMost;

    /**
     * @return mixed
     */
    public function getLikesMost() {
        return $this->likesMost;
    }

    /**
     * @param mixed $likesMost
     */
    public function setLikesMost($likesMost) {
        if(stripos($likesMost,"smash") === false){
            echo "You have to be kidding me!!! Hulk just likes to SMASH! <br />";
            return;
        } else {
            echo "Now we're talkin'...<br />";
            $this->likesMost = $likesMost;
        }
    }


    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname) {
        $this->surname = $surname;
    }
}

//////// example /////////////

$user = new User();
$user->setEmail("hulk@smash.now");
$user->setName("Hulk");
/// thanks to the interface we can easily use object as an array, without need to use getters
echo "User name is <b>{$user['name']}</b>, and e-mail <b>{$user['email']}</b> <br />";
$user['likesMost'] = "sleep"; //ooops! seems that we've set a wrong value
$user['likesMost'] = "SMASH!"; //now we're cool