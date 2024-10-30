const express = require('express');
const bodyParser = require('body-parser');
const db = require('./db');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

const PORT = process.env.PORT || 1234;

// Middleware
app.use(bodyParser.json());

io.on('connection', (socket) => {
  console.log('New client connected');

  socket.on('locationUpdate', async (data, callback) => {
    console.log('Received locationUpdate:', data);
    const { latitude, longitude, timestamp, userId } = data;

    try {
      const [result] = await db.query(
        'INSERT INTO locations (latitude, longitude, timestamp, user_id) VALUES (?, ?, ?, ?)',
        [latitude, longitude, timestamp, userId]
      );

      // Emit location data to all connected clients
      io.emit('locationUpdate', { latitude, longitude, timestamp, userId });

      // Send acknowledgment back to the client
      callback({ status: 'success', id: result.insertId });
    } catch (error) {
      console.error('Error inserting location:', error);
      callback({ status: 'error', message: error.message });
    }
  });

  socket.on('disconnect', () => {
    console.log('Client disconnected');
  });
});

app.get('/locations', async (req, res) => {
  const { userId } = req.query;

  try {
    const [rows] = await db.query(
      'SELECT * FROM locations WHERE user_id = ? ORDER BY timestamp ASC',
      [userId]
    );

    res.status(200).send(rows);
  } catch (error) {
    console.error('Error fetching locations:', error);
    res.status(400).send({ error: error.message });
  }
});

server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
