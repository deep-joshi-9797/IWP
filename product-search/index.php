<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
    <script>
        function searchProduct(str) {
            if (str.length == 0) {
                document.getElementById("result").innerHTML = "";
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("result").innerHTML = xhr.responseText;
                }
            };

            xhr.open("GET", "search.php?q=" + str, true);
            xhr.send();
        }
    </script>
</head>
<body>

<h2>AJAX Product Search</h2>

<input type="text" onkeyup="searchProduct(this.value)" placeholder="Search product...">

<div id="result"></div>

</body>
</html>
