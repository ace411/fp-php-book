<?php

require __DIR__ . '/../vendor/autoload.php';

use function Chemem\Bingo\Functional\{
  any,
  map,
  every,
  filter,
  extend,
  identity
};

define('USERS', [
  [
    'name'      => 'chemem',
    'activated' => true,
  ],
  [
    'name'      => 'bruno',
    'activated' => false,
  ],
]);

function checkActivation(array $user)
{
  return is_bool($user['activated']) ? $user['activated'] : false;
}

function generateKey(array $user): array
{
  return extend($user, ['key' => md5($user['activated'])]);
}

function someActivated(array $users): array
{
  return any($users, 'checkActivation') ?
    filter('checkActivation', $users) :
    identity([]);
}

function allActivated(array $users): array
{
  return every($users, 'checkActivation') ?
    map('generateKey', $users) :
    identity([]);
}

print_r(someActivated(USERS));

print_r(allActivated(USERS));
