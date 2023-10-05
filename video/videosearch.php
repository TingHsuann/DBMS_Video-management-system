<?php
  require("../dbconnect.php");
?>
<?php
        session_start();
        if(isset($_POST['search_class_name'])!=null){
            $search_class_name=$_POST['search_class_name'];
            $startDate=$_POST['startDate'];
            $endDate=$_POST['endDate'];
            $search_cname=$_POST['search_cname'];
            if (empty($search_class_name)==false && empty($startDate)==false && empty($endDate)==false && empty($search_cname)==false) {
              $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                    FROM course c,professor p,class cls ,uploadinfo u
                                    WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                    AND (c.cdate BETWEEN '$startDate' AND '$endDate') AND cls.class_name = '$search_class_name' AND c.cname = '$search_cname'
                                    ORDER BY c.cdate DESC";
            }elseif (empty($search_class_name)==false && empty($startDate)==false ) {
              $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                        FROM course c,professor p,class cls ,uploadinfo u
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                              AND (c.cdate BETWEEN '$startDate' AND '$endDate') AND cls.class_name = '$search_class_name'
                                        ORDER BY c.cdate DESC";
            }elseif (empty($startDate)==false && empty($search_cname)==false) {
              $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                        FROM course c,professor p,class cls ,uploadinfo u
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                        AND (c.cdate BETWEEN '$startDate' AND '$endDate') AND c.cname = '$search_cname'
                                        ORDER BY c.cdate DESC";
               
            }elseif (empty($search_class_name)==false && empty($search_cname)==false) {
              $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                        FROM course c,professor p,class cls ,uploadinfo u
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                        AND cls.class_name = '$search_class_name' AND c.cname = '$search_cname'
                                        ORDER BY c.cdate DESC";
                
            }else{
              $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                        FROM course c,professor p,class cls ,uploadinfo u
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                        ORDER BY c.cdate DESC";
            }  
        }
        
        if(empty($_SESSION["video_SQL"])==true){
          $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                    FROM course c,professor p,class cls ,uploadinfo u
                                    WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                    ORDER BY c.cdate DESC";
        }
        
      
      
      
    ?>
<!doctype html>
<html lang="en">
  <head>   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>影片管理系統</title>
    <style>
      .navbar-nav .nav-item .nav-link.active{      
        color: #154360;
      }
     
    </style>
  </head>
  <!-- style="background-color: #EBF5FB;" -->
  <body>

    <!-- navbar-->
  <div class="container">
  <div class="row">  
    <nav class="navbar navbar-expand-md navbar-light fixed-top " style="background-color: #AED6F1;">
    <div class="container-fluid">
      <a class="navbar-brand" href="videosearch.php" style="color:#154360;">
        <img src="../img/logo.png" alt="" width="32" height="32" class="d-inline-block align-text-top"> 
        <b>影片管理系統</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto me-auto mb-2 mb-md-0">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="../coursemanager/coursemanage.php" >課程管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="videosearch.php"><b>影片查詢</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../schedule/schedulemanage.php">影片進度管理</a>
          </li>
          </li>
          
          
        </ul>

        <ul class="navbar-nav ">
        <hr class="d-md-none text-white-50">
        <li class="nav-item">
          <a class="nav-link ">
              <b></b>
          <?php
              if(isset($_COOKIE["USERNAME"])){
                $usercookie = $_COOKIE["USERNAME"];
                echo "<b>您好</b>&nbsp".$usercookie;
              }
            ?>
            </a>
          </li>
          <li class="nav-item"><p</p></li>
         
          <li class="nav-item">
        <a class="btn btn-info"  style="text-decoration: none; color:white; " data-bs-toggle="modal" data-bs-target="#exampleModal">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"></path>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
          </svg>   
          &nbsp Sign out
        </a>
        </li>
        </ul>
      </div>
    </div>
  </nav>

  </div><!-- sign out-->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">您即將登出</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            您確定要登出嗎?
          </div>
          
          <div class="modal-footer">
            <a  class="btn btn-secondary" href="videosearch.php"> 取消</a>
            <a class="btn btn-primary" href="../index.php">登出</a>
          
          </div>
        </div>
      </div>
    </div>

    <p><br><br><br></p>

    <!-- search box-->
    <div class="container">
      <div class="card text-dark bg-light mb-3" style="width: 100%;">
        <div class="card-header"> <h5><b><br>依以下條件篩選資料</b></h5> </div>
          <div class="card-body">
            <form class="row g-3 needs-validation" action="videosearch.php" method="POST" novalidate>
              <div class="col-md-4">
                <label for="inputState" class="form-label"><b>班別</b></label>
                  <select id="search_class_name" name="search_class_name" class="form-select">
                  <option value="" selected disable hidden>請選擇班別</option> 
                    <?php 

                      $query = "SELECT cls.class_name FROM class cls ";
                      $query_run = mysqli_query($link, $query);
                    
                      if($query_run)
                      {
                        foreach($query_run as $row)
                        {
                          echo "<option value='".$row['class_name']."' >".$row['class_name']."</option>";
                        }
                      }
                    ?>
                      
                  </select>
              </div>

              <div class="col-md-4">
                <label for="inputState" class="form-label"> <b>課程日期</b> </label>
                <div class="input-group ">
                  <input type="date" name="startDate"  id="startDate" class="form-control" >
                  <span class="input-group-text">到</span>
                  <input type="date" name="endDate" id="search_date_info" class="form-control" >
                </div> 
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label"> <b>課程名稱</b> </label>
                <input type="text" name="search_cname"  id="search_cname" class="form-control">
              </div>
              
              

              <div class="d-grid gap-2 d-md-flex justify-content-md-end">            
                <button type="submit" name="" class="btn btn-secondary col-md- " >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg> 搜尋</button>
                  </button> 
                  <button type="submit" name="" class="btn btn-secondary col-md- " herf="video_selectclear.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>&nbsp清除篩選條件
                  </button> 
              </div>
              
            </form>
          </div>
          <div class="card-footer text-muted">
              篩選條件必須選擇&nbsp<b>2個</b>&nbsp或&nbsp<b>3個</b>，才可進行篩選
          </div>
        </div>
      </div>
    </div>

    
    <p></p>
    <div class="container">
      <div class="table-responsive">
        <?php
          
          // $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
          // FROM course c,professor p,class cls ,uploadinfo u
          // WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
          // ORDER BY c.cdate DESC";
            $query_run = mysqli_query($link,$_SESSION["video_SQL"]);
        ?>
        <table class='table table-hover able-bordered align-middle '>
          <thead>
              <tr>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">序號</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">班別</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程名稱</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">授課講師</th>                             
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">影片連結</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;"> </th>
              </tr>
          </thead>
          <?php
            if($query_run)
            {
              foreach($query_run as $row)
              {
          ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['cid'];?></td>  
                        <td><?php echo $row['class_name'];?></td>  
                        <td><?php echo $row['cdate'];?></td>                  
                        <td><?php echo $row['cname'];?></td>                        
                        <td><?php echo $row['pname'];?></td>
                        <td><?php echo $row['ulink'];?></td>
                        <td><a href="<?php echo $row['ulink'];?>" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16" style="color: red;">
                          <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                        </svg></a></td>
                    </tr>
                </tbody>
          <?php           
                      }
                  }
            else 
            {
              echo "No Record Found";
            }
          ?>
        </table>
        
          </div>
      </div>
    </div>
    <!-- script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
          $('.editbtn').on('click', function () {
                $('#editmodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);                              
                     
                $('#update_cid').val(data[0]);
                $('#class_name').val(data[1]);
                $('#cdate').val(data[2]);
                $('#cname').val(data[3]);
                $('#pname').val(data[4]);               
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#delete').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_cid').val(data[0]);                          
            });
        });
    </script>
    <script>
     $(document).ready(function () {
         var time = new Date();
         var day = ("0" + time.getDate()).slice(-2);
         var month = ("0" + (time.getMonth() + 1)).slice(-2);
         var today = time.getFullYear() + "-" + (month) + "-" + (day);
         $('#date_info').val(today);
    });
    </script>
    <script>
     $(document).ready(function () {
         var time = new Date();
         var day = ("0" + time.getDate()).slice(-2);
         var month = ("0" + (time.getMonth() + 1)).slice(-2);
         var today = time.getFullYear() + "-" + (month) + "-" + (day);
         $('#search_date_info').val(today);
    });
    </script>
  </body>
</html>  