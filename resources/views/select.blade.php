
<!DOCTYPE html>
<head>
<title>Select Convert to</title>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato");
        body {
            font-family: Lato, Arial;
            color: #fff;
            padding: 20px;
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

        .select-hidden {
            display: none;
            visibility: hidden;
            padding-right: 10px;
        }

        .select {
            cursor: pointer;
            display: inline-block;
            position: relative;
            font-size: 16px;
            color: #fff;
            width: 220px;
            height: 40px;
        }

        .select-styled {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: #c0392b;
            padding: 8px 15px;
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
        .select-styled:after {
            content: "";
            width: 0;
            height: 0;
            border: 7px solid transparent;
            border-color: #fff transparent transparent transparent;
            position: absolute;
            top: 16px;
            right: 10px;
        }
        .select-styled:hover {
            background-color: #b83729;
        }
        .select-styled:active, .select-styled.active {
            background-color: #ab3326;
        }
        .select-styled:active:after, .select-styled.active:after {
            top: 9px;
            border-color: transparent transparent #fff transparent;
        }

        .select-options {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            left: 0;
            z-index: 999;
            margin: 0;
            padding: 0;
            list-style: none;
            background-color: #ab3326;
        }
        .select-options li {
            margin: 0;
            padding: 12px 0;
            text-indent: 15px;
            border-top: 1px solid #962d22;
            -moz-transition: all 0.15s ease-in;
            -o-transition: all 0.15s ease-in;
            -webkit-transition: all 0.15s ease-in;
            transition: all 0.15s ease-in;
        }
        .select-options li:hover {
            color: #c0392b;
            background: #fff;
        }
        .select-options li[rel="hide"] {
            display: none;
        }
        form{text-align: center}
        .file-upload-button {
            cursor: pointer;
            display: inline-block;
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            padding: 11px 20px;
            border: none;
            margin-left: 46%;
            background-color: #962d22;
            float: left;
            /* IE 9 Fix */
            -moz-transition: all 0.2s ease-in;
            -o-transition: all 0.2s ease-in;
            -webkit-transition: all 0.2s ease-in;
            transition: all 0.2s ease-in;
        }
    </style></head><body>
<h1>Selet convertion type <span>Convert file to</span></h1>
<!--
TO DO:
1. Add icons to List 
2. Toogle opened state
-->
<form method="post" enctype="multipart/form-data" action="{{ route('select') }}">
    @csrf

<select id="mounth" name="from">
    <option selected value="{{$from}}" rel="icon-temperature">{{$from}}</option>
</select>

<select required id="year" name="to" >
    @foreach($types as $type)
        <option value="{{ $type->outputformat }}">{{ $type->outputformat }}</option>
        @endforeach
</select>
<br>
    <input type="submit" class="file-upload-button" value="Convert">
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script >/*
Reference: http://jsfiddle.net/BB3JK/47/
*/

    $('select').each(function(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            //console.log($this.val());
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });
    //# sourceURL=pen.js
</script>
</body></html>