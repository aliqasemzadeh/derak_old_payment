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

    app.post('/wallet/withdraw/bnb', function (req, res) {

            console.log("Trying to withdraw from the main wallet");
        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('BNB Withdraw Tx Failed with id ' + req.body.id);
                    });
                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {
                    console.log('BNB Withdraw Tx Confirmed ' + receipt.transactionHash + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.transactionHash, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('BNB Withdraw Tx Confirmed updated');
                    });

                }
            });
            res.end(JSON.stringify({ message: "Started BNB withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }
    });

    app.post('/wallet/withdraw/bep', function (req, res) {

        console.log("Trying to withdraw bep from the main wallet");

        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('BEP Withdraw Tx Failed with id ' + req.body.id);
                    });

                }
            }, (confirmation, receipt) => {
                if (confirmation == 1 && receipt.transactionHash) {
                    console.log('BEP Withdraw Tx Confirmed ' + receipt.transactionHash + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.transactionHash, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('BEP Withdraw Tx Confirmed updated');
                    });

                }
            });
            res.end(JSON.stringify({ message: "Started bep withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
        }
    });

    app.post('/wallet/balance/bnb', function (req, res) {

        console.log("Get BNB balance of " + req.body.address);

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

    app.post('/wallet/balance/bep', function (req, res) {

        console.log("Get BEP balance of " + req.body.address + " with contract " + req.body.contract);

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


    app.get('/blockchain/latest/block', function (req, res) {
        methods.getLatestBlock((block) => {
            res.end(block.toString());
        });
    });


    /*************************************************************************************************************
     * ************************************************************************************************************
     * bep
     */

    app.post('/wallet/transfer/to/main/wallet/bep', function (req, res) {

        console.log("Trying to transfer bep token to the main wallet");
        try {
            methods.walletTransferBepToMainWallet(req.body, (receipt) => {
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
                        console.log('Bep Deposit Transferred with id ' + req.body.id);
                    });


                    console.log('Bep Tx Confirmed ' + receipt.transactionHash + ' for ' + req.body.id);
                }
            });
            res.end(JSON.stringify({ message: "Started transferring bep to main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }

    });

    app.get('/wallet/create', function (req, res) {

        let accountWallet = methods.walletCreate();
        accountWallet.address = accountWallet.address.toLowerCase();

        res.send(JSON.stringify(accountWallet));
    });
}

exports.gateways = gateways;
