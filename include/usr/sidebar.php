<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="text-center" style="height: 160px; padding: 40px 10px; border-bottom: 1px solid #DADADA;">
            <h3 class="no-margin">Welcome to Crimson Tourism <?php echo $_SESSION['user']; ?>!!</h3>
        </div>
        <ul class="sidebar-nav-custom">
            <a href="dashboard.php">
                <li class="<?php echo $dashboard_user; ?>">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </li>
            </a>
            <a href="my-favorites.php">
                <li class="<?php echo $my_favroites; ?>">
                    <i class="fa fa-star fa-fw"></i> My Favorites
                </li>
            </a>
            <a href="../logout.php">
                <li class="<?php echo $logout; ?>">
                    <i class="fa fa-power-off fa-fw"></i> Logout
                </li>
            </a>
        </ul>
    </div>
<!-- /#sidebar-wrapper -->