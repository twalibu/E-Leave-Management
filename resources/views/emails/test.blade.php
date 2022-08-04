<!DOCTYPE html>
<html>
<head>
    <title>New Leave Application</title>
</head>
<body>
 
            
             
    <p>Hi </p>
     
    <p>the user {{$pendind['name'] }} applied for a leave of type: {{ $pendind['type'] }} for total days: {{ $pendind['total_day'] }}
    starting from: {{ $pendind['start_date'] }} and ending in:{{ $pendind['end_date'] }} </p>
    

    <p>the reason of the leave is: {{ $pendind['reason'] }}</p>
     
    <p>Thank you</p>
</body>
</html> 