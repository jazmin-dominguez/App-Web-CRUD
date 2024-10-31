<!-- funciones.php -->
<?php
function incluirWeglot() {
    echo '
    <script type="text/javascript" src="https://cdn.weglot.com/weglot.min.js"></script>
    <script>
        Weglot.initialize({
            api_key: "wg_9ec94632da65fbf9be08565c3fe0a96b1",
            save_language: true
        });
    </script>';
}
?>
