<?php

/**
 * FunctionCustomizer
 *
 * @author Dominik
 * @url https://github.com/DominikStyp
 * 
 * Example: 
 * <pre>
 *  <code>
 *  $pregMatch = (new FunctionCustomizer('preg_match', 3))
 *           ->setArgument(0, "#\d{2}#")
 *           ->setArgumentRef(2, $matches0)
 *           ->getClosure();
 *  if($pregMatch("sdf22x")){ }
 *  </code>
 * </pre>
 */
class FunctionCustomizer {
    
    private $mixedCallable;
    private $numArgs;
    private $arguments = array();
    
    /**
     * 
     * @param string|array $mixedCallable - name of function | static method | array($object,'method')
     *                                      ex. 'myFunction', 'MyClass::myMethod', array($myObject,'myMethod')
     * @param int $numArgs - number of arguments that you want to pass to the function,
     *                       (NOT THE NUMBER OF ARGUMENTS WHICH FUNCTION HAS AVAILABLE)
     *                       so this should be sum of: closure args + predefined args
     */
    public function __construct($mixedCallable, $numArgs){
        $this->mixedCallable = $mixedCallable;
        $this->numArgs = $numArgs;
        /**
        *   REMARK:
        *   Since call_user_func_array() doesn't care what argument index is (it gets them by FIFO queue),
        *   array of arguments passed to this function MUST BE pushed in the correct order.
        *   For example array(2 => $arr, 0 => "#\d{2}#", 1 => "str22xx") won't work for the preg_match call, because push order is wrong.
        *   That's the one reason why there's array_fill() first to fill up indexes in correct order.
        */
        $this->arguments = array_fill(0, $numArgs, null);
    }
    
    /**
     * Checks wheter index is correct number
     * @param int $argIndex
     * @throws Exception
     */
    private function checkIndex($argIndex){
        if($argIndex > ($this->numArgs - 1)){
            throw new Exception("argument index ($argIndex) is bigger than defined number of arguments in the constructor ({$this->numArgs})");
        }
        if(!is_numeric($argIndex)){
            throw new Exception("argIndex: $argIndex is not a number");
        }
        if($argIndex < 0){
            throw new Exception("argIndex can't be less than 0");
        }
    }
    
    /**
     * Set predefined argument for the function
     * @param int $argIndex - zero-indexed parameter position
     * @param mixed $argValue - parameter value
     * @return \FunctionCustomizer
     */
    public function setArgument($argIndex, $argValue){
        $this->checkIndex($argIndex);
        $this->arguments[$argIndex] = $argValue;
        return $this;
    }
    
    /**
     * Sets predefined argument passed by reference 
     * Can be used in preg_match where array of matches is passed by reference.
     * @param int $argIndex - zero-indexed parameter position
     * @param reference $argValue - parameter value
     * @return \FunctionCustomizer
     */
    public function setArgumentRef($argIndex, & $argValue){
        $this->checkIndex($argIndex);
        $this->arguments[$argIndex] = & $argValue;
        return $this;
    }
    
    /**
     * Array of predefined arguments for the function
     * @param array $args
     * @return \FunctionCustomizer
     */
    public function setArguments(array $args){
        $this->arguments = $args;
        return $this;
    }
    
    /**
     * Returns closure ready to use in function-like fashion
     * 
     * @return callable
     */
    public function getClosure(){
        $mixedCallable = $this->mixedCallable;
        $numArgs = $this->numArgs;
        $arguments = & $this->arguments;
        return function() use ($mixedCallable, $numArgs, $arguments){
            $closureArgs = func_get_args();
            for($i = 0, $j = 0; $i < $numArgs; $i++){
                if(!isset($arguments[$i])){
                   $arguments[$i] = & $closureArgs[$j++];
                }
            }
            return call_user_func_array($mixedCallable, $arguments);
        };
    }
    
    
    /**
     * Returns closure with only one argument.
     * Written only to be (a bit) faster, than one generated via getClosure()
     * but it has fixed number of arguments that you can pass,
     * and you have to give it a position
     * 
     * @param int $arg1Position - zero-indexed position of the first closure argument
     * @return callable
     */
    public function getClosureWithOneArg($arg1Position = 0){
        $mixedCallable = $this->mixedCallable;
        $arguments = & $this->arguments;
        return function($arg1) use ($mixedCallable, $arguments, $arg1Position){
              $arguments[$arg1Position] = & $arg1;
              return call_user_func_array($mixedCallable, $arguments);
        };
    }
    
    /**
     * Returns closure with two mandatory arguments.
     * Written only to be (a bit) faster, than one generated via getClosure()
     * @param int $arg1Position - zero-indexed position of the first closure argument
     * @param int $arg2Position - zero-indexed position of the second closure argument
     * @return callable
     */
    public function getClosureWithTwoArgs($arg1Position = 0, $arg2Position = 1){
        $mixedCallable = $this->mixedCallable;
        $arguments = & $this->arguments;
        return function($arg1, $arg2) use ($mixedCallable, $arguments, $arg1Position, $arg2Position){
              $arguments[$arg1Position] = & $arg1;
              $arguments[$arg2Position] = & $arg2;
              return call_user_func_array($mixedCallable, $arguments);
        };
    }
    
    
    /**
     * Returns closure with two mandatory arguments.
     * Written only to be (a bit) faster, than one generated via getClosure()
     * @param int $arg1Position - zero-indexed position of the first closure argument
     * @param int $arg2Position - zero-indexed position of the second closure argument
     * @param int $arg3Position - zero-indexed position of the third closure argument
     * @return callable
     */
    public function getClosureWithThreeArgs($arg1Position = 0, $arg2Position = 1, $arg3Position = 2){
        $mixedCallable = $this->mixedCallable;
        $arguments = & $this->arguments;
        return function($arg1, $arg2, $arg3) use ($mixedCallable, $arguments, $arg1Position, $arg2Position, $arg3Position){
              $arguments[$arg1Position] = & $arg1;
              $arguments[$arg2Position] = & $arg2;
              $arguments[$arg3Position] = & $arg3;
              return call_user_func_array($mixedCallable, $arguments);
        };
    }
    
    
}

