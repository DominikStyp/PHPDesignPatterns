<?php
/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 06:34
 */
abstract class MyHTMLAbstractTemplate {
    public function getHead(){
        return "<head><title>MyHTMLTemplate</title></head>";
    }
    public function getFooter(){
        return "<div id=\"footer\">This is my custom footer</div>";
    }
    final public function getBody(){
        $body = $this->getMenu();
        $body .= $this->getMainDiv();
        if($this->hasRightColumn()) {
            $body .= $this->getRightColumn();
        }
        return $body;
    }

    abstract public function getMainDiv();

    public function getRightColumn(){
        return "<div id=\"rightCol\">This is my right column</div>";
    }
    public function getMenu(){
        return <<<html
        <ul>
        <li><a href="http://google.com">Google</a></li>
        <li><a href="http://yahoo.com">Yahoo</a></li>
        </ul>
html;
    }
    public function __toString(){
        return $this->getHead().$this->getBody().$this->getFooter();
    }

    ////// boolean methods
    protected function hasRightColumn() {
        return false;
    }
    protected function hasMenu(){
        return false;
    }
}

class MyHTMLTemplate extends MyHTMLAbstractTemplate {

    /**
     * Override
     * @return string
     */
    public function getMainDiv() {
        return '<div id="main">Content of my page</div>';
    }

    /**
     * Override
     * @return bool
     */
    public function hasMenu(){
        return true;
    }
}

/////////// example /////////
$template = new MyHTMLTemplate();
echo $template;


