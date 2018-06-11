<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions.php';
require __DIR__ . '/state.php';

use function Chemem\Bingo\Functional\Algorithms\{any, every, filter, extend, identity};

const generateKey = 'generateKey';

function generateKey(array $user)
{
    return extend($user, ['key' => md5($user['activated'])]);
}

function someActivated(array $users)
{
    $result = any($users, checkActivation) ? 
        filter(checkActivation, $users) : 
        identity([]);

    return $result;
}

function allActivated(array $users)
{
    $result = every($users, checkActivation) ?
        map(generateKey, $users) :
        identity([]);

    return $result;
}

print_r(someActivated(USERS));

print_r(allActivated(USERS));