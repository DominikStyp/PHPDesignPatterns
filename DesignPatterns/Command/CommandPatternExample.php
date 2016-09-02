<?php

/**
 * User: Dominik
 * Date: 2016-09-02
 * Time: 07:25
 */
interface CommandI {
    public function execute();
}

class CommandInvoker {
    public static function invoke(array $commands) {
        $output = array();
        foreach ($commands as $command) {
            /* @var $command CommandI */
            $output[] = $command->execute();
        }
        return $output;
    }
}

class ClearCacheCommand implements CommandI {
    /**
     * @var MyCache
     */
    private $cache;

    public function __construct(MyCache $cache) {
        $this->cache = $cache;
    }

    public function execute() {
        $dir = $this->cache->getCacheDirectory();
        if (is_dir($dir)) {
            foreach (new DirectoryIterator($dir) as $file) {
                if ($file->isFile()) {
                    unlink($file->getRealPath());
                }
            }
        }
        return "Removing cache files <br />";
    }
}

class DestroyUserSessionCommand implements CommandI {
    public function execute() {
        if (isset( $_SESSION['userData'] )) {
            unset( $_SESSION['userData'] );
        }
        return "Unsetting session <br />";
    }
}

class ClearUserCookiesCommand implements CommandI {
    public function execute() {
        setcookie("user", "", time() - 3600);
        return "Unsetting cookies <br />";
    }
}

class MyCache {
    private $cacheDirectory;

    public function __construct($cacheDirectory) {
        $this->cacheDirectory = $cacheDirectory;
    }

    public function getCacheDirectory() {
        return $this->cacheDirectory;
    }
}

class TestUser {
    public function logOut() {
        $logoutCommands = [
            new ClearCacheCommand(new MyCache("./cache")),
            new DestroyUserSessionCommand(),
            new ClearUserCookiesCommand()
        ];
        print_r(CommandInvoker::invoke($logoutCommands));
    }
}

////////// example ///////
$user = new TestUser();
$user->logOut();