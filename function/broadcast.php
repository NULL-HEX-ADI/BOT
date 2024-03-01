<?php

// Telegram bot token
$token = "6996301449:AAHfQYMGCwpEOsviw-VxgGmFQnLZM3UIUzA";

// Get chat ID of the owner
$ownerChatId = trim(file_get_contents("Database/owner.txt"));

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
            $chatId = trim($chatId);
            if (!empty($chatId)) {
                $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=".urlencode($message);
                $result = file_get_contents($url);
                if ($result === false) {
                    echo "Failed to send message to chat ID: $chatId\n";
                }
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
