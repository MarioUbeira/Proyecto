document.getElementById('numField').addEventListener('keydown', function(e) {
    if (!isNaN(parseInt(e.key))) {
        e.preventDefault();
    }
});