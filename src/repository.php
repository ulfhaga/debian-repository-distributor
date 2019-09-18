<?php
require 'bootstrap.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload Debian package</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<h1>
    Upload Debian package
</h1>
<body>
 Adds a repository into the folder /etc/apt/sources.list.d/  on your computer <br>
<?php
  $hostName = getenv('HTTP_HOST');
  echo "sudo echo deb [trusted=yes] http://$hostName/debtoox "
?>
<scan id="p1"></scan>
&nbsp;
<scan id="p2"></scan>
&nbsp;

<?php
  echo " > /etc/apt/sources.list.d/debtoox.list"
?>

<br>
<br>

<script>
    function handleClickSuit(suit) {
      currentValue = suit.value;
      document.getElementById('p1').innerHTML = currentValue;
    }

    function handleClickRepoType(repoType) {
      currentValue = repoType.value;
      document.getElementById('p2').innerHTML = currentValue;
    }

</script>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input class="color green button"  type="file" name="package" id="package"/>
    <br>Type of Suite: <br>
    <input type="radio" name="suit" onclick="handleClickSuit(this);"  value="stable">stable<br>
    <input type="radio" name="suit" onclick="handleClickSuit(this);"  checked="checked" value="unstable">unstable<br>

    <br>Type of repository: <br>
    <input type="radio" name="repotype" onclick="handleClickRepoType(this);"  value="main">main<br>
    <input type="radio" name="repotype" onclick="handleClickRepoType(this);"  checked="checked" value="contrib">contrib<br>
    <input type="radio" name="repotype" onclick="handleClickRepoType(this);" value="free">non-free<br>
    <input type="radio" name="repotype" onclick="handleClickRepoType(this);" value="test">test<br>

    <input class="color green button"  type="submit"/>
</form>

<script>
(function () {
   document.getElementById('p2').innerHTML = "contrib";
   document.getElementById('p1').innerHTML = "unstable";
})();
</script>

</body>
</html>
