<?php 
// Include the database config file 
include_once 'dbConfig.php'; 
 
$postID = 1; // It will be changed with dynamic value 
 
// Fetch the post and rating info from database 
$query = "SELECT p.*, COUNT(r.rating_number) as rating_num, FORMAT((SUM(r.rating_number) / COUNT(r.rating_number)),1) as average_rating FROM posts as p LEFT JOIN rating as r ON r.post_id = p.id WHERE p.id = $postID GROUP BY (r.post_id)"; 
$result = $db->query($query); 
$postData = $result->fetch_assoc(); 
?>
<!DOCTYPE HTML>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
$(function() {
    $('.rate input').on('click', function(){
        var postID = <?php echo $postData['id']; ?>;
        var ratingNum = $(this).val();
		
        $.ajax({
            type: 'POST',
            url: 'rating.php',
            data: 'postID='+postID+'&ratingNum='+ratingNum,
            dataType: 'json',
            success : function(resp) {
                if(resp.status == 1){
                    $('#avgrat').text(resp.data.average_rating);
                    $('#totalrat').text(resp.data.rating_num);
					
                    alert('Thanks! You have rated '+ratingNum+' to "<?php echo $postData['title']; ?>"');
                }else if(resp.status == 2){
                    alert('You have already rated to "<?php echo $postData['title']; ?>"');
                }
				
                $( ".rate input" ).each(function() {
                    if($(this).val() <= parseInt(resp.data.average_rating)){
                        $(this).attr('checked', 'checked');
                    }else{
                        $(this).prop( "checked", false );
                    }
                });
            }
        });
    });
});
</script>
</head>
<body>
<div class="container">
    <h1><?php echo $postData['title']; ?></h1>
    <div class="rate">
        <input type="radio" id="star5" name="rating" value="5" <?php echo ($postData['average_rating'] >= 5)?'checked="checked"':''; ?>>
        <label for="star5"></label>
        <input type="radio" id="star4" name="rating" value="4" <?php echo ($postData['average_rating'] >= 4)?'checked="checked"':''; ?>>
        <label for="star4"></label>
        <input type="radio" id="star3" name="rating" value="3" <?php echo ($postData['average_rating'] >= 3)?'checked="checked"':''; ?>>
        <label for="star3"></label>
        <input type="radio" id="star2" name="rating" value="2" <?php echo ($postData['average_rating'] >= 2)?'checked="checked"':''; ?>>
        <label for="star2"></label>
        <input type="radio" id="star1" name="rating" value="1" <?php echo ($postData['average_rating'] >= 1)?'checked="checked"':''; ?>>
        <label for="star1"></label>
    </div>
    <div class="overall-rating">
        (Average Rating <span id="avgrat"><?php echo $postData['average_rating']; ?></span>
        Based on <span id="totalrat"><?php echo $postData['rating_num']; ?></span> rating)</span>
    </div>
	
    <div class="content"><?php echo $postData['content']; ?></div>
</div>
</body>
</html>