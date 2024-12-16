<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us </title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
        .video-section {
            margin-top: 30px;
        }
        .ordered-list-section {
            margin-top: 30px;
        }
        .ordered-list-section ol {
            padding-left: 20px;
            list-style-type: decimal;
        }
        .ordered-list-section li {
            margin-bottom: 10px;
        }
        /* Enhance the appearance of the form card */
.card {
    border-radius: 10px;
    background-color: #f8f9fa;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Input focus effect */
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button style */
.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

/* Add some spacing between the form elements */
.form-group {
    margin-bottom: 1.5rem;
}

.header {
 background-color:#3498db;
 padding: 20px;
 text-align: center;
 font-size: 35px;
 color: #333;
}


/* Responsive card */
@media (max-width: 767px) {
    .card {
        padding: 15px;
    }
}

    </style>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (including Popper.js for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    
</head>
<body>
<div class="header">
 <h1>Contact Us</h1>
</div>
    <div class="container py-5">

        <div class="video-section text-center">
            <h2 class="mb-4">Watch Our Introduction</h2>
            <video controls width="650">
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- Ordered List Section -->
        <div class="ordered-list-section">
            <h2 class="text-center mb-4">How to Contact Us</h2>
            <ol>
                <li>Fill in your details in the form above.</li>
                <li>Click the "Submit" button to send your message.</li>
                <li>Wait for our team to reach out to you within 24-48 hours.</li>
                <li>If you have urgent queries, call us at <strong>(123) 456-7890</strong>.</li>
            </ol>
        </div>

        <!-- Contact Form -->
        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="text-center mb-4">Contact Us</h3>
                    <form action="process_contact.php" method="POST">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject of your message" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



    </div>
    <div>
  <p><a  href="logout.php"><button > Logout</button></a></p>
</div>




</body>
</html>
