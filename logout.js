window.addEventListener('beforeunload', function (event) {
     // Create an XMLHttpRequest to call the logout script
     var xhr = new XMLHttpRequest();
     xhr.open('GET', 'logout.php', false); // Synchronous request
     xhr.send();
 });
 