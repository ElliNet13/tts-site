<html>
<head>
  <title>TTS</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function shell() {
      var targetDiv = $('#run');
      $.ajax({
        url: `run.php?text=${$('#text').val()}`,
        statusCode: {
          400: function(data) {
            var consolehtml = $(`<p>Error: ${data.responseText}</p>`);
            targetDiv.append(consolehtml);
          }
        },
        success: function(data) {
          var consolehtml = $(`<audio autoplay controls src="${data}" type="audio/mp3"><a href="${data}">Audio file</a></audio>`);
          targetDiv.append(consolehtml);
        }
      });
    }
  </script>

</head>
<body>
  <h1>TTS</h1>
  <div id="run"></div>
  <br><button onclick="shell()">Create TTS</button>
  <br><input id="text" type="text">
  <script src="https://replit.com/public/js/replit-badge-v2.js" theme="dark" position="bottom-right"></script>
</body>
</html>