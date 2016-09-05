<?php
namespace DesignPatterns\ChainOfResponsibility;
/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 09:21
 */
interface Chain {
    public function setNextChain(Chain $nextChain);
    public function getReportString(ReportType $report);
}

class ReportType {
    private $type;
    public function __construct($type){
        $this->type = $type;
    }
    public function getReportType(){
        return $this->type;
    }
}

class ReportGuests implements Chain {
    /**
     * @var Chain
     */
    private $nextChain;

    /**
     * @param Chain $nextChain
     * @return Chain
     */
    public function setNextChain(Chain $nextChain) {
         $this->nextChain = $nextChain;
        return $nextChain;
    }

    public function getReportString(ReportType $report) {
        if($report->getReportType() == "guests"){
            return "There are currently 100 guests on your site";
        }
        return $this->nextChain->getReportString($report);
    }
}

class ReportUsers implements Chain {
    /**
     * @var Chain
     */
    private $nextChain;

    /**
     * @param Chain $nextChain
     * @return Chain
     */
    public function setNextChain(Chain $nextChain) {
        $this->nextChain = $nextChain;
        return $nextChain;
    }

    public function getReportString(ReportType $report) {
        if($report->getReportType() == "users"){
            return "There are currently 200 logged in users on the site";
        }
        return $this->nextChain->getReportString($report);
    }
}


class ReportAdmins implements Chain {
    /**
     * @var Chain
     */
    private $nextChain;

    /**
     * @param Chain $nextChain
     * @return Chain
     */
    public function setNextChain(Chain $nextChain) {
        $this->nextChain = $nextChain;
        return $nextChain;
    }

    public function getReportString(ReportType $report) {
        if($report->getReportType() == "admins"){
            return "There are currently 2 logged admins on the site";
        }
        return $this->nextChain->getReportString($report);
    }
}

class ReportTest {
    /**
     * @return Chain
     */
    public static function getChainedReports(){
        // set up chain
        $report = new ReportGuests();
        $report->setNextChain(new ReportUsers())
               ->setNextChain(new ReportAdmins());
        return $report;
    }
}

//////// example /////////

// see how it works
echo "Report: " . ReportTest::getChainedReports()->getReportString(new ReportType("admins"));