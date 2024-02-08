<?php
setcookie("testCookie", "testValue", [
    'expires' => time() + 3600,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax' // Explicitly set for demonstration, Snuffleupagus should enforce this
]);

if (isset($_COOKIE['testCookie'])) {
    echo "Cookie 'testCookie' is set.<br/>";
    echo "Manual verification needed: Check browser's DevTools to confirm 'SameSite=Lax' attribute.";
} else {
    echo "Cookie 'testCookie' is not set. Something went wrong.";
}
?>
