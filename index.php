<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Lilliput- coding_forum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>

    <!-- Slider Starts here -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" style="height:70vh;" src="https://source.unsplash.com/oqStl2L5oxI"
                    alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="height:70vh; weight:66vw"src="https://source.unsplash.com/Q1p7bh3SHj8" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="height:70vh; weight:66vw"
                    src="https://wallpaperaccess.com/full/1111946.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Category container starts here -->
    <div class="container my-4">
        <h2 class="text-center mb-4">Lilliput Coding Forums - Categories</h2>
        <div class="row">


          <!-- Fetch all the categories -->
          <?php
          $sql = "SELECT * FROM `categories`";
          $resutl = mysqli_query($conn, $sql);

          // Use a for loop to iterate through categories
          while($row = mysqli_fetch_assoc($resutl)){
            // echo $row['category_id'];
            // echo $row['category_name'];
            $id = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo'
              <div class="col-md-4 mb-3">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="https://source.unsplash.com/random/?'.$cat.',programming/400x400"
                  alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"> <a href="thread_list.php?catid=' . $id . '"> '.$cat.' </a> </h5>
                    <p class="card-text">'.substr($desc, 0, 90).'...</p>
                    <a href="thread_list.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                  </div>
                </div>
              </div>';

          }

          ?>


        </div>
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