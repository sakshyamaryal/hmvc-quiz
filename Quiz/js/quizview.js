var key = [];

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
        radioButton() ;
        correctAnswer();
    });


}

function playername() {
    var player = localStorage.getItem("playername");
    if (player == '' || player == null) {
        window.location.replace( 'http://localhost/quiz/quiz');
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
        correctquestions = localStorage.getItem("previous");
        attemptedquestions = localStorage.getItem("attempt");

        var url = "http://localhost/quiz/quiz/savePlayerInfo";
        console.log(url);
        $.post(url, {
            playername,
            date,
            totalquestions,
            attemptedquestions,
            correctquestions,
            timeconsumed
        });

        window.location.replace('http://localhost/quiz/quiz/viewsingleData');
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
            if(val){
            for(var i = 1; i<=questionnumber ; i++){
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
            for(var i = 1; i<=questionnumber ; i++){
            var count = 0;
            val = this.value;
            var correct = localStorage.getItem("answer");
            
            // $("input[name=option][value=" + correct + "]").prop("checked", true);
            // $('#'+correct).css("background-color", "green");
          
            if (correct === val) {
                // count = Number(count) + 1;
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