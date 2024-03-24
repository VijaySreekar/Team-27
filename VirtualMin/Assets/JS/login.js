$(document).ready(function(){
    $("#login-form").on("submit", function(event){
        event.preventDefault(); // Prevent the form from submitting through the standard HTTP request

        $.ajax({
            url: "VerifyUser.php",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response){
                if(response.success){
                    // Construct a personalized welcome message based on the user's role
                    var welcomeMessage = "Login successful. ";
                    if(response.role === "admin"){
                        welcomeMessage += "Welcome, Admin " + response.username + ". "; // Assuming 'username' is sent in the response
                    }
                    welcomeMessage += "Redirecting in 3 seconds...";
                    $("#error-message").text(welcomeMessage);

                    // Start the countdown
                    var counter = 3;
                    var redirectUrl = response.role === "admin" ? '../AdminPage/adminpage.php' : '../../index.php'; // Decide the redirect URL based on the user's role
                    setInterval(function() {
                        counter--;
                        if (counter <= 0) {
                            window.location.href = redirectUrl;
                        } else {
                            // Update the message during the countdown
                            var countdownMessage = "Redirecting in " + counter + " seconds...";
                            if(response.role === "admin"){
                                countdownMessage = "Welcome, Admin " + response.username + ". " + countdownMessage; // Update message for admin
                            }
                            $("#error-message").text(countdownMessage);
                        }
                    }, 1000);
                } else {
                    $("#error-message").text(response.message);
                }
            },
            error: function(xhr, status, error){
                console.error("AJAX error: " + status + ": " + error); // Log AJAX errors
                $("#error-message").text("An error occurred. Please try again later.");
            }
        });
    });
});




$(document).ready(function(){
    $("#signup-form").on("submit", function(event){
        event.preventDefault();
        console.log("Signup form submitted");

        var formData = $(this).serialize() + "&register_btn=Register";

        $.ajax({
            url: "RegisterUser.php",
            type: "post",
            data: formData,
            dataType: "json",
            success: function(response){
                if(response.success){
                    alert("Registration successful!");
                    $("#change").prop("checked", !$("#change").prop("checked"));
                } else {
                    $("#signup-error-message").text(response.message);
                }
            },
            error: function(xhr, status, error){
                console.error("AJAX error: " + status + ": " + error);
                $("#signup-error-message").text("An error occurred during registration.");
            }
        });
    });
});