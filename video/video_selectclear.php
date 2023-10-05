<?php
    session_start();
    $_SESSION["video_SQL"] = "SELECT c.cid, cls.class_name, c.cdate, c.cname, p.pname ,u.ulink
                                FROM course c,professor p,class cls ,uploadinfo u
                                WHERE c.class_id = cls.class_id AND c.pid = p.pid AND c.cid = u.ucid AND u.ueid != 1
                                ORDER BY c.cdate DESC";
    echo '<script> alert("Data Updated"); </script>';
    header("Location:videosearch.php");
?>