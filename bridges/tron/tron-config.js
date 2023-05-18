require('dotenv').config({ path: require('path').dirname(require.main.filename).replace('bridges/tron', '') + '/.env' })

// Tron Node Url
global.TRONGRID_API_KEY = process.env.APP_TRONGRID_API;

// Ethereum Node Environment
global.geth_env = 'mainnet';
// Application Port
global.port = '8009';

global.database_credentials = {
    host     : process.env.DB_HOST,
    user     : process.env.DB_USERNAME,
    password : process.env.DB_PASSWORD,
    database : process.env.DB_DATABASE,
};
