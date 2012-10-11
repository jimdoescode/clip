<?php namespace Clip;

class Main
{
    /**
     * @var array All loaded commands
     */
    static $commands = array();

    /**
     * Loads the commands into an array.
     */
    public static function load($exec)
    {
        //Move to the directory where the command resides
        chdir(substr($exec, 0, strrpos($exec, '/')));

        array_map(function($command)
        {
            if($command !== '.' && $command !== '..')
            {
                include(Config::main('directory')."/{$command}");
                $command = substr($command, 0, -4);
                if(class_exists($command, false))
                {
                    $obj = new $command;
                    if($obj instanceof Command)
                        Main::$commands[$command] = $obj;
                }
            }

        }, scandir(Config::main('directory')));
    }

    /**
     * Outputs the help text.
     */
    public static function help()
    {
        echo Config::main('help_text');
        foreach(self::$commands as $key => $ignored)
            echo " - $key\r\n";
        echo PHP_EOL;
    }

    /**
     * Executes the command specified by the name with the
     * additional params
     *
     * @param string $name
     * @param array $params
     */
    public static function command($name, array $params)
    {
        $converted = array();
        foreach($params as $key => $param)
        {
            //Convert foo=bar params into key value pairs
            $segs = explode('=', $param);
            if(count($segs) > 1)
                $converted[trim($segs[0])] = trim($segs[1]);
            else
                $converted[$key] = $param;
        }
        //If the command exists or is a help command run
        //it otherwise display the general help text
        if(array_key_exists($name, self::$commands))
            self::$commands[$name]->run($converted);
        elseif($name === 'help' && array_key_exists($params[0], self::$commands))
            self::$commands[$params[0]]->help();
        else
            self::help();
    }
}

class Config
{
    public static function __callStatic($name, $params)
    {
        $key = "clip_config_{$name}";
        if(!array_key_exists($key, $GLOBALS))
            $GLOBALS[$key] = require_once("config/{$name}.php");

        if(is_array($params))
        {
            $value = $GLOBALS[$key];
            foreach($params as $param)
                $value = $value[$param];
            return $value;
        }
        return $GLOBALS[$key];
    }
}

interface Command
{
    public function help();
    public function run(array $params);
}