<?php

use Codedungeon\PHPMessenger\Messenger;

/**
 *  Corresponding Class to test Printer class.
 *
 * @author mike erickson
 */
class MessengerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var
     */
    protected $messenger;

    public function setUp():void
    {
        $this->messenger = new Messenger();
    }

    /** @test */
    public function should_return_module_package_name(): void
    {
        $this->assertSame('PHP library for creating console messages', $this->messenger->packageName());
    }

    /** @test */
    public function should_return_full_pathname_to_config_file(): void
    {
        $this->assertStringContainsString('php-messenger.yml', $this->messenger->getConfigurationFile());

        $this->assertFileExists($this->messenger->getConfigurationFile());
    }

    /** @test  */
    public function should_return_package_version()
    {
        $version = $this->messenger->version();

        $this->assertRegExp("/^(\d+\.)?(\d+\.)?(\*|\d+)$/",$version);

    }

}
