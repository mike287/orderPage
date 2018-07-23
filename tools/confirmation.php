<script>

    var user = "<?php echo $_SESSION['sender'];?>";
    var info = "<?php echo $_SESSION['info'];?>";

    if (info === '1'  ) {
        alert(user);
        <?php echo $_SESSION['sender'] =''?>
        <?php echo $_SESSION['info'] =''?>
    }

    if (info === '2') {
        alert(user);
        <?php echo $_SESSION['sender'] =''?>
        <?php echo $_SESSION['info'] =''?>
    }

</script>