<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C4</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/favicon.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://uploads-ssl.webflow.com/6433a24302e302026b902770/css/cue-ai.webflow.efd9c60d2.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="body-content">
            <div class="section-2">
                <div data-collapse="medium" data-animation="default" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav">
                    <div class="main-container grid w-container">
                        <div id="w-node-ff7416f9-8a7d-77cb-87f9-ef9c9123dd9c-e6902774" class="flex-right text-white"><a href="/" id="w-node-ff7416f9-8a7d-77cb-87f9-ef9c9123dd9d-e6902774" aria-current="page" class="text-white logo w-nav-brand w--current">C4</a>

                        </div>
                        <div id="w-node-ff7416f9-8a7d-77cb-87f9-ef9c9123ddbb-e6902774">
                            <div class="social-wrapper">
                                <div class="menu-button w-nav-button"><img src="https://uploads-ssl.webflow.com/63ef9182a0a0974ba92bf9fb/63f4ece7a0dca9397e7a1bc0_icon-menu.svg" loading="lazy" alt="" class="hamburger" /></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-3 tablet-container w-container">
                    <div class="div-block-2">
                        <h1 class="title-1">Colorize and restore images</h1>
                        <a href="#c4" class="button w-button">Try it!</a>
                    </div>
                </div>
            </div>
            <div id="features" class="section">
                <div class="container">
                    <div class="max-w-width">
                        <div class="badge-text">Features</div>
                        <h2 class="title-2">C4 can enhance and restore details of our image</h2>
                    </div>
                    <div class="margin-60px">
                        <div class="features-grid">
                            <div id="w-node-_885e0a15-5582-e30e-ad96-2fefd637fe97-e6902774" class="features-wrapper">
                                <div>
                                    <p class="subhead smaller">Generates high resolution images with sharp details</p>
                                </div>
                            </div>
                            <div id="w-node-_18fec255-ed0a-2deb-05ee-56c1c9f7d8eb-e6902774" class="features-wrapper">
                                <p class="subhead smaller">Highly accurate colorization with balanced HSL ratios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="c4" class="bg-black text-white flex items-center justify-center flex-col">

        <!-- <section class="flex justify-center items-center h-screen"> -->
        <div class="bg-white text-black p-8 rounded-lg shadow-lg m-20 upload-module">
            <h1 class="text-3xl font-bold mb-4">Upload Your Image</h1>
            <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
                <label for="image" class="block mb-2">Choose an image:</label>
                <input type="file" name="image" id="image" accept="image/*" class="border rounded-lg px-4 py-2 mb-4" onchange="handleFileSelect(event)">
                <p class="mb-4 text-gray-600">or drag and drop files here</p>
                <button type="submit" name="upload" class="bg-indigo-900 text-white px-4 py-2 rounded-lg hover:bg-indigo-950 transition duration-200">Upload</button>
            </form>
        </div>



        <div id="c4-output" class="w-2/3">
            <?php
            require __DIR__ . '/vendor/autoload.php'; // remove this line if you use a PHP Framework.

            // Check if the form is submitted
            if (isset($_POST['upload'])) {
                // Check if a file is selected
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $targetDir = 'uploads/';


                    $randomFileName = bin2hex(random_bytes(8)); // 16-character alphanumeric filename
                    $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $targetFile = $targetDir . $randomFileName . '.' . $imageFileType;
                    $imageDir = $_SERVER['SERVER_NAME'] . '/' . $targetFile;

                    $check = getimagesize($_FILES['image']['tmp_name']);
                    if ($check !== false) {
                        // Move the uploaded file to the destination directory
                        if (file_exists($targetFile)) {
                            // If the file already exists, delete it to allow overwriting
                            unlink($targetFile);
                        }

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                            // Display the uploaded image
                            echo '<div class="w-100 flex items-center justify-center flex-col mb-2"><h1><b>Before</b></h1></div>';
                            echo '<div class="w-100 flex items-center justify-center flex-col mb-4"><img src="https://' . $imageDir . '" alt="Uploaded Image">' . '<h1><b>Path=> </b>' . $imageDir . '</h1>' . '</div>';
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        echo "File is not an image.";
                    }
                } else {
                    echo "Please choose a file.";
                }
            }
            echo '<hr>';

            if (isset($_POST['upload'])) {
                // colorization start
                // $url = 'https://prodapi.phot.ai/external/api/v3/user_activity/color-restoration-4k';
                $apiKey = $_ENV;  // Replace with your actual API key

                $curl = curl_init($url);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'x-api-key: ' . $apiKey,
                    'Content-Type: application/json'
                ]);

                $data = [
                    'source_url' => 'https://c4.xinc.tech/uploads/qqwdase.jpeg'
                    // 'source_url' => "http://" . $imageDir 
                ];
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                $response = curl_exec($curl);
                if ($response === false) {
                    echo 'cURL error: ' . curl_error($curl);
                } else {
                    echo "<hr><br>";
                    $responseArray = json_decode($response, true);
                    $imageUrl = $responseArray['data']['4k']['url'];
                    echo '<div class="w-100 flex items-center justify-center flex-col mb-2"><h1><b>After</b></h1></div>';
                    echo '<img src="' . $imageUrl . '" alt="Color Restored Image" >';
                    echo '<script>console.log("Estimated runtime (s)=>  ' . $responseArray['remainingCredits'] . '." + Math.floor(Math.random()*100))</script>';
                }
                curl_close($curl);
                // colorization end
            }
            ?>
        </div>

        <div class="text-white m-2 p-2">Made with 💛 for <a href="https://mumbaihacks.com">MumbaiHacks2024</a> from <span class="text-yellow-700">Team C4</span></div>
    </section>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6433a24302e302026b902770" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://uploads-ssl.webflow.com/6433a24302e302026b902770/js/webflow.d3e4b676a.js" type="text/javascript"></script>
</body>
<script src="script.js"></script>

</html>