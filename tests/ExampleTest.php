<?php

use NiceRegex\RegexBuilder;

it('works for now!', function () {
    $regex_obj = (new RegexBuilder())->isGlobal()->isMultiLine()->make();

    $regex = $regex_obj
        ->in(['a', 'b', 'c'])
        ->oneOrMoreTimes()
        ->or()
        ->notIn(['x', 'y', 'z'])
        ->build();

    expect($regex)->toBe('/[abc]+|[^xyz]/gm');
});
