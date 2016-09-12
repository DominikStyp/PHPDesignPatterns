<?php
/**
 * User: Dominik
 * Date: 2016-09-12
 * Time: 16:28
 */
namespace SPL\SplIterators;

use Iterator;
use RegexIterator;

class RegexIteratorCustom  extends \RegexIterator {
    const NOT_MATCH = 10;
    private $mode;
    public function __construct(Iterator $iterator, $regex, $mode = self::MATCH, $flags = 0, $preg_flags = 0) {
        $this->mode = $mode;
        if($mode === self::NOT_MATCH){
            $mode = parent::MATCH;
        }
        parent::__construct($iterator, $regex, $mode, $flags, $preg_flags);
    }
    public function accept() {
        return $this->mode === self::NOT_MATCH ? !parent::accept() : parent::accept();
    }
}

abstract class AbstractRegexIterator {
    protected $format;
    protected $flag;
    protected $input;
    protected $replacement = "";
    protected function __construct(Iterator $input, $format, $flag){
        $this->input = $input;
        $this->format = $format;
        $this->flag = $flag;
    }
    /**
     * @return \RegexIterator
     */
    public function getIterator(){
        $iterator = new RegexIteratorCustom($this->input, $this->format, $this->flag);
        if($this->flag === \RegexIterator::REPLACE){
            $iterator->replacement = $this->replacement;
        }
        return $iterator;
    }
    protected function setReplacement($replacement){
        $this->replacement = $replacement;
    }
}

/**
 * cleans strings removing all the contents besides post codes in format xx-xxx,
 * like: 11-000, 12-345 ....
 * @package SPL\SplIterators
 */
class PostCodeExtractor extends AbstractRegexIterator {
    /**
     * Important is that you have flexibility to choose the constructor's parameter.
     * This can be an array or other Iterator. Depends on you
     * @param array $input
     */
    public function __construct(array $input) {
        parent::__construct(new \ArrayIterator($input), "#.*?(\D|^)(\d{2}-\d{3})(\D|$).*#", RegexIteratorCustom::REPLACE);
        $this->setReplacement('$2');
    }
}

class VulgarismsFilter extends AbstractRegexIterator{
    const VULGARISMS = "fuck|shit|whore|ass|cunt|dick";
    public function __construct(array $input) {
        parent::__construct(new \ArrayIterator($input), "#".self::VULGARISMS."#", RegexIteratorCustom::NOT_MATCH);
    }
}

class BoldedWordsMatcher extends AbstractRegexIterator{
    public function __construct(array $input) {
        parent::__construct(new \ArrayIterator($input), '#<b>(.*?)(?=</b>)#i', RegexIteratorCustom::ALL_MATCHES);
    }
}

////// example 1 replace everything except the post code in the string ///////
$extractor = new PostCodeExtractor([
    'some string, 1992-03-03, postal code 12-333 other string',
    '11-222 other string',
    'phone is 333-222-333 and post code 44-666',
]);
// all other strings that don't match the post code will be removed
foreach($extractor->getIterator() as $code){
    echo "Post code: $code <br />";
}

////// example 2 exclude those that match vulgarisms list /////////
$filter = new VulgarismsFilter([
    'Very nice page.',
    'You fucking moron',
    'You are a whore, not to mention stupidity.',
    'Thank you for this post.'
]);
// posts will be automatically censored, only those with proper content are gonna be displayed
foreach($filter->getIterator() as $post){
    echo "<p>Post content: <b>$post</b></p>";
}

///// example 3 match all bolded words in the string //////////////
$matcher = new BoldedWordsMatcher( [
        'This is some <b>HTML</b> where we have important <b>words</b>',
        'And we would like to <b>iterate</b> over <b>all</b> of them',
        'This line won\'t be displayed, since it doesn\'t have bolded words',
] );
foreach($matcher->getIterator() as $found){
    $words = implode(', ', $found[1]); // [1] refers to the first matched atom (.*?)
    echo "<p>In this line I've found bolded words: <b>$words</b></p>";
}