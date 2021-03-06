<?php
   echo '    <!-- NAV -->
   <nav class="navbar navbar-dark bg-transparent navbar-expand-md py-2" id="main-nav">
        <div class="container">
            <a href="main.php" class="navbar-brand mr-auto">
                <img src="./images/logo/logo.jpg" width="50" height="50" alt="" class="img-fluid">
            </a>

            <button role="button" class="navbar-toggler" data-toggle="collapse" data-target="#idcollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="idcollapse">
                <ul class="navbar-nav ml-auto">
                    <li>
                    <form action="search.php" method="POST">
                        <input type="text" name="search" placeholder="Discounts Name" required class="form-control" style="display:inline-block; width:70%;height:35px;margin: 2px -3px 2px 2px;">
                        <button type="submit" name="submit_search" class="btn btn-primary" style="margin-top:-2px;"><i class="fas fa-search"></i></button>
                    </form>
                    </li>
                    <li class="nav-item">
                        <a href="main.php" class="nav-link">Home</a>
                    </li>';
                    if(!isset($_SESSION['type'])){
                        echo
                    '<li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
        } else {
                    echo
                    '<li class="nav-item">
                    <a href="main.php" class="nav-link" >'. $_SESSION['type'] . ' '. $_SESSION['fname'] . ' '. $_SESSION['lname'] .  '</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="shoe.php">Shoe</a>
                            <a class="dropdown-item" href="category.php">Category</a>
                            <a class="dropdown-item" href="discount.php">Discount</a>
                            <a class="dropdown-item" href="allshoes.php">Show all shoes</a>
                            <a class="dropdown-item" href="alldiscounts.php">Show all discounts</a>
                            <a class="dropdown-item" href="allcategories.php">Show all categories</a>';
                            if(($_SESSION['type'] == 'admin')){
                                echo   
                            '<a class="dropdown-item" href="allusers.php">Show all users</a>
                            <a class="dropdown-item" href="register.php">Add user</a>
                            <a class="dropdown-item" href="user.php">Update/Delete user</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="signout.php">Sign Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
                    } else {
                        echo
                        '<a class="dropdown-item" href="user.php">Update/Delete user</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="signout.php">Sign Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>';
    }
    }     
                 
?>