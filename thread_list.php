<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
    #heigght {
        min-height: 103px;
    }
    </style>

    <title>Lilliput- coding_forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id;";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    
    
    ?>

    <?php
    $show_alert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // Insert thread into thread db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];

        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);

        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);

        $sno = $_POST['sno'];

        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $show_alert = true;
        if($show_alert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your thread has been added! Pls wait for the community to respond.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
        }
    }

    ?>


    <!-- Category container starts here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with each other.
                No Spam / Advertising / Self-promote in the forums is not allowed/
                Do not post copyright-infringing material. Do not post “offensive” posts, links or images.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div class="container">
        <h1 class="my-4 py-2">Start a discussion</h1>
        <form action="' .$_SERVER["REQUEST_URI"].' " method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Thread Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Enter title">
                <small id="emailHelp" class="form-text text-muted">Keep you title as short and crisp as
                    possible.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
    }
    else{
        echo '
        <div class="container my-4">
            <h1 class="my-4 py-2">Start a discussion</h1>
            <div class="jumbotron">
                <h4 class="display-5">You are not logged in !!</h4>
                <hr class="my-2">
                <p>Kindly login to ask a question in the ' . $catname.' thread</p>
            </div>
        </div>
        ';
    }
    ?>

    <div class="container mb-4" id="heigght">
        <h1 class="my-4 py-2">Browse questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id;";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){

            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            
     

            echo '<div class="media my-3">
                    <img class="mr-3" height="64" src="https://img.freepik.com/free-icon/user_318-804790.jpg?w=2000"
                        alt="Generic placeholder image">
                    <div class="media-body">
                    <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'">'. $title . '</a></h5> '. $desc . '<p class="font-weight-bold my-0">Asked by: '.$row2['user_email'].' at '. $thread_time.'</p>'.
                    '</div>
                  </div>';

        }
        // echo var_dump($noResult);
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No threads found</p>
                        <p class="lead">Be the first person to ask a question</p>
                    </div>
                </div>';
        }
            
        ?>

    </div>




    <?php include 'partials/_footer.php'; ?>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>