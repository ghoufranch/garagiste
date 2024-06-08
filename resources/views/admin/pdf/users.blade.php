<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>USers List</title>
    </head>
    <body>
        <p class="h1">Users List</p>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
              </tr>
            </thead>
            <tbody>
                @if(count($users))
                    @foreach ($users as $user)
              <tr>
               
                <td>{{$user->id}}</td>
                <td>{{ $user->name }}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->phone}}</td>
               
              </tr>
                    @endforeach 
              @else
                <tr>
                    <td colspan="3">NO USER FOUND</td>
                </tr>
              @endif
                
              
            </tbody>
          </table>
          
          
          
    </body>
</html>

