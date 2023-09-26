  $(document).ready(function() {
    var songs = []; 
    var currentSongIndex = 0; 
    
    $(".audio-button").each(function() {
      songs.push($(this).data("src"));
    });

    var audio = $("#audioPlayer")[0];

    
    function playSong(index) {
      if (index >= 0 && index < songs.length) {
        currentSongIndex = index;
        audio.src = songs[currentSongIndex];
        audio.load();
        audio.play();
      }
    }

    
    audio.addEventListener("ended", function() {
      playNextSong();
    });

    
    function playNextSong() {
      currentSongIndex++;
      if (currentSongIndex >= songs.length) {
        currentSongIndex = 0; 
      }
      playSong(currentSongIndex);
    }

    
    $(".audio-button").click(function() {
      var index = $(this).index();
      console.log("Clicked index: " + index);
      playSong(index);
    });
  });


  $(document).ready(function () {
   $('#searchInput').on('input', function () {
        var searchTerm = $(this).val().toLowerCase();
        $('#musicButtons button').each(function () {
            var buttonTitle = $(this).text().toLowerCase();
            if (buttonTitle.includes(searchTerm)) {
                $(this).removeClass('d-none'); 
                console.log(buttonTitle);
            } else {
                $(this).addClass('d-none'); 
            }
        });
    });
  });

 $(document).ready(function() {
    $("#add_form").submit(function(event) {
        var checkboxes = $('input[type="checkbox"]:checked');
        
        if (checkboxes.length === 0) {
            alert("Please select at least one song.");
            event.preventDefault();
        }
    });
});
