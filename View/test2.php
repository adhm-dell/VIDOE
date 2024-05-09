<?php
$video = new Video;
$channelId = $video->getChannelId();
?>
<div class="single-video-left">
    <div class="single-video">
        <video width="100%" height="315" src="<?= "assets/Videos/" . basename($video->getVideoUrl()) ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></video>
    </div>
    <div class="single-video-title box mb-3">
        <h2><a href="#"><?= $video->getVideoTitle() ?></a></h2>
        <p class="mb-0"><i class="fas fa-eye"></i> <?= $video->getViews() ?> views</p>
    </div>
    <div class="single-video-author box mb-3">
        <div class="float-right"><button class="btn btn-danger" type="button">Subscribe</button> <button class="btn btn btn-outline-danger" type="button"><i class="fas fa-bell"></i></button></div>
        <img class="img-fluid" src="img/s4.png" alt="">
        <p><a href="#"><strong>Osahan Channel</strong></a> <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Verified"><i class="fas fa-check-circle text-success"></i></span></p>
        <small>Published on Aug 10, 2018</small>
    </div>
    <div class="single-video-info-content box mb-3">
        <h6>Cast:</h6>
        <p>Nathan Drake , Victor Sullivan , Sam Drake , Elena Fisher</p>
        <h6>Category :</h6>
        <p>Gaming , PS4 Exclusive , Gameplay , 1080p</p>
        <h6>About :</h6>
        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved overVarious versions have evolved over the years, sometimes </p>
        <h6>Tags :</h6>
        <p class="tags mb-0">
            <span><a href="#">Uncharted 4</a></span>
            <span><a href="#">Playstation 4</a></span>
            <span><a href="#">Gameplay</a></span>
            <span><a href="#">1080P</a></span>
            <span><a href="#">ps4Share</a></span>
            <span><a href="#">+ 6</a></span>
        </p>
    </div>
</div>