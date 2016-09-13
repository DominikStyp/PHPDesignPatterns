<?php
/**
 * User: Dominik
 * Date: 2016-09-13
 * Time: 05:43
 */
class RegexTester {
    private $testStr;
    public function __construct($testStr){
        $this->testStr = $testStr;
    }
    public function pregMatch($regex){
        $r = htmlspecialchars($regex);
        if(preg_match($regex, $this->testStr, $matches)){
            echo "<b>$r</b> &nbsp;&nbsp;&nbsp; MATCHED against '$this->testStr'<br />";
            var_dump($matches);
            echo "<br />";
        } else {
            echo "<b>$r</b> &nbsp;&nbsp;&nbsp; NOT MATCHED against '$this->testStr'<br />";
        }
    }
}

/**
 * MOST IMPORTANT REASON why to use look-arounds instead of atomic groups,
 * is that THEY DO NOT GET COLLECTED by the array of matches.
 * Look-around group : never gets collected
 * Atomic group      : gets collected by $0 element of the match
 * Non-atomic group  : gets collected to the $0 and $n-number of parentheses
 */
$obj = new RegexTester('STR1 STR2 STR3 STR4 STR5 STRX STRY');
// NON-ATOMIC GROUP: I assume that immediately after STR2 there will be STR3
$obj->pregMatch("#STR2 (STR3)#");
// ATOMIC GROUP: I assume that immediately after STR2 there will be STR3
$obj->pregMatch("#STR2 (?>STR3)#");
// POSITIVE LOOK AHEAD: I assume that immediately after STR2 there will be STR3
$obj->pregMatch("#STR2 (?=STR3)#");
// NEGATIVE LOOK AHEAD: I assume that immediately after STR2 there won't be STR5
$obj->pregMatch("#STR2 (?!STR5)#");
// POSITIVE LOOK BEHIND: I assume that immediately before STR5 there is STR4
$obj->pregMatch("#(?<=STR4) STR5#");
// NEGATIVE LOOK BEHIND: I assume that immediately before STR5 there isn't STR1
$obj->pregMatch("#(?<!STR1) STR5#");

echo "<p>--------------- Differences between regular, atomic, non-atomic ----------------- </p>";
//////// WARNING! difference between atomic and non-atomic when using | (or) /////////
// will match its 1st alternative "ST", then fail as "1" does not immediately follow, and stop as backtracking is disallowed.
$obj->pregMatch("#(?>ST|STR)1#");
// will match the string as 2nd alternative
$obj->pregMatch("#(ST|STR)1#");

//////// another difference is to use greedy expressions with look-arounds,
//////// which works the same way as non-greedy, but with negation
// here we look-back from the word boundary and check whether there is X or Y before it
$obj->pregMatch("#\b\w+(?<![X,Y])\b#");
//here we must negate all the characters that can't occur before word boundary
$obj->pregMatch("#\b\w*[^X,Y,\s]\b#");