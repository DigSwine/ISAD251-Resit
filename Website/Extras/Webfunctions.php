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
        window.open(
            'HomePage.php',
            '_blank');
        <?php
            #------ needs fixing ---------
        echo $_SESSION["user"] ?>
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