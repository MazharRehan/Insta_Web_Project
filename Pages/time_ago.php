<?php
// tells time ago in days, hours, minutes, seconds

// $time_ago = "2021-05-01 12:00:00";
$time_ago = strtotime($time_ago);
$current_time = time();
$time_difference = $current_time - $time_ago;
$seconds = $time_difference;
$minutes = round($seconds / 60); // 60 seconds in 1 minute
$hours = round($seconds / 3600); // 3600 seconds in 1 hour
$days = round($seconds / 86400); // 86400 seconds in 1 day
$weeks = round($seconds / 604800); // 604800 seconds in 1 week
$months = round($seconds / 2629440); // 2629440 seconds in 1 month
$years = round($seconds / 31553280); // 31553280 seconds in 1 year
if ($seconds <= 60) {
    echo "Just now";
} else if ($minutes <= 60) {
    if ($minutes == 1) {
        echo "1 minute ago";
    } else {
        echo "$minutes minutes ago";
    }
} else if ($hours <= 24) {
    if ($hours == 1) {
        echo "1 hour ago";
    } else {
        echo "$hours hours ago";
    }
} else if ($days <= 7) {
    if ($days == 1) {
        echo "1 day ago";
    } else {
        echo "$days days ago";
    }
} else if ($weeks <= 4.3) // 4.3 == 52/12
{
    if ($weeks == 1) {
        echo "1 week ago";
    } else {
        echo "$weeks weeks ago";
    }
} else if ($months <= 12) {
    if ($months == 1) {
        echo "1 month ago";
    } else {
        echo "$months months ago";
    }
} else {
    if ($years == 1) {
        echo "1 year ago";
    } else {
        echo "$years years ago";
    }
}

?>