<?php
/**
 * User: Dominik
 * Date: 2016-09-01
 * Time: 08:23
 */

abstract class BlogPostComponent {
    public function add(BlogPostComponent $component){
        throw new Exception("Unsupported operation");
    }
    public function remove(BlogPostComponent $component){
        throw new Exception("Unsupported operation");
    }
    public function getPostContent(){
        throw new Exception("Unsupported operation");
    }
    public function getPostTitle(){
        throw new Exception("Unsupported operation");
    }
    public function getComponents(){
        throw new Exception("Unsupported operation");
    }
}

// Composite
class BlogPostGroup extends BlogPostComponent {
    private $groupName;
    /**
     * @var BlogPostComponent
     */
    private $components;

    public function __construct($groupName){
        $this->groupName = $groupName;
    }

    public function add(BlogPostComponent $component) {
        $this->components[spl_object_hash($component)] = $component;
    }

    public function remove(BlogPostComponent $component) {
        unset($this->components[spl_object_hash($component)]);
    }
    public function getComponents(){
        return $this->components;
    }
    public function getGroupName(){
        return $this->groupName;
    }
    public function __toString(){
        $str = "<p>------- Group name: " . $this->getGroupName(). " --------- <br />";
        $str .= "<ul>";
        foreach($this->getComponents() as $comp){
            $str .= $comp;
        }
        return $str . "</ul><br />-------------------------------------------------</p>";
    }
}

class BlogPost extends BlogPostComponent {
    private $title;
    private $content;

    public function __construct($title, $content){
        $this->title = $title;
        $this->content = $content;
    }

    public function getPostContent() {
        return $this->content;
    }

    public function getPostTitle() {
        return $this->title;
    }
    public function __toString(){
        return "<li>Post: <b>" .$this->getPostTitle()
        . "</b> <i>[" . $this->getPostContent() . "]</i></li>";
    }
}



/////// example ////////
$phpPosts = new BlogPostGroup("PHP Posts");
$php7Posts = new BlogPostGroup("PHP 7 Posts");
$javaPosts = new BlogPostGroup("Java Posts");
////////
$php7Posts->add($firstPhp7Post = new BlogPost("1. PHP 7 Post", "1. PHP 7 is awesome"));
$php7Posts->add(new BlogPost("2. PHP 7 Post", "2. PHP 7 has new great features"));
$phpPosts->add(new BlogPost("First PHP Post", "Setting up environment"));
$phpPosts->add($php7Posts);
$phpPosts->add(new BlogPost("Second PHP Post", "Learning OO PHP"));
// __toString() does all the job for you
echo $phpPosts;
// if we don't need to display "1. PHP 7 Post" anymore just do
$php7Posts->remove($firstPhp7Post);
echo "<br />//////////////////////////////<br />", $phpPosts;