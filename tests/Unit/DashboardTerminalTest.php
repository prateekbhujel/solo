<?php

/**
 * @author Aaron Francis <aaron@tryhardstudios.com>
 *
 * @link https://aaronfrancis.com
 * @link https://x.com/aarondfrancis
 */

namespace SoloTerm\Solo\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use SoloTerm\Solo\Prompt\Dashboard;

class DashboardTerminalTest extends Base
{
    #[Test]
    public function it_prefers_native_terminal_dimensions_when_available(): void
    {
        $dashboard = new class extends Dashboard
        {
            public function __construct()
            {
                //
            }

            /**
             * @return array{0: int, 1: int}|null
             */
            protected function nativeDimensions(): ?array
            {
                return [132, 43];
            }
        };

        $this->assertSame([132, 43], $dashboard->getDimensions());
    }

    #[Test]
    public function resize_respects_a_get_dimensions_override(): void
    {
        $dashboard = new class extends Dashboard
        {
            public function __construct()
            {
                $this->width = 80;
                $this->height = 24;
                $this->commands = [];
            }

            public function getDimensions(): array
            {
                return [144, 48];
            }

            protected function nativeDimensions(): ?array
            {
                return [132, 43];
            }
        };

        $dashboard->handleResize();

        $this->assertSame(144, $dashboard->width);
        $this->assertSame(48, $dashboard->height);
    }
}
