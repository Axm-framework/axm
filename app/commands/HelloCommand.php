<?php

namespace App\Commands;

use Console\BaseCommand;
use Console\CLI;

class HelloCommand extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'App';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'hello';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Displays a "hello world!" on console';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'hello [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        CLI::write('Hello Word!', 'green');
    }
}
