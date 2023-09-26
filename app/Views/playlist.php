<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1cbcfd8c59.js" crossorigin="anonymous"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Calistoga&family=Poppins:wght@100;500&display=swap');

    .title {
        font-family: Calistoga;
    }

    * {
        font-family: Poppins;
    }
    </style>
</head>

<body>
    <div class=" fs-1 p-2 px-3 bg-warning d-flex justify-content-between align-items-center">
        <div class="title"><i class="fa-solid fa-circle-play"></i> Music Player</div>
        <div></div>
    </div>
    <a class="btn btn-light rounded-pill m-3 mb-4" href="/"><i class="fa-solid fa-angle-left"></i> Back</a><br>
    <span class="fs-5 bg-secondary mx-3 p-1 px-5 rounded-pill text-white">Playlist</span>

    <div class="mx-3 mt-3 p-2 shadow-lg rounded-2">
        <div class="fs-2 px-3 p-2 d-flex justify-content-between align-items-center">
            <div><i class="fa-solid fa-compact-disc"></i> <?= $playlist['name']?></div>
            <div><a class="btn btn-warning" href="/add_to_playlist/ <?=$playlist['playlist_id']?>">Add Song</a></div>
        </div>

        <div id="musicButtons">
            <?php foreach ($music as $val):?>
            <button type="button"
                class="audio-button btn btn-light mb-1 form-control d-flex justify-content-between align-items-center"
                data-src="<?= $val['file']?>">
                <div><i class="fa-solid fa-angle-right"></i> <?=$val['title']?></div>
                <span class="badge bg-light rounded-2 ms-1"><a class="btn btn-sm"
                        href="/remove_song/<?= $playlist['playlist_id']."/".$val['music_id']?>"><i
                            class="fa-solid fa-xmark"></i></a></span>
            </button>
            <?php endforeach; ?>
        </div>


    </div>
    <audio id="audioPlayer" class="form-control position-fixed bottom-0" src="" controls autoplay>There's a problem
        playing the file
    </audio>
</body>
<script src=" https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url()?>/assets/js/script.js"></script>

</html>