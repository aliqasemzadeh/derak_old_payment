const bodyParser = require('body-parser')
const methods = require('../methods');
const axios = require('axios');

const gateways = (app) => {

    app.use( bodyParser.json() );
    app.use(bodyParser.urlencoded({
        extended: true
    }));

    app.post('/wallet/transfer/to/main', function (req, res) {
        try {
            console.log("Trying to transfer to the main wallet");
            methods.walletTransferToMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);
                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {
                    console.log('Tx Confirmed ' + receipt.transactionHash);
                }
            });
            res.end(JSON.stringify({ message: "Started transferring to main wallet" }));
        } catch (error) {
            console.log(error)
            res.end(JSON.stringify({ message: "Not successful" }));
        }

    });

    app.post('/wallet/withdraw/eth', function (req, res) {

        console.log("Trying to withdraw from the main wallet");

        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Eth Withdraw Tx Failed with id ' + req.body.id);
                    });

                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {
                    console.log('Eth Withdraw Tx Confirmed ' + receipt.transactionHash + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.transactionHash, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Eth Withdraw Tx Confirmed updated');
                    });

                }
            });
            res.end(JSON.stringify({ message: "Started eth withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }
    });

    app.post('/wallet/withdraw/erc', function (req, res) {

        console.log("Trying to withdraw erc from the main wallet");

        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Erc Withdraw Tx Failed with id ' + req.body.id);
                    });

                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {
                    console.log('Erc Withdraw Tx Confirmed ' + receipt.transactionHash + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.transactionHash, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Erc Withdraw Tx Confirmed updated');
                    });

                }
            });
            res.end(JSON.stringify({ message: "Started erc withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
        }
    });

    app.post('/wallet/balance/eth', function (req, res) {

        console.log("Get ETH balance of " + req.body.address);

        try {
            methods.getAccountBalance(req.body.address, '', (balance) => {
                if (balance instanceof Error) {
                    console.log("Error instance received");
                    console.log(balance);
                    res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
                } else {
                    res.end(JSON.stringify({ success: true, message: methods.weiToNumber(balance, 18) }));
                }
            });

        } catch (error) {
            console.log(error);
            res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
        }
    });

    app.post('/wallet/balance/erc', function (req, res) {

        console.log("Get ERC balance of " + req.body.address + " with contract " + req.body.contract);

        try {
            methods.getAccountBalance(req.body.address, req.body.contract, (balance, decimals) => {
                if (balance instanceof Error) {
                    console.log("Error instance received");
                    console.log(balance);
                    res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
                } else {
                    res.end(JSON.stringify({ success: true, message: methods.weiToNumber(balance,decimals) }));
                }
            });

        } catch (error) {
            console.log(error);
            res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
        }
    });

    /*************************************************************************************************************
     * ************************************************************************************************************
     * ERC
     */

    app.post('/wallet/transfer/to/main/wallet/erc', function (req, res) {

        console.log("Trying to transfer erc token to the main wallet");
        try {
            methods.walletTransferErcToMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);
                } else {
                    console.log(receipt);
                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {


                    global.database.query('UPDATE deposits SET wallet_transfer_status = ? WHERE id = ?', ['processed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Erc Deposit Transferred with id ' + req.body.id);
                    });


                    console.log('Erc Tx Confirmed ' + receipt.transactionHash + ' for ' + req.body.id);
                }
            });
            res.end(JSON.stringify({ message: "Started transferring erc to main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }

    });

    app.get('/wallet/create', function (req, res) {
        let accountWallet = methods.walletCreate();
        res.send(JSON.stringify(accountWallet));
    });
}

exports.gateways = gateways;
