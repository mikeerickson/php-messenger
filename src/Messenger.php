<?php

namespace Codedungeon\PHPMessenger;


use Codedungeon\PHPCliColors\Color;

/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger
 */
class Messenger
{

    protected $colors;

    /**
     * Messenger constructor.
     */
    public function __construct()
    {
        $this->colors = new Color();
    }

    /**
     * @return string
     */
    public function packageName()
    {
        $content = file_get_contents($this->getPackageRoot() . DIRECTORY_SEPARATOR . 'composer.json');
        if ($content) {
            $content = json_decode($content, true);

            return isset($content['description']) ? $content['description'] : '<unknown>';
        }

        return '<unknown>';
    }

    /**
     * @return string | returns package root
     */
    private function getPackageRoot()
    {
        return \dirname(__FILE__, 2);
    }

    /**
     * @param string $configFileName
     * @return string
     */
    public function getConfigurationFile($configFileName = 'php-messenger.yml')
    {
        $defaultConfigFilename = $this->getPackageRoot() . DIRECTORY_SEPARATOR . 'src/' . $configFileName;

        $configPath = getcwd();
        $filename = '';

        $continue = true;
        while (!file_exists($filename) && $continue) {
            $filename = $configPath . DIRECTORY_SEPARATOR . $configFileName;
            if (($this->isWindows() && \strlen($configPath) === 3) || $configPath === '/') {
                $filename = $defaultConfigFilename;
                $continue = false;
            }
            $configPath = \dirname($configPath);
        }

        return $filename;
    }

    /**
     * @return bool
     */
    private function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    /**
     * @return string
     */
    public function version()
    {
        $content = file_get_contents($this->getPackageRoot() . DIRECTORY_SEPARATOR . 'composer.json');
        if ($content) {
            $content = json_decode($content, true);

            return isset($content['version']) ? $content['version'] : '<unknown>';
        }
    }


    public function isTesting($key = "APP_ENV")
    {
        return $_ENV[$key] === "testing";
    }

    private function get_color($msgType = "", $colorType = "fg")
    {
        switch ($msgType) {
            case "success":
                $color = $colorType === "bg" ? $this->colors::BG_GREEN : $this->colors::GREEN;
                break;
        }

        return $color;
    }

    // -------------------------------------------------------------------------------------
    // Messenger commands
    // -------------------------------------------------------------------------------------

    public function build_message($type = "log", $msg = "", $label = "")
    {
        if (strlen($label) > 0) {
            return $this->get_color($type,
                    "bg") . " " . $label . " " . $this->get_color($type, "fg") . " " . $msg . $this->colors::RESET;
        } else {
            return $this->get_color($type, "fg") . $msg . $this->colors::RESET;
        }
    }

    public function log($msg = "", $label = "")
    {
        $msg = $this->build_message("log", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function info($msg = "", $label = "")
    {
        $msg = $this->build_message("info", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function debug($msg = "", $label = "")
    {
        $msg = $this->build_message("debug", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function critical($msg = "", $label = "")
    {
        $msg = $this->build_message("critical", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function error($msg = "", $label = "")
    {
        $msg = $this->build_message("error", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function success($msg = "", $label = "")
    {
        $msg = $this->build_message("success", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function warning($msg = "", $label = "")
    {
        $msg = $this->build_message("warning", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function warn($msg = "", $label = "")
    {
        $msg = $this->build_message("warn", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    public function important($msg = "", $label = "")
    {
        $msg = $this->build_message("important", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

}