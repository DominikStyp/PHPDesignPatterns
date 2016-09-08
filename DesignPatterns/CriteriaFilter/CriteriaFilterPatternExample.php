<?php
/**
 * User: Dominik
 * Date: 2016-09-08
 * Time: 11:57
 */
namespace DesignPatterns\CriteriaFilter;

interface Criteria {
    function meetCriteria(array $input);
}

abstract class AbstractConditionalCriteria implements Criteria {
    /**
     * @var Criteria[]
     */
    protected $criteria = array();
    function __construct(Criteria $one, Criteria $two){
        $this->criteria[] = $one;
        $this->criteria[] = $two;
    }
    function add(Criteria $criteria){
        $this->criteria[] = $criteria;
        return $this;
    }

}
////////////// GROUPING CRITERIA ////////////
////////////// GROUPING CRITERIA ////////////
////////////// GROUPING CRITERIA ////////////
/**
 * Every array value must meet every chained criteria to be returned in output.
 * @package DesignPatterns\CriteriaFilter
 */
class AndCriteria extends AbstractConditionalCriteria {
    function meetCriteria(array $input) {
        foreach($this->criteria as $criteria){
            /* @var $criteria Criteria */
            $input = $criteria->meetCriteria($input);
        }
        return $input;
    }

}

/**
 * Every array value must meet at least one criteria to be returned in output.
 * @package DesignPatterns\CriteriaFilter
 */
class OrCriteria extends AbstractConditionalCriteria {
    function meetCriteria(array $input) {
        $output = array();
        foreach($this->criteria as $criteria){
            /* @var $criteria Criteria */
            $tmpArr = $criteria->meetCriteria($input);
            // here we gather all elements that are present in any of the filtered arrays
            foreach($tmpArr as $tmpV){
                if(!in_array($tmpV, $output)){
                    $output[] = $tmpV;
                }
            }
        }
        return $output;
    }
}
////////////// FILTERS ////////////////
////////////// FILTERS ////////////////
////////////// FILTERS ////////////////
class FilterBigLetters implements Criteria {
    function meetCriteria(array $input) {
        $output = array();
        foreach($input as $el){
            if(preg_match("#^[A-Z]+$#", $el)){
                $output[] = $el;
            }
        }
        return $output;
    }
}

class FilterNumbers implements Criteria {
    function meetCriteria(array $input) {
        $output = array();
        foreach($input as $el){
          if(is_numeric($el)){
              $output[] = $el;
          }
        }
        return $output;
    }
}
class FilterOdd implements Criteria {
    function meetCriteria(array $input) {
        $output = array();
        foreach($input as $el){
            if($el % 2 === 1){
                $output[] = $el;
            }
        }
        return $output;
    }
}
class FilterPositive implements Criteria {
    function meetCriteria(array $input) {
        $output = array();
        foreach($input as $el){
            if($el > 0){
                $output[] = $el;
            }
        }
        return $output;
    }
}
function implodeArr(array $arr){
    echo implode(",", $arr);
}

/////// example 1 ////////
$criteriaAnd = (new AndCriteria(new FilterNumbers(), new FilterPositive()))->add(new FilterOdd());
$input = [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8];
echo "<p>Input:</p>";
implodeArr($input);
echo "<p>Numbers that are Positive and Odd:</p>";
implodeArr($criteriaAnd->meetCriteria($input));

////// example 2 ///////////
$criteriaOr = new OrCriteria(new FilterNumbers(), new FilterBigLetters());
$input = ["c", "d", "A", "B", "()", "##", 3, 4, 5, 6, 7];
echo "<p>Input:</p>";
implodeArr($input);
echo "<p>Filtered Numbers OR BigLetters:</p>";
implodeArr($criteriaOr->meetCriteria($input));









