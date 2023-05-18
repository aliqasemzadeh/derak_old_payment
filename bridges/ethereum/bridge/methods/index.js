// Load libraries
require('../../eth-config');
const Web3 = require('web3');
const web3Provider = require('web3-providers-http');
const Tx = require('ethereumjs-tx').Transaction;
const bigInt = require("big-integer");
let mysql = require('mysql');

global.database = mysql.createConnection(global.database_credentials);
global.database.connect();

let web3 = new Web3(new web3Provider(global.geth, global.web3config));

// Export BigNumber Instance
const BN = web3.utils.BN;
exports.web3 = web3;

// This function used to transfer from user's wallet to the system wallet
const walletTransferToMainWallet = (wallet, callback, confirmation) => {
    return signMainWalletEthTransaction(wallet, callback, confirmation);
}
exports.walletTransferToMainWallet = walletTransferToMainWallet;

const walletTransferErcToMainWallet = (wallet, callback, confirmation) => {
    return sendFeeAndWithdrawToMain(wallet, callback, confirmation);
}

exports.walletTransferErcToMainWallet = walletTransferErcToMainWallet;

// Start transferring to main wallet
const walletWithdrawFromMainWallet = (wallet, callback, confirmation) => {
    if (wallet.contract) {
        return signMainWalletErcTransaction(wallet, callback, confirmation);
    } else {
        return signMainWalletEthTransaction(wallet, callback, confirmation);
    }
}
exports.walletWithdrawFromMainWallet = walletWithdrawFromMainWallet;

// Set signed transaction
const signMainWalletEthTransaction = (wallet, callback, confirmation) => {

    ethGas((gasGweiPrice) => {
        try {
            console.log("Current eth gas costs " + gasGweiPrice);

            let gasLimit = 21000;
            let gasPrice = web3.utils.toWei(gasGweiPrice, 'Gwei');

            let amount = web3.utils.toWei(wallet.amount.toString());

            if (wallet.fee) {

                let gasFee = gasLimit * gasPrice;
                amount = amount - gasFee;

                if (amount < 0) {
                    console.log('Insufficient funds');
                    return;
                }
            }

            let privateKey = Buffer.from(wallet.private_key.substring(2, 66), 'hex');

            web3.eth.getTransactionCount(wallet.address, 'pending').then((txCount) => {

                let tx = new Tx({
                    nonce: web3.utils.numberToHex(txCount),
                    gasPrice: web3.utils.numberToHex(gasPrice),
                    gasLimit: web3.utils.numberToHex(gasLimit),
                    to: wallet.to,
                    value: web3.utils.numberToHex(amount)
                }, {'chain': global.geth_env});

                tx.sign(privateKey);

                let transaction = web3.eth.sendSignedTransaction('0x' + tx.serialize().toString('hex'))

                transaction.on('confirmation', confirmation).catch(callback);

            }).catch((error) => {
                throw error;
            });
        } catch (error) {
            console.log(error);
            throw error;
        }
    });
};
exports.signMainWalletEthTransaction = signMainWalletEthTransaction;


const signMainWalletErcTransaction = (wallet, callback, confirmation) => {

    let tokenContract = createTokenContract(wallet.contract);

    tokenContract.methods.decimals().call((error, decimals) => {

        let amount = numberToWei(wallet.amount, decimals);

        let tokenData = tokenContract.methods.transfer(wallet.to, amount.toString()).encodeABI();

        web3.eth.estimateGas({from: wallet.address, to: wallet.contract, data: tokenData}).then((gasLimit) => {

            ethGas((gasGweiPrice) => {

                web3.eth.getTransactionCount(wallet.address, 'pending').then((nonce) => {

                    let privateKey = Buffer.from(wallet.private_key.substring(2, 66), 'hex');

                    let tx = new Tx({
                        nonce: web3.utils.numberToHex(nonce),
                        gasPrice: web3.utils.numberToHex(web3.utils.toWei(gasGweiPrice.toString(), 'Gwei')),
                        gasLimit: web3.utils.numberToHex(gasLimit),
                        to: wallet.contract,
                        value: web3.utils.numberToHex(0),
                        data: tokenData
                    }, {'chain': global.geth_env});

                    tx.sign(privateKey);

                    let transaction = web3.eth.sendSignedTransaction('0x' + tx.serialize().toString('hex'))

                    transaction.on('confirmation', confirmation).catch(callback);

                }).catch((error) => {
                    throw error;
                });

            });

        }).catch((error) => {
            console.log(error);
            throw error;
        });

    }).catch((error) => {
        console.log(error);
        throw error;
    });
};

exports.signMainWalletErcTransaction = signMainWalletErcTransaction;

const sendFeeAndWithdrawToMain = (deposit, callback, confirmation) => {

    let tokenContract = createTokenContract(deposit.contract);

    let tokenData = tokenContract.methods.transfer(deposit.wallet, deposit.wei.toString()).encodeABI();

    web3.eth.estimateGas({from: deposit.address, to: deposit.contract, data: tokenData}).then((gasLimitErc) => {

        console.log("Gas limit is " + gasLimitErc);

        ethGas((gasGweiPrice) => {

            let gasPrice = web3.utils.toWei(gasGweiPrice, 'Gwei');

            let fee = bigInt(gasLimitErc).multiply(gasPrice).toString();

            let privateKey = Buffer.from(deposit.private_key.substring(2, 66), 'hex');

            web3.eth.getTransactionCount(deposit.wallet, 'pending').then((txCount) => {

                let gasLimit = 21000;

                let tx = new Tx({
                    gasPrice: web3.utils.numberToHex(gasPrice),
                    gasLimit: web3.utils.numberToHex(gasLimit),
                    nonce: web3.utils.numberToHex(txCount),
                    to: deposit.address,
                    value: web3.utils.numberToHex(fee)
                }, {'chain': global.geth_env});

                tx.sign(privateKey);

                let transaction = web3.eth.sendSignedTransaction('0x' + tx.serialize().toString('hex'))

                transaction.on('receipt', (receipt) => {
                    console.log(receipt);
                }).catch((error) => {


                    global.database.query('UPDATE deposits SET wallet_transfer_status = ? WHERE id = ?', ['fee_error', deposit.id], function (error) {
                        if (error) {
                            console.log(error);
                        } else {
                            console.log('Erc Deposit Transferred with id ' + deposit.id);
                        }
                    });

                    console.log("BNB Balance transfer from main wallet ");
                    console.log(error);

                });

                // Fee amount was sent and start sending erc amount to main wallet after first confirmation
                transaction.on('confirmation', (confirms, receipt) => {

                    if (confirms == 1 && receipt.transactionHash) {

                        console.log("Fee paid for " + deposit.deposit_id);

                        let privateKey = Buffer.from(deposit.address_private_key.substring(2, 66), 'hex');

                        web3.eth.getTransactionCount(deposit.address, 'pending').then((txCount) => {

                            let tx = new Tx({
                                nonce: web3.utils.numberToHex(txCount),
                                gasPrice: web3.utils.numberToHex(web3.utils.toWei(gasGweiPrice.toString(), 'Gwei')),
                                gasLimit: web3.utils.numberToHex(gasLimitErc),
                                to: deposit.contract,
                                value: web3.utils.numberToHex(0),
                                data: tokenData
                            }, {
                                'chain': global.geth_env
                            });

                            tx.sign(privateKey);

                            // Send ERC and wait for confirmation

                            let ercTransaction = web3.eth.sendSignedTransaction('0x' + tx.serialize().toString('hex'))

                            ercTransaction.on('confirmation', confirmation).catch(callback);

                        }).catch((error) => {
                            throw error;
                        });
                    }

                }).catch(callback);

            }).catch((error) => {
                throw error;
            });
        });
    });
};

exports.sendFeeAndWithdrawToMain = sendFeeAndWithdrawToMain;

const ethGas = (callback) => {
    web3.eth.getGasPrice()
        .then(price => callback(Math.round(parseInt(web3.utils.fromWei(price, 'Gwei')) + 10).toString())).catch(error => {
        console.log(error);
        throw error;
    }).catch((error) => {
        console.log(error);
        throw error;
    });
}

exports.ethGas = ethGas;

// Get the latest block
const getLatestBlock = (callback) => {
    web3.eth.getBlockNumber().then(callback).catch(console.log);
}
exports.getLatestBlock = getLatestBlock;

// Get account balance
const getAccountBalance = (address, contract, callback) => {
    if (contract != '') {

        let tokenContract = createTokenContract(contract);

        tokenContract.methods.balanceOf(address).call((error, balance) => {
            if (error) {
                console.log("ERROR HERE ON CONTRACT");
                console.log(contract, error);
            }

            tokenContract.methods.decimals().call((error, decimals) => {
                callback(balance, decimals);
            });
        });
    } else {
        web3.eth.getBalance(address).then(callback);
    }
}
exports.getAccountBalance = getAccountBalance;

const createTokenContract = (address) => {
    return new web3.eth.Contract(require('../../contract/abi'), address);
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

    let bnAmount = new BN(amount);
    let decimal = new BN('10').pow(new BN(decimals));

    return toFixed(bnAmount / decimal);
}

exports.weiToNumber = weiToNumber;

const numberToWei = (amount, decimals) => {
    return toFixed(amount * Math.pow(10, decimals));
}

exports.numberToWei = numberToWei;

// Create a new wallet address
const walletCreate = () => {
    return web3.eth.accounts.create();
};
exports.walletCreate = walletCreate;

// Get transaction details by hash
const getTransaction = (txHash, callback) => {
    web3.eth.getTransaction(txHash).then(callback).catch((error) => {
        console.log(txHash);
    });
}
exports.getTransaction = getTransaction;
