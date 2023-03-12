<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/static/js/moment.js"></script>

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top" style="background:white;box-shadow:1px 1px 2px #aaa;">
        <div class="container">
            <a class="navbar-brand" style="font-size:22px;font-weight:900;color:#2b74e2" href="">
                Admin
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/admin/home.php'){ echo 'active'; } ?>" aria-current="page" href="/admin/home.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" onclick="return confirm('Do you want to Logout?')" href="/admin/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>