<?php
    require("../dbconnect.php");
    if(isset($_POST['insertdata']))
    {   
        $insert_cid = $_POST['insert_cid'];
        $class_name=$_POST["insert_class_name"];
        $cdate=$_POST["insert_cdate"];
        $cname=$_POST["insert_cname"];
        $pname=$_POST["insert_pname"];
       
        
        if (empty($cname)!=false){           
            echo "<script type='text/javascript'>";
            echo "alert('課程名稱不能為空白，請填寫課程名稱');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>"; 

        }else{

            if (empty($class_name)==false){            
                $query="SELECT cls.class_id FROM class cls WHERE cls.class_name='$class_name'";
                $query_run = mysqli_query($link, $query);
                if($query_run){
                    foreach($query_run as $row){
                        $class_id = $row['class_id'];                    
                    }
                }
            }

            if (empty($pname)==false){
                $query="SELECT p.pid FROM professor p WHERE p.pname='$pname'";
                $query_run = mysqli_query($link, $query);
                if($query_run){
                    foreach($query_run as $row){
                        $pid = $row['pid'];
                      
                    }
                }
            }
            // 輸入相同一天的課程
            $check1 = "  SELECT * FROM course c 
                        WHERE c.class_id = '$class_id' AND c.cname = '$cname' AND c.pid = '$pid' AND c.cdate = '$cdate'";
            $query_checkrun1 = mysqli_query($link, $check1);
            if(mysqli_num_rows($query_checkrun1)==1){
                echo "<script type='text/javascript'>";
                echo "alert('此班別當天課程已新增，請重新輸入課程資訊');";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>"; 
            }else{
                $check2 = "  SELECT * FROM course c 
                            WHERE c.class_id = '$class_id' AND c.cdate = '$cdate'";
                $query_checkrun2 = mysqli_query($link, $check2);
                if(mysqli_num_rows($query_checkrun2)==1){
                    echo "<script type='text/javascript'>";
                    echo "alert('此班別當天已有課程，請重新輸入課程資訊');";
                    echo "</script>";
                    echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>"; 
            }
                else{
                    $query="INSERT INTO course (cname, cdate, pid, class_id) VALUES ('$cname','$cdate','$pid','$class_id')";
                    $query_run = mysqli_query($link, $query);

                    if($query_run){   
                    
                        echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";                
                    }
                    else
                    {
                        echo '<script> alert("Data Not Updated"); </script>';
                        echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
                    }
                }
            }
        }
    }
?>