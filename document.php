<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Documents</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 200vh; /* Increase height of the body */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: linear-gradient(to bottom, #f0a5a5, #800000); /* Light red to dark red gradient */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .documents-container {
            display: flex;
            flex-direction: column; /* Align items vertically */
            align-items: center; /* Center items horizontally */
            width: 100%;
        }

        .flip-card {
            background-color: transparent;
            width: 300px; /* Adjust width as needed */
            height: 300px; /* Adjust height as needed */
            perspective: 1000px;
            margin-bottom: 40px; /* Add margin to create gap */
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
                        border-radius:25px;

        }

        .flip-card-front {
            background-image: linear-gradient(to bottom, white, #98FB98, #ADFF2F);
            color: black;
        }

        .flip-card-back {
            background-image: linear-gradient(to bottom, white, #ADD8E6, #87CEEB);
            color: white;
            transform: rotateY(180deg);
        }

        .flip-card-back img {
            max-width: 60%; /* Decrease image size */
            max-height: 60%; /* Decrease image size */
            object-fit: cover;
        }

        .document {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: black;
        }

        .document-number {
            background-color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
        }

        .document-info h2 {
            margin-bottom: 10px;
        }

        .requirements {
            text-align: left;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Barangay Document Requirements</h1>
    <div class="documents-container">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="document-number">1.</div>
                    <div class="document-info">
                        <h2>Barangay Clearance Requirements</h2>
                        <div class="requirements">
                            <ul>
                                <li>Application Form</li>
                                <li>Valid ID</li>
                                <li>Certificate of Residency</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <a href="display_user.php" class="document">
                        <div class="document-number">1</div>
                        <div class="document-info">
                            <div class="requirements">
                                <ul>
                                    <p>Barangay Clearance</p>
                                    <img src="clear.png" alt="Back Image">
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Repeat the above structure for other documents -->

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="document-number">2</div>
                    <div class="document-info">
                        <h2>Barangay ID Requirements</h2>
                        <div class="requirements">
                            <ul>
                                <li>Application Form</li>
                                <li>1x1 ID Photo</li>
                                <li>PSA/NSO/Birth Certificate</li>
                                <li>Certificate of Residency</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <a href="display_user.php" class="document">
                        <div class="document-number">2</div>
                        <div class="document-info">
                            <div class="requirements">
                                <ul>
                                    <p>Barangay ID</p>
                                    <img src="idB.png" alt="Back Image">
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="document-number">3</div>
                    <div class="document-info">
                        <h2>Barangay Blotter Requirements</h2>
                        <div class="requirements">
                            <ul>
                                <li>Application Form</li>
                                <li>Valid ID</li>
                                <li>Certificate of Residency</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <a href="display_user.php" class="document">
                        <div class="document-number">3</div>
                        <div class="document-info">
                            <div class="requirements">
                                <ul>
                                    <p>Barangay Blotter</p>
                                    <img src="blotter.png" alt="Back Image">
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="document-number">4</div>
                    <div class="document-info">
                        <h2>Business Permit Requirements</h2>
                        <div class="requirements">
                            <ul>
                                <li>Application Form</li>
                                <li>Valid ID</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <a href="display_user.php" class="document">
                        <div class="document-number">4</div>
                        <div class="document-info">
                            <div class="requirements">
                                <ul>
                                    <p>Business Permit</p>
                                    <img src="business.png" alt="Back Image">
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <div class="document-number">5</div>
                    <div class="document-info">
                        <h2>Brgy. Health Cert Requirements</h2>
                        <div class="requirements">
                            <ul>
                                <li>Application Form</li>
                                <li>Valid ID</li>
                                <li>Certificate of Residency</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flip-card-back">
                    <a href="display_user.php" class="document">
                        <div class="document-number">5</div>
                        <div class="document-info">
                            <div class="requirements">
                                <ul>
                                    <p>Brgy. Health Cert</p>
                                    <img src="med.png" alt="Back Image">
                                </ul>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.flip-card').forEach((flipCard) => {
            flipCard.addEventListener('click', () => {
                flipCard.classList.toggle('flip');
            });
        });
    </script>
</body>
</html>

