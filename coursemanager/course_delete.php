<?php
    require("../dbconnect.php");

    if(isset($_POST['deletedata']))
    {   
        $cid = $_POST['delete_cid'];       

        $query="SELECT *  FROM recordinfo r WHERE r.rcid='$cid'";
        $query_run = mysqli_query($link, $query);
        $rowcount=mysqli_num_rows($query_run);
        echo $rowcount;
        if($rowcount==1){
            echo "<script type='text/javascript'>";
            echo "alert('抱歉，此課程已增加至影片進度，故無法刪除!');";
            echo "</script>";
            echo "<meta http-equiv='Refresh' content='0; url=coursemanage.php'>";
        
        }else{


            $query="DELETE FROM course WHERE cid='$cid'";
            $query_run = mysqli_query($link, $query);

            if($query_run)
            {            
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