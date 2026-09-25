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
}
