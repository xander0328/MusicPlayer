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
    <a class="btn btn-light rounded-pill m-3 mb-4" href="/"><i class="fa-solid fa-angle-left"></i> Back</a>
    <br>
    <span class="fs-5 bg-secondary mx-3 p-1 px-5 rounded-pill text-white">Create Playlist</span>

    <form class="mx-3 mt-3 p-3 shadow-lg rounded-2" action="/save_playlist" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">Playlist Name: </span>
            <input type="text" class="form-control" name="playlist_name" required>
        </div>
        <div>
            <div class="fs-4 mb-2">Add songs</div>
            <?php 
            $index = 0;
            foreach ($music as $val):?>
            <div class="input-group mb-1">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" name="song[]" id="<?=$val['music_id']?>"
                        value="<?=$val['music_id']?>">
                </div>
                <input type="text" class="form-control" aria-label="Text input with checkbox" disabled
                    value="<?=$val['title']?>">
            </div>

            <!-- <input type="checkbox" name="song[]" id="<?=$val['music_id']?>" value="<?=$val['music_id']?>">
            <label for="<?=$val['music_id']?>"><?=$val['title']?></label><br> -->
            <?php $index++;
        endforeach; ?>
        </div>
        <div class="text-end mt-3">
            <input class=" col-2 btn btn-warning" type="submit" value="Save">
        </div>

    </form>
</body>

</html>