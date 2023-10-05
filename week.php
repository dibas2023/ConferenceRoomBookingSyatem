<?php
session_start();
if(!$_SESSION['email'])
{
    header("Location:index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Slot Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="weekStyle.css">
    <link rel="stylesheet" href="./bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.0.2-dist/css/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="head">
        <div class="Left">
            <h2> Conference Booking System </h2> 
        </div>
        <div class="Right">
            <?php
            echo "<h7>{$_SESSION['email']}</h7>";
            ?>
        </div>
        <div class="logout">
            <a href="logout.php" id="">Logout</a>
        </div>  
</div>
    <div class="datecontainer">
        <div class="datesection">
            <form method="post" action="">
                <label for="date">Enter a Date:</label>
                <div class="datePart">
                    <input type="date" id="date" name="date">
                </div>
                <div class="submitPart">
                    <input type="submit" value="Generate">
                </div>
            </form>
        </div>
    </div>
    <?php
    include 'conection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["date"])) {
        $inputDate = $_POST["date"];
    } else {
        $inputDate = date("Y-m-d"); 
    }
        // Create a DateTime object from the input date
        $date = new DateTime($inputDate);
        $currentDate = new DateTime();
        if ($date->format('Y-m-d') < $currentDate->format('Y-m-d')) {
            echo '<div class=" errordiv">';
            echo '<p class="alertmsg">You have selected a previous date. Please select the current date or a future date.</p>';
            echo '</div>';
        }
        else{
            echo '<div class="tablecontainer">';
            echo '<table class="tableBody">';
            echo '<thead>';
            echo '<tr>';
            echo '<th class="heading">Day</th>';
            echo '<th class="heading">Date</th>';
            echo '<th class="headingTime">Time Slots</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            // Loop through the days of the week
            $currentDate = clone $date;
            echo '<tr>';
            echo '<td>' . $currentDate->format('l') . '</td>';
            echo '<td>' . $currentDate->format('Y-m-d') . '</td>';
            echo '<td class="slotButton">';
            $datee = $currentDate->format('Y-m-d');
            for ($i = 10; $i <= 16; $i++) {
                // check which user already booked..
                $query = "SELECT isActive, user_email, booking_title, booking_des FROM SlotTable WHERE booking_time = '$i' AND booking_date ='$datee'";
                $result = mysqli_query($db, $query);
            
                if ($result && $row = mysqli_fetch_assoc($result)) {
                    $b = $i + 1;
                    if ($row['user_email'] === $_SESSION['email']) {
                        echo '<button class="danger cancel-slot cheacktime" data-day="' . $currentDate->format('Y-m-d') . '" data-time="' . $i . '">Cancel</button>';
                    } else {
                        echo '<button class="danger bookedid cheacktime" data-day="' . $currentDate->format('Y-m-d') . '" data-time="' . $i . '" data-title="' . $row['booking_title'] . '" data-description="' . $row['booking_des'] . '">Booked</button>';
                    }
                } else {
                    $b = $i + 1;
                    echo '<button class="normal slot-button cheacktime" data-day="' . $currentDate->format('Y-m-d') . '" data-time="' . $i . '">' . $i . ":00" . "-" . $b . ':00</button>';
                }
            }
            echo '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
    
        }

    ?>
    <!-- Slot Booking Modal -->
    <div class="modal fade" id="slotModal" tabindex="-1" role="dialog" aria-labelledby="slotModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="slotModalLabel">Book Slot</h4>
                </div>
                <div class="modal-body">
                    <p id="slotDescription">Slot details go here.</p>
                    <form id="slotForm" method="post" action="action.php">
                        <div class="form-group">
                            <input type="hidden" name="day" id="day">
                            <input type="hidden" name="time" id="time">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" name="description" rows="4" placeholder="Enter description"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" id="bookSlotButton" value="book">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Already booking slot Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content bookmodal">
            <div class="modal-header">
                <h4 class="modal-title" id="bookModalLabel">Slot Booking Details</h4>
            </div>
            <div class="modal-body">
                <p id="dateDes"> </p>
                <p id="bookedSlotTitle"> </p>
                <p id="bookedSlotDescription"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function () {
            var currentTime = new Date();
            var currentHour = currentTime.getHours();
            var currentDate = currentTime.toISOString().slice(0, 10);
            $('.cheacktime').each(function () {
                var day = $(this).data('day');
                var time = $(this).data('time');
                if (day === currentDate && time <= currentHour) {
                    $(this).prop('disabled', true);
                }
            });
            // open slot booking modal
            $('.slot-button').click(function () {
                var day = $(this).data('day');
                var time = $(this).data('time');
                $("#time").val(time);
                $("#day").val(day);
                var description = "Slot on " + day + " at " + time + ":00";
                $('#slotDescription').text(description);
                $('#slotModal').modal('show');
            });
            $('.bookedid').click(function () {
                var day = $(this).data('day');
                var time = $(this).data('time');
                var bookedTitle = $(this).data('title');
                var bookedDescription = $(this).data('description');
                var des = "Slot on " + day + " at " + time + ":00 is already booked";
                $('#dateDes').text(des);
                $('#bookedSlotTitle').text("Title: " + bookedTitle);
                $('#bookedSlotDescription').text("Description: " + bookedDescription);
                $('#bookModal').modal('show');
            });

            $('.cancel-slot').click(function () {
                    var day = $(this).data('day');
                    var time = $(this).data('time');
                    // Send an AJAX request to cancel the slot
                    $.ajax({
                        type: 'POST',
                        url: 'cancel_slot.php', 
                        data: {
                            day: day,
                            time: time
                        },
                        success: function (response) {
                            alert('Slot canceled successfully');
                            window.location.href = 'week.php';
                        },
                        error: function (error) {
                            console.error('Slot cancellation failed:', error);
                        }
                    });
                });

            
        });
        
    
    </script>
</body>
</html>


