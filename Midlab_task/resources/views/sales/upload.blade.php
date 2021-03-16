<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= <div class="container text-center">
        <h2>Product Sales Log</h2>
        <div class="col-md-6 ">
            @include('include.alert')
            <form action="{{ route('SalesController.salesLog') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                <input type="file" class="form-control" name="file" value="{{ old('file') }}" >
                </div>
                <span class="text-danger">@error('file'){{ $message }}@enderror</span>
                

                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Load Sales Data</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
        </div>, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>