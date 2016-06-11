<!DOCTYPE html>
<html>
<head>
    <title>TestCase</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>
@endif
<div class="container">
    <div class="content">
        <h1>Test case</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Input file</div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => route('post_case'),'novalidate' => 'novalidate','files' => true)) !!}
                        <div class="form-group">
                            <label for="fileToUpload">Select yout file to submit</label>
                            <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"
                                   accept=".txt">
                        </div>
                        <button type="submit" value="Upload Image" class="btn btn-default">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @if($output!=null)
                <div class="col-md-6">
                    @include('output',['output'=>$output])
                </div>
            @endif
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
</body>
</html>
