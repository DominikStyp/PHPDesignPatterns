<?php
namespace DesignPatterns\ChainOfResponsibility;
/**
 * User: Dominik
 * Date: 2016-09-05
 * Time: 09:21
 */
interface Chain {
    public function setNextChain(Chain $nextChain);
    public function getReportString($report);
}

abstract class ChainAbstract implements Chain {
    /**
     * @var Chain
     */
    protected $nextChain;
    /**
     * @param Chain $nextChain
     * @return Chain
     */
    public function setNextChain(Chain $nextChain) {
        $this->nextChain = $nextChain;
        return $nextChain;
    }
}

class ReportGuests extends ChainAbstract {
    public function getReportString($report) {
        if($report === "guests"){
            return "There are currently 100 guests on your site";
        }
        return $this->nextChain->getReportString($report);
    }
}

class ReportUsers extends ChainAbstract {
    public function getReportString($report) {
        if($report === "users"){
            return "There are currently 200 logged in users on the site";
        }
        return $this->nextChain->getReportString($report);
    }
}


class ReportAdmins extends ChainAbstract {
    public function getReportString($report) {
        if($report === "admins"){
            return "There are currently 2 logged admins on the site";
        }
        return $this->nextChain->getReportString($report);
    }
}

class ReportForMoron extends ChainAbstract {
    public function getReportString($report) {
        return "Sorry but all previous reports failed. So you end up in Report for Moron. Congrats!";
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
               ->setNextChain(new ReportAdmins())
               ->setNextChain(new ReportForMoron());
        return $report;
    }
}


///////// see how it works ////////////
echo "Report: " . ReportTest::getChainedReports()->getReportString("admins");