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
    
    private $functionName;
    private $numArgs;
    private $arguments = array();
    
    /**
     * 
     * @param string $functionName - name of built-in OR user-defined function 
     * @param int $numArgs - number of arguments that you want to pass to the function,
     *                       (NOT THE NUMBER OF ARGUMENTS WHICH FUNCTION HAS AVAILABLE)
     *                       so this should be sum of: closure args + predefined args
     */
    public function __construct($functionName, $numArgs){
        $this->functionName = $functionName;
        $this->numArgs = $numArgs;
    }
    
    /**
     * Set predefined argument for the function
     * @param int $agrIndex - zero-indexed parameter position
     * @param mixed $argValue - parameter value
     * @return \FunctionCustomizer
     */
    public function setArgument($agrIndex, $argValue){
        $this->arguments[$agrIndex] = $argValue;
        return $this;
    }
    
    /**
     * Sets predefined argument passed by reference 
     * Can be used in preg_match where array of matches is passed by reference.
     * @param int $agrIndex - zero-indexed parameter position
     * @param reference $argValue - parameter value
     * @return \FunctionCustomizer
     */
    public function setArgumentRef($agrIndex, & $argValue){
        $this->arguments[$agrIndex] = & $argValue;
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
        $functionName = $this->functionName;
        $numArgs = $this->numArgs;
        $arguments = array_fill(0, $numArgs, null);
        /**
        *   REMARK:
        *   Since call_user_func_array() doesn't care what argument index is (it takes them by FIFO queue),
        *   array of arguments passed to this function MUST BE pushed in the correct order.
        *   For example array(2 => $arr, 0 => "#\d{2}#", 1 => "str22xx") won't work for the preg_match call, because push order is wrong.
        *   That's the one reason why there's array_fill() first to fill up indexes in correct order.
        */
        foreach($this->arguments as $key => & $val){
                $arguments[$key] = & $val;
        }
        return function() use ($functionName, $numArgs, $arguments){
            $closureArgs = func_get_args();
            for($i = 0, $j = 0; $i < $numArgs; $i++){
                if(!isset($arguments[$i])){
                   $arguments[$i] = & $closureArgs[$j++];
                }
            }
            return call_user_func_array($functionName, $arguments);
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
        $functionName = $this->functionName;
        $arguments = array_fill(0, $this->numArgs, null);
        foreach($this->arguments as $key => & $val){
                $arguments[$key] = & $val;
        }
        return function($arg1) use ($functionName, $arguments, $arg1Position){
              $arguments[$arg1Position] = & $arg1;
              return call_user_func_array($functionName, $arguments);
        };
    }
    
    /**
     * Returns closure with two mandatory arguments.
     * @param int $arg1Position - zero-indexed position of the first closure argument
     * @param int $arg2Position - zero-indexed position of the second closure argument
     * @return callable
     */
    public function getClosureWithTwoArgs($arg1Position = 0, $arg2Position = 1){
        $functionName = $this->functionName;
        $arguments = array_fill(0, $this->numArgs, null);
        foreach($this->arguments as $key => & $val){
                $arguments[$key] = & $val;
        }
        return function($arg1, $arg2) use ($functionName, $arguments, $arg1Position, $arg2Position){
              $arguments[$arg1Position] = & $arg1;
              $arguments[$arg2Position] = & $arg2;
              return call_user_func_array($functionName, $arguments);
        };
    }
}

