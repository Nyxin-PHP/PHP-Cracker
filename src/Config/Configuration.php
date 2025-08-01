<?php

namespace App\Config;

class Configuration
{
    public string $Characters = 'Numbers';
    public string $UniqueChars = 'Abc';
    public string $StartPoint = '';
    public int $MinLen = 2;
    public int $MaxLen = 3;
    public string $Formation = 'matrix';
    public bool $ShowPasswords = true;
    public bool $Resume = false;
    public bool $Pause = false;
    public int $Delay = 0;
    public string $Target = 'Dojo';
    public bool $ignoreAbort = false;
}
