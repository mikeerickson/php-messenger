<?php

use Codedungeon\PHPCliColors\Color;
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

    protected $colors;


    public function setUp(): void
    {
        $this->messenger = new Messenger();

        $this->colors = new Color();
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

    /** @test */
    public function should_return_package_version()
    {
        $version = $this->messenger->version();

        $this->assertRegExp("/^(\d+\.)?(\d+\.)?(\*|\d+)$/", $version);

    }

    /** @test */
    public function should_display_log_message()
    {
        $msg = $this->messenger->log("log", "");

        $this->assertEquals($this->colors->white() . "log" . $this->colors->reset(), $msg);
    }

    /** @test */
    public function should_display_log_message_and_label()
    {
        $msg = $this->messenger->log("log", "label");

        $this->assertEquals("label log", $msg);
    }


    /** @test */
    public function should_display_info_message()
    {
        $msg = $this->messenger->info("info", "");

        $this->assertEquals("info", $msg);
    }

    /** @test */
    public function should_display_info_message_and_label()
    {
        $msg = $this->messenger->info("info", "label");

        $this->assertEquals("label info", $msg);
    }

    /** @test */
    public function should_display_debug_message()
    {
        $msg = $this->messenger->debug("debug", "");

        $this->assertEquals("debug", $msg);
    }

    /** @test */
    public function should_display_debug_message_and_label()
    {
        $msg = $this->messenger->debug("debug", "label");

        $this->assertEquals("label debug", $msg);
    }

    /** @test */
    public function should_display_critical_message()
    {
        $msg = $this->messenger->critical("critical", "");

        $this->assertEquals("critical", $msg);
    }

    /** @test */
    public function should_display_critical_message_and_label()
    {
        $msg = $this->messenger->critical("critical", "label");

        $this->assertEquals("label critical", $msg);
    }

    /** @test */
    public function should_display_error_message()
    {
        $msg = $this->messenger->error("error", "");

        $this->assertEquals("error", $msg);
    }

    /** @test */
    public function should_display_error_message_and_label()
    {
        $msg = $this->messenger->error("error", "label");

        $this->assertEquals("label error", $msg);
    }

    /**
     * @test
     * @group color
     */
    public function should_display_success_message()
    {
        $msg = $this->messenger->success("success", "");

        $expect = $this->colors::GREEN . "success" . $this->colors::RESET;
        $this->assertEquals($expect, $msg);
    }

    /** @test
     * @group color
     */
    public function should_display_success_message_and_label()
    {
        $msg = $this->messenger->success("success", "label");


        $expect = $this->colors::BG_GREEN . " label " . $this->colors->green() . " success" . $this->colors::RESET;
        $this->assertEquals($expect, $msg);
    }

    /** @test */
    public function should_display_warning_message()
    {
        $msg = $this->messenger->warning("warning", "");

        $this->assertEquals("warning", $msg);
    }

    /** @test */
    public function should_display_warning_message_and_label()
    {
        $msg = $this->messenger->warning("warning", "label");

        $this->assertEquals("label warning", $msg);
    }

    /** @test */
    public function should_display_warn_message()
    {
        $msg = $this->messenger->warn("warn", "");

        $this->assertEquals("warn", $msg);
    }

    /** @test */
    public function should_display_warn_message_and_label()
    {
        $msg = $this->messenger->warn("warn", "label");

        $this->assertEquals("label warn", $msg);
    }

    /** @test */
    public function should_display_important_message()
    {
        $msg = $this->messenger->important("important", "");

        $this->assertEquals("important", $msg);
    }

    /** @test */
    public function should_display_important_message_and_label()
    {
        $msg = $this->messenger->important("important", "label");

        $this->assertEquals("label important", $msg);
    }
}
