<?php

use NiceRegex\RegexBuilder;

test('regex flags!', function () {
    $regex_obj = (new RegexBuilder())
        ->isGlobal()
        ->isMultiLine()
        ->isUnicode()
        ->make();

    $regex = $regex_obj->build();

    expect($regex)->toBe('//gmu');
});

test('in & notIn methods!', function () {
    $regex_obj = (new RegexBuilder())->make();

    $regex = $regex_obj
        ->in(['a', 'b', 'c'])
        ->notIn(['x', 'y', 'z'])
        ->build();

    expect($regex)->toBe('/[abc][^xyz]/');
});

test('oneOrMoreTimes,zeroOrMoreTimes and zeroOrOneTimes methods!', function () {
    $regex_obj = (new RegexBuilder())->make();

    $regex = $regex_obj
        ->oneOrMoreTimes()
        ->zeroOrMoreTimes()
        ->zeroOrOneTimes()
        ->build();

    expect($regex)->toBe('/+*?/');
});

test('times & range methods', function () {
    $regex_obj = (new RegexBuilder())->make();

    $regex = $regex_obj
        ->times(4)
        ->range(1, 5)
        ->build();

    expect($regex)->toBe('/{4}{1,5}/');
});

test('exactly methods', function () {
    $regex_obj = (new RegexBuilder())->make();

    $regex = $regex_obj
        ->exactly('uuId-')
        ->build();

    expect($regex)->toBe('/uuId-/');
});

test('digits method', function () {
    $regex_obj = (new RegexBuilder())->make();

    $regex1 = $regex_obj
        ->digits(4)
        ->build();

    $regex2 = $regex_obj
        ->digits()
        ->build();

    expect($regex1)->toBe('/\d{4}/');
    expect($regex2)->toBe('/\d/');
});
