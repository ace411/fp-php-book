<?php

declare(strict_types=1);

namespace Project;

use \Chemem\Bingo\Functional\{
  Algorithms as f, 
  Functors\Monads\IO,
  Functors\Monads as m
};

const writeRegistry = __NAMESPACE__ . '\\writeRegistry';

/**
 *
 * writeRegistry function
 * Execute a function that writes to the registry
 *
 * writeRegistry :: ([a] -> b) -> IO ()
 *
 * @param callable $action
 * @return object IO
 */

function writeRegistry(callable $action): IO
{
  $write = f\partialRight(
		IO\writeFile,
		m\bind(
      fn (array $contents) => IO\IO(fn () => $action($contents)), 
      readRegistry()
    )->exec()
	);
		
  return $write(registry());
}

const create = __NAMESPACE__ . '\\create';

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

function create(string $name, string $phone): IO
{
  $action = f\compose(f\partialRight(f\extend, [
		[
			'name'	 => $name,
			'phone' => formatPhone($phone),
		],
	]), f\partialRight('json_encode', JSON_PRETTY_PRINT));
		
  return writeRegistry($action);
}

const formatPhone = __NAMESPACE__ . '\\formatPhone';

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

function formatPhone(string $phone): string
{
  $format = f\compose(
		f\partial('str_replace', ' ', ''),
		f\partialRight('substr', 9, 0),
		f\partial(f\concat, ' ', '+256')
	);
	
  return $format($phone);
}

const delete = __NAMESPACE__ . '\\delete';

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

function delete(string $name): IO
{
  $action = f\compose(
		f\partial(f\reject, fn ($entry): bool => $entry['name'] == $name),
		f\identity('array_values'),
		f\partialRight('json_encode', JSON_PRETTY_PRINT)
	);
    
  return writeRegistry($action);
}

const search = __NAMESPACE__ . '\\search';

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

function search(string $name): IO
{
  $search = f\compose(f\partial(f\filter, fn ($entry) => (
    preg_match(f\concat('', '/(', $name, ')+/', 'im'), $entry['name'])
  )), 'array_values');
    
  return m\bind(fn ($data) => IO\IO($search($data)), readRegistry());
}

const readRegistry = __NAMESPACE__ . '\\readRegistry';

/**
 *
 * readRegistry function
 * Read registry file contents
 *
 * readRegistry :: IO ()
 *
 * @return object IO
 */
function readRegistry(): IO
{
  $read = m\mcompose(function ($contents) {
    $read = f\compose(f\partialRight('json_decode', true), IO\IO);
		
    return $read($contents);
  }, IO\readFile);
    
  return $read(IO\IO(registry()));
}

const formatOutput = __NAMESPACE__ . '\\formatOutput';

/**
 *
 * formatOutput function
 * Beautifies console list display
 *
 * formatOutput :: [a] -> String
 *
 * @param array $contents
 * @return string
 */
function formatOutput(array $contents): string
{
  $out = f\compose(
    f\partial(f\map, 'array_values'),
    f\partial(printTable, ['name', 'phone'])
  );

  return $out($contents);
}

const printTable = __NAMESPACE__ . '\\printTable';

/**
 * printTable function
 * Prints data in a tabular format
 * 
 * printTable :: Array -> Array -> String
 * 
 * @param array $header
 * @param array $data
 * 
 * @return string
 */
function printTable(array $header, array $data): string
{
  return \Mmarica\DisplayTable::create()
    ->headerRow($header)
    ->dataRows($data)
    ->toText()
    ->generate();
}

const registry = __NAMESPACE__ . '\\registry';

/**
 *
 * registry function
 * Outputs registry file path
 *
 * registry :: String
 *
 * @return string
 */
function registry(): string
{
  return f\filePath(0, REGISTRY_FILE);
}
