<div id="wrapper" style="margin-top: 50px;">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="text-center" style="height: 160px; padding: 40px 10px; border-bottom: 1px solid #DADADA;">
            <h3 class="no-margin">Welcome to Crimson Tourism <?php echo $_SESSION['admin']; ?>!!</h3>
        </div>
        <ul class="sidebar-nav-custom">
            <a href="dashboard.php">
                <li class="<?php echo $dashboard_active; ?>">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </li>
            </a>
            <a href="add-destination.php">
                <li class="<?php echo $add_destination; ?>">
                    <i class="fa fa-plus fa-fw"></i> Add Point of Interests
                </li>
            </a>
            <a href="list_destination.php">
                <li class="<?php echo $view_destination; ?>">
                    <i class="fa fa-list fa-fw"></i> View Destinations
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