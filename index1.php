<?php
error_reporting(E_ERROR | E_PARSE);
include_once 'connect.php';
$ide = $_POST['fn'];

//Fetch rating deatails from database
$query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM view_rating WHERE post_id = '$ide' AND status = 1";
$result = mysqli_query($conn,$query);
$ratingRow = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css1/rating.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js1/rating.js"></script>
<script language="javascript" type="text/javascript">
$(function() {
    $("#rating_star").spaceo_rating_widget({
        starLength: '5',
        initialValue: '',
        callbackFunctionName: 'processRating',
        imageDirectory: 'img1/',
        inputAttr: 'post_id'
    });
});

function processRating(val, attrVal){
    $.ajax({
        type: 'POST',
        url: 'rating.php',
        data: 'post_id= <?php echo $ide;?> & points='+val,
        dataType: 'json',
        success : function(data) {
            if (data.status == 'ok') {
                alert('You have rated '+val+'');
                $('#avgrat').text(data.average_rating);
                $('#totalrat').text(data.rating_number);
            }else{
                alert('please after some time.');
            }
        }
    });
}
</script>
<style type="text/css">
    .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
</style>
<title>Product Rating </title>
</head>
<body>
    <h1>Rating</h1>
    <input name="rating" value="0" id="rating_star" type="hidden"  />
    <div class="overall-rating">(Average Rating <span id="avgrat"><?php echo $ratingRow['average_rating']; ?></span>
    Based on <span id="totalrat"><?php echo $ratingRow['rating_number']; ?></span>  rating)</span></div>
    
</body>
</html>