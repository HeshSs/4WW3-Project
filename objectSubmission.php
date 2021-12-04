<?php
require_once 'config/config.php';
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
    header('location: login.php');
    exit;
}

// Define variables and initialize with empty values
$name = $latitude = $longitude = $location_type = $description = "";
$name_err = $latitude_err = $longitude_err = $location_type_err = $description_err = "";

// Process submitted form datas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validate Name
    if (empty(trim($_POST['name']))) {
        $name_err = "Please enter a Location Name.";
    }

    //Validate Latitude
    if (empty(trim($_POST['latitude']))) {
        $latitude_err = "Please enter a Latitude.";
    }

    //Validate Longitude
    if (empty(trim($_POST['longitude']))) {
        $longitude_err = "Please enter a Longitude.";
    }

    //Validate Location Type
    if (empty(trim($_POST['location_type']))) {
        $location_type_err = "Please enter a Location Type.";
    }

    //Validate Description
    if (empty(trim($_POST['description']))) {
        $description_err = "Please enter a Description.";
    }

    if (empty($name_err) && empty($latitude_err) && empty($longitude_err) && empty($location_type_err) && empty($description_err)) {

        // Prepare insert statement
        $sql = 'INSERT INTO spots (name, latitude, longitude, location_type, description) VALUES (?,?,?,?,?)';

        if ($stmt = $mysql_db->prepare($sql)) {
            // Set parmater
            $param_name = $_POST['name'];
            $param_latitude = $_POST['latitude'];
            $param_longitude = $_POST['longitude'];
            $param_location_type = $_POST['location_type'];
            $param_description = $_POST['description'];

            // Bind param variable to prepares statement
            $stmt->bind_param('sddss', $param_name, $param_latitude, $param_longitude, $param_location_type, $param_description);

            // Attempt to execute
            if ($stmt->execute()) {
                // Redirect to login page
                header('location: ./success.php');
                // echo "Will  redirect to login page";
            } else {
                header('location: ./failure.php');
            }

            // Close statement
            $stmt->close();
        }

        // Close connection
        $mysql_db->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <style>
        .wrapper {
            width: 500px;
            padding: 20px;
        }

        .wrapper h2 {
            text-align: center
        }

        .wrapper form .form-group span {
            color: red;
        }
    </style>
</head>

<body>
    <?php include './common/header.php'; ?>
    <main>
        <section class="container wrapper">
            <div class="page-header">
                <h2 class="display-5">Welcome <?php echo $_SESSION['username']; ?>, <br /> Please fill and submit the form. </h2>
            </div>
            <div>
                <form enctype="multipart/form-data" id='UploadForm'>
                    <div class="form-group">
                        <label for="s3imageupload">Upload the image.</label>
                        <input id="image" name="image" type="file" class="form-control-file" id="s3imageupload">
                    </div>
                    <div class="form-group">
                        <input id="UploadImage" type="button" class="btn btn-block btn-outline-secondary" value="Uplaod Image">
                    </div>
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group <?php (!empty($name_err)) ? 'has_error' : ''; ?>">
                        <label for="name">Location Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $name ?>">
                        <span class="help-block"><?php echo $name_err; ?></span>
                    </div>

                    <div class="form-group <?php (!empty($latitude_err)) ? 'has_error' : ''; ?>">
                        <label for="latitude">Latitude</label>
                        <input type="number" step="any" name="latitude" id="latitude" class="form-control" value="<?php echo $latitude ?>">
                        <span class="help-block"><?php echo $latitude_err; ?></span>
                    </div>

                    <div class="form-group <?php (!empty($longitude_err)) ? 'has_error' : ''; ?>">
                        <label for="longitude">Longitude</label>
                        <input type="number" step="any" name="longitude" id="longitude" class="form-control" value="<?php echo $longitude ?>">
                        <span class="help-block"><?php echo $longitude_err; ?></span>
                    </div>

                    <div class="form-group <?php (!empty($location_type_err)) ? 'has_error' : ''; ?>">
                        <label for="location_type">Location Type</label>
                        <input type="text" name="location_type" id="location_type" class="form-control" value="<?php echo $location_type ?>">
                        <span class="help-block"><?php echo $location_type_err; ?></span>
                    </div>

                    <div class="form-group <?php (!empty($description_err)) ? 'has_error' : ''; ?>">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="<?php echo $description ?>">
                        <span class="help-block"><?php echo $description_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-outline-primary" value="Submit">
                        <input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
                    </div>
                </form>
            </div>

        </section>
    </main>
</body>
<script>
    const StartUpload = () => {
        const fileInput = $('#image').get(0).files[0];
        if (fileInput) {
            const formdata = new FormData();
            formdata.append("image", fileInput);
            console.log('coming here');
            $.ajax({
                url: "http://3.109.123.151:3050/api/upload/image",
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(data) {
                    if (data.status === 1) {
                        console.log(data)
                    } else {
                        alert("Something went wrong: " + data.msg)
                    }
                },
                error: function() {
                    alert("Can't connect to network.")
                }
            });
        } else {
            console.log("Please upload File.")
        }

    }
    $(document).ready(function() {
        $('#UploadImage').click(function() {
            StartUpload();
        });
    });
</script>

</html>