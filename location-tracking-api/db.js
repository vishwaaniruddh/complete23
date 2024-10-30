const mysql = require('mysql2');


// Replace with your actual MySQL credentials
const pool = mysql.createPool({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'location-tracking-api'
  });
module.exports = pool.promise();
