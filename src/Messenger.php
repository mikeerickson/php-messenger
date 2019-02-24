<?php

namespace Codedungeon\PHPMessenger;


/**
 * Class Messenger
 * @package Codedungeon\PHPMessenger
 */
class Messenger
{

    /**
     * Messenger constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function packageName() {
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
        $defaultConfigFilename = $this->getPackageRoot() . DIRECTORY_SEPARATOR . 'src/' .$configFileName;

        $configPath = getcwd();
        $filename   = '';

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


}