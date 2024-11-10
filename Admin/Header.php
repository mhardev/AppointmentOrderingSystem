<header class="header">
    <div class="menu-icon" onclick="openSidebar()">
        <span class="material-icons-outlined">menu</span>
    </div>
    <div class="header-right">
        <div class="dropdown">
            <?php 
            include("./APIs/Header/getAdminDetails.php");
            ?>
            <span><?php echo $username;?></span>
            <button type="button" class="btn btn-light rounded-5" id="profile" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="Root/img/admin/<?php echo $image; ?>" alt="" style="max-width:40px; border-radius: 50%;">
            </button>
            <ul class="dropdown-menu" aria-labelledby="profile">
                <li><a class="dropdown-item" id="updtInfo" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#updateInfo"> Update Info</a></li>
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#updateProfile"> Update Picture</a></li>
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-backdrop="static" data-bs-target="#headerCP"> Change password</a></li>
                <li><a class="dropdown-item" href="Logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>