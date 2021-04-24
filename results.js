var http = require('http');
var url = require('url');
const MongoClient = require('mongodb').MongoClient;
const conn_url = "mongodb+srv://jmasle01:awesome2002@cluster0.uunkx.mongodb.net/myFirstDatabase?retryWrites=true&w=majority";  // connection string goes here

const find_data = (to_find, is_ticker, err_func, callback) => {
  MongoClient.connect(conn_url, { useUnifiedTopology: true }, function (err, db) {
    if (err) {
      console.log("Connection err: " + err); return;
    }
    if (to_find == "" || to_find == null) {
      return
    }
    var dbo = db.db('stock_ticker_app');
    var coll = dbo.collection('companies');
    theQuery = is_ticker? {Ticker:to_find} : {Company:to_find}
    
    coll.find(theQuery).toArray(function (err, items) {
      if (err) {
        console.log("Error: " + err);
      }
      else {
        db.close();
        if (items.length > 0) {
          callback(items[0])
        } else {
          err_func()
        }
      }
    });  //end find		
  });  //end connect
}

http.createServer(function (req, res) {
  res.writeHead(200, { 'Content-Type': 'text/html' });
  var qobj = url.parse(req.url, true).query;
  var company = qobj.company_name;
  var ticker = qobj.ticker

  if (company != "") {
    find_data(company, false, () => {
      res.write("Invalid query")
      res.end()
    }, 
    (item) => {
      res.write("The company is: " + company + "<br>");
      res.write("The ticker is: " + item.Ticker)
      res.end()
    })
  } else {
    find_data(ticker, true, () => {
      res.write("Invalid query")
      res.end()
    },
    (item) => {
      res.write("The company is: " + item.Company + "<br>")
      res.write("The ticker is: " + ticker );
      res.end()
    })
  }
}).listen(8080);

