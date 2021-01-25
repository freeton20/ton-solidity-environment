<?php
//
//write path to solidity file
$path_to_solidity_file = __DIR__.'/tools/test.sol';

$path_to_code_file = __DIR__ . '/'.basename($path_to_solidity_file,'.sol').'.code';
$path_to_abi_json_file = __DIR__ . '/'.basename($path_to_solidity_file,'.sol').'.abi.json';

exec('rm '.__DIR__.'/*.tvc');
exec(__DIR__ . '/tools/solc '.$path_to_solidity_file, $output);

exec(__DIR__ . '/tools/tvm_linker compile '.$path_to_code_file.' --lib ' . __DIR__. '/tools/stdlib_sol.tvm --abi-json '.$path_to_abi_json_file.' --genkey ./keyfile.json -w 0', $output1);
print_r($output);
file_put_contents(__DIR__.'/compile_data.txt', print_r($output1,true));

//tests
exec("find " . __DIR__."/*tvc", $output2);
$address = basename($output2[0],'.tvc');

$method = "result";
$abi_params = '{}';
$str = __DIR__ . "/tools/tvm_linker test $address --abi-json $path_to_abi_json_file -m $method --abi-params '$abi_params' --sign ".__DIR__.'/keyfile.json';
exec($str,$output4);
print_r($output4);