<script src="/js/main.js"></script>

<script type="text/javascript">
if (document.getElementById('test')) {
  var like = document.getElementById('test');

  like.addEventListener('click', function(e) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/photo/like?photo_id=<?php if (isset($photo['id'])) print $photo['id']; ?>&user_id=<?php if (null !== $session->get('user.id')) print $session->get('user.id'); ?>', true);

    xhr.onload = function() {
      if (xhr.status >= 300 && xhr.status < 400) {
        var data = JSON.parse(xhr.responseText);
        console.log(data);
      } else {
        var data = JSON.parse(xhr.responseText);
        console.log(data);
      }
    };

    xhr.onerror = function() {
      console.log('connection error');
    };

    xhr.send();

  });
}
</script>
</main>
</body>
</html>
