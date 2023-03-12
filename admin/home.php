<?php require("./layout/Header.php") ?>
<?php require("./layout/db.php") ?>

<div class="container mt-3">
    <h3 class="mt-4" style="color:#2b74e2;display:flex;flex-direction:row;justify-content:space-between">
        <span>Hospital :</span>
        <span>
            <button type="button" style="color:#fff;background-color:#2b74e2"  class="btn" data-bs-toggle="modal" data-bs-target="#myModal">
                Add
            </button>
        </span>
    </h3>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:#2b74e2">Add Hospital</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form onsubmit="document.getElementById('loader').style.display='block'" action="/admin/action/hospital.php" method="post">
                    <div class="form-floating mb-3 ">
                        <input required type="text" class="form-control"  name="name" placeholder="Hospital Name">
                        <label>Hospital Name</label>
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
    <div class="table-responsive">        
    <table class="table table-striped table-bordered">
        <thead style="text-align:center">
            <tr>
                <th>#</th>
                <th>Hospital Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $result = $conn->query("SELECT * FROM hospital ORDER BY id DESC");
            if($result->num_rows > 0){
                $i=0;
                while($row = $result->fetch_assoc()){
                    $i++;
                    ?>
                        <tr>
                            <td style="text-align:center"><?php echo($i) ?></td>
                            <td><?php echo($row["name"]) ?></td>
                            <td><?php echo($row["email"]) ?></td>
                            <td><?php echo($row["mobile"]) ?></td>
                            <td>
                                <form action="/admin/action/delete.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo($row["id"]) ?>">
                                    <center>
                                        <button class="btn btn-danger w-75">Delete</button>
                                    </center>
                                </form>
                            </td>
                        </tr>
                    <?php
                }
            }else{
            ?>
            <tr>
                <td style="text-align:center" colspan="5">Nothing Found</td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>
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


<?php require("./layout/Footer.php") ?>