<?php
    session_start();
    $_SESSION["course_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname 
                                      FROM course c,professor p,class cls 
                                      WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                      ORDER BY c.cdate DESC";
    echo '<script> alert("Data Updated"); </script>';
    header("Location:coursemanage.php");
?>