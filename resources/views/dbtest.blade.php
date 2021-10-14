<!doctype html>
<html>
  <head>
    <title>MariaDB Info</title>
  </head>
  <body>
   @foreach($members as $member)
   {{ $member->account}} <br/>
   @endforeach

  </body>
</html>