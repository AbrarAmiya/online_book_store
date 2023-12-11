<?php
    include 'partials/_dbconnect.php';
     if (session_status() === PHP_SESSION_NONE) {
        session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="icon" type="image/x-icon" href="/store/uploads/logo1.png">
    <link rel="stylesheet" type="text/css" href="/store/partials/_header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="/store/style/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top" style="background-color: #1F618D;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/store/index.php"><img src="/store/uploads/logo1.png" height="60" width="60"
                    alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link s1" aria-current="page" href="/store/index.php">Home</a>
                    </li>
                    <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
                        echo'<li><a style="margin-right: 5px; padding-top: 7px" class="s1">Categories <i
                                class="fa fa-chevron-down"></i></a>';
                    }else{
                        echo'<li><a style="margin-right: 5px;padding-top: 7px ;width: 100px" class="s1">Categories <i
                                class="fa fa-chevron-down"></i></a>';
                    }
                    ?>
                    <ul>
                        <?php
                            $sql = "SELECT DISTINCT product_category FROM `products`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)){
                                $name = $row['product_category'];
                            echo '
                                <li class="nav-item"><a class="nav-link s1" href="/store/categoryPage.php?cat='.$name.'">'.strtoupper($name).'</a></li>
                                
                            ';
                        }
                    echo'
                       </ul>
                    </li>';
                    
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
                        $curUserName = $_SESSION['user_name'];
                        $curUserId = $_SESSION['user_id'];
                    echo'
                    <li id="drop"><a style="margin-left: 5px; padding-top: 7px" class="s1">'.strtoupper($curUserName).' <i class="fa fa-chevron-down"></i></a></a>
                    <ul>
                        <li class="nav-item"><a  class="nav-link s1" href="/store/userProfile.php">User Profile</a></li>
                        <li class="nav-item"><a  class="nav-link s1" href="/store/changePassword.php">Change Password</a></li>
                    </ul>
                    </li>';
                    if($_SESSION['user_type'] == 'admin'){
                        echo'
                        <li class="s1" style="margin-left: 7px; padding-top: 7px"><a href="">Admin Panel <i
                                class="fa fa-chevron-down"></i></a>
                            <ul>
                                <li class="nav-item"><a  class="nav-link s1" href="/store/manageUser.php">Manage Users</a></li>
                                <li class="nav-item"><a  class="nav-link s1" href="/store/manageOrder.php">Manage Orders</a></li>
                                <li class="nav-item"><a  class="nav-link s1" href="/store/manageProduct.php">Manage Products</a></li>
                                <li class="nav-item"><a  class="nav-link s1" href="/store/manageRequest.php">Requested Products</a></li>
                            </ul>
                        </li>';
                    }
                    }
                ?>
                    </ul>

                    <?php
                            $c=0;
                            if(isset($_SESSION['cart'])){
                            $c = count($_SESSION['cart']);
                            }
                            echo'
                                <a href="/store/shoppingCart.php" style="padding: 10px; margin-right: 3px" class="s1 rounded-circle"><i class="fa fa-cart-plus" aria-hidden="true"><span class=" badge rounded-pill bg-secondary" style="margin-left: 3px;">'.$c.'</span></i></a>'
                            ;?>
                </ul>

                <form class="d-flex" role="search" action="/store/searchPage.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search for a product"
                        aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <?php
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true){
                    echo' <ul>
                    <li class="nav-item"><a  class="btn btn-danger mx-2" href="/store/logout.php">Logout</a></li>
                    </ul>';
                }else{
                    echo'
                    <button class="btn btn-primary nav-item mx-2"><a href="/store/signup.php">Signup</a></button>
                    <button class="btn btn-success nav-item"><a href="/store/login.php">Login</a></button>
                    ';
                }
                ?>

            </div>
        </div>
    </nav>
    <!-- Img carousel -->
    

    <div id="carouselExampleAutoplaying c-item" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
      <div class="carousel-inner">
        <div class="carousel-item active c-item">  
          <img src="http://localhost/store/uploads/111.jpg" class="d-block w-100 c-img img-fluid" alt="Slide 1">
          <div class="carousel-caption d-none d-md-block">
              <h5>Welcome to our online book haven, where every click opens the door to a world of literary wonders. Embrace the magic of storytelling as you explore our curated collection, carefully selected to ignite your imagination and satisfy your literary cravings.</h5>
              
            </div>
        </div>
        <div class="carousel-item c-item">
          <img src="http://localhost/store/uploads/222.PNG" class="d-block w-100 c-img img-fluid" class="d-block w-100 c-img img-fluid" alt="Slide 2">
          <div class="carousel-caption d-none d-md-block">
              <h5>Step into the realm of boundless adventures and endless knowledge as you enter our online book emporium. We extend a warm welcome to fellow book enthusiasts, where each page promises a new journey, and every title whispers the invitation to discover something extraordinary.</h5>
             
            </div>
        </div>
        <div class="carousel-item c-item">
          <img src="http://localhost/store/uploads/333.PNG" class="d-block w-100 c-img img-fluid" alt="Slide 3">
          <div class="carousel-caption d-none d-md-block">
              <h5>Greetings, avid readers and literary explorers! At our online book sanctuary, the shelves are alive with tales waiting to be unfolded. Join us in celebrating the joy of reading, where every visit promises a delightful rendezvous with captivating narratives, insightful wisdom, and the timeless magic of books.</h5>
            
            </div>
        </div>
      </div>
      <!-- CAROUSEL CONTROLS-->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div>

    <script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a33530bb41.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <h3 id="DarkModetext">Dark Mode is OFF</h3>
                <button onclick="darkMode()">Darkmode</button>
                <button onclick="lightMode()">LightMode</button>
                <script>
                    function darkMode() {
                        let element = document.body;
                        let content = document.getElementById("DarkModetext");
                        element.className = "dark-mode";
                        content.innerText = "Dark Mode is ON";
                    }
                    function lightMode() {
                        let element = document.body;
                        let content = document.getElementById("DarkModetext");
                        element.className = "light-mode";
                        content.innerText = "Dark Mode is OFF";
                    }
                </script>
    

</body>

</html>