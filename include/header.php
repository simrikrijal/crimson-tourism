<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="index.php">Crimson Tourism</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right custom-hover">
                    <li>
                        <a href="index.php" class="<?php echo $active_home;?>">Home</a>
                    </li>
                    <li>
                        <a href="contact.php" class="<?php echo $active_contact;?>">Contact</a>
                    </li>
                    <li>
                        <a href="login.php" class="<?php echo $active_login;?>">Login</a>
                    </li>
                    <li>
                        <a href="sign-up.php" class="<?php echo $active_signup;?>">Sign Up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Header -->
