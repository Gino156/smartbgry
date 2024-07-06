<?php
// Folder path where images are stored
$folder_path = 'uploads';

// Get list of all files in the folder
$files = scandir($folder_path);

// Sort files by modification time, latest first
array_multisort(array_map('filemtime', $files), SORT_DESC, $files);

// Filter out only image files
$image_files = array_filter($files, function($file) {
    $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']);
});

// Define fixed width and height for images
$image_width = 200;
$image_height = 200;

// Counter for aligning images horizontally
$image_count = 0;

// Display images
foreach ($image_files as $image) {
    // Get image dimensions
    $image_path = $folder_path . '/' . $image;

    // Start a new row after every 5 images
    if ($image_count % 5 == 0) {
        echo '<div class="image-row">';
    }

    // Template for each image with fixed dimensions
    echo '<div class="image-container" style="width: ' . $image_width . 'px; height: ' . $image_height . 'px;">';
    echo '<img src="' . $image_path . '" alt="Image" style="width: 100%; height: 100%;">';
    // You can customize the template further here
    echo '</div>';

    // End the row after every 5 images
    if (($image_count + 1) % 5 == 0 || $image_count == count($image_files) - 1) {
        echo '</div>';
    }

    $image_count++;
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Images</title>
    <style>
        .images-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around; /* Adjust alignment */
            align-items: flex-start; /* Adjust alignment */
        }
        .image-container {
            margin: 10px;
        }
        .image-container img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
    <div class="images-container"></div>

    <script>
        // Fetch image URLs from the server
        fetch('get_image_urls.php') // Adjust URL if necessary
            .then(response => response.json())
            .then(imageUrls => {
                const imagesContainer = document.querySelector('.images-container');

                // Loop through the image URLs and create image elements
                imageUrls.forEach(imageUrl => {
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('image-container');

                    const imageElement = document.createElement('img');
                    imageElement.src = imageUrl; // Assuming imageUrl contains the full path
                    imageElement.alt = 'Image';

                    // Append image element to the image container
                    imageContainer.appendChild(imageElement);
                    imagesContainer.appendChild(imageContainer);
                });
            })
            .catch(error => console.error('Error fetching image URLs:', error));
    </script>
</body>
</html>

