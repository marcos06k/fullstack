<?php
    session_start();
    session_write_close();
    include("conexao.php");
    $banco->close();
    echo "<META http-equiv='refresh' content='0,URL=login.html'>";
    
?>