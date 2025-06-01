<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ./login/');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./src/css/home.css">
    <title>Black Ninja</title>
</head>

<body>
    <header>
        <h1><i class="fas fa-user-ninja icon"></i> Black Ninja</h1>
        <button type="button" class="btn btn-danger" onclick="logout()"><i class="fas fa-sign-out-alt icon"></i>
            Logout</button>
    </header>

    <div class="container">
        <button id="createBtn" class="btn"><i class="fas fa-plus icon"></i>Create New Game</button>

        <div id="my-games">
            <h3>My Games</h3>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./src/js/home.js"></script>

    <script>
        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                background: '#000000',
                color: '#e0e0e0',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Logged out!',
                        text: 'You have been successfully logged out.',
                        icon: 'success',
                        background: '#000000',
                        color: '#e0e0e0',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = './logout/';
                    });
                }
            });
        }
    </script>
</body>

</html>