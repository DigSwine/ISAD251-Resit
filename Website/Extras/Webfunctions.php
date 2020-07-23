<script>
    function Loginpage() {
        window.open('LoginPage.php', '_blank');
        close();
    }

    function newuser() {
        window.open(
            'NewFamily.php',
            '_blank');
        close();
    }

    function Backtohome() {
        window.open(
            'HomePage.php',
            '_blank');
        close();
    }

    function Logout() {
        <?php
        $_SESSION["name"] = "";
        $_SESSION["role"] = "";
        ?>
        window.open(
            'HomePage.php',
            '_blank');
        close();
    }

    function openParent() {
        window.open(
            'ParentView.php',
            '_blank');
        close();
    }

    function openChild(){
        window.open(
            'ChildView.php',
            '_blank');
        close();
    }
</script>