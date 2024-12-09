const express = require('express');
const bodyParser = require('body-parser');
const app = express();

app.use(bodyParser.json());

app.post('/send-message', (req, res) => {
    const userMessage = req.body.message;

    // Simulate a reply
    const reply = `You said: "${userMessage}"`;
    res.json({ reply });
});

const PORT = 3000;
app.listen(PORT, () => console.log(`Server running on http://localhost:${PORT}`));

document.addEventListener('DOMContentLoaded', function() {
    fetchDoctors();

    document.getElementById('addDoctorForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const name = document.getElementById('doctorName').value;
        const specialty = document.getElementById('doctorSpecialty').value;

        fetch('/add-doctor', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, specialty })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                fetchDoctors(); // Refresh the doctor list
            }
        });
    });
});

function fetchDoctors() {
    fetch('/doctors')
        .then(response => response.json())
        .then(doctors => {
            const tbody = document.querySelector('#doctorTable tbody');
            tbody.innerHTML = ''; // Clear existing rows
            doctors.forEach(doctor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${doctor.name}</td>
                    <td>${doctor.specialty}</td>
                    <td><button onclick="deleteDoctor(${doctor.id})">Delete</button></td>
                `;
                tbody.appendChild(row);
            });
        });
}

function deleteDoctor(id) {
    fetch(`/delete-doctor/${id}`, {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            fetchDoctors(); // Refresh the doctor list
        }
    });
}