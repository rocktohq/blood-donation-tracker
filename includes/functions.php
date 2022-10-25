<?php

    // Requested by
    function requestedby($id){
        include 'config.php';

        $sql = "SELECT `name` FROM `user` WHERE `id` = $id";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $rows = $result->fetch_assoc();
            echo "<span class='text-muted'>by:</span> <a href='profile.php?id={$id}'>{$rows['name']}</a>";
        }

    }

    // User Requests
    function request($id) {

        include 'config.php';

        $sql = "SELECT COUNT(*) AS `count` FROM `request` WHERE `author_id` = $id";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<p>Request</p><p class='text-muted'>{$row['count']}</p>";
        }
    }

    // If User Exists
    function userExists($email) {
        include 'config.php';

        $sql = "SELECT EXISTS (SELECT `email` FROM `user` WHERE `email` = '$email') as `row_exists`  LIMIT 1";
        $result = $con->query($sql);

        if($result->fetch_assoc()['row_exists'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    // User Name
    function userName($id) {
        include 'config.php';

        $sql = "SELECT `name` FROM `user` WHERE `id` = '$id'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];

            return $name;
        }

    }

    // Total
    function totalMembers() {
        include 'config.php';

        $sql = "SELECT * FROM `user`";
        $result = $con->query($sql);

        $count = $result->num_rows;
        return $count;

    }

    function totalRequests() {
        include 'config.php';

        $sql = "SELECT * FROM `request` WHERE `completed` != 1";
        $result = $con->query($sql);

        $count = $result->num_rows;
        return $count;

    }

    function completedRequests() {
        include 'config.php';

        $sql = "SELECT * FROM `request` WHERE `completed` = 1";
        $result = $con->query($sql);

        $count = $result->num_rows;
        return $count;

    }

    function totalDonation() {
        include 'config.php';

        $sql = "SELECT SUM(ammount) AS `sum` FROM `donation` WHERE `approved` != 0";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['sum'];
        return $count;
        }
    }
      