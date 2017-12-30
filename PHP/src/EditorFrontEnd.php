<!DOCTYPE html>
<html>

<head>
    
    <script src='jquery-1.12.1.js'></script>
    <style type="text/css" media="screen">
        #Editor {
            margin: 0px;
            position: absolute;
            width: 65%;
            height: 60%;
            border-radius: 10px;
            z-index:1;
        }
        
        #Submit {
            position: absolute;
            top: 78%;
            left: 74%;
            width: 90px;
            height: 30px;
            background: green;
            color: white;
            border-radius: 5px;
        }
        
        #EditorsInvisibleTextArea {
            display: none;
        }
        
        #language {
            position: absolute;
            top: 49%;
            left: 74%;
            width: 90px;
            height: 30px;
            background: rgb(100, 100, 100);
            color: white;
            border: 0px;
            border-radius: 5px;
        }
        
        #InputTextArea {
            position: absolute;
            top: 13%;
            left: 68%;
            height: 200px;
            width: 26%;
            display: none;
        }
        
        #OutputFrame {
            position: absolute;
            top: 70%;
            height: 130px;
            border-radius: 10px;
            width: 65%;
        }
        
        #Run {
            position: absolute;
            top: 72%;
            left: 74%;
            width: 90px;
            height: 30px;
            background: green;
            color: white;
            border-radius: 5px;
        }
        #SaveButton {
            position: absolute;
            top: 84%;
            left: 74%;
            width: 90px;
            height: 30px;
            background: green;
            color: white;
            border-radius: 5px;
        }  
        #BackButton {
            position: absolute;
            top: 90%;
            left: 74%;
            width: 90px;
            height: 30px;
            background: green;
            color: white;
            border-radius: 5px;
        }
        
        #custom-input-toggle {
            position: absolute;
            top: 30px;
            left: 68%;
            width: 150px;
            height: 30px;
            background: green;
            color: white;
            border-radius: 5px;
        }
        
        #Note {
            position: absolute;
            top: 62%;
            height: 130px;
            border-radius: 10px;
            width: 580px;
        }
        #err{
            position:relative;
            margin:1% 35%;
            color:red;
        }
        /* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 3; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
padding-top: 60px;
align-items: center;
}
#container{
position: relative;
top:10%;
padding:16%;
}
.animate {
-webkit-animation: animatezoom 0.6s;
animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
from {-webkit-transform: scale(0)}
to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
from {transform: scale(0)}
to {transform: scale(1)}
}
.modal-content {

align-content: center;
background-color: #fefefe;
margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
border: 1px solid #888;
width: 40%; /* Could be more or less, depending on screen size */
}
input[type=text]{
width: 70%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;

}

.login{
position:relative;
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
float:right;
}

/* Extra styles for the cancel button */

.lcancelbtn{
position: relative;
float:left;
background-color: #4CAF50;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
cursor: pointer;
}


#extension{
    position:relative;
    margin:2% 10%;
}

    </style>
</head>

<body>
    <!--------------------------------------FORM DECLARATION STARTS---------------------------------------->

    <div id="Editor" name="Editor"></div>
    <p id="Note" style="color:red">
        <form action="EditorBackEnd.php" method="POST" name="editorform" target="OutputFrame">
            <textarea name="Code" id="EditorsInvisibleTextArea"></textarea>
            <textarea name="Args" id="InputTextArea" placeholder="Enter Run  Input here"></textarea>
            <select name="language" id="language" onchange="Onchange(this.value)">
	<option value="c">C</option>
	<option value="cpp">C++</option>
	<option value="java">Java</option>
    <option value="pl">Perl</option>
    <option value="php">PHP</option>
   <option value="py">Python</option>
</select>

            <button type="submit" id="Run" name="Run">Run</button>
            <button type="submit" id="Submit" name="Submit">Submit</button>
            
        </form>
        <button onclick="document.getElementById('id01').style.display='block'" id='SaveButton'>Save</button>
        <button id="custom-input-toggle" name='togglebutton'>Click for custom Input</button>
        <iframe name="OutputFrame" id="OutputFrame"></iframe>

        <form action="contestpage.php" target="_parent">
            <button type="submit" id="BackButton">Back</button>
        </form>
        <div id="id01" class="modal">

<div class="modal-content animate">
<div id="err"></div>
<div class="container">

<label><b> FileName &nbsp; </b></label>
<input type="text" placeholder="Enter Filename" id="fname"><br>

<label><b> FileType &nbsp; </b></label>
<select name="language" id="extension" onchange="Onchange(this.value)">
	<option value="c">C</option>
	<option value="cpp">C++</option>
	<option value="java">Java</option>
    <option value="pl">Perl</option>
    <option value="php">PHP</option>
   <option value="py">Python</option>
</select>



</div>
<div class="container" style="background-color:#f1f1f1">
<button onclick="save()" class='login' name="login-Button">Save</button>
<button type="button"  onclick="document.getElementById('id01').style.display='none'" class="lcancelbtn">Cancel</button>
</div>
</div>
</div>

        <!--------------------------------------FORM DECLARATION ENDS------------------------------------------>
        <!--------------------------------------EDITOR INTGRATION STARTS---------------------------------------->
        <!-- load ace -->
        <script src="ace.js"></script>
        <!-- load ace language tools -->
        <script src="ext-language_tools.js"></script>
        <script>
            // trigger extension
            ace.require("ace/ext/language_tools");
            var editor = ace.edit("Editor");

            editor.session.setMode("ace/mode/c_cpp");
            editor.setTheme("ace/theme/monokai");
            editor.setShowPrintMargin(false);
            editor.setHighlightActiveLine(true);
            editor.resize();
            editor.setBehavioursEnabled(true);
            editor.getSession().setUseWrapMode(true);
            editor.getSession().setUseWrapMode(true);
            // enable autocompletion and snippets
            editor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                nableLiveAutocompletion: true
            });

        </script>
        <script src="./show_own_source.js"></script>
        <script type="text/javascript">
            var textarea = $('#EditorsInvisibleTextArea');
            editor.getSession().on('change', function () {
                textarea.val(editor.getSession().getValue());
            });
        </script>
        <script type="text/javascript">
            var text = $('#InputTextArea');
            $("#custom-input-toggle").on('click', function () {
                text.toggle();

                $(this).text(function (i, text) {


                    return text === "Click for sample Input" ? "Click for custom Input" : "Click for sample Input";
                });
            });
            $(document).ready(function () {
                $("#custom-input-toggle").click(function () {
                    $("#InputTextArea").val("");
                });
            });
            function Onchange(val) {
                if (val == "java") {
                    document.getElementById('Note').innerHTML = '<b>Note:Please name your class as "main".<a href="CodeFile.java" target="OutputFrame">Refer this link</a></b>';
                }
                else {
                    document.getElementById('Note').innerHTML = "";
                }
            }
        
        </script>
        <!--------------------------------EDITOR INTEGRATION ENDS---------------------------------------------->
        
        <script type="text/javascript">
            $(document).on("keydown", function (e) {
                if (e.which === 8 && !$(e.target).is("input:not([readonly]):not([type=radio]):not([type=checkbox]):not([type=button]):not([type=submit]), textarea, [contentEditable], [contentEditable=true]")) {
                    e.preventDefault();
                }
            });

        </script>
        <script>
         
        function save(){
            $fname=document.getElementById("fname").value;
            $ext=document.getElementById("extension").value;
            $data=editor.getSession().getValue();
            if($fname === ""){
              errormessage("Enter Filename!");
            }

jQuery.ajax({
    type: "POST",
    url: 'savetofile.php',
    dataType: 'json',
    data: {functionname: 'savetofile', content:$data ,filename:$fname, extension:$ext},
});
document.getElementById('id01').style.display='none';
}
function errormessage($message) {
    $("#err").html($message);
    $( "#err" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  }

        </script>

</body>

</html>