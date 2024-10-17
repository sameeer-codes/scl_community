<?php

require("_database/_dbconnect.php"); // Make sure this file correctly sets up $conn

// SQL to create Users table
$UsersTable = "CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- For storing hashed passwords
    profile_picture_url VARCHAR(255),
    bio TEXT,
    website_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// SQL to create Posts table
$PostsTable = "CREATE TABLE IF NOT EXISTS Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    caption TEXT,
    location VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

// SQL to create Comments table
$CommentsTable = "CREATE TABLE IF NOT EXISTS Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
)";

// SQL to create Likes table
$LikesTable = "CREATE TABLE IF NOT EXISTS Likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES Posts(post_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    UNIQUE(post_id, user_id) -- To ensure a user can like a post only once
)";

$FollowersTable = "CREATE TABLE IF NOT EXISTS Followers (
    follower_id INT NOT NULL,
    followed_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES Users(user_id),
    FOREIGN KEY (followed_id) REFERENCES Users(user_id),
    PRIMARY KEY (follower_id, followed_id) -- To ensure unique follower-followed pairs
)";

// Execute the SQL statements
$createUsersTable = mysqli_query($conn, $UsersTable);
$createPostsTable = mysqli_query($conn, $PostsTable);
$createCommentsTable = mysqli_query($conn, $CommentsTable);
$createLikesTable = mysqli_query($conn, $LikesTable);
$createFollowersTable = mysqli_query($conn, $FollowersTable);

// Check for errors
if ($createUsersTable && $createPostsTable && $createCommentsTable && $createLikesTable && $createFollowersTable) {
    echo "\n All tables have been created successfully.";
} else {
    echo "Error creating tables: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);