require('./tron-config');
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

        web3.isConnected().then((block) => {
            console.log(block);
            console.log('Connected to Tron Network');

            app.listen(global.port, () => {
                console.log(`Tron Node Bridge has been started...`)
            });
        });

    } catch (error) {
        console.log("Connection Error with the Tron node with the following error:");
        console.log(error);
        process.exit(1);
    }
}
