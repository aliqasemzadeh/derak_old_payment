require('dotenv').config({ path: require('path').dirname(require.main.filename).replace('bridges/ethereum', '') + '/.env' })

// Ethereum Node Url (wss based infura or full ethereum node url)
global.geth = process.env.APP_ETHEREUM_NODE;

// Ethereum Node Environment
global.geth_env = 'mainnet';
// Application Port
global.port = '8007';

// Default web3 configs
global.web3config = {
    keepAlive: true,
    timeout: 20000,
};

global.database_credentials = {
    host     : process.env.DB_HOST,
    user     : process.env.DB_USERNAME,
    password : process.env.DB_PASSWORD,
    database : process.env.DB_DATABASE,
};
