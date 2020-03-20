<html>
<head>
    <title>Quotation Assigned</title>
    <style>
     
    </style>
</head>
<body>
    <div style="width: 60%;
    border: 1px solid #ddd;
    margin: 0 auto;">
    <p style="height: 51px;
    padding: 9px 0px 0px 47px;
    border-bottom: 1px solid #ddd;"><img src="http://54.255.235.110/images/logo.png" style="height: 45%;
    margin-left: 35%;"></p>
        
        <p style="font-weight:bold;color:black;padding: 0 15px;">Hello {{$user->name}} ({{$user->role->display_name}}),</p>
        <p style="padding:0 15px;">A new quotation with reference No.: {{$quotation_update->refrence_number}} has been assigned to you.</p>
    <table style="width:100%;border-spacing: 0px;" >
    <tbody>
      <tr style="background-color: #ebebef;
    /* padding: 31px 0; */
    height: 36px">
        <th style="font-weight:bold;
            color:black;">Customer </th>
        <td> {{$quotation_update->customer->name}}</td>
      </tr>
      <tr style=" height: 36px">
        <th style="font-weight:bold;
            color:black;">Project Name </th>
        <td>{{$quotation_update->quotation_for}}</td>
      </tr>
      <tr style="background-color: #ebebef;
    /* padding: 31px 0; */
    height: 36px">
        <th style="font-weight:bold;
            color:black;">Amount </th>
        <td>{{$quotation_update->currency}} {{$quotation_update->quotation_cost}}</td>
      </tr>
      <tr style=" height: 36px">
        <th style="font-weight:bold;
            color:black;">Created By </th>
        <td>{{$quotation_update->created_by}}</td>
      </tr>
   
        
        </tbody>
  </table>
       <center>
        <h2 style="background:white;padding: 0 15px;">
            <a href="http://192.168.18.127:8000/viewquotation/{{$quotation_update->id}}"   style="background-color: #008CBA;
color:white;font-weight:bold;   background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;">Go to Quotation</a>
        </h2>
        </center>
    </div>
</body>
</html>
