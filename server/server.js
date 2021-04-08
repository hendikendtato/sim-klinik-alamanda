var mysql = require('mysql')
var dotenv = require('dotenv')
var dateFormat = require('dateformat')
dotenv.config()
// Let’s make node/socketio listen on port 5656
var io = require('socket.io').listen(process.env.PORT)

// Define our db creds
var db = mysql.createConnection({
  host: process.env.DEV_MODE ? process.env.DB_HOST : 'localhost',
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB
})

// Log any errors connected to the db
db.connect(function(err) {
  if (err) console.log(err)
  console.log('Connected to Digital Ocean')
})

// Define/initialize our global vars
var antrianBeliProduk = []
var antrianKonsultasi = []
var antrianPerawatan = []
var isInitCue = false
var socketCount = 0
var date = dateFormat(new Date(), 'yyyy-mm-dd')

io.sockets.on('connection', function(socket) {
  // Socket has connected, increase socket count
  socketCount++
  console.log(socketCount + ' user connected')

  const synchronize = () => {
    // get antrian beli produk
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='${date}' AND keperluan='Beli Produk'`
    )
      .on('result', function(data) {
        antrianBeliProduk.push(data)
      })
      .on('end', function() {
        // Only emit notes after query has been completed
        socket.emit('initial antrian beli', antrianBeliProduk)
      })

    // get antrian konsultasi
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='${date}' AND keperluan='Konsultasi'`
    )
      .on('result', function(data) {
        antrianKonsultasi.push(data)
      })
      .on('end', function() {
        // Only emit notes after query has been completed
        socket.emit('initial antrian konsultasi', antrianKonsultasi)
      })

    // get antrian perawatan
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='${date}' AND keperluan='Perawatan'`
    )
      .on('result', function(data) {
        antrianPerawatan.push(data)
      })
      .on('end', function() {
        // Only emit notes after query has been completed
        socket.emit('initial antrian perawatan', antrianPerawatan)
      })
  }

  socket.on('disconnect', function() {
    socketCount--
  })

  // New antrian beli added, push to all sockets
  socket.on('add antrian beli', function(data) {
    var id = data.antrian.id
    var temp = []
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE id=${id}`
    )
      .on('result', function(data) {
        antrianBeliProduk.push(data)
        temp.push(data)
      })
      .on('end', function() {
        io.sockets.emit('new antrian beli', {
          row: temp,
          index: antrianBeliProduk.length
        })
      })
  })

  // New antrian konsultasi added, push to all sockets
  socket.on('add antrian konsultasi', function(data) {
    var id = data.antrian.id
    var temp = []
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE id=${id}`
    )
      .on('result', function(data) {
        antrianKonsultasi.push(data)
        temp.push(data)
      })
      .on('end', function() {
        io.sockets.emit('new antrian konsultasi', {
          row: temp,
          index: antrianKonsultasi.length
        })
      })
  })

  // New antrian perawatan added, push to all sockets
  socket.on('add antrian perawatan', function(data) {
    var id = data.antrian.id
    var temp = []
    db.query(
      `SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE id=${id}`
    )
      .on('result', function(data) {
        antrianPerawatan.push(data)
        temp.push(data)
      })
      .on('end', function() {
        io.sockets.emit('new antrian perawatan', {
          row: temp,
          index: antrianPerawatan.length
        })
      })
  })

  // Check to see if initial query/notes are set
  if (!isInitCue) {
    // Initial app start, run db query
    synchronize()
    isInitCue = true
  } else {
    // Initial notes already exist, send out
    socket.emit('initial antrian beli', antrianBeliProduk)
    socket.emit('initial antrian konsultasi', antrianKonsultasi)
    socket.emit('initial antrian perawatan', antrianPerawatan)
  }

  // synchronize data
  socket.on('synchronize', function() {
    antrianBeliProduk = []
    antrianKonsultasi = []
    antrianPerawatan = []

    synchronize()

    date = dateFormat(new Date(), 'yyyy-mm-dd')
  })
})
