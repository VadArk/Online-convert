<!DOCTYPE html>
<head>

    <style class="cp-pen-styles">@import url("https://fonts.googleapis.com/css?family=Lato");
        * {
            margin: 0;
            padding: 0;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: Lato, Arial;
            color: #fff;
            padding: 55px 25px;
            background-color: #e74c3c;
            text-align: center;
        }

        h1 {
            font-weight: normal;
            font-size: 40px;
            font-weight: normal;
            text-transform: uppercase;
        }
        h1 span {
            font-size: 13px;
            display: block;
            padding-left: 4px;
        }

        p {
            margin-top: 200px;
        }
        p a {
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            color: #fff;
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #b83729;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
        p a:hover {
            background-color: #ab3326;
        }

        .custom-file-upload-hidden {
            display: none;
            visibility: hidden;
            position: absolute;
            left: -9999px;
        }

        .custom-file-upload {
            display: table;
            margin: 0 auto;
            width: auto;
            font-size: 16px;
            margin-top: 30px;
            text-align: center;
        }
        .custom-file-upload label {
            display: block;
            margin-bottom: 5px;
        }

        .file-upload-wrapper {
            position: relative;
            margin-bottom: 5px;
        }

        .file-upload-input {
            width: 300px;
            color: #fff;
            font-size: 16px;
            padding: 11px 17px;
            border: none;
            background-color: #c0392b;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
            float: left;
            /* IE 9 Fix */
        }
        .file-upload-input:hover, .file-upload-input:focus {
            background-color: #ab3326;
            outline: none;
        }

        .file-upload-button {
            cursor: pointer;
            display: inline-block;
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            padding: 11px 20px;
            border: none;
            margin-left: -1px;
            background-color: #962d22;
            float: left;
            /* IE 9 Fix */
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
        .file-upload-button:hover {
            background-color: #6d2018;
        }
    </style>
</head><body>
<h1>Download your file <span>Your file successfully converted </span></h1>
<h2> <a style="text-decoration: none; color: white; margin: 50px;" href="{{ asset('tmp') }}/{{$name}}">Download</a></h2>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script >//Reference:

</script>
</body></html>
