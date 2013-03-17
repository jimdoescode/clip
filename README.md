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
This Command interface has two methods that must be defined:

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

## Styling Output

Clip lets you style your output if you so choose. To do so you will need to use the render function under the clip namespace.
```php
\Clip\render('Some colorful test [red]output[reset]. Neato!');
```

Check out the styles.php config file for the different options. Use the square bracket syntax with the key of the style in it. Feel free to add any additional styles that are not currently set in the config file.

## Command nesting

If you would like to call another Command inside of a Command you can do that with Clip. Access the current Clip instance using the 'instance' method. Then call the 'fire' method on the Clip instance specifying what the other Command is and what parameters to use.
 ```php
 \Clip\instance()->fire('OtherCommand', $params);
 ```
This is useful if you have a separate Command that needs to be executed immediately after another Command finishes or if a Command relies on some parameters from another Command. I would advise that if you aren't careful this type of execution stack can get messy with too many Commands called consecutively.

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
