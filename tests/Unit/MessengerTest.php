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

    public function setUp(): void
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

    /** @test */
    public function should_return_package_version()
    {
        $version = $this->messenger->version();

        $this->assertRegExp("/^(\d+\.)?(\d+\.)?(\*|\d+)$/", $version);

    }


    // -------------------------------------------------------
    // Class message tests
    // -------------------------------------------------------


    /** @test
     */
    public function should_display_log_message()
    {
        $msg = $this->messenger->log("Log message", "");

        $expect = $this->messenger->buildMessage("log", "Log message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_log_message_and_label()
    {
        $msg = $this->messenger->log("Log Message", "LOG");

        $this->assertStringContainsString(" LOG ", $msg);
        $this->assertStringContainsString("Log Message", $msg);
    }


    /** @test
     */
    public function should_display_info_message()
    {
        $msg = $this->messenger->info("Info message", "");

        $expect = $this->messenger->buildMessage("info", "Info message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_info_message_and_label()
    {
        $msg = $this->messenger->info("Info Message", "INFO");

        $this->assertStringContainsString(" INFO ", $msg);
        $this->assertStringContainsString("Info Message", $msg);
    }

    /** @test
     */
    public function should_display_debug_message()
    {
        $msg = $this->messenger->debug("Debug message", "");

        $expect = $this->messenger->buildMessage("debug", "Debug message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_debug_message_and_label()
    {
        $msg = $this->messenger->debug("Debug Message", "DEBUG");

        $this->assertStringContainsString(" DEBUG ", $msg);
        $this->assertStringContainsString("Debug Message", $msg);
    }

    /** @test
     */
    public function should_display_critical_message()
    {
        $msg = $this->messenger->critical("Critical message", "");

        $expect = $this->messenger->buildMessage("critical", "Critical message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_critical_message_and_label()
    {
        $msg = $this->messenger->critical("Critical Message", "CRITICAL");

        $this->assertStringContainsString(" CRITICAL ", $msg);
        $this->assertStringContainsString("Critical Message", $msg);
    }

    /** @test
     */
    public function should_display_error_message()
    {
        $msg = $this->messenger->error("Error message", "");

        $expect = $this->messenger->buildMessage("error", "Error message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_error_message_and_label()
    {
        $msg = $this->messenger->error("Error Message", "ERROR");

        $this->assertStringContainsString(" ERROR ", $msg);
        $this->assertStringContainsString("Error Message", $msg);
    }

    /**
     * @test
     */
    public function should_display_success_message()
    {
        $msg = $this->messenger->success("Success message", "");

        $expect = $this->messenger->buildMessage("success", "Success message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_success_message_and_label()
    {
        $msg = $this->messenger->success("Success Message", "SUCCESS");

        $this->assertStringContainsString(" SUCCESS ", $msg);
        $this->assertStringContainsString("Success Message", $msg);
    }

    /** @test
     */
    public function should_display_warning_message()
    {
        $msg = $this->messenger->warning("Warning message", "");

        $expect = $this->messenger->buildMessage("warning", "Warning message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_warning_message_and_label()
    {
        $msg = $this->messenger->warning("Warning Message", "WARNING");

        $this->assertStringContainsString(" WARNING ", $msg);
        $this->assertStringContainsString("Warning Message", $msg);
    }

    /** @test
     */
    public function should_display_warn_message()
    {
        $msg = $this->messenger->warn("Warn message", "");

        $expect = $this->messenger->buildMessage("warn", "Warn message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_warn_message_and_label()
    {
        $msg = $this->messenger->warn("Warn Message", "WARN");

        $this->assertStringContainsString(" WARN ", $msg);
        $this->assertStringContainsString("Warn Message", $msg);
    }

    /** @test
     */
    public function should_display_important_message()
    {
        $msg = $this->messenger->important("Important message", "");

        $expect = $this->messenger->buildMessage("important", "Important message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_important_message_and_label()
    {
        $msg = $this->messenger->important("Important Message", "IMPORTANT");

        $this->assertStringContainsString(" IMPORTANT ", $msg);
        $this->assertStringContainsString("Important Message", $msg);
    }

    /** @test
     */
    public function should_display_notice_message()
    {
        $msg = $this->messenger->notice("Notices message", "");

        $expect = $this->messenger->buildMessage("notice", "Notices message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_notice_message_and_label()
    {
        $msg = $this->messenger->notice("Notice Message", "NOTICE");

        $this->assertStringContainsString(" NOTICE ", $msg);
        $this->assertStringContainsString("Notice Message", $msg);
    }

    /** @test
     */
    public function should_display_status_message()
    {
        $msg = $this->messenger->status("Status message", "");

        $expect = $this->messenger->buildMessage("status", "Status message");
        $this->assertEquals($expect, $msg);
    }

    /** @test
     */
    public function should_display_status_message_and_label()
    {
        $msg = $this->messenger->status("Status Message", "STATUS");

        $this->assertStringContainsString(" STATUS ", $msg);
        $this->assertStringContainsString("Status Message", $msg);

    }

    /** @test
     * @group note
     */
    public function should_display_note_message()
    {
        $msg = $this->messenger->note("Note message", "");

        $expect = $this->messenger->buildMessage("note", "Note message");
        $this->assertEquals($expect, $msg);
    }
}
