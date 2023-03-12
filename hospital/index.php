<?php 
require("../admin/layout/db.php");
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$sid = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Hospital Home</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/static/js/moment.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top" style="background:white;box-shadow:1px 1px 2px #aaa;">
        <div class="container">
            <a class="navbar-brand" style="font-size:22px;font-weight:900;color:#2b74e2" href="">
                Hospital
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/hospital">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" onclick="return confirm('Do you want to Logout?')" href="/">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-3">
    <h3 class="mt-4" style="color:#2b74e2;display:flex;flex-direction:row;justify-content:space-between">
        <span>Users :</span>
        <span>
            <button type="button" style="color:#fff;background-color:#2b74e2"  class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                Add User
            </button>
        </span>
    </h3>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#2b74e2">Add User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form onsubmit="document.getElementById('loader').style.display='block'" action="/hospital/add.php" method="post">
                    <div class="form-floating mb-3 ">
                        <input required type="text" class="form-control"  name="name" placeholder="Hospital Name">
                        <label>Name</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="number" class="form-control"  name="mobile" placeholder="Mobile">
                        <label>Mobile</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="email" class="form-control"  name="email" placeholder="Email">
                        <label>Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="password" class="form-control"  name="password" placeholder="Password">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="text" class="form-control"  name="address" placeholder="Address">
                        <label>Address</label>
                    </div>
                    <div style="display:flex;justify-content:flex-end">
                        <button class="btn  w-25" style="background-color:#2b74e2;color:#fff">Add</button>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>
    <br>  
    <?php if(isset($_GET["email"]) && isset($_GET["password"])){ 
        $email = $_GET["email"];
        $password = $_GET["password"];
        $result = $conn->query("SELECT * FROM user WHERE email='$email' AND password='$password'");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $uid=$row["id"];
        ?>
        <div class="row mb-2">
            <h5 class="col-6"><span style="color:#2b74e2">Name :</span> <?php echo($row["name"])?></h5>
            <h5 class="col-6"><span style="color:#2b74e2">Email :</span> <?php echo($row["email"])?></h5>
            <h5 class="col-6"><span style="color:#2b74e2">Mobile :</span> <?php echo($row["mobile"])?></h5>
            <h5 class="col-6"><span style="color:#2b74e2">Address :</span> <?php echo($row["address"])?></h5>
        </div>
        <div style="display:flex;justify-content:flex-end;align-items:flex-end" class="mb-2">
            <button type="button" style="color:#fff;background-color:#2b74e2"  class="btn" data-bs-toggle="modal" data-bs-target="#report">
                Upload Report
            </button>
        </div>

        <div class="modal fade" id="report">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color:#2b74e2">Upload New Report</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form onsubmit="document.getElementById('loader').style.display='block'" enctype="multipart/form-data" action="/hospital/report.php" method="post">
                        <input type="hidden" name="id" value="<?php echo($row["id"]) ?>">
                        <input type="hidden" name="email" value="<?php echo($_GET['email']) ?>">
                        <input type="hidden" name="password" value="<?php echo($_GET['password']) ?>">
                        <div class="form-floating mb-3 ">
                            <input required type="text" class="form-control"  name="dname" placeholder="Hospital Name">
                            <label>Docter Name</label>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input required type="file" class="form-control"  name="file" placeholder="File">
                            <label>File</label>
                        </div>
                        <div style="display:flex;justify-content:flex-end">
                            <button class="btn  w-25" style="background-color:#2b74e2;color:#fff">Add</button>
                        </div>
                    </form>
                </div>

                </div>
            </div>
        </div>


        <div class="table-responsive">        
            <table class="table table-striped table-bordered">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Hospital Name</th>
                        <th>Docter Name</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $result1 = $conn->query("SELECT * FROM list WHERE uid='$uid' ORDER BY id DESC");
                    if($result1->num_rows > 0){
                        while($row1 = $result1->fetch_assoc()){
                            $hid = $row1["hid"];
                            $result2 = $conn->query("SELECT * FROM hospital WHERE id='$hid'");
                            while($row2 = $result2->fetch_assoc()){
                            $i++;
                            ?>
                                <tr>
                                    <td style="text-align:center"><?php echo($i) ?></td>
                                    <td><?php echo($row2["name"]) ?></td>
                                    <td><?php echo($row1["dname"]) ?></td>
                                    <td><a href="/hospital/uploads/<?php echo($row1["pdf"]) ?>" target="_blank">Click here</a></td>
                                    
                                </tr>
                            <?php
                        }}
                    }else{
                    ?>
                    <tr>
                        <td style="text-align:center" colspan="5">Nothing Found!</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php }}else{?>
            <p style="text-align:center;color:#444;font-size:18px">User not Found or email ,password is wrong</p>
        <?php }}else{ ?>
        <center>
            <div class="container" style="width: 400px;">
                <h4 class="modal-title" style="color:#2b74e2">Search User</h4>
                <form action="/hospital" method="get">
                    <div class="form-floating mb-3 mt-3">
                        <input required type="email" class="form-control"  name="email" placeholder="email">
                        <label>User Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="password" class="form-control"  name="password" placeholder="password">
                        <label>User Password</label>
                    </div>
                    <div>
                        <button class="btn  w-50" style="background-color:#2b74e2;color:#fff">Search</button>
                    </div>
                </form>
            </div>
        </center>
    <?php } ?>
    <br>
</div>





<script>
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if(urlParams.get('err')){
      document.write("<div id='err' style='position:fixed;bottom:30px; right:30px;background-color:#FF0000;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>"+urlParams.get('err')+"</div>")
    }
    setTimeout(()=>{
        document.getElementById("err").style.display="none"
    }, 3000)
</script>

<script>
    if(urlParams.get('msg')){
      document.write("<div id='msg' style='position:fixed;bottom:30px; right:30px;background-color:#4CAF50;padding:10px;border-radius:10px;box-shadow:2px 2px 4px #aaa;color:white;font-weight:600'>"+urlParams.get('msg')+"</div>")
    }
    setTimeout(()=>{
        document.getElementById("msg").style.display="none"
    }, 3000)
</script>
<script src="/static/js/bootstrap.bundle.js"></script>

</body>
</html>