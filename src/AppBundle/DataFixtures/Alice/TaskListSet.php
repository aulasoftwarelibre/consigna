<?php

use h4cc\AliceFixturesBundle\Fixtures\FixtureSet;

$set = new FixtureSet(array(
    'locale' => 'es_ES',
    'do_drop' => true,
    'do_persist' => true,
));

$set->addFile(__DIR__.'/users.yml', 'yaml');
$set->addFile(__DIR__.'/tags.yml', 'yaml');
$set->addFile(__DIR__.'/folders.yml', 'yaml');
//$set->addFile(__DIR__.'/files.yml', 'yaml');



return $set;