<?php

// Get chat ID of the owner
$ownerChatId = file_get_contents("Database/owner.txt");

// Get chat IDs of users
$chatIds = file_get_contents("Database/free.txt");
$chatIds = explode("\n", $chatIds);

// Check if the command is '/broadcast'
if (isset($_GET['command']) && $_GET['command'] == '/broadcast') {
    // Get the message from the command
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
        // Send message to all users
        foreach ($chatIds as $chatId) {
            if (!empty($chatId)) {
                $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=".urlencode($message);
                file_get_contents($url);
            }
        }
        // Respond to the bot command
        echo "Broadcast message sent to all users.";
    } else {
        echo "Please provide a message.";
    }
} else {
    echo "Invalid command.";
}
