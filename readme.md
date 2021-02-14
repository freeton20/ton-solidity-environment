# Free TON Solidity Environment

Example compile and deploy smart contract (Solidity) for TON network.

## Dependencies

    brew install git
    brew install docker
    brew install node

## Develop

    yarn
    yarn compile
    export TON_NODE_PORT=8080
    yarn start # stat TON local node on http://localhost/graphql 
    yarn deploy-local
    yarn stop

## Example with tonos-cli
```bash
$ tonos-cli --url http://localhost:8080 account 0:841288ed3b55d9cdafa806807f02a0ae0c169aa5edfe88a789a6482429756a94
```
