<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: black; 
            margin: 20px;
        }

        .contact-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .section-container {
            border: 2px solid black; 
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .contact-details,
        .user-input {
            width: 100%;
            margin-bottom: 20px;
            color: black; 
        }

        .contact-details,
        .user-input {
            text-align: left;
        }

        .contact-details h2,
        .user-input h2 {
            color: black; 
            margin-bottom: 10px;
        }

        .contact-details p {
            color: #555;
            margin: 5px 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-submit {
            background-color: #007bff;
            color: black; 
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #007bff;
        }

        .form-control {
            border-radius: 5px;
            color: black; 
        }

        h1 {
            color: black; 
            margin-bottom: 10px;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    @include('Navigation')
    <div class="contact-container">
        <h1>Contact Us</h1>

        <div class="section-container contact-details">
            <p>Email: gains@gmail.com</p>
            <p>Phone: 01332 345475</p>
            <p>Address: 64 Striker Lane, Kensington, London, W8 4AB</p>
        </div>

        <div class="section-container user-input">
            <h2>Send us a message:</h2>
            <form id="contactForm">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="button" class="btn-submit" onclick="submitForm()">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function submitForm() {
            alert('Form submitted!');
        }
    </script>

</body>

</html>
