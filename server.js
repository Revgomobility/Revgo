// server.js
const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Serve the HTML form (Assuming the form is in the public directory)
app.use(express.static('public')); // Make sure your HTML is in the 'public' folder

// Route to handle form submission
app.post('/submit-form', async (req, res) => {
    const { name, email, vehicle, note } = req.body;

    // Nodemailer configuration
    let transporter = nodemailer.createTransport({
        service: 'gmail', // For Gmail, you can change the service to match your email provider
        auth: {
            user: process.env.EMAIL_USER, // Your email (set in the .env file)
            pass: process.env.EMAIL_PASS, // Your email password or app password
        },
    });

    // Email options
    let mailOptions = {
        from: process.env.EMAIL_USER,
        to: 'hello@revgo.xyz', // Receiver email
        subject: 'New Vehicle Form Submission',
        text: `Name: ${name}\nEmail: ${email}\nVehicle: ${vehicle}\nNote: ${note}`,
    };

    // Send email
    try {
        await transporter.sendMail(mailOptions);
        res.send('Form submitted successfully. You will be contacted soon.');
    } catch (error) {
        console.error('Error sending email:', error);
        res.status(500).send('Error occurred while sending the form details.');
    }
});

// Start the server
app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});
