<?php
  require("../dbconnect.php");
?>
<?php
        session_start();
        if(isset($_POST['schedule_select'])!=null){
          $schedule_select= $_POST['schedule_select'] ;
          if(empty($schedule_select)==true){
            $_SESSION["schedule_SQL"] = " SELECT c.cid , cls.class_name, c.cdate, c.cname, p.pname ,r.rdate, e1.ename AS no1, cut.cutdate , e2.ename AS no2, u.udate, e3.ename AS no3, u.ulink
                                        FROM course c, professor p, class cls, recordinfo r, cutinfo cut, uploadinfo u, employees e1, employees e2 ,employees e3
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                              AND c.cid =r.rcid AND c.cid =cut.ccid AND c.cid =u.ucid
                                              AND r.reid = e1.eid AND cut.ceid = e2.eid AND u.ueid = e3.eid 
                                        ORDER BY c.cdate DESC";      
          }
          else if($schedule_select==1){
            $_SESSION["schedule_SQL"] = " SELECT c.cid , cls.class_name, c.cdate, c.cname, p.pname ,r.rdate, e1.ename AS no1, cut.cutdate , e2.ename AS no2, u.udate, e3.ename AS no3, u.ulink
                                          FROM course c, professor p, class cls, recordinfo r, cutinfo cut, uploadinfo u, employees e1, employees e2 ,employees e3
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                                AND c.cid =r.rcid AND c.cid =cut.ccid AND c.cid =u.ucid
                                                AND r.reid = e1.eid AND cut.ceid = e2.eid AND u.ueid = e3.eid 
                                                AND u.ueid = 1 AND cut.ceid = 1
                                          ORDER BY c.cdate DESC";                    
          }
          else if($schedule_select==2){
            $_SESSION["schedule_SQL"] = " SELECT c.cid , cls.class_name, c.cdate, c.cname, p.pname ,r.rdate, e1.ename AS no1, cut.cutdate , e2.ename AS no2, u.udate, e3.ename AS no3, u.ulink
                                          FROM course c, professor p, class cls, recordinfo r, cutinfo cut, uploadinfo u, employees e1, employees e2 ,employees e3
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                                AND c.cid =r.rcid AND c.cid =cut.ccid AND c.cid =u.ucid
                                                AND r.reid = e1.eid AND cut.ceid = e2.eid AND u.ueid = e3.eid 
                                                AND u.ueid = 1 AND cut.ceid != 1
                                          ORDER BY c.cdate DESC";                    
          }    
        }  
        if(empty($_SESSION["schedule_SQL"])==true){
          $_SESSION["schedule_SQL"] = " SELECT c.cid , cls.class_name, c.cdate, c.cname, p.pname ,r.rdate, e1.ename AS no1, cut.cutdate , e2.ename AS no2, u.udate, e3.ename AS no3, u.ulink
                                        FROM course c, professor p, class cls, recordinfo r, cutinfo cut, uploadinfo u, employees e1, employees e2 ,employees e3
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                              AND c.cid =r.rcid AND c.cid =cut.ccid AND c.cid =u.ucid
                                              AND r.reid = e1.eid AND cut.ceid = e2.eid AND u.ueid = e3.eid 
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
      <a class="navbar-brand" href="schedulemanage.php" style="color:#154360;">
        <img src="../img/logo.png" alt="" width="32" height="32" class="d-inline-block align-text-top"> 
        <b>影片管理系統</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto me-auto mb-2 mb-md-0">
          <li class="nav-item ">
            <a class="nav-link " aria-current="page" href="../coursemanager/coursemanage.php" >課程管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../video/videosearch.php">影片查詢</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="schedulemanage.php"><b>影片進度管理</b></a>
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
  </div>
<!-- sign out-->
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
            <a  class="btn btn-secondary" href="schedulemanage.php"> 取消</a>
            <a class="btn btn-primary" href="../index.php">登出</a>
          
          </div>
        </div>
      </div>
    </div>
    <p><br><br><br></p>
    
    
    <!-- UPDATE (schedule_update.php) -->
    <div class="modal fade" id="schedulemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>更新影片進度</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
          </div>
          <form action="schedule_update.php" method="POST">
            <div class="modal-body">
           
              <input type="hidden" name="schedule_cid" id="schedule_cid">         
            
              <div class="form-group">
                <label><b>錄製日期</b></label>
                <input type="date" name="schedule_rdate" id="schedule_rdate" class="form-control" >
              </div> 
              <div class="form-group">
                <label for="inputState" class="form-label"><b>錄製人</b></label>
                  <select id="schedule_rename" name="schedule_rename" class="form-select">
                    <?php  
                    
                     
                      $query = "SELECT e.ename FROM employees e ";
                      $query_run = mysqli_query($link, $query);
                  
                    if($query_run)
                    {
                      foreach($query_run as $row)
                      {
                        echo "<option value='".$row['ename']."' >".$row['ename']."</option>";
                      }
                    }
                    ?>
                    
                  </select>
              </div>
              <div class="form-group">
                <label><b>剪輯日期</b></label>
                <input type="date" name="schedule_cutdate" id="schedule_cutdate" class="form-control" >
              </div> 
              <div class="form-group">
                <label for="inputState" class="form-label"><b>剪輯人</b></label>
                  <select id="schedule_cename" name="schedule_cename" class="form-select">
                    <?php  
                    
                     
                      $query = "SELECT e.ename FROM employees e ";
                      $query_run = mysqli_query($link, $query);
                  
                    if($query_run)
                    {
                      foreach($query_run as $row)
                      {
                        echo "<option value='".$row['ename']."' >".$row['ename']."</option>";
                      }
                    }
                    ?>
                    
                  </select>
              </div>
              <div class="form-group">
                <label><b>上傳日期</b></label>
                <input type="date" name="schedule_udate" id="schedule_udate" class="form-control" >
              </div> 
              <div class="form-group">
                <label for="inputState" class="form-label"><b>上傳人</b></label>
                  <select id="schedule_uename" name="schedule_uename" class="form-select">
                    <?php  
                    
                     
                      $query = "SELECT e.ename FROM employees e ";
                      $query_run = mysqli_query($link, $query);
                  
                    if($query_run)
                    {
                      foreach($query_run as $row)
                      {
                        echo "<option value='".$row['ename']."' >".$row['ename']."</option>";
                      }
                    }
                    ?>
                    
                  </select>
              </div>
              <div class="form-group ">
                <label><b>課程影片連結</b></label>
                <input type="text" name="schedule_ulink" id="schedule_ulink" class="form-control" placeholder="請輸入課程影片連結">
              </div>
              
              <div class="modal-footer">
                <a  class="btn btn-secondary" href="coursemanage.php"> 取消</a>                     
                <button type="submit" name="scheduledata" class="btn btn-primary">修改</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- search box-->
    <div class="container">
      <div class="card text-dark bg-light mb-3" style="width: 100%;">
        <div class="card-header"> <h5><b><br>依以下條件篩選資料</b></h5> </div>
          <div class="card-body">
            <form class="row g-3 needs-validation" action="schedulemanage.php" method="POST" novalidate>
              <div class="col-md-4">
                <label for="inputState" class="form-label"><b>影片進度</b></label>
                  <select id="schedule_select" name="schedule_select" class="form-select">  
                    <option value="" selected disable hidden>請選擇影片進度</option>                           
                    <option value="1">尚未剪輯</option>
                    <option value="2">尚未上傳</option>                     
                  </select>
              </div>
              

              <div class="d-grid gap-2 d-md-flex justify-content-md-end">            
                <button type="submit" name="" class="btn btn-secondary col-md- ">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg> 搜尋</button>
                  </button> 
                  <button type="submit" name="" class="btn btn-secondary col-md- " href="schedule_selectclear.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>&nbsp清除篩選條件
                  </button> 
              </div>
              
            </form>
          </div>
          <div class="card-footer text-muted">
            &nbsp
          </div>
        </div>
      </div>
    </div>

    
    <p></p>
    <div class="container">
      <div class="table-responsive">
        <?php          
           
            $query_run = mysqli_query($link, $_SESSION["schedule_SQL"]);
        ?>
        <table class='table table-hover able-bordered align-middle '>
          <thead>
              <tr>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">序號</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">班別</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程名稱</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">授課講師</th>  
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">錄製日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">錄製人</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">剪輯日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">剪輯人</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">上傳日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">上傳人</th>                             
                  <th scope="col" class="table-secondary" colspan="2" style="background-color: #FEF9E7;">操作</th>
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
                        <td><?php echo $row['rdate'];?></td>  
                        <td ><?php echo $row['no1'];?></td>  
                        <td><?php echo $row['cutdate'];?></td>                  
                        <td><?php echo $row['no2'];?></td>                        
                        <td><?php echo $row['udate'];?></td>                  
                        <td><?php echo $row['no3'];?></td> 
                        <td hidden><?php echo $row['ulink'];?></td>
                        
                        
                        <td rowspan="2">                            
                            <button type="button" class="btn btn-success schedulebtn"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                            </svg>
                            更新進度</button>
                        </td>
                        
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
          $('.schedulebtn').on('click', function () {
                $('#schedulemodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);                              
                     
                $('#schedule_cid').val(data[0]);
                $('#schedule_rdate').val(data[5]);
                $('#schedule_rename').val(data[6]);
                $('#schedule_cutdate').val(data[7]);
                $('#schedule_cename').val(data[8]);
                $('#schedule_udate').val(data[9]);
                $('#schedule_uename').val(data[10]);
                $('#schedule_ulink').val(data[11]);               
            });
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