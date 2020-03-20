<html>
<head>
    <title>Register Successfully</title>
    <style>
      
    </style>
</head>
<body>
    <div style="  width: 60%;
    border: 1px solid #ddd;
    margin: 0 auto;">
    <p style="height: 51px;
    padding: 9px 0px 0px 47px;
    border-bottom: 1px solid #ddd;"><img src="http://54.255.235.110/images/logo.png" style=" height: 45%;
    margin-left: 35%;"></p>
        
        <p style="font-weight:bold;color:black;padding: 0 15px;">Hello {{$user->name}},</p>
        <p style="padding:0 15px;">Registration successfull at geberit.com.</p>
        <p style="padding:0 15px;">Now you can use the login details provided to you to login.</p>
    <table style="width:100%;border-spacing: 0px;" >
    <tbody>
      <tr style="background-color: #ebebef;height: 36px">
        <th style="font-weight:bold;
            color:black;">Name </th>
        <td> {{$user->name}}</td>
      </tr>
      <tr style=" height: 36px">
        <th style="font-weight:bold;
            color:black;">Email </th>
        <td>{{$user->email}}</td>
      </tr>
      <tr style="background-color: #ebebef;height: 36px">
        <th style="font-weight:bold;
            color:black;">Password </th>
        <td>{{$pass}}</td>
      </tr>
     
   
        
        </tbody>
  </table>
       <center>
        <h2 style="background:white;padding: 0 15px;">
            <a href="http://192.168.18.127:8000/login"  style="background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;font-weight:bold;background-color: #008CBA;
color:white;">Click here to login</a>
        </h2>
        </center>
    </div>
</body>
</html>
