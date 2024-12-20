const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
app.use(bodyParser.json());

// Configura tu conexión a la base de datos
const connection = mysql.createConnection({
    host: 'localhost',  // Cambia esto si tu base de datos está en otro host
    user: 'root',       // Tu usuario de MySQL
    password: '',       // Tu contraseña de MySQL
    database: 'chatbot' // El nombre de tu base de datos
});

connection.connect(err => {
    if (err) {
        console.error('Error connecting to the database:', err);
        return;
    }
    console.log('Connected to the database.');
});

// Ruta para obtener la respuesta
app.post('/get-response', (req, res) => {
    const userMessage = req.body.message;

    // Consulta a la base de datos
    const query = 'SELECT response FROM responses WHERE question = ?';
    connection.query(query, [userMessage], (err, results) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).send('Error executing query');
            return;
        }

        if (results.length > 0) {
            res.json({ response: results[0].response });
        } else {
            res.json({ response: 'No se encontró una respuesta para tu pregunta.' });
        }
    });
});

const PORT = process.env.PORT || 3300;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});