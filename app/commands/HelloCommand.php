<?php

namespace App\Commands;

use Console\BaseCommand;
use Console\CLI;

class HelloCommand extends BaseCommand
{
    /**
     * The Command's Group
     */
    protected string $group = 'App';

    /**
     * The Command's Name
     */
    protected string $name = 'hello';

    /**
     * The Command's Description
     */
    protected string $description = 'Displays a "hello world!" on console';

    /**
     * The Command's Usage
     */
    protected string $usage = 'hello [options]';

    /**
     * The Command's Arguments
     */
    protected array $arguments = [];

    /**
     * The Command's Options
     */
    protected array $options = [];

    /**
     * Actually execute a command.
     */
    public function run(array $params)
    {
        CLI::write('Hello Word!', 'green');
    }
}
