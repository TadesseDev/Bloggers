<?php
@include_once("../includes/connection.php");
@require_once("../includes/functions.php");
$searchIn = null;
if (is_array($_POST['searchIn'])) {
    $searchIn = [];
    foreach ($_POST['searchIn'] as $search) {
        array_push($searchIn, mysqli_real_escape_string($con, $search));
    }
} else {
    $searchIn = mysqli_real_escape_string($con, $_POST['searchIn']);
}
if (isset($_POST['loadGrid'])) {
    if (is_array($searchIn)) {
        foreach ($searchIn as $search) {
            echo searchContainer($search);
        }
    } else echo searchContainer($searchIn);
}

//searching fot the value
if (isset($_POST['search'])) {
    $searchIn = mysqli_real_escape_string($con, $_POST['searchIn']);
    $searchFor = mysqli_real_escape_string($con, $_POST['searchFor']);
    if (strlen($searchFor) > 0)
        searchIn($searchIn, $searchFor);
    // echo ($searchIn);
}

function searchContainer($title)
{
    return "
    <div class='searchDisplay'>
    <div id='$title'>
        <p class='title1'>$title</p>
        <hr>
        <div class='result row'>
        </div>
    </div>
    </div>
    ";
}
function searchIn($in, $for)
{
    if (strnatcasecmp($in, "blog") == 0) {
        $query = "
        select res.bid,blog.title, res.con from 
        (select bid,group_concat(content) as con from content group by(bid)) as res,
        blog where (res.bid=blog.id and res.con REGEXP '$for') or 
        (blog.title REGEXP '$for' and  res.bid=blog.id);";
        $res = getQueryResult($query);
        $row = mysqli_fetch_all($res, 1);
        // echo print_r($row);
        if (count($row) > 0) {
            foreach ($row as $res) {
                $bid = $res['bid'];
                $title = $res['title'];
                echo "
          <div class='col-sm-6 col-md-4 col-lg-3'>
            <div class='card'>
              <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>
                <a href='#' class='btn btn-primary' id='$bid' >Go somewhere</a>
              </div>
            </div>
          </div>
            ";
            }
        }
    }
    if (strnatcasecmp($in, "author") == 0) {
        $query = "select * from (select id, title, fname, lname, group_CONCAT(Fname,Lname,Experties,Title,email) as con from author group by(id)) as res where res.con REGEXP '$for';";
        $res = getQueryResult($query);
        $row = mysqli_fetch_all($res, 1);
        if (count($row) > 0) {
            foreach ($row as $res) {
                $aid = $res['id'];
                $fullName = $res['title'] . " " . $res['fname'] . " " . $res['lname'];
                echo "
          <div class='col-sm-6 col-md-4 col-lg-3'>
            <div class='card'>
              <div class='card-body'>
                <h5 class='card-title'>$fullName</h5>
                <p class='card-text'>With supporting text below as a natural lead-in to additional content.</p>
                <a href='#' class='btn btn-primary'  >Go somewhere</a>
              </div>
            </div>
          </div>
            ";
            }
        }
    }
}
