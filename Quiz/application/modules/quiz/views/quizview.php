<title>quiz</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url() ?>css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<span>Total Time Taken - <span id="timetaken"></span><span>&nbsp;seconds</span></span>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">

                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <div>Welcome,
                            <p id="player"></p>
                        </div>

                        <h4>MCQ Quiz</h4><span>Timeleft-<span id="timer"></span></span>
                    </div>
                </div>
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row align-items-center question-title">
                        <h3 class="text-danger" id="id">
                            <h3 class="text-danger">/10</h3>
                        </h3>
                        <h5 class="mt-1 ml-2" id='question'></h5>
                    </div>
                    <div class="options"></div>
                </div>

                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                    <button class="btn btn-primary d-flex align-items-center btn-danger" type="button" id='previous' class="prev">
                        <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>

                    <button class="btn btn-primary border-success align-items-center btn-success" type="button" id='next'>Next
                        <i class="fa fa-angle-right ml-2"></i></button>

                    <button class="btn btn-primary border-success align-items-center btn-success" type="button" id='submit'>Submit
                        <i class="fa fa-angle-right ml-2"></i></button>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
  
    var arr = [];
    $(function() {
        data();
        playername();
        submit();
        radioButton();
        correctAnswer();
    });


    function data() {
        let count = 0;
        var timeleft = 20;
        var timeTaken = 0;
        var storetime;
        var storeQuestion;
        var newTime;
        var correct;
        var item;
        var question = Math.floor((Math.random() * 1) + 1);

        var downloadTimer = setInterval(function() {

            if (timeleft == 0) {
                question = question + 1;
                if (question <= 10) {
                    listQuestions(question);
                    timeleft = 20;
                    $("#timer").html(timeleft);
                }

            } else if ((timeleft < 0)) {
                clearInterval(downloadTimer);
            } else {
                $("#timer").html(timeleft);
            }
            timeleft -= 1;
            timeTaken += 1;
            $("#timetaken").html(timeTaken);
            storetime = sessionStorage.setItem(question, timeleft);

            localStorage.setItem("timeTaken", timeTaken);
        }, 1000);

        listQuestions(question);

        $("#next").click(function() {
            storetime = sessionStorage.key(question);
            question = question + 1;

            if (storetime) {
                timeleft = sessionStorage.getItem(question);
            } else {
                timeleft = 20;
            }

            if (storetime > 10) {
                sessionStorage.clear(question);
            }

            if (question == 10) {
                $('#next').hide();
            } else {
                $('#next').show();
            }
            listQuestions(question);

            radioButton();
            correctAnswer();
        });

        $("#previous").click(function() {

            question = question - 1;

            storetime = sessionStorage.key(question);
            if (storetime) {

                timeleft = sessionStorage.getItem(question);
            } else {
                timeleft = 20;
            }
            if (question == 1) {
                $('#previous').hide();
            }
            if (question < 10) {
                $('#next').show();
            }

            listQuestions(question);
            radioButton();
            correctAnswer();
        });


    }

    function playername() {
        var player = localStorage.getItem("playername");
        if (player == '' || player == null) {
            window.location.replace(<?php base_url() ?> 'quiz');
        } else {
            $("#player").html(player);
        }
    }

    function submit() {
        $("#submit").click(function() {
            for (let index = 1; index <=10; index++) {
            var one = localStorage.getItem(index); 
            var items = arr.push(one + ",");
            console.log(arr);
                }
                localStorage.setItem("keys",arr);
        
            var date, playername, totalquestion, attemptedquestions, correctquestions, timeconsumed,selectedoption;
            playername = localStorage.getItem("playername");
            date = localStorage.getItem("date");
            timeconsumed = localStorage.getItem("timeTaken");
            totalquestions = 10;
            correctquestions = localStorage.getItem("previous");
            attemptedquestions = localStorage.getItem("attempt");
            selectedoption = localStorage.getItem("keys");
            var url = "<?php echo base_url() . "quiz/savePlayerInfo" ?>";
            console.log(url);
            $.post(url, {
                playername,
                date,
                totalquestions,
                attemptedquestions,
                correctquestions,
                timeconsumed,
                selectedoption
            });

            window.location.replace(<?php base_url() ?> 'viewsingleData');
        });
    }

    function makeCounter(count) {
        return function() {
            count++;
            return count;
        };
    }

    function radioButton() {
        var val;
        var questionnumber;
        var checkbox;
        var change;
        var question;
        var value;
        $('.mark').click(function() {

            $('input[name="option"]:checked').each(function() {
                val = this.value;
                questionnumber = localStorage.getItem('questionNo');
                if (val) {
                    for (var i = 1; i <= questionnumber; i++) {
                        // attempt = Number(attempt) + 1;
                        localStorage.setItem("attempt", i);
                        console.log(val);
                        localStorage.setItem("correctanswer", val);
                        question = localStorage.setItem(questionnumber, val);
                    }
                }
            });

        });

    }


    function correctAnswer() {
        var val;
        $('.mark').click(function() {
            $('input[name="option"]:checked').each(function() {
                var questionnumber = localStorage.getItem('questionNo');
                val = this.value;
                for (var i = 1; i <= questionnumber; i++) {
                    var count = 0;
                    
                    var correct = localStorage.getItem("answer");

                    // $("input[name=option][value=" + correct + "]").prop("checked", true);
                    // $('#'+correct).css("background-color", "green");

                    if (correct === val) {
                        count = Number(count) + 1;
                        localStorage.setItem("previous", i);
                    } else {
                        count = localStorage.getItem("previous");
                    }
                }
            });
        });
    };

    function listQuestions(question) {
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url(); ?>Quiz/show',
            async: false,
            dataType: 'json',
            type: "POST",
            data: {
                "question": question
            },
            success: function(data) {
                var html = '';
                var option = '';
                var correct_option = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += data[i].question

                    correct_option += data[i].correct_option;

                    option += '<div class="ans ml-2">' +
                        '<label class="radio" id="1"> <input type="radio" name="option" value="1" class="mark"> <span id="option_a">' + data[i].option_a + '</span>' +
                        '</label>' +
                        '</div>' +
                        '<div class="ans ml-2">' +
                        '<label class="radio" id="2"> <input type="radio" name="option" value="2" class="mark"> <span id="option_b">' + data[i].option_b + '</span>' +
                        '</label>' +
                        '</div>' +
                        '<div class="ans ml-2">' +
                        '<label class="radio" id="3"> <input type="radio" name="option" value="3" class="mark"> <span id="option_c">' + data[i].option_c + '</span>' +
                        '</label>' +
                        '</div>' +
                        '<div class="ans ml-2">' +
                        '<label class="radio" id="4"> <input type="radio" name="option" value="4" class="mark"> <span id="option_d">' + data[i].option_d + '</span>'
                    '</label>' +
                    '</div>';
                }
                console.log("correct ans is" + correct_option);

                $('#question').html(html);
                $('.options').html(option);

                $('#id').html(question);
                localStorage.setItem('answer', correct_option);
                localStorage.setItem('questionNo', question);
                if (localStorage.key(question)) {
                    $('input[value="' + localStorage.getItem(question) + '"]').prop("checked", true);
                    console.log(localStorage.key(question));
                }

            }
        });



    }
</script>