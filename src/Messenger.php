<?php

namespace Codedungeon\PHPMessenger;

/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger
 */
class Messenger
{
    /**
     * @var array
     */

    private $foreground_colors = [];

    /**
     * @var array
     */
    private $background_colors = [];

    /**
     * Messenger constructor.
     */
    public function __construct()
    {

        // Set up shell colors
        $this->foreground_colors['black'] = '0;30';
        $this->foreground_colors['critical'] = '1;30';
        $this->foreground_colors['dark_gray'] = '1;90';
        $this->foreground_colors['blue'] = '0;34';
        $this->foreground_colors['light_blue'] = '1;34';
        $this->foreground_colors['green'] = '0;32';
        $this->foreground_colors['light_green'] = '1;32';
        $this->foreground_colors['cyan'] = '0;36';
        $this->foreground_colors['light_cyan'] = '1;36';
        $this->foreground_colors['red'] = '0;31';
        $this->foreground_colors['light_red'] = '1;31';
        $this->foreground_colors['purple'] = '0;35';
        $this->foreground_colors['light_purple'] = '1;35';
        $this->foreground_colors['brown'] = '0;33';
        $this->foreground_colors['yellow'] = '0;33';
        $this->foreground_colors['light_gray'] = '0;37';
        $this->foreground_colors['white'] = '1;37';
        $this->foreground_colors['magenta'] = '0;35';
        $this->foreground_colors['blood'] = '1;91';
        $this->foreground_colors['orange'] = '1;38';

//        const GRAY = "\033[0;90m";
        $this->background_colors['black'] = '40';
        $this->background_colors['dark_gray'] = '1;47';
        $this->background_colors['red'] = '41';
        $this->background_colors['light_red'] = '41';
        $this->background_colors['green'] = '42';
        $this->background_colors['yellow'] = '43';
        $this->background_colors['blue'] = '44';
        $this->background_colors['magenta'] = '45';
        $this->background_colors['cyan'] = '46';
        $this->background_colors['light_gray'] = '47';
        $this->background_colors['white'] = '37';
        $this->background_colors['blood'] = '101';
        $this->background_colors['orange'] = '1;48';
    }

    /**
     * @return string
     */
    public function packageName()
    {
        $content = file_get_contents($this->getPackageRoot().DIRECTORY_SEPARATOR.'composer.json');
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
     * @param  string  $configFileName
     * @return string
     */
    public function getConfigurationFile($configFileName = 'php-messenger.yml')
    {
        $defaultConfigFilename = $this->getPackageRoot().DIRECTORY_SEPARATOR.'src/'.$configFileName;

        $configPath = getcwd();
        $filename = '';

        $continue = true;
        while (!file_exists($filename) && $continue) {
            $filename = $configPath.DIRECTORY_SEPARATOR.$configFileName;
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
        $content = file_get_contents($this->getPackageRoot().DIRECTORY_SEPARATOR.'composer.json');
        if ($content) {
            $content = json_decode($content, true);

            return isset($content['version']) ? $content['version'] : '<unknown>';
        }
    }


    /**
     * @param  string  $key
     * @return bool
     */
    public function isTesting($key = "APP_ENV")
    {
        return getenv($key) === "testing";
    }


    // Returns all foreground color names

    /**
     * @return array
     */
    public function getForegroundColors()
    {
        return array_keys($this->foreground_colors);
    }

    // Returns all background color names

    /**
     * @return array
     */
    public function getBackgroundColors()
    {
        return array_keys($this->background_colors);
    }

    // Returns colored string

    /**
     * @param $string
     * @param  null  $foreground_color
     * @param  null  $background_color
     * @return string
     */
    public function getColoredString($string, $foreground_color = null, $background_color = null)
    {
        $colored_string = "";

        // Check if given foreground color found
        if (isset($this->foreground_colors[$foreground_color])) {
            $colored_string .= "\033[".$this->foreground_colors[$foreground_color]."m";
        }
        // Check if given background color found
        if (isset($this->background_colors[$background_color])) {
            $colored_string .= "\033[".$this->background_colors[$background_color]."m";
        }

        // Add string and end coloring
        $colored_string .= $string."\033[0m";

        return $colored_string;
    }

    /**
     * @param  string  $msgType
     * @param  string  $colorType
     * @return mixed
     */
    private function getColor($msgType = "")
    {
        switch ($msgType) {
            case "log":
                $color = "light_gray";
                break;
            case "info":
                $color = "cyan";
                break;
            case "debug":
                $color = "dark_gray"; // dark_gray not working for label background
                break;
            case "critical":
                $color = "blood";
                break;
            case "error":
                $color = "red";
                break;
            case "success":
                $color = "green";
                break;
            case "warning":
                $color = "yellow";
                break;
            case "warn":
                $color = "yellow";
                break;
            case "important":
                $color = "yellow";
                break;
            case "status":
                $color = "magenta";
                break;
            case "note":
                $color = "yellow";
                break;
            case "notice":
                $color = "blue";
                break;
        }

        return $color;
    }

    // -------------------------------------------------------------------------------------
    // Messenger commands
    // -------------------------------------------------------------------------------------

    /**
     * @param  string  $type
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function buildMessage($type = "log", $msg = "", $label = "")
    {
        $color = $this->getColor($type);
        $label_fg = ($type === "critical") ? "critical" : "black";

        if (strlen($label) > 0) {
            return $this->getColoredString(" ".$label." ", $label_fg, $color)." ".$this->getColoredString($msg,
                    $color);
        } else {
            return $this->getColoredString($msg, $color);
        }
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function log($msg = "", $label = "")
    {
        $msg = $this->buildMessage("log", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function info($msg = "", $label = "")
    {
        $msg = $this->buildMessage("info", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function debug($msg = "", $label = "")
    {
        $msg = $this->buildMessage("debug", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function critical($msg = "", $label = "")
    {
        $msg = $this->buildMessage("critical", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function error($msg = "", $label = "")
    {
        $msg = $this->buildMessage("error", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function success($msg = "", $label = "")
    {
        $msg = $this->buildMessage("success", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function warning($msg = "", $label = "")
    {
        $msg = $this->buildMessage("warning", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function warn($msg = "", $label = "")
    {
        $msg = $this->buildMessage("warn", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function important($msg = "", $label = "")
    {
        $msg = $this->buildMessage("important", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function status($msg = "", $label = "")
    {
        $msg = $this->buildMessage("status", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function notice($msg = "", $label = "")
    {
        $msg = $this->buildMessage("notice", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    /**
     * @param  string  $msg
     * @param  string  $label
     * @return string
     */
    public function note($msg = "", $label = "")
    {
        $msg = $this->buildMessage("warning", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg.PHP_EOL;
        }
        return $msg;
    }

    public static function test()
    {
        echo "test";
    }
}