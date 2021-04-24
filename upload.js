const MongoClient = require('mongodb').MongoClient;
const url = 'mongodb+srv://jmasle01:awesome2002@cluster0.uunkx.mongodb.net/myFirstDatabase?retryWrites=true&w=majority';  // connection string goes here

// from https://stackabuse.com/reading-and-writing-csv-files-with-node-js/
const csv = require('csv-parser');
const fs = require('fs');

function main() {
  MongoClient.connect(url, { useUnifiedTopology: true }, function (err, db) {
    if (err) { return console.log(err); }

    var dbo = db.db('stock_ticker_app');
    var collection = dbo.collection('companies');

    fs.createReadStream('companies.csv')
      .pipe(csv())
      .on('data', (row) => {
        collection.insertOne(row, function(err, res) {
          if (err) { console.log("query err: " + err); return; }
        })
      })
      .on('end', () => {
        console.log('CSV file successfully processed');
      });
  });
}

main();