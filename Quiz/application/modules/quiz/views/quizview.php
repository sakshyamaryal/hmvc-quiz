<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js">
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<!-- <link rel="stylesheet" href=""> -->
<link rel="stylesheet" href="css/style.css">


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
                    <div class="ans ml-2">
                        <label class="radio"> <input type="radio" name="option" value="1" class="mark"> <span id="option_a"></span>
                        </label>
                    </div>
                    <div class="ans ml-2">
                        <label class="radio"> <input type="radio" name="option" value="2" class="mark"> <span id="option_b"></span>
                        </label>
                    </div>
                    <div class="ans ml-2">
                        <label class="radio"> <input type="radio" name="option" value="3" class="mark"> <span id="option_c"></span>
                        </label>
                    </div>
                    <div class="ans ml-2">
                        <label class="radio"> <input type="radio" name="option" value="4" class="mark"> <span id="option_d"></span>
                        </label>
                    </div>
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
    var timer_arr = [];

    $(function() {
        data();
        playername();
        submit();
        
    });


    function data() {
        let count = 0;
        var timeleft = 20;
        var timeTaken = 0;
        var storetime;
        var storeQuestion;
        var newTime;
        var correct;
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

            // console.log(storetime);
            // console.log(timeTaken);
            // newTime = timer_arr.push(storetime);



        }, 1000);

        listQuestions(question);
        correctAnswer();
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
                // $('previous').show();
            }

            // $("[type=radio]").prop("checked", false);

            listQuestions(question);

        });

        $("#previous").click(function() {
            // radioBtn();
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
            const entries = Object.entries(sessionStorage)
            console.log(entries)
            console.log(timeleft);
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
            var date, playername, totalquestion, attemptedquestions, correctquestions, timeconsumed;
            playername = localStorage.getItem("playername");
            date = localStorage.getItem("date");
            timeconsumed = localStorage.getItem("timeTaken");
            totalquestions = 10;

            var url = "<?php echo base_url() . "quiz/savePlayerInfo" ?>";
            console.log(url);
            $.post(url, {
                playername,
                date,
                totalquestions,
                attemptedquestions,
                correctquestions,
                timeconsumed
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

    function radioButton(questions) {
        var val;
        $('.mark').click(function() {
            $('input[name="option"]:checked').each(function() {
                val = this.value;
                console.log(val);
                localStorage.setItem("correctanswer", val);
                localStorage.setItem(questions, val);
            });
        });

       
        // $("input[name=mygroup][value=" + value + "]").attr('checked', true);
        // $("#previous").click(function(){
        //     $('.1').prop("checked",true);
        //     $('.2').prop("checked",true);
        //     $('.3').prop("checked",true);
        //     $('.4').prop("checked",true);
        // });

        // var checked = localStorage.getItem("questionNo");
        

    }

    function correctAnswer() {
        var count = 0;

        var val;
        $('.mark').click(function() {
            $('input[name="option"]:checked').each(function() {
                val = this.value;
                console.log(val);
                // localStorage.setItem("correctanswer", count);
            });
            var correct = localStorage.getItem("answer");

            if (correct == val) {
                count = Number(count) + 1;
                localStorage.setItem("previous", count);
                console.log("increment" + count);
            } else {
                count = localStorage.getItem("previous");
                console.log("decrement" + count);
            }

         
        });
        


    };
    //     $( "select" )
    //   .change(function() {
    //     var str = "";
    //     $( "select option:selected" ).each(function() {
    //       str += $( this ).text() + " ";
    //     });
    //   })
    //   .trigger( "change" );



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
                var option_a = '';
                var option_b = '';
                var option_c = '';
                var option_d = '';
                var correct_option = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += data[i].question
                    option_a += data[i].option_a
                    option_b += data[i].option_b
                    option_c += data[i].option_c
                    option_d += data[i].option_d
                    correct_option += data[i].correct_option;
                }
                console.log("correct ans is" + correct_option);

                $('#question').html(html);
                $('#option_a').html(option_a);
                $('#option_b').html(option_b);
                $('#option_c').html(option_c);
                $('#option_d').html(option_d);
                $('#id').html(question);
                localStorage.setItem('answer', correct_option);
                localStorage.setItem('questionNo', question);
            }

        });

    }
</script>