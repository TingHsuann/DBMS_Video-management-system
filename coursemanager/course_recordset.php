<?php
    require("../dbconnect.php");
    if(isset($_POST['recorddata']))
    {   
        $record_cid = $_POST['record_cid'];
        $enmae=$_POST["record_ename"];
        $rdate=$_POST["record_cdate"];      
        $eid = '';
       
        
        $query="SELECT *  FROM recordinfo r WHERE r.rcid='$record_cid'";
        $query_run = mysqli_query($link, $query);
        $rowcount=mysqli_num_rows($query_run);
       
        if($rowcount==1){
            echo "<script type='text/javascript'>";
            echo "alert('此課程已增加至影片進度!!');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
        
        }else{

            if (empty($enmae)==false){            
                $query="SELECT e.eid FROM employees e WHERE e.ename='$enmae'";
                $query_run = mysqli_query($link, $query);
                if($query_run){
                    foreach($query_run as $row){
                        $eid = $row['eid'];           
                    }
                }
            }
            
            if ($eid==1){           
                echo "<script type='text/javascript'>";
                echo "alert('錄製人一定要填寫!!');";
                echo "</script>";
                echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
            }else{
            

                $query1="INSERT INTO recordinfo (rdate, rcid, reid) VALUES ('$rdate','$record_cid','$eid')";           
                $query_run1 = mysqli_query($link, $query1);
            

                if($query_run1){
                    $query2="INSERT INTO cutinfo (cutdate, ccid, ceid) VALUES ('$rdate','$record_cid',1)";
                    $query_run2 = mysqli_query($link, $query2);
                    if($query_run2){
                        $query3="INSERT INTO uploadinfo (udate, ulink,ucid, ueid) VALUES ('$rdate','無','$record_cid',1)";
                        $query_run3 = mysqli_query($link, $query3);
                        echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
                    }else{
                        echo '<script> alert("Data Not Updated"); </script>';
                        echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
                    }
                                    
                }
                else{
                    echo '<script> alert("Data Not Updated"); </script>';
                    echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
                }
            }
        }
    }
?>