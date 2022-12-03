<?php
if ($_SESSION['username'] && $_SESSION['password']) { ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">


                        <h4>PLAYER STATS</h4>
                    </div>
                </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class="sn">S.N</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">Total Questions</th>
                <!-- <th scope="col">Attempted Questions</th> -->
                <!-- <th scope="col">Correct Answer</th> -->
                <th scope="col">Selected Answer</th>
                <th scope="col">Total Time(In seconds)</th>

            </tr>
        </thead>

        <?php
        $sn = 1;
        foreach ($played as $key) {
            echo ' <tbody>
                    <tr>' .
                '<th scope="row">' . $sn++ . '</th>' . '
                            <td id="playername">' . $key['playername'] . '</td>' . '
                            <td id= "date">' . $key['date'] .  '</td>' . '
                            <td id="totalquestion">' . $key['totalquestions'] . '</td>' . '

                            
                            <td id="timeconsumed">{' . $key['selectedoption'] . '}</td>
                            <td id="timeconsumed">' . $key['timeconsumed'] . '</td>
                            </tr>
                            </tbody>';
        } ?>

    </table>
    <form action="" method="post">
        <div class="text-center pt-1 mb-5 pb-1">
            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" name="submit" type="submit" id="back">Back</button>
        </div>
    </form>

<?php     } else {
    header('location:' . base_url() . 'quiz/admin');
}
if (isset($_POST['submit'])) {
    header('location:' . base_url() . 'quiz/showData');
}
?>