// Load libraries
require('../../tron-config');
let mysql = require('mysql');
const TronWeb = require('tronweb')
const bigInt = require("big-integer");

global.database = mysql.createConnection(global.database_credentials);
global.database.connect();

let web3;

try {

    const HttpProvider = TronWeb.providers.HttpProvider;
    const fullNode = new HttpProvider("https://api.trongrid.io");
    const solidityNode = new HttpProvider("https://api.trongrid.io");
    const eventServer = new HttpProvider("https://api.trongrid.io");
    web3 = new TronWeb(fullNode,solidityNode,eventServer);
    web3.setHeader({"TRON-PRO-API-KEY": global.TRONGRID_API_KEY});

} catch (error) {
    console.log(error);
    process.exit(1);
}

exports.web3 = web3;

// Get account balance
const getAccountBalance = async (address, contract, callback) => {
    if (contract != '') {

        createTokenContract(contract, async (instance) => {

            web3.setAddress(address);

            let res = await instance.balanceOf(address).call();

            instance.decimals().call((error, decimals) => {
                callback(res.toString(), decimals);
            });

        });
    } else {
        web3.trx.getBalance(address).then((balance) => {
            callback(balance, 6);
        });
    }
}
exports.getAccountBalance = getAccountBalance;

const createTokenContract = (address, callback) => {
    web3.contract().at(address).then(callback);
};

exports.createTokenContract = createTokenContract;

const toFixed = (x) => {
    if (Math.abs(x) < 1.0) {
        var e = parseInt(x.toString().split('e-')[1]);
        if (e) {
            x *= Math.pow(10, e - 1);
            x = '0.' + (new Array(e)).join('0') + x.toString().substring(2);
        }
    } else {
        var e = parseInt(x.toString().split('+')[1]);
        if (e > 20) {
            e -= 20;
            x /= Math.pow(10, e);
            x += (new Array(e + 1)).join('0');
        }
    }
    return x;
}

exports.toFixed = toFixed;

const weiToNumber = (amount, decimals) => {

    let bnAmount = web3.toBigNumber(amount)
    let decimal = web3.toBigNumber('10').pow(web3.toBigNumber(decimals));

    return toFixed(bnAmount / decimal);
}

exports.weiToNumber = weiToNumber;

// Start transferring to main wallet
const walletWithdrawFromMainWallet = (wallet, callback, confirmation) => {
    if (wallet.contract) {
        return signMainWalletTrcTransaction(wallet, callback, confirmation);
    } else {
        return signMainWalletTrxTransaction(wallet, callback, confirmation);
    }
}

exports.walletWithdrawFromMainWallet = walletWithdrawFromMainWallet;

// Set signed transaction
const signMainWalletTrxTransaction = (wallet, callback, confirmation) => {

        try {

            web3.trx.sendTransaction(wallet.to, numberToWei(wallet.amount, 6), wallet.private_key).then((data) => {
                callback(data);
            }).catch((error) => {
                callback(error);
            });

        } catch (error) {
            console.log(error);
            throw error;
        }
};

exports.signMainWalletTrxTransaction = signMainWalletTrxTransaction;

// Set signed transaction
const signMainWalletTrcTransaction = async (wallet, callback) => {

    try {

        createTokenContract(wallet.contract, async (instance) => {

            web3.setAddress(wallet.address);

            instance.decimals().call(async (error, decimals) => {

                let amount = wallet.amount;
                let parameter = [{type: 'address', value: wallet.to}, {type: 'uint256', value: numberToWei(amount, decimals).toString()}];
                let options = {
                    feeLimit: 100000000
                }

                const transactionObject = await web3.transactionBuilder.triggerSmartContract(
                    web3.address.toHex(wallet.contract),
                    "transfer(address,uint256)",
                    options,
                    parameter,
                    web3.address.toHex(wallet.address),
                );

                let signedTransaction = await web3.trx.sign(transactionObject.transaction, wallet.private_key);

                let broadcastTransaction = await web3.trx.sendRawTransaction(signedTransaction);

                callback(broadcastTransaction);

            });

        });

    } catch (error) {
        console.log(error);
        throw error;
    }
};

exports.signMainWalletTrcTransaction = signMainWalletTrcTransaction;


const numberToWei = (amount, decimals) => {
    return toFixed(amount * Math.pow(10, decimals));
}

exports.numberToWei = numberToWei;
