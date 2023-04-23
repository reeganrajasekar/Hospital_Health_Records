<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>USER Home</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/static/js/moment.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top" style="background:white;box-shadow:1px 1px 2px #aaa;">
        <div class="container">
            <a class="navbar-brand" style="font-size:22px;font-weight:900;color:#2b74e2" href="">
                User
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/signin.php">Hospital</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-3">

    <?php
    require("./admin/layout/db.php"); 
    if(isset($_GET["email"]) && isset($_GET["password"]) ){ 
        if($_GET["otpold"]==$_GET["otpnew"]){
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


        <div class="table-responsive">        
            <table class="table table-striped table-bordered">
                <thead style="text-align:center">
                    <tr>
                        <th>#</th>
                        <th>Hospital Name</th>
                        <th>Docter Name</th>
                        <th>Description</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
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
                                    <td><?php echo($row1["data"]) ?></td>
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
    <?php }}else{
        ?>
            <p style="text-align:center;color:#444;font-size:18px">OTP NOT VALID</p>
            <a  style="display:block;text-align:center;color:#444;font-size:18px" href="/hospital">Check again</a>
        <?php
    }}else{ ?>
        <center>
            <div class="container" style="width: 400px;">
                <h4 class="modal-title" style="color:#2b74e2">User Login</h4>
                <form action="/" method="get">
                    <div class="form-floating mb-3 mt-3">
                        <input required type="email" class="form-control"  name="email" placeholder="email">
                        <label>User Email</label>
                    </div>
                    <div class="form-floating mb-3 mt-3">
                        <input required type="password" class="form-control"  name="password" placeholder="password">
                        <label>User Password</label>
                    </div>
                    <div id="btn">
                        <button type="button" onclick="otp()" class="btn  w-50" style="background-color:#2b74e2;color:#fff">GET OTP</button>
                    </div>
                    <div id="otp" style="display:none">
                        <div class="form-floating mb-3 mt-3">
                            <input required type="number" class="form-control"  name="otpnew" placeholder="OTP">
                            <label>Enter OTP</label>
                        </div>
                        <button class="btn  w-50" style="background-color:#2b74e2;color:#fff">Search</button>
                    </div>
                </form>
            </div>
        </center>
    <?php } ?>
    <br>
</div>

<script>
    function otp(){
        var otp = Math.floor(100000 + Math.random() * 900000);
        document.getElementById("otp").style.display = "block"
        document.getElementById("btn").innerHTML=`
        <input type="hidden" name="otpold" value="${otp}">
        <p class="alert alert-primary" style="position:fixed;bottom:10px;right:50px">Your OTP is ${otp}</>
        `
    }
</script>




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