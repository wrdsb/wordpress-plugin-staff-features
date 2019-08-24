<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Fixed top navbar example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>
</head>

<body>
    <main role="main" class="container">
        <form>
            <div class="form-group">
                <label for="staffMember">Staff Member</label>
                <input type="text" class="form-control" id="staffMember" aria-describedby="staffMemberHelp" placeholder="Enter name">
            </div>

            <!-- Just capture this -->
            <div class="form-group">
                <label for="createdOn">Date Submitted</label>
                <input type="text" class="form-control" id="createdOn" aria-describedby="createdOnHelp" placeholder="2019-01-31">
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="absentOn">Date and Time of Absence</label>
                    <input type="text" class="form-control" id="absentOn" aria-describedby="absentOnHelp" placeholder="2019-01-31">
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">From</label>
                    <input type="text" class="form-control" id="absentOn" aria-describedby="absentOnHelp" placeholder="8:00">
                </div>
                <!-- Ignore in calculations -->
                <div class="form-group col-md-4">
                    <label for="absentOn">To</label>
                    <input type="text" class="form-control" id="absentOn" aria-describedby="absentOnHelp" placeholder="15:00">
                </div>
            </div>

            <div class="form-group">
                <label for="reason">Reason for absence</label>
                <select class="form-control" id="reason">
                    <option>A295 Staff development (include Short Term Ed. Leave (STEL) # or Staff Development (SD) #)</option>
                    <option>Board-mandated meeting (include Occasional Teacher (OT) allocation code)</option>
                    <option>A201 School Activity/Field Trip (include OT request form and Off Campus #)</option>
                    <option>A201 School Activity/Field Trip (internal coverage (on call) is expected) (specify FT/sport coached/club/event) (location)</option>
                    <option>Coaching (team)</option>
                    <option>Field Trip (destination)</option>
                    <option>Meeting (location)</option>

                    <option>A315 Personal Day</option>
                    <option>A100 Personal Illness</option>
                    <option>A400 Medical Appointments</option>
                    <option>A256 Family Care (specify relationship (son, daughter, etc.))</option>
                    <option>A212 Subject Association (specify subject)</option>
                    <option>A276 Staff Development (Board) (specify title, location, and SD #)</option>
                    <option>A326 Site Based 7-12 (School) (specify title, location)</option>
                    <option>A280 Bereavement (specify)</option>
                    <option>A400 Medical Appointment</option>
                    <option>A321 NTIP New Teacher</option>
                    <option>A322 NTIP Mentor</option>

                    <option>Family Care Day (indicate family member and reason)</option>
                    <option>Remedy Day</option>
                    <option>Other (indicate reason)</option>
                </select>
            </div>

            <div></div>

            <div class="form-group">
                <label for="staffMember">Easy Connect job number</label>
                <input type="text" class="form-control" id="staffMember" aria-describedby="staffMemberHelp" placeholder="123456">
            </div>

            Class 1, 2, 3, (maybe lunch):
            Room Number (defaults to what we know, but is input field)
            Lesson plans can be found (Main office; Department desk; classroom desk) (if unplanned absence code chosen, additional option for "emailed to main office staff")
            Medical Yes / No / Kid Name + another
            Behaviour Plan Yes / No / Details Kid Name + another
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-6 pt-0">Coverage Requested</legend>
                    <div class="col-sm-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="easyConnect1" name="easyConnect1" class="custom-control-input">
                            <label class="custom-control-label" for="easyConnect1">First Half Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="easyConnect2" name="easyConnect1" class="custom-control-input">
                            <label class="custom-control-label" for="easyConnect2">First Half No</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="easyConnect2" name="easyConnect1" class="custom-control-input">
                            <label class="custom-control-label" for="easyConnect2">Second Half Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="easyConnect2" name="easyConnect1" class="custom-control-input">
                            <label class="custom-control-label" for="easyConnect2">Second Half No</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>