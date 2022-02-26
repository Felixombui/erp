<?php
include 'config.php';
if(isset($_POST['login'])){
    $username=addslashes($_POST['username']);
    $password=addslashes($_POST['password']);
    $encpass=md5($password);
    $loginqry=mysqli_query($config,"SELECT * FROM users WHERE username='$username' AND password='$encpass'");
    if(mysqli_num_rows($loginqry)>0){
        session_start();
        $loginrow=mysqli_fetch_assoc($loginqry);
        $_SESSION['username']=$loginrow['username'];
        $_SESSION['emailaddress']=$loginrow['emailaddress'];
        $_SESSION['fullnames']=$loginrow['fullnames'];
        $_SESSION['level']=$loginrow['rights'];
        header('location:index.php');
    }else{
        $err='<img src="images/error.png" width="23" height="23" align="left"> Login failed! Wrong username and/or password.';
    }
}
?>
<div class="loginform">
    <form action="" method="post">
        
        <div style="padding:6px;text-align:center;font-weight:bolder;">Login</div>
        <input type="text" name="username" placeholder="Enter your username..." required="required">
        <input type="password" name="password" placeholder="Enter your password..." required="required">
        <input type="submit" name="login" value="Login">
        <a href="recover.php" style="color: blue;">Forgot your password?</a><br>
        <?php echo $err ?>
    </form>

</div>

<style>
<?php echo include 'styles.css';
?>
</style>