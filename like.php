<?php
if (isset($_GET['topicID'])) {
    try {
        $db = new PDO('sqlite:phpliteadmin/Forum.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $topicID = $_GET['topicID'];

        // Increment the like count for the topic
        $stmt = $db->prepare('UPDATE Post SET Likes = Likes + 1 WHERE TopicID = :topicID');
        $stmt->bindParam(':topicID', $topicID, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the topics page
        header('Location: Topics.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid topic ID.";
}
?>
