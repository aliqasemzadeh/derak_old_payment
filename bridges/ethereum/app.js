require('./eth-config');
const express = require('express');
const app = express();

const {
    web3
} = require('./bridge/methods');
const {
    gateways
} = require('./bridge/gateways');

gateways(app);
init();

console.log('Trying to connect to the Node');

async function init() {

    try {
        web3.eth.getBlockNumber().then((block) => {
            console.log('Connected to Ethereum Network: Current block number is ' + block);

            app.listen(global.port, () => {
                console.log(`Ethereum Node Bridge has been started...`)
            });
        });
    } catch (error) {
        console.log("Connection Error with the Ethereum node with the following error:");
        console.log(error);
        process.exit(1);
    }
}
