<?php
    require("../dbconnect.php");
    if(isset($_POST['updatedata']))
    {   
        $update_cid = $_POST['update_cid'];
        $class_name=$_POST["class_name"];
        $cdate=$_POST["cdate"];
        $cname=$_POST["cname"];
        $pname=$_POST["pname"];
        echo $update_cid;
        
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
                        // echo $pid;
                    }
                }
            }
            
        
            $query="UPDATE course SET cdate = '$cdate' ,cname = '$cname', class_id = '$class_id', pid = '$pid' WHERE cid=' $update_cid'";
            $query_run = mysqli_query($link, $query);

            if($query_run){  
                // echo "<script type='text/javascript'>";
                // echo "alert('課程資料修改完成!')";
                // echo "</script>";
                echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";                
            }
            else
            {
                echo '<script> alert("Data Not Updated"); </script>';
                echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
            }
        }
    }
?>