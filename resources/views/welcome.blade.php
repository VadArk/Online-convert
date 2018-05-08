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
<h1>Custom File Converter <span>Only select a file and see the magic</span></h1>

    <div class="custom-file-upload">
        <!--<label for="file">File: </label>-->
        <form method="post" enctype="multipart/form-data" action="{{ route('convert') }}">
            @csrf

            <input type="file" id="file" name="files"  />
            <div class="custom-file-upload" >
                <button type="submit" class="file-upload-button" style="margin-top: 15%" >Upload</button>
            </div>
        </form>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script >//Reference:
    //https://www.onextrapixel.com/2012/12/10/how-to-create-a-custom-file-input-with-jquery-css3-and-php/
    ;(function($) {

        // Browser supports HTML5 multiple file?
        var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
            isIE = /msie/i.test( navigator.userAgent );

        $.fn.customFile = function() {

            return this.each(function() {

                var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
                    $wrap = $('<div class="file-upload-wrapper">'),
                    $input = $('<input type="text" class="file-upload-input" />'),
                    // Button that will be used in non-IE browsers
                    $button = $('<button type="button" class="file-upload-button">Select a File</button>'),
                    // Hack for IE
                    $label = $('<label class="file-upload-button" for="'+ $file[0].id +'">Select a File</label>');

                // Hide by shifting to the left so we
                // can still trigger events
                $file.css({
                    position: 'absolute',
                    left: '-9999px'
                });

                $wrap.insertAfter( $file )
                    .append( $file, $input, ( isIE ? $label : $button ) );

                // Prevent focus
                $file.attr('tabIndex', -1);
                $button.attr('tabIndex', -1);

                $button.click(function () {
                    $file.focus().click(); // Open dialog
                });

                $file.change(function() {

                    var files = [], fileArr, filename;

                    // If multiple is supported then extract
                    // all filenames from the file array
                    if ( multipleSupport ) {
                        fileArr = $file[0].files;
                        for ( var i = 0, len = fileArr.length; i < len; i++ ) {
                            files.push( fileArr[i].name );
                        }

                        filename = files.join(', ');

                        // If not supported then just take the value
                        // and remove the path to just show the filename
                    } else {
                        filename = $file.val().split('\\').pop();
                    }

                    $input.val( filename ) // Set the value
                        .attr('title', filename) // Show filename in title tootlip
                        .focus(); // Regain focus

                });

                $input.on({
                    blur: function() { $file.trigger('blur'); },
                    keydown: function( e ) {
                        if ( e.which === 13 ) { // Enter
                            if ( !isIE ) { $file.trigger('click'); }
                        } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
                            // On some browsers the value is read-only
                            // with this trick we remove the old input and add
                            // a clean clone with all the original events attached
                            $file.replaceWith( $file = $file.clone( true ) );
                            $file.trigger('change');
                            $input.val('');
                        } else if ( e.which === 9 ){ // TAB
                            return;
                        } else { // All other keys
                            return false;
                        }
                    }
                });

            });

        };

        // Old browser fallback
        if ( !multipleSupport ) {
            $( document ).on('change', 'input.customfile', function() {

                var $this = $(this),
                    // Create a unique ID so we
                    // can attach the label to the input
                    uniqId = 'customfile_'+ (new Date()).getTime(),
                    $wrap = $this.parent(),

                    // Filter empty input
                    $inputs = $wrap.siblings().find('.file-upload-input')
                        .filter(function(){ return !this.value }),

                    $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

                // 1ms timeout so it runs after all other events
                // that modify the value have triggered
                setTimeout(function() {
                    // Add a new input
                    if ( $this.val() ) {
                        // Check for empty fields to prevent
                        // creating new inputs when changing files
                        if ( !$inputs.length ) {
                            $wrap.after( $file );
                            $file.customFile();
                        }
                        // Remove and reorganize inputs
                    } else {
                        $inputs.parent().remove();
                        // Move the input so it's always last on the list
                        $wrap.appendTo( $wrap.parent() );
                        $wrap.find('input').focus();
                    }
                }, 1);

            });
        }

    }(jQuery));

    $('input[type=file]').customFile();
    //# sourceURL=pen.js
</script>
</body></html>
