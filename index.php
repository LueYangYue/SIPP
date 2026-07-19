<!DOCTYPE html>
<html>
  <head>
    <script>
      fetch('https://github.com/LueYangYue/SIPP/src/landing.html')
        .then(response => response.text())
        .then(data => {
          document.innerHTML = data;
          document.open();
          document.write(data);
          document.close();
        })
        .catch(error => {
          console.error('Error fetching landing.html:', error);
        });
    </script>
  </head>
  <body></body>
</html>