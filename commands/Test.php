<?php

class Test implements \Clip\Command
{
    public function run(array $params)
    {
        echo "These are the params you passed:\r\n";
        print_r($params);
    }

    public function help()
    {
        echo 'This is help text for the \'Test\' command';
    }
}
