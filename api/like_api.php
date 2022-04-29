<?php 
include 'dbConfig.php';

// if user clicks like or dislike button

if (isset($_POST['action'])) {

  $image_id = $_POST['image_id'];
  $action = $_POST['action'];

  switch ($action) {
    //insert user into liked images table id user like image
  	case 'like':
         $sql = "INSERT INTO liked_images (user_id, image_id, like_time) VALUES ($user_id, $image_id, NOW())";     
         break;

  	case 'unlike':
	      $sql = "DELETE FROM liked_images WHERE user_id = $user_id AND image_id = $image_id";
	      break;

  	default:
  		break;
  }

  // execute query to effect changes in the database 
  mysqli_query($db, $sql);

  echo getRating($image_id);

  exit(0);
}


// Get total number of likes for a particular post
function getLikes($id)
{
  global $db;
  $sql = "SELECT COUNT(*) FROM liked_images WHERE image_id = $id ";
  $rs = mysqli_query($db, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}



// Get total number of likes for a particular post and encode it to json
function getRating($id)
{
  global $db;

  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM liked_images WHERE image_id = $id";

  $likes_rs = mysqli_query($db, $likes_query);
  $likes = mysqli_fetch_array($likes_rs);

  $rating = [
  	'likes' => $likes[0],
  ];

  return json_encode($rating);
}



// Check if user already likes post or not
function userLiked($image_id)
{
  global $db;
  global $user_id;

  $sql = "SELECT * FROM liked_images WHERE user_id = $user_id AND image_id = $image_id ";
  $result = mysqli_query($db, $sql);

  if (mysqli_num_rows($result) > 0) {
    
  	return true;
  }else{
    
  	return false;
  }
}