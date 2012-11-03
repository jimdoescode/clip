<?php

class Test implements \Clip\Command
{
    public function run(array $params)
    {
        //Demonstrate what parameters look like
        echo "These are the params you passed:\r\n";
        print_r($params);

        //Demonstrate what coloring and config access looks like.
        \Clip\render("\r\nThis is the [RED]directory[/RED] we look in for commands:\r\n");
        echo \Clip\Config::main('directory');
        echo PHP_EOL;

        return 0;
    }

    public function help()
    {
        echo "This is help text for the 'Test' command\r\n";
    }
}
