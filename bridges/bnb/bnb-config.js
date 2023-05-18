// Bnb Node Url (ENDPOINT FROM THE OFFICIAL BINANCE BSC DOCS)
require('dotenv').config({ path: require('path').dirname(require.main.filename).replace('bridges/bnb', '') + '/.env' })

global.geth = 'https://bsc-dataseed.binance.org';

// Application Port
global.port = '8008';
// Optima Laravel App

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
