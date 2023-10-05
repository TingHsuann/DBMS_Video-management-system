<?php
    require("../dbconnect.php");
    if(isset($_POST['scheduledata']))
    {   
        $schedule_cid = $_POST['schedule_cid'];
        $rdate=$_POST["schedule_rdate"];
        $rename=$_POST["schedule_rename"];
        $cutdate=$_POST["schedule_cutdate"];
        $cename=$_POST["schedule_cename"];
        $udate=$_POST["schedule_udate"];
        $uename=$_POST["schedule_uename"];
        $ulink=$_POST["schedule_ulink"];

        $reid='';
        $ceid='';
        $ueid='';

        if (empty($rename)==false){            
            $query="SELECT e.eid FROM employees e WHERE e.ename='$rename'";
            $query_run = mysqli_query($link, $query);
            if($query_run){
                foreach($query_run as $row){
                    $reid = $row['eid'];           
                }
            }
        }
        if ($reid==1){           
            echo "<script type='text/javascript'>";
            echo "alert('錄製人一定要填寫!!');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";            
        }else{

            

            if (empty($cename)==false){
                $query="SELECT e.eid FROM employees e WHERE e.ename='$cename'";
                $query_run = mysqli_query($link, $query);
                if($query_run){
                    foreach($query_run as $row){
                        $ceid = $row['eid'];           
                    }
                }
            }

            if (empty($uename)==false){
                $query="SELECT e.eid FROM employees e WHERE e.ename='$uename'";
                $query_run = mysqli_query($link, $query);
                if($query_run){
                    foreach($query_run as $row){
                        $ueid = $row['eid'];           
                    }
                }
            }
            
        

            $query1="UPDATE recordinfo SET rdate = '$rdate' ,reid = '$reid', rcid = '$schedule_cid' WHERE rcid=' $schedule_cid'";           
            $query_run1 = mysqli_query($link, $query1);
         

            if($query_run1){
                $query2="UPDATE cutinfo SET cutdate = '$cutdate' ,ceid = '$ceid', ccid = '$schedule_cid' WHERE ccid=' $schedule_cid'";
                $query_run2 = mysqli_query($link, $query2);
                if($query_run2){
                    if ($ueid != 1){
                        if($ulink != '無'){
                            $query3="UPDATE uploadinfo SET udate = '$udate' ,ulink = '$ulink',ueid = '$ueid', ucid = '$schedule_cid' WHERE ucid=' $schedule_cid'";
                            $query_run3 = mysqli_query($link, $query3);
                            echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";
                        }else{
                            echo "<script type='text/javascript'>";
                            echo "alert('上傳時，「上傳人」和「影片連結」皆需填寫!!');";
                            echo "</script>";
                            echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";    
                        }
                    }else{
                        echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";
                    }    
                }else{
                    echo '<script> alert("Data Not Updated"); </script>';
                    echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";    
                }
                                
            }
            else{
                echo '<script> alert("Data Not Updated"); </script>';
                echo "<meta http-equiv='Refresh' content='0; url=schedulemanage.php'>";    
            }
        }
    }
?>