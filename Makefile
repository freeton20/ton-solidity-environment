deps:
	brew install tonsoft/stable/tonos-cli
	brew install --head tonsoft/stable/tvm-linker
	brew install tonsoft/stable/tvm-solc

test: prune
	@mkdir -p build
	@$(MAKE) --silent test/Main.tvc method="result" params="{}"

test/Main.tvc:
test/%.tvc: build/%.tvc
	tvm-linker test build/$*.tvc \
		--abi-json build/$*.abi.json \
		-m ${method} \
		--abi-params ${params} \
		--sign build/$*.key

build/Main.tvc:
build/%.tvc:
	tvm-solc contract/$*.sol --output-dir build
	tvm-linker compile \
		--lib contract/stdlib_sol.tvm \
		--abi-json build/$*.abi.json \
		--genkey build/$*.key -w 0 \
		-o build/$*.tvc \
		build/$*.code

prune:
	rm -rf build
