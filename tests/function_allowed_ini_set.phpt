--TEST--
Stackdriver Debugger: Allowing a allowed function and a allowed method from ini_set
--FILE--
<?php

ini_set('stackdriver_debugger.functions_allowed', 'foo');
ini_set('stackdriver_debugger.methods_allowed', 'bar');

$statements = [
    'foo($bar)',
    'bar($foo)',
    'asdf()',
    '$foo->bar()',
    '$bar->foo()',
    '$foo->asdf($bar)',
];
var_dump(ini_get('stackdriver_debugger.functions_allowed'));
var_dump(ini_get('stackdriver_debugger.methods_allowed'));

foreach ($statements as $statement) {
    $valid = @stackdriver_debugger_valid_statement($statement) ? 'true' : 'false';
    echo "statement: '$statement' valid: $valid" . PHP_EOL;
}

?>
--EXPECT--
string(3) "foo"
string(3) "bar"
statement: 'foo($bar)' valid: true
statement: 'bar($foo)' valid: false
statement: 'asdf()' valid: false
statement: '$foo->bar()' valid: true
statement: '$bar->foo()' valid: false
statement: '$foo->asdf($bar)' valid: false
