<?php
    session_start();
    $_SESSION["schedule_SQL"] = " SELECT c.cid , cls.class_name, c.cdate, c.cname, p.pname ,r.rdate, e1.ename AS no1, cut.cutdate , e2.ename AS no2, u.udate, e3.ename AS no3, u.ulink
                                        FROM course c, professor p, class cls, recordinfo r, cutinfo cut, uploadinfo u, employees e1, employees e2 ,employees e3
                                        WHERE c.class_id = cls.class_id AND c.pid = p.pid 
                                              AND c.cid =r.rcid AND c.cid =cut.ccid AND c.cid =u.ucid
                                              AND r.reid = e1.eid AND cut.ceid = e2.eid AND u.ueid = e3.eid 
                                        ORDER BY c.cdate DESC";      
    echo '<script> alert("Data Updated"); </script>';
    header("Location:schedulemanage.php");
?>