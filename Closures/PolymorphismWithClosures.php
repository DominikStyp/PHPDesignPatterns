<?php
interface FilterString{
    public function returnFilter();
}

class FilterStringV1 implements FilterString {
    /**
     * Here we have filter1("some string");
     * @return callable
     */
    protected function filterV1(){
        return function($str){
            return htmlspecialchars($str);
        };
    }
    public function returnFilter(){
        return $this->filterV1();
    }
}
class FilterStringV2 extends FilterStringV1 implements FilterString {
    /**
     * Here we have filter2(filter1("some string"));
     * @return callable
     */
    protected function filterV2(){
        $func = parent::returnFilter();
        return function($str) use($func) {
            /**
             * Important thing is, that you can nest closures without caring what parent closure does.
             */
            return strtoupper($func($str));
        };
    }
    public function returnFilter(){
        return $this->filterV2();
    }
}

class FilterStringV3 extends FilterStringV2 implements FilterString {
    /**
     * Here we have filter3(filter1("some string"));
     * @return callable
     */
    protected function filterV3(){
        // here we want to use filter from version 1 + version 3
        $func = $this->filterV1();
        return function($str) use($func) {
            /**
             * Important thing is, that you can nest closures without caring what parent closure does.
             */
            return strtolower($func($str));
        };
    }
    public function returnFilter(){
        return $this->filterV3();
    }
}


/**
 * How polymorphism can be implemented with closures.
 * Here we have 3 string filters which we can combine in many different possibilities in every single child class
 *
 * @author Dominik
 */
class PolymorphismWithClosures {
    public static function getStringFilter(FilterString $filter){
        return $filter->returnFilter();
    }
}

///////// example 1 ////////
$filter = PolymorphismWithClosures::getStringFilter(new FilterStringV3());

echo $filter("<html><body>Some string</body></html>");