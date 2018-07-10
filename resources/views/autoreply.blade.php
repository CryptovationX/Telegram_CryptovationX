<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style>
            .hidden {
                display: none;
            }
    </style>
    </head>
<body>
<div class="container">
{!! Form::open(['action'=>'TelegramAutoReplyController@store','enctype' => 'multipart/form-data']) !!}
<div class="row">
        <div class="alert alert-success" id="boardcast-alert">
				<span class="glyphicon glyphicon-ok"></span> Hello
		</div>
</div>
<div class="form-group">
    {!! Form::label('heading', 'Your Heading') !!}
    {!! Form::text('heading', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group">
    {!! Form::label('content', 'Your Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<div class="row" >

        <div class='col-md-3'>
            {{Form::file('file', ['id' => 'attach_file'])}}

        </div>

    </div>
    <div class="row" style="margin-bottom:20px">
        <div class='col-md-10' style="margin-top:20px">
            <p>• For browser uploading, 10 MB max size for photos (JPEG, JPG and PNG allowed) and 50 MB for other files.</p>
            <p>• For HTTP URL, 5 MB max size for photos (JPEG, JPG and PNG allowed) and 20 MB max for other types of content.</p>
            <p>• Note: HTTP URL can be directly placed in content box.</p>
        </div>
        <div class="col-md-2" style="margin-top:20px"></div>

{!! Form::submit('Submit', ['class' => 'btn btn-info', 'id' => 'submit-button']) !!}

{!! Form::close() !!}
</div>

@section('scripts')
	<script>
	        $("#boardcast-alert").hide();
            $("#submit-button").click(function () {
                
                window.setTimeout(function () { 
                    $("#boardcast-alert").slideDown(75, function(){
                    $("#boardcast-alert").slideDown(500);
                    })
                });
                window.setTimeout(function () { 
                    $("#boardcast-alert").slideUp(500, function(){
                    $("#boardcast-alert").slideUp(500);
                    });  
                } , 2000);   
            }); 

    </script>
@endsection
</body>
</html>