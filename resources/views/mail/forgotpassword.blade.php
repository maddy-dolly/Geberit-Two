<html>
<head>
    <title>Forgot Password</title>
    <style>
        
    </style>
</head>
<body>
    <div style="border: 1px solid #ddd;
    margin: 0 auto;
    ">
    <p style="height: 51px;
    padding: 9px 0px 0px 47px;
    border-bottom: 1px solid #ddd; "><img src="http://54.255.235.110/images/logo.png" style="height: 45%;
    margin-left: 35%;"></p>
        
        <p style="font-weight:bold;color:black;padding: 0 15px;">Hello,</p>
        <p style="padding:0 15px;">We get a new password reset request for your account. Click the below link to get a new password.</p>
   
       <center>
        <h2 style="background:white;padding: 0 15px;">
            <a href="http://192.168.18.127:8000/forgotpassword/{{$pass->token}}" class="button button2" style="color:white;font-weight:bold;padding: 12px;background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            background-color: #008CBA;
            color:white;
            cursor: pointer;">Click here to reset password</a>
        </h2>
        </center>
    </div>
</body> 
</html>
