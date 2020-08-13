<script>
    function Loginpage() {
        window.open(
            'LoginPage.php',
            '_blank');
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
            'index.php',
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
    function formview(name){
        var x = document.getElementById(name);
        if (x.style.display === "none") {
            //show
            x.style.display = "block";
            if(name == "Addform"){
                //avoid multiple forms being sent and to make the form look clean after selecting an appt
                var edbt = document.getElementById('btn_Edit').disabled;
                if(edbt == false){
                    btnuse('btn_Edit');
                    btnuse('btn_Delete');
                }
                clearallforms();
            }
            hideforms(x);
        } else {
            //hide
            x.style.display = "none";
            clearallforms(x);
        }
    }
    function btnuse(btn) {
        var x = document.getElementById(btn);
        if (x.disabled === true) {
            //enable
            x.disabled = false;
        } else {
            //disable
            x.disabled = true;
        }
    }
    function hideforms(form){
        if(form.id == "Addform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Editform"){
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Deleteform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Newmember"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
        }
    }
</script>