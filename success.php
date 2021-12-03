<?php
// Initialize session
session_start();

if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
    header('location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Well done! <?php echo $_SESSION['username']; ?></h4>
                    <p>You have submitted the form Successfully!</p>
                    <hr>
                    <p class="mb-0">If you want to add another Location so click on the Button.</p>
                </div>
            </div>
            <form action="objectSubmission.php" class="form-inline my-2 my-lg-0">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Add More</button>
            </form>
        </section>
    </main>
</body>
<script>
    $('#spot_form').on('submit', function(e) {
        // Prevent form submission by the browser
        e.preventDefault();

        // Rest of the logic
    });
</script>

</html>