## Overview

Clip is a simple framework for making CLI (console) commands in PHP.

You can run a command by typing the following:

    $ clip <command-name> [parameters...]

Output from the command will be displayed in the console.


## New Commands

Make a new command by adding a file to the 'commands' directory. The file name should exactly match the class name.
Clip provides an interface that must be implemented for any command.
```php
class NewCommand implements \Clip\Command
```
This Command interface has two methods that must be implemented:

The 'run' method which actually executes the command:
```php
public function run(array $params)
```
The 'help' method which outlines what this command actually does:
```php
public function help()
```

## Configuration

Clip provides a very simple way to create and access config files. Add a new file to the 'config' directory.
In that file you will return an associative array of configuration parameters.
```php
    return array(
        'foo' => 'bar',
        'test' => 'baz'
    );
```
To access these parameters you would use the following command:
```php
    \Clip\Config::<config-filename>('foo');
```

You can specify additional configuration keys as parameters to the call to get an array back for each key specified.
```php
    \Clip\Config::<config-filename>('foo', 'test');
```

You can also not specify any parameters to get the entire configuration array back.
```php
    \Clip\Config::<config-filename>();
```

## Coloring

Clip lets you color your output if you so choose. To do so you will need to use the render function under the clip namespace.
```php
    \Clip\render('Some colorful test [red]output[/red]. Neato!');
```

Check out the colors.php config file for all of the different color options. Use the square bracket syntax with the key of the color in it. Note that nesting does not work the way it would in HTML.


## Help

You can see what commands are available by typing:

    $ clip

To see help text for a command you would type:

    $ clip help <command-name>


## Installation

Copy the files where ever you need them. All the files with the exception of commands/Test.php are required so make sure you have them all.

Also make sure the clip command file (./clip) has execute permissions.


## License

Clip is MIT licensed
