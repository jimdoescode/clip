## Overview

CLIP is a simple framework for making CLI (console) commands in PHP.

You can run a command by typing the following:

    $ clip <command-name> [parameters...]

Output from the command will be displayed in the console.


## Commands

Make a new command by adding a file to the 'commands' directory. The file name should exactly match the class name.
CLIP provides an interface that must be implemented for any command.

    class NewCommand implemented \Clip\Command

This Command interface has two methods that must be implemented:

The 'run' method which actually executes the command:

    public function run(array params)

The 'help' method which outlines what this command actually does:

    public function help()


## Configuration

CLIP provides a very simple way to create and access config files. Add a new file to the 'config' directory.
In that file you will return an associative array of configuration parameters.

    return array(
        'foo' => 'bar',
        'test' => 'baz'
    );

To access these parameters you would use the following command:

    \Clip\Config::<config-filename>('foo');

    
## Help

You can see what commands are available by typing:

    $ clip

To see help text for a command you would type:

    $ clip help <command-name>