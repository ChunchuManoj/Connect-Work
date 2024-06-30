<?php

session_start();
session_destroy();
echo "user successfully logout";
echo "
<script>
setTimeout(function() {
    window.location.href='../Home_page/Signin/index.php';
}, 1000);
</script>
"
?>