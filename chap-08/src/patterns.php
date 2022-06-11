<?php

declare(strict_types=1);

namespace Project;

use \Chemem\Bingo\{
  Functional as f,
  Functional\Functors\Monads\IO,
  Functional\Functors\Monads as m,
  Functional\PatternMatching as p
};

const toAction = __NAMESPACE__ . '\\toAction';

/**
 *
 * toAction function
 * Transforms command into an action
 *
 * toAction :: String -> IO ()
 *
 * @param string $cmd
 * @return object IO
 */

function toAction(string $cmd): IO
{
  return p\patternMatch([
    '["add", name, phone]'  => fn (string $name, string $phone) => (
      registryAction(create, $name, $phone)
    ),
    '["search", name]'      => fn (string $name) => (
      showRegistryData(search, $name)
    ),
    '["delete", name]'      => fn (string $name) => (
      registryAction(delete, $name)
    ),
    '["exit"]'              => fn () => (
      m\bind(
        fn ($_) => IO\IO(fn () => exit()),
        IO\_print(IO\IO('Thanks for using the phonebook'))
      )
    ),
    '["all"]'               => fn () => showRegistryData(readRegistry),
    '_'                     => fn () => IO\IO('Unrecognized input'),
  ], explode(' ', $cmd));
}

const registryAction = __NAMESPACE__ . '\\registryAction';

/**
 * registryAction
 * produces apt message for registry write operations
 * 
 * registryAction :: (a -> IO) -> a -> IO
 * 
 * @param callable $action
 * @param mixed $args...
 * @return IO
 */
function registryAction(callable $action, ...$args): IO
{
  $action = m\mcompose(
    fn (bool $res) => IO\IO(f\concat(' ', 'Action', ($res ? 'completed' : 'not completed'))),
    fn ($args)     => $action(...$args)
  );

  return $action(IO\IO($args));
}

const showRegistryData = __NAMESPACE__ . '\\showRegistryData';

/**
 * showRegistryData
 * conveys registry data produced by registry read operations
 * 
 * showRegistryData :: (a -> IO) -> a -> IO
 * 
 * @param callable $action
 * @param mixed $args...
 * @return IO 
 */
function showRegistryData(callable $action, ...$args): IO
{
  $show = m\mcompose(
    fn ($data) => IO\IO(formatOutput($data)),
    fn ($args) => $action(...$args)
  );

  return $show(IO\IO($args));
}
