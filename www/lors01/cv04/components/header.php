<!DOCTYPE html>
<html>
<head>
    <title>Registration Form for Card Game Tournament</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script>
        function showImage() {
            var src = document.getElementById("avatar").value;
            var target = document.getElementById("target-avatar");
            if (src) {
                target.src = src;
                target.style.display = 'block';
            } else {
                target.style.display = 'none';
            }
        }
    </script>
</head>
<body>