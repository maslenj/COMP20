let mongo = require('mongodb')

mongo.MongoClient.connect(
  '',
  { useUnifiedTopology: true },
  (err, db) => {
    if (err) {
      console.log(err)
      return
    }
    let dbo = db.db('textbooks')
    let collection = dbo.collection('books')

    console.log("before find")
    let s = collection.find().stream()
    s.on('data', (item) => {
      console.log(item)
    })

    console.log("after find")
  }
)






