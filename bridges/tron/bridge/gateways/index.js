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

    app.post('/wallet/withdraw/trx', function (req, res) {

        console.log("Trying to withdraw from the main wallet");

        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error || (receipt && !receipt.txid)) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Trx Withdraw Tx Failed with id ' + req.body.id);
                    });

                } else {

                    console.log('Trx Withdraw Tx Confirmed ' + receipt.txid + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.txid, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Trx Withdraw Tx Confirmed updated');
                    });

                    console.log(receipt);
                }

            });
            res.end(JSON.stringify({ message: "Started eth withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }
    });

    app.post('/wallet/withdraw/trc', function (req, res) {

        console.log("Trying to withdraw from the main wallet");

        try {
            methods.walletWithdrawFromMainWallet(req.body, (receipt) => {
                if (receipt instanceof Error || (receipt && !receipt.txid)) {
                    console.log("Error instance received");
                    console.log(receipt);

                    global.database.query('UPDATE withdrawals SET status = ? WHERE id = ?', ['failed', req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Trc Withdraw Tx Failed with id ' + req.body.id);
                    });

                } else {

                    console.log('Trc Withdraw Tx Confirmed ' + receipt.txid + ' with id ' + req.body.id);

                    global.database.query('UPDATE withdrawals SET txn = ? WHERE id = ?', [receipt.txid, req.body.id], function (error) {
                        if (error) throw error;
                        console.log('Trc Withdraw Tx Confirmed updated');
                    });


                    console.log(receipt);
                }

            });
            res.end(JSON.stringify({ message: "Started eth withdrawing from the main wallet" }));
        } catch (error) {
            res.end(JSON.stringify({ message: "Not successful" }));
            return console.log(error);
        }

    });

    app.post('/wallet/balance/trx', function (req, res) {

        console.log("Get Tron balance of " + req.body.address);

        try {
            methods.getAccountBalance(req.body.address, '', async (balance) => {
                if (balance instanceof Error) {
                    console.log("Error instance received");
                    console.log(balance);
                    res.end(JSON.stringify({success: false, message: "Could not fetch balance"}));
                } else {
                    let accountBalance = await methods.weiToNumber(balance, 6);
                    res.end(JSON.stringify({success: true, message: accountBalance}));
                }
            });

        } catch (error) {
            console.log(error);
            res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
        }
    });

    app.post('/wallet/balance/trc', function (req, res) {

        console.log("Get TRC balance of " + req.body.address + " with contract " + req.body.contract);

        try {
            methods.getAccountBalance(req.body.address, req.body.contract, async (balance, decimals) => {
                if (balance instanceof Error) {
                    console.log("Error instance received");
                    console.log(balance);
                    res.end(JSON.stringify({success: false, message: "Could not fetch balance"}));
                } else {
                    let accountBalance = await methods.weiToNumber(balance, decimals);
                    res.end(JSON.stringify({success: true, message: accountBalance}));
                }
            });

        } catch (error) {
            console.log(error);
            res.end(JSON.stringify({ success: false, message: "Could not fetch balance" }));
        }
    });
}

exports.gateways = gateways;
