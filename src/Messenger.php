<?php

namespace Codedungeon\PHPMessenger;


use Codedungeon\PHPCliColors\Color;

/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger
 */
class Messenger
{
    /**
     * @var Color
     */
    protected $colors;

    private $foreground_colors = [];
    private $background_colors = [];

    /**
     * Messenger constructor.
     */
    public function __construct()
    {
        $this->colors = new Color();

        // Set up shell colors
        $this->foreground_colors['black'] = '0;30';
        $this->foreground_colors['dark_gray'] = '1;30';
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
        $this->foreground_colors['yellow'] = '1;33';
        $this->foreground_colors['light_gray'] = '0;37';
        $this->foreground_colors['white'] = '1;37';

        $this->background_colors['black'] = '40';
        $this->background_colors['red'] = '41';
        $this->background_colors['green'] = '42';
        $this->background_colors['yellow'] = '43';
        $this->background_colors['blue'] = '44';
        $this->background_colors['magenta'] = '45';
        $this->background_colors['cyan'] = '46';
        $this->background_colors['light_gray'] = '47';

        echo $this->getColoredString(" TEST ", "black", "green") . " " . $this->getColoredString("Test Message",
                "green") . "\n";
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


    /**
     * @param string $key
     * @return bool
     */
    public function isTesting($key = "APP_ENV")
    {
        return false;
        return $_ENV[$key] === "testing";
    }


    // Returns all foreground color names
    public function getForegroundColors()
    {
        return array_keys($this->foreground_colors);
    }

    // Returns all background color names
    public function getBackgroundColors()
    {
        return array_keys($this->background_colors);
    }

    // Returns colored string
    public function getColoredString($string, $foreground_color = null, $background_color = null)
    {
        $colored_string = "";

        // Check if given foreground color found
        if (isset($this->foreground_colors[$foreground_color])) {
            $colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
        }
        // Check if given background color found
        if (isset($this->background_colors[$background_color])) {
            $colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
        }

        // Add string and end coloring
        $colored_string .= $string . "\033[0m";

        return $colored_string;
    }

    /**
     * @param string $msgType
     * @param string $colorType
     * @return mixed
     */
    private function get_color($msgType = "", $colorType = "fg")
    {
        switch ($msgType) {
            case "log":
                $color = $colorType === "bg" ? $this->colors::BG_WHITE : $this->colors::WHITE;
                break;
            case "info":
                $color = $colorType === "bg" ? $this->colors::BG_CYAN : $this->colors::CYAN;
                break;
            case "debug":
                $color = $colorType === "bg" ? $this->colors::BG_LIGHT_GRAY : $this->colors::LIGHT_GRAY;
                break;
            case "critical":
                $color = $colorType === "bg" ? $this->colors::BG_RED : $this->colors::RED;
                break;
            case "error":
                $color = $colorType === "bg" ? $this->colors::BG_RED : $this->colors::RED;
                break;
            case "success":
                $color = $colorType === "bg" ? "green" : "green";
                break;
            case "warning":
                $color = $colorType === "bg" ? $this->colors::BG_YELLOW : $this->colors::YELLOW;
                break;
            case "warn":
                $color = $colorType === "bg" ? $this->colors::BG_YELLOW : $this->colors::YELLOW;
                break;
            case "important":
                $color = $colorType === "bg" ? $this->colors::BG_MAGENTA : $this->colors::MAGENTA;
                break;
            case "status":
                $color = $colorType === "bg" ? $this->colors::BG_MAGENTA : $this->colors::MAGENTA;
                break;
            case "notice":
                $color = $colorType === "bg" ? $this->colors::BG_BLUE : $this->colors::BLUE;
                break;
        }

        return $color;
    }

    // -------------------------------------------------------------------------------------
    // Messenger commands
    // -------------------------------------------------------------------------------------

    /**
     * @param string $type
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function build_message($type = "log", $msg = "", $label = "")
    {

        $label_fg = $this->colors::BLACK;
        if ($type === "success") {
            $label_fg = $this->colors::WHITE;
        }
        if (strlen($label) > 0) {
            return $this->getColoredString(" " . $label . " ", "black", "green") . " " . $this->getColoredString($msg,
                    "green") . "\n";
        } else {
            return $this->getColoredString($msg, "green");
        }
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function log($msg = "", $label = "")
    {
        $msg = $this->build_message("log", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function info($msg = "", $label = "")
    {
        $msg = $this->build_message("info", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function debug($msg = "", $label = "")
    {
        $msg = $this->build_message("debug", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function critical($msg = "", $label = "")
    {
        $msg = $this->build_message("critical", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function error($msg = "", $label = "")
    {
        $msg = $this->build_message("error", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function success($msg = "", $label = "")
    {
        $msg = $this->build_message("success", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function warning($msg = "", $label = "")
    {
        $msg = $this->build_message("warning", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function warn($msg = "", $label = "")
    {
        $msg = $this->build_message("warn", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function important($msg = "", $label = "")
    {
        $msg = $this->build_message("important", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function status($msg = "", $label = "")
    {
        $msg = $this->build_message("status", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }

    /**
     * @param string $msg
     * @param string $label
     * @return string
     */
    public function notice($msg = "", $label = "")
    {
        $msg = $this->build_message("notice", $msg, $label);
        if (!$this->isTesting()) {
            echo $msg;
        }
        return $msg;
    }


}