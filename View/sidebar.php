<?php
require_once '../Controllers/VideoController.php';
$videoController = new VideoController;
$categories = $videoController->getAllCategories();
?>
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="channels.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Channels</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="myChannel.php">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>My Channel</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="playlists.php">
            <i class="fas fa-fw fa-user-alt"></i>
            <span>Playlists</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="upload-video.php">
            <i class="fas fa-fw fa-cloud-upload-alt"></i>
            <span>Upload Video</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="history-page.php">
            <i class="fas fa-fw fa-history"></i>
            <span>History Page</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="categories.html" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Categories</span>
        </a>
        <div class="dropdown-menu">
            <?php foreach ($categories as $categorie) : ?>
                <a class="dropdown-item" href="http://localhost/Vidoe/View/result.php?cat_id= <?= $categorie['id'] ?>"><?= $categorie['name'] ?></a>
            <?php endforeach; ?>
        </div>
    </li>
    <li class="nav-item channel-sidebar-list">
        <h6>SUBSCRIPTIONS</h6>
        <ul>
            <li>
                <a href="subscriptions.html">
                    <img class="img-fluid" alt="" src="img/s1.png"> Your Life
                </a>
            </li>
            <li>
                <a href="subscriptions.html">
                    <img class="img-fluid" alt="" src="img/s2.png"> Unboxing <span class="badge badge-warning">2</span>
                </a>
            </li>
            <li>
                <a href="subscriptions.html">
                    <img class="img-fluid" alt="" src="img/s3.png"> Product / Service
                </a>
            </li>
            <li>
                <a href="subscriptions.html">
                    <img class="img-fluid" alt="" src="img/s4.png"> Gaming
                </a>
            </li>
        </ul>
    </li>
</ul>