<?php

function connect_db() {
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'mentorski';

    $conn = new mysqli($server, $username, $password, $db);

    if (mysqli_connect_error()) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    $conn->set_charset('UTF8');
    return $conn;
}

function get_user_by_email($email) {
    $db = connect_db();
    $sqlstr = "SELECT * FROM korisnici WHERE email='$email'";
    $result = $db->query($sqlstr);
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $data;
    } else {
        $db->close();
        return false;
    }
}

function checkUserByEmail($email) {
    $conn = connect_db();
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    if (true) {
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    }
}

function create_user($email, $password_hash, $role, $status) {
    $db = connect_db();
    $stmt = $db->prepare("INSERT INTO korisnici (email, password, role, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $email, $password_hash, $role, $status);
    $nr = $stmt->execute();
    return $nr;
}

function delete_course($sid) {
    $db = connect_db();
    $sqlstr = "DELETE FROM predmeti WHERE courseCode='$sid'";
    if ($db->query($sqlstr) === true) {
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

function getAllCourses() {
    $conn = connect_db();
    $sql = "SELECT * FROM predmeti ORDER BY courseName ASC";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    } else {
        $conn->close();
        return false;
    }
}

function new_course($courseName, $courseCode, $courseProgram, $coursePoints, $sem_regular, $sem_irregular) {
    $db = connect_db();
    $stmt = $db->prepare("INSERT INTO predmeti (courseName, courseCode, courseProgram, coursePoints, sem_regular, sem_irregular) 
             VALUES (?, ?, ?, ?,?,?)");
    $stmt->bind_param('ssssss', $courseName, $courseCode, $courseProgram, $coursePoints, $sem_regular, $sem_irregular);
    $nr = $stmt->execute();
    return $nr;
}

function update_course($courseCode, $courseProgram, $coursePoints, $sem_regular, $sem_irregular, $elective) {
    $db = connect_db();
    $sqlstr = "UPDATE predmeti SET courseProgram='$courseProgram', 
		coursePoints='$coursePoints', sem_regular='$sem_regular', sem_irregular='$sem_irregular', 
		elective='$elective' WHERE courseCode='$courseCode'";
    if ($db->query($sqlstr) === true) {
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

function getAllStudents() {
    $conn = connect_db();
    $sql = "SELECT * FROM korisnici WHERE role = 'student' ORDER BY status ASC";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    } else {
        $conn->close();
        return false;
    }
}

function enrollCourse($uid, $course_id) {
    $conn = connect_db();
    $status = 'enrolled';
    $sql = "INSERT INTO upisi (user_id, course_id, status) VALUES (?, ?, ?)";
    $stmt = $conn->stmt_init();
    if ($stmt->prepare($sql)) {
        $stmt->bind_param('iis', $uid, $course_id, $status);
        $stmt->execute();
    } else {
        $conn->close();
        return false;
    }
    $conn->close();
    return true;
}
function get_course($id) {
    $conn = connect_db();
    $sql = "SELECT * FROM predmeti WHERE courseCode='$id'";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    } else {
        $conn->close();
        return false;
    }
}
function updateCourseStatus($uid, $course_id, $status) {
    $conn = connect_db();
    $sql = "UPDATE upisi SET status='$status' WHERE user_id='$uid' AND course_id='$course_id'";
    if ($conn->query($sql) === true) {
        $conn->close();
        return true;
    } else {
        $conn->close();
        return false;
    }
}

function unenrollCourse($uid, $course_id) {
    $db = connect_db();
    $sqlstr = "DELETE FROM upisi WHERE user_id='$uid' AND course_id='$course_id'";
    if ($db->query($sqlstr) === true) {
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

function getAllCoursesForUser($uid) {
    $conn = connect_db();
    $sql = "SELECT predmeti.course_id, predmeti.courseName, predmeti.courseCode, predmeti.courseProgram, 
		predmeti.coursePoints, upisi.status, predmeti.sem_regular, predmeti.sem_irregular, predmeti.elective FROM predmeti 
		INNER JOIN upisi ON predmeti.course_id=upisi.course_id 
		WHERE upisi.user_id='$uid' ORDER BY predmeti.courseName ASC";
    $result = $conn->query($sql);
    if ($result) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $data;
    } else {
        $conn->close();
        return false;
    }
}

function getAllUnenrolledCourses($uid) {
    $conn = connect_db();
    $sql = "SELECT predmeti.course_id, predmeti.courseCode, predmeti.courseName 
		FROM upisi INNER JOIN predmeti ON upisi.course_id=predmeti.course_id 
		WHERE upisi.user_id='$uid' ORDER BY predmeti.courseName ASC";
    $result1 = $conn->query($sql);
    $data1 = $result1->fetch_all(MYSQLI_ASSOC);
    $sql = "SELECT predmeti.course_id, predmeti.courseCode, predmeti.courseName 
		FROM predmeti ORDER BY courseName ASC";
    $result2 = $conn->query($sql);
    $data2 = $result2->fetch_all(MYSQLI_ASSOC);
    $data = array();
    foreach ($data2 as $value) {
        if (!in_array($value, $data1)) {
            $data[] = $value;
        }
    }
    if ($result1 and $result2) {
        $conn->close();
        return $data;
    } else {
        $conn->close();
        return false;
    }
}

?>