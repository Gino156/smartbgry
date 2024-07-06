<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Handa</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
            color: #fff;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #45a049;
        }

        #forecastInfo {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            text-align: left;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            color: #333;
        }

        #forecastInfo.show {
            opacity: 1;
            transform: translateY(0);
        }

        #forecastInfo div {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        #forecastInfo h2 {
            margin-top: 0;
        }

        #forecastInfo p {
            margin: 5px 0;
            flex: 1;
        }

        .icon {
            margin-right: 10px;
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        #forecastInfo div:hover .icon {
            transform: scale(1.2);
        }

        footer {
            position: absolute;
            bottom: 10px;
            font-size: 0.9em;
            color: #ddd;
        }
    </style>
</head>
<body>
    
    
    
    
    
    
    <h1>Weather Forecast</h1>
    <button onclick="getLocation()">Get My Location</button>
    <div id="forecastInfo">
        Click the button to get your location and see the forecast.
    </div>
    
    
    
    
        <p>Visit <a href="https://typhoon2000.org/">Typhoon2000.org</a> for typhoon-related information.</p>

    <footer>Powered by WeatherAPI.com</footer>
    
    <!-- Back button -->
    <button onclick="goBack()">Back</button>

    <script>
        // Function to get the user's current location with high accuracy
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(fetchWeather, showError, {
                    enableHighAccuracy: true,
                    timeout: 10000,  // Increased timeout for better accuracy
                    maximumAge: 0
                });
            } else {
                document.getElementById('forecastInfo').innerHTML = 'Geolocation is not supported by this browser.';
            }
        }

        // Function to handle errors with geolocation
        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById('forecastInfo').innerHTML = 'User denied the request for Geolocation.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById('forecastInfo').innerHTML = 'Location information is unavailable.';
                    break;
                case error.TIMEOUT:
                    document.getElementById('forecastInfo').innerHTML = 'The request to get user location timed out.';
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById('forecastInfo').innerHTML = 'An unknown error occurred.';
                    break;
            }
        }

        // Function to fetch weather data for the user's location
        function fetchWeather(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            const apiKey = '3b0529e0edcc41c582384205240506';
            const apiUrl = `https://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${latitude},${longitude}&days=3`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    // Extract relevant information from the response
                    const location = data.location.name;
                    const country = data.location.country;
                    const forecast = data.forecast.forecastday;

                    // Construct HTML to display forecast information
                    let forecastHtml = `<h2>Forecast for ${location}, ${country}</h2>`;
                    forecast.forEach(day => {
                        const date = day.date;
                        const condition = day.day.condition.text;
                        const conditionIcon = day.day.condition.icon;
                        const maxTemp = day.day.maxtemp_c;
                        const minTemp = day.day.mintemp_c;
                        forecastHtml += `
                            <div>
                                <img src="https://cdn-icons-png.flaticon.com/512/747/747310.png" class="icon" alt="Date Icon">
                                <p>Date: ${date}</p>
                            </div>
                            <div>
                                <img src="${conditionIcon}" class="icon" alt="Condition Icon">
                                <p>Condition: ${condition}</p>
                            </div>
                            <div>
                                <img src="https://cdn-icons-png.flaticon.com/512/4814/4814268.png" class="icon" alt="Max Temp Icon">
                                <p>Max Temperature: ${maxTemp}°C</p>
                            </div>
                            <div>
                                <img src="https://cdn-icons-png.flaticon.com/512/4814/4814280.png" class="icon" alt="Min Temp Icon">
                                <p>Min Temperature: ${minTemp}°C</p>
                            </div>
                        `;
                    });

                    // Update the forecastInfo div with the forecastHtml and add show class
                    const forecastInfoDiv = document.getElementById('forecastInfo');
                    forecastInfoDiv.innerHTML = forecastHtml;
                    forecastInfoDiv.classList.add('show');
                })
                .catch(error => {
                    console.error('Error fetching weather data:', error);
                    document.getElementById('forecastInfo').innerHTML = 'Failed to fetch weather data';
                });
        }
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
