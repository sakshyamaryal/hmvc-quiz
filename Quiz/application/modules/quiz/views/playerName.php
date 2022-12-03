<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<section class="h-100 gradient-form" style="background-color: #eee;">

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">

                                    <h4 class="mt-1 mb-5 pb-1" id="name"></h4>
                                </div>
                                <p>Enter your name</p>
                                <form>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11"></label>
                                        <input type="text" id="playername" class="form-control" />

                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" id="navigate">ENTER</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(function() {
        playerData();
    });

    function playerData() {
        $("#navigate").click(function() {
            var playername = $("#playername").val();

            var date = new Date();

            if (playername == '') {
                $('#name').html('Player Name cannot be null!')
            } else {
                localStorage.setItem("playername", playername);
                localStorage.setItem("date", date);
                window.location.replace('http://localhost/quiz/quiz/quizTemplate');
            }

        });
    }
</script>