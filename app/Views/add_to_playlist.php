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
    <a class="btn btn-light rounded-pill m-3 mb-4" href="/playlist/<?= $playlist[0]['playlist_id']?>"><i
            class="fa-solid fa-angle-left"></i> Back</a>
    <div>
        <span class="fs-5 bg-secondary mx-3 p-1 px-5 rounded-pill text-white">Add song(s) to
            <?= $playlist[0]['name']?> Playlist</span>
        <form id="add_form" class="mx-3 mt-3 p-3 shadow-lg rounded-2"
            action="/save_adding/<?= $playlist[0]['playlist_id']?>" method="post">
            <?php foreach ($music as $val):
            $checked = false;
                foreach ($playlistmusic as $pm):
                    
                    if($checked != true){
                        
                    if ($pm['music_id'] == $val['music_id'])
                        $checked = true;
                    else {
                        $checked = false;
                    } }
                endforeach;
                if (!$checked) {
            ?>
            <div class="input-group mb-1">
                <div class="input-group-text">
                    <input class="form-check-input mt-0" type="checkbox" name="song[]" id="<?=$val['music_id']?>"
                        value="<?=$val['music_id']?>">
                </div>
                <input type="text" class="form-control" aria-label="Text input with checkbox" disabled
                    value="<?=$val['title']?>">
            </div>
            <?php }
            endforeach;
            ?>
            <div class="text-end mt-3">
                <input class=" col-2 btn btn-warning" type="submit" value="Save">
            </div>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url()?>/assets/js/script.js"></script>

</html>