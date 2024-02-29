<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Barlow:400,500,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <link rel="manifest" href="/manifest.json">
  <style>
    #slash a:after {
      content: "/";
      margin-left: 20px;
    }

    #slash a:last-child:after {
      content: "";
      margin-left: 20px;
    }

    #slash a {
      color: black;
    }

    .no-gutters {
      margin-right: 0;
      margin-left: 0;
    }

    .dropdown-toggle::after {
      display: none;
    }
  </style>
  <title>ExplorAI Blog</title>
</head>


<body style="font-family: 'Barlow', sans-serif;">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #342A3D;">
        <div class="container-fluid">
            <a class="navbar-brand h3" href="<?= site_url('/'); ?>">ExplorAI Blogs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
</div>

</nav>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #581845;">  
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url('/'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url('/posts/create'); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Article</a>
                    </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('/posts/index'); ?>"><i class="fa fa-align-justify" aria-hidden="true"></i> All Articles</a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('/profile'); ?>">
                            <i class="fa fa-user" aria-hidden="true"></i> About us
                            </a>
                        </li>
                        <?php if (session()->has("logged")) : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('/login/logout'); ?>">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                            </a>
                        </li>

                        <?php if (session("admin")) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?php echo site_url("admin/posts"); ?>">Articles</a></li>
                                    <li><a class="dropdown-item" href="<?php echo site_url("admin/users"); ?>">Users</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('/register'); ?>">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url('/login'); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
                    </nav>

        
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto my-3">
                <?php if (session()->has("success")) : ?>
                    <div class="alert alert-success">
                        <?php echo session("success"); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has("error")) : ?>
                    <div class="alert alert-danger">
                        <?php echo session("error"); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has("info")) : ?>
                    <div class="alert alert-info">
                        <?php echo session("info"); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has("warning")) : ?>
                    <div class="alert alert-warning">
                        <?php echo session("warning"); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php $this->renderSection("content"); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- <div class="fixed-bottom"> -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #581845;">
  <div class="container-fluid">
    <a class="navbar-brand h2" href="#">
      &copy; 2024 ExplorAi
    </a>
    <div class="navbar-brand" href="#">Contact us!</div>
  </div>
</nav>
<!-- </div> -->
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>