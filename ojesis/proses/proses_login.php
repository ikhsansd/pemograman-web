<?php
    $username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "" ;
    $password = (isset($_POST['password'])) ? htmlentities($_POST['password']) : "" ;
    if(!empty($_POST['submit_validate'])){
        if($username == "abc@gmail.com" && $password == "abc"){
            header('location:../home');
        }else{ ?>
            <script>
                alert('Username atau password yang anda masukan salah');
                window.location='../login'
            </script>
<?php
        }
    }
?>