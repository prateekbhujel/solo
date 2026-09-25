<?php

namespace Io\Terminal;

final class TerminalSize
{
    public readonly int $cols;

    public readonly int $rows;
}

class Terminal
{
    public static function create(): self {}

    public function getSize(): TerminalSize|false {}
}
