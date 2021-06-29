--TEST--
Stackdriver Debugger: Not allowing a allowed function regex if regex are not enabled
--INI--
stackdriver_debugger.functions_allowed="/oo/"
stackdriver_debugger.methods_allowed="/ar/"
--FILE--
<?php

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
string(4) "/oo/"
string(4) "/ar/"
statement: 'foo($bar)' valid: false
statement: 'bar($foo)' valid: false
statement: 'asdf()' valid: false
statement: '$foo->bar()' valid: false
statement: '$bar->foo()' valid: false
statement: '$foo->asdf($bar)' valid: false
