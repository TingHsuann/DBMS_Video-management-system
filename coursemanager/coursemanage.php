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
              $_SESSION["course_SQL"] = " SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                          FROM course c,professor p,class cls 
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid AND (c.cdate BETWEEN '$startDate' AND '$endDate')
                                                AND cls.class_name = '$search_class_name' AND c.cname = '$search_cname' 
                                          ORDER BY c.cdate DESC"; 
            }elseif (empty($search_class_name)==false && empty($startDate)==false ) {
              $_SESSION["course_SQL"] = " SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                          FROM course c,professor p,class cls 
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid AND (c.cdate BETWEEN '$startDate' AND '$endDate')
                                                AND cls.class_name = '$search_class_name'
                                          ORDER BY c.cdate DESC"; 
              
            }elseif (empty($startDate)==false && empty($search_cname)==false) {
              $_SESSION["course_SQL"] = " SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                          FROM course c,professor p,class cls 
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid AND (c.cdate BETWEEN '$startDate' AND '$endDate')
                                                AND c.cname = '$search_cname'
                                          ORDER BY c.cdate DESC"; 
               
            }elseif (empty($search_class_name)==false && empty($search_cname)==false) {
              $_SESSION["course_SQL"] = " SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                          FROM course c,professor p,class cls 
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                                AND cls.class_name = '$search_class_name' AND c.cname = '$search_cname' 
                                          ORDER BY c.cdate DESC";
                
            }else{
              $_SESSION["course_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                          FROM course c,professor p,class cls 
                                          WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                          ORDER BY c.cdate DESC";
            }  
        }
        
        if(empty($_SESSION["course_SQL"])==true){
          $_SESSION["course_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                      FROM course c,professor p,class cls 
                                      WHERE c.class_id = cls.class_id AND c.pid = p.pid 
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
      <a class="navbar-brand" href="coursemanage.php" style="color:#154360;">
        <img src="../img/logo.png" alt="" width="32" height="32" class="d-inline-block align-text-top"> 
        <b>影片管理系統</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto me-auto mb-2 mb-md-0">
          <li class="nav-item ">
            <a class="nav-link active" aria-current="page" href="coursemanage.php" ><b>課程管理</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../video/videosearch.php">影片查詢</a>
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
            <a  class="btn btn-secondary" href="coursemanage.php"> 取消</a>
            <a class="btn btn-primary" href="../index.php">登出</a>
          
          </div>
        </div>
      </div>
    </div>

    <p><br><br><br></p>
    <!-- INSERT (course_insert.php) -->
    <div class="modal fade" id="insertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>新增課程資料</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
          </div>
          <form action="course_insert.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="insert_cid" id="insert_cid"> 

              <div class="form-group">
                <label for="inputState" class="form-label"><b>班別</b></label>
                  <select id="insert_class_name" name="insert_class_name" class="form-select">
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

              <div class="form-group">
                <label><b>課程日期</b></label>
                <input type="date" name="insert_cdate" id="date_info" class="form-control" >
              </div>         
              <div class="form-group ">
                <label><b>課程名稱</b></label>
                <input type="text" name="insert_cname" id="insert_cname" class="form-control" placeholder="請輸入課程名稱">
              </div>
              <div class="form-group">
                <label><b>授課講師</b></label>
                <select id="insert_pname" name="insert_pname" class="form-select">
                  <?php  
                  
                    
                    $query = "SELECT p.pname FROM professor p ";
                    $query_run = mysqli_query($link, $query);
                
                  if($query_run)
                  {
                    foreach($query_run as $row)
                    {
                      echo "<option value='".$row['pname']."' >".$row['pname']."</option>";
                    }
                  }
                  ?>
                    
                </select>
              </div>
            </div>                              
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
              <button type="submit" name="insertdata" class="btn btn-primary">新增</button>
            </div>
          </form>

        </div>
      </div>
    </div>    
    <!-- DELETE (course_delete.php) -->    
    <div class="modal" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <b>刪除課程資料</b></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
                </div>
                <form action="course_delete.php" method="POST">
                    <div class="modal-body">                        
                        <h4></h4>
                        <p>您確認要刪除此筆課程資料嗎?</p>
                        <input type="hidden" name="delete_cid" id="delete_cid">                      
                    </div>
                    
                    <div class="modal-footer">
                      <a  class="btn btn-secondary" href="coursemanage.php"> 取消</a>                     
                      <button type="submit" name="deletedata" class="btn btn-primary">刪除</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- UPDATE (course_update.php) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>修改課程資料</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
          </div>
          <form action="course_update.php" method="POST">
            <div class="modal-body">
           
              <input type="hidden" name="update_cid" id="update_cid">         

              <div class="form-group">
                <label for="inputState" class="form-label"><b>班別</b></label>
                  <select id="class_name" name="class_name" class="form-select">
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

              <div class="form-group">
                <label><b>課程日期</b></label>
                <input type="date" name="cdate" id="cdate" class="form-control" >
              </div>         
              <div class="form-group ">
                <label><b>課程名稱</b></label>
                <input type="text" name="cname" id="cname" class="form-control" placeholder="請輸入課程名稱">
              </div>
              <div class="form-group">
                <label for="inputState" class="form-label"><b>授課講</b></label>
                  <select id="pname" name="pname" class="form-select">
                    <?php  
                    
                      require("../dbconnect.php");
                      $query = "SELECT p.pname FROM professor p ";
                      $query_run = mysqli_query($link, $query);
                  
                    if($query_run)
                    {
                      foreach($query_run as $row)
                      {
                        echo "<option value='".$row['pname']."' >".$row['pname']."</option>";
                      }
                    }
                    ?>
                    
                  </select>
              </div>             
              <div class="modal-footer">
                <a  class="btn btn-secondary" href="coursemanage.php"> 取消</a>                     
                <button type="submit" name="updatedata" class="btn btn-primary">修改</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- addrecord(course_recordset.php) -->
    <div class="modal fade" id="recordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>錄製影片</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>                    
          </div>
          <form action="course_recordset.php" method="POST">
            <div class="modal-body">
           
              <input type="hidden" name="record_cid" id="record_cid">         

              <div class="form-group">
                <label for="inputState" class="form-label"><b>錄製人</b></label>
                  <select id="record_ename" name="record_ename" class="form-select">
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
                <label><b>錄製日期</b></label>
                <input type="date" name="record_cdate" id="record_cdate" class="form-control" >
              </div>         
              <div class="modal-footer">
                <a  class="btn btn-secondary" href="coursemanage.php"> 取消</a>                     
                <button type="submit" name="recorddata" class="btn btn-primary">確定</button>
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
            <form class="row g-3 needs-validation" action="coursemanage.php" method="POST" novalidate>
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
                  <button type="submit" name="" class="btn btn-secondary col-md- " herf="course_selectclear.php">
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

    <div class="container">                  
      <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#insertmodal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>&nbsp新增課程資訊
      </button>
    </div>
    <p></p>
    <div class="container">
      <div class="table-responsive">
        <?php
          
            // $query = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname FROM course c,professor p,class cls WHERE c.class_id = cls.class_id AND c.pid = p.pid ORDER BY c.cdate DESC";
            $query_run = mysqli_query($link, $_SESSION["course_SQL"]);
        ?>
        <table class='table table-hover able-bordered align-middle '>
          <thead>
              <tr>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">序號</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">班別</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程日期</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">課程名稱</th>
                  <th scope="col" class="table-secondary" style="background-color: #FEF9E7;">授課講師</th>                             
                  <th scope="col" class="table-secondary" colspan="3" style="background-color: #FEF9E7;">操作</th>
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
                        
                        
                       
                        <td rowspan="3"> 
                          <button type="button" class="btn btn-primary recordbtn"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2V5zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556v4.35zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H2z"/>
                          </svg>
                            錄製影片</button>
                        </td>
                        <td >                            
                            <button type="button" class="btn btn-success editbtn"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                            修改</button>
                        </td>
                        <td>
                              <button type="button" class="btn btn-danger deletebtn">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                              </svg>                              
                              刪除</button>
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
          $('.recordbtn').on('click', function () {
                $('#recordmodal').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);                              
                     
                $('#record_cid').val(data[0]);
                       
            });
        });
    </script>
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