<?php

namespace Project;

use \Chemem\Bingo\Functional\Algorithms as A;
use \Chemem\Bingo\Functional\Functors\Monads\{IO, State};
use function \Chemem\Bingo\Functional\Functors\Monads\{bind, mcompose};

/**
 * 
 * execAction function
 * Execute a function that writes to the registry
 * 
 * execAction :: ([a] -> b) -> IO ()
 * 
 * @param callable $action 
 * @return object IO
 */

function execAction(callable $action) : IO
{
    $write = A\partialRight(IO\writeFile, bind(function (array $contents) use ($action) {
        return IO\IO($action($contents));
    }, connect())->exec());

    return $write(registry());
}

/**
 * 
 * create function
 * Add a record to the registry
 * 
 * create :: String -> String -> IO ()
 * 
 * @param string $name
 * @param string $phone
 * @return object IO
 */

function create(string $name, string $phone) : IO
{
    $action = A\compose(
        A\partialRight(A\extend, [['name' => $name, 'phone' => formatPhone($phone)]]),
        A\partialRight('json_encode', \JSON_PRETTY_PRINT)
    );    
    return execAction($action);
}

/**
 * 
 * formatPhone function
 * format telephone numbers to match the format +(code) (digits)
 * 
 * formatPhone :: String -> String
 * 
 * @param string $phone
 * @return string
 */

function formatPhone(string $phone) : string
{
    $format = A\compose(
        A\partial('str_replace', ' ', ''),
        A\partialRight('substr', 9, 0),
        A\partial(A\concat, ' ', '+256')
    );

    return $format($phone);
}

/**
 * 
 * delete function
 * Delete an entry from the registry
 * 
 * delete :: String -> IO ()
 * 
 * @param string $name
 * @return object IO
 */

function delete(string $name) : IO
{
    $action = A\compose(
        A\partial(A\reject, function ($entry) use ($name) {
            return $entry['name'] == $name;
        }),
        'array_values',
        A\partialRight('json_encode', \JSON_PRETTY_PRINT)
    );
    return execAction($action);
}

/**
 * 
 * search function
 * Search the registry for an entry associated with a particular name
 * 
 * search :: String -> IO ()
 * 
 * @param string $name
 * @return object IO
 */

function search(string $name) : IO
{
    $action = A\compose(
        A\partial(A\filter, function ($entry) use ($name) {
            return preg_match(A\concat('', '/(', $name, ')+/', 'im'), $entry['name']);
        }),
        'array_values'
    );
    return bind(function ($data) use ($action) {
        return IO\IO($action($data));
    }, connect());
}

/**
 * 
 * connect function
 * Read registry file contents
 * 
 * connect :: IO ()
 * 
 * @return object IO
 */

function connect() : IO
{
    $read = mcompose(function ($contents) {
        $read = A\compose(A\partialRight('json_decode', true), IO\IO);
        return $read($contents);
    }, IO\readFile);
    
    return $read(IO\IO(registry()));
}

/**
 * 
 * formatOutput function
 * Beautifies console list display
 * 
 * formatOutput :: [a] -> IO String
 * 
 * @param array $contents
 * @return object IO
 */

const formatOutput = 'Project\\formatOutput';

function formatOutput(array $contents) : IO
{
    $format = A\compose(
        A\partialRight('json_encode', \JSON_PRETTY_PRINT),
        A\partial('str_replace', '{', '-------'),
        A\partial('str_replace', '}', '-------'),
        A\partial('str_replace', '"', ''),
        A\partial('str_replace', ',', ''),
        A\partial('str_replace', '[', ''),
        A\partial('str_replace', ']', ''),
        IO\IO
    );

    return $format($contents);
}

/**
 * 
 * registry function
 * Outputs registry file path
 * 
 * registry :: String
 * 
 * @return string
 */

function registry() : string
{
    return A\concat('/', dirname(__DIR__), REGISTRY_FILE);
}

/**
 * 
 * replPrompt function
 * Output REPL prompt directive (>>>)
 * 
 * replPrompt :: IO Int
 * 
 * @return object IO
 */

function replPrompt() : IO
{
    $prompt = mcompose(function ($prompt) {
        $action = A\compose(A\partial('printf', '%s'), IO\IO);
        return $action($prompt);
    }, IO\IO);

    return $prompt(IO\IO(CONSOLE_PROMPT));
}
