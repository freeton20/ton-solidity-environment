<?php
//
//write path to solidity file
$bib_path = '/home/linuxbrew/.linuxbrew/bin';
$path_to_solidity_file = __DIR__ . '/contract/Main.sol';
$name_solidity_file = basename($path_to_solidity_file, '.sol');

$path_build = __DIR__ . '/build/';
$path_to_code_file = $path_build . $name_solidity_file . '.code';
$path_to_abi_json_file = $path_build . $name_solidity_file . '.abi.json';
$path_to_key = $path_build . $name_solidity_file . '.key';
$path_to_tvc = $path_build . $name_solidity_file . '.tvc';

exec('rm -fr ' . $path_build);
exec('mkdir -p ' . $path_build);
exec($bib_path . '/tvm-solc --output-dir ' . $path_build . ' ' . $path_to_solidity_file, $output_solc);
print_r($output_solc);

exec($bib_path . '/tvm-linker compile ' . $path_to_code_file
    . ' --lib ' . __DIR__ . '/contract/stdlib_sol.tvm'
    . ' --abi-json ' . $path_to_abi_json_file
    . ' -o ' . $path_build . $name_solidity_file . '.tvc'
    . ' --genkey ' . $path_to_key . ' -w 0', $output_compile);
print_r($output_compile);

//tests
$method = "result";
$abi_params = '{}';
$str = $bib_path . "/tvm-linker test $path_to_tvc --abi-json $path_to_abi_json_file -m $method --abi-params '$abi_params' --sign $path_to_key";
exec($str, $output_test);
print_r($output_test);