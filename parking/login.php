<html>
<head>
<title>Javascript Login Form Validation</title>

<script >
    function ValidateForm()
     {
        var AGE =document.forms["myform"]["AGE"].value;
        if(AGE=="") {
            alert("AGE should be filled");
            return false;
        }
        if(isNaN(AGE)) {
            alert("AGE must be in number");
            return false;
        }
        if(AGE<18) {
            alert(" You are under 18");
            return false;
        }
        return true;
    }
</script>
</head>
<body>
    <h2>Javascript Login Form Validation</h2>
    <form action=" " method="post">
        <label for="username"> username :</label><br>
        <input type="username"  id="username" name="username"><br><br>
        <label for="password"> password :</label><br>
        <input type="password"  name="password"><br><br>
        <label for="AGE"> AGE :</label><br>
        <input type="AGE" id="AGE" name="AGE"><br><br>
        <label for="Email"> Email :</label><br>
        <input type="Email" id="Email"  name="Email"><br><br>
        <input type="submit" name="samm" value="submit">
    </form>
</body>
</html>


<?php
$server="localhost";
$DBname="root";
$pass="";
$Filename="shank";
$con=mysqli_connect($server,$DBname,$pass,$Filename);
if(isset($_POST['samm']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $age=$_POST['AGE'];
    $email=$_POST['Email'];

    $sql="INSERT into `ms1`(username,password,AGE,Email) Values ('$username','$password','$age','$email')";
    $result = mysqli_query($con,$sql);

    if($result==TRUE)
    {
echo"Register Successfull";
    }
    else
    {
echo"Register unsuccessfull";
    }
}
?>