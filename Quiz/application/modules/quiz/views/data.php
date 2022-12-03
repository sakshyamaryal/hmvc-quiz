<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<table class="table">
    <thead>
        <tr>
            <th scope="col">S.N</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col">Total Questions</th>
            <!-- <th scope="col">Attempted Questions</th> -->
            <th scope="col">Correct Answer</th>
            <th scope="col">Total Time</th>
            <th scope="col">Selected Options</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td id="playername"></td>
            <td id= date></td>
            <td id="totalquestion"></td>
            <!-- <td id="attemptedquestions"></td> -->
            <td id="correctquestions">{2,2,3,4,2,1,3,2,2,3}</td>
            <td id="timeconsumed"></td>
            <td id="selectedoptions"></td>

        </tr>
    </tbody>
</table>
<div class="text-center pt-1 mb-5 pb-1">
    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" id="back">Back to new game</button>
</div>

<script>
    var arr = [];
    $(function() {
        backToNewGame();
        fetchPlayerData();
    });

    function fetchPlayerData(){
        for (let index = 1; index <=10; index++) {
            var one = localStorage.getItem(index); 
            var items = arr.push(one + ",");
            console.log(localStorage.getItem("keys"));
        }
        
        var date,playername,totalquestion,attemptedquestions,correctquestions,timeconsumed,selectedoptions;
            playername = localStorage.getItem("playername");
            date = localStorage.getItem("date");
            timeconsumed = localStorage.getItem("timeTaken");
            totalquestion = 10;
            attemptedquestions = '';
            // correctquestions = localStorage.getItem("previous");
            timeconsumed = localStorage.getItem("timeTaken") + ' second';
            attemptedquestions = localStorage.getItem("attempt");
            selectedoptions = arr;
            $('#playername').html(playername);
            $('#date').html(date);
            $('#timeconsumed').html(timeconsumed);
            $('#totalquestion').html(totalquestion);
            $('#attemptedquestions').html(attemptedquestions);
            // $('#correctquestions').html(correctquestions);
            $('#selectedoptions').html(selectedoptions);
    }
    function backToNewGame() {
        $("#back").click(function() {
            window.location.replace('http://localhost/quiz/quiz');
        });
    }
</script>