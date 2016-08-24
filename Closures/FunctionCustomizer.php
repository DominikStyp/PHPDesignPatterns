<?php

/**
 * BuiltinFunctionCustomizer
 *
 * @author Dominik
 * @url https://github.com/DominikStyp
 */
class FunctionCustomizer {
    
    private $functionName;
    private $numArgs;
    private $arguments = array();
    
    /**
     * 
     * @param string $functionName - name of built-in OR user-defined function 
     * @param int $numArgs - number of arguments that you want to pass to the function
     *                       this should be sum of: closure args + defined args
     */
    public function __construct($functionName, $numArgs){
        $this->functionName = $functionName;
        $this->numArgs = $numArgs;
    }
    
    /**
     * Set predefined argument for the function
     * @param int $agrIndex - zero index parameter position
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
     * @param int $agrIndex
     * @param reference $argValue
     * @return \FunctionCustomizer
     */
    public function setArgumentRef($agrIndex, & $argValue){
        $this->arguments[$agrIndex] = & $argValue;
        return $this;
    }
    
    /**
     * Array of predefined arguments for the function
     * @param array $args
     */
    public function setArguments(array $args){
        $this->arguments = $args;
    }
    
    
    public function getClosure(){
        $arguments = $this->arguments;
        $functionName = $this->functionName;
        $numArgs = $this->numArgs;
        return function() use ($functionName, $numArgs, $arguments){
            $closureArgs = func_get_args();
            $passedArgs = array();
            for($i = 0; $i < $numArgs; $i++){
                if(isset($arguments[$i])){
                   $passedArgs[] = & $arguments[$i];
                } else {
                    $passedArgs[] = & array_shift($closureArgs);
                }
            }
            return call_user_func_array($functionName, $passedArgs);
        };
    }
}

