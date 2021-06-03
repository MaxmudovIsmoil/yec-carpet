<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Image Upload Using Ajax Example with Coding Driver</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2>Laravel Image Upload Using Ajax Example with- <a href="https://codingdriver.com/">codingdriver.com</a></h2>
    <form method="post" id="upload-image-form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nomi</label>
            <input type="text" name="fullname" id="name" />
        </div>
        <div class="form-group">
            <input type="file" name="file" class="form-control" id="image-input">
            <span class="text-danger" id="image-input-error"></span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Upload</button>
        </div>

    </form>
    <h4 class="text-center">Images</h4>

    @foreach($img as $k => $v)
        <p>{{ $v->name }}</p>
        <img src="{{ url('storage/app/'.$v->path) }}" width="20%" alt="img" />
    @endforeach

</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#upload-image-form').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $('#image-input-error').text('');

        $.ajax({
            type:'POST',
            url: "{{ url('upload-images') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response) {
                    this.reset();
                    alert('Image has been uploaded successfully');
                    console.log(response)
                }
            },
            error: function(response){
                console.log(response);
                $('#image-input-error').text(response.responseJSON.errors.file);


            }
        });
        console.log(response);
    });
</script>
</body>
</html>
