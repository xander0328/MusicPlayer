<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1cbcfd8c59.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Calistoga&family=Poppins:wght@100;500&display=swap');

    .title {
        font-family: Calistoga;
    }

    * {
        font-family: Poppins;
    }

    ul {
        list-style: none;
    }
    </style>
</head>

<body>
    <div class=" fs-1 p-2 px-3 bg-warning d-flex justify-content-between align-items-center">
        <div class="title"><i class="fa-solid fa-circle-play"></i> Music Player</div>
        <div><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#upload">
                Upload
            </button>
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#playlist">
                My Playlists
            </button>
        </div>
    </div>

    <div class="text-center mx-auto col-4 m-2 rounded-pill border">
        <span class="m-2"><i class="fa-solid fa-magnifying-glass"></i></span>
        <input class=" border-0 col-10  p-2" type="text" name="" id="searchInput" placeholder="Search Song">
    </div>

    <div class="m-2" id="musicButtons">
        <?php 
            foreach ($music as $val) :
            ?>
        <button
            class=" audio-button rounded-2 btn btn-light mb-1 form-control d-flex justify-content-between align-items-center"
            type="button" data-src="<?= $val['file']?>">
            <div>
                <i class="fa-solid fa-angle-right"></i> <?= $val['title']?>
            </div>
            <span class="badge bg-light rounded-2 ms-1 "><a class="btn btn-sm"
                    href="/delete_song/<?=$val['music_id']?>"><i class="fa-solid fa-trash"></i>
                </a></span>
        </button>
        <?php endforeach;?>
    </div>

    <audio id="audioPlayer" class="form-control position-fixed bottom-0" src="" controls autoplay>
        There's a problem playing the file
    </audio>

    <!-- Upload Music Modal-->
    <div class="modal" id="upload">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Music File</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="/upload" enctype="multipart/form-data">
                        <input class="form-control mb-2" type="file" name="file" id="" accept=".mp3, .wav, .ogg">
                        <input class=" btn btn-warning form-control" type="submit" value="Upload">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Playlists Modal-->
    <div class="modal" id="playlist">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">My Playlists</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div>
                        <?php foreach ($playlist as $val):?>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a class="btn btn-light form-control rounded-2 rounded-end-0"
                                href="/playlist/<?=$val['playlist_id']?>"><?= $val['name'] ?>
                            </a>
                            <span class="badge bg-danger rounded-start-0  rounded-2"><a class="btn btn-sm text-white"
                                    href="/delete_playlist/<?= $val['playlist_id']?>"><i class="fa-solid fa-trash"></i>
                                </a>
                            </span>
                        </div>

                        <?php endforeach;?>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <a class="btn btn-warning form-control" href="/create_playlist">Create New</a>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url()?>/assets/js/script.js"></script>

</html>