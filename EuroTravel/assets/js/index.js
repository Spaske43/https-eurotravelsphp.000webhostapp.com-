$( document ).ready(function() {

    //     ANKETA
        $("#poll-btn").on("click", function (e){
            e.preventDefault();
    
            const countryID = $('input[name="country"]:checked').val();
    
            if(countryID){
                $.ajax({
                    url: 'models/poll/add.php',
                    method: 'POST',
                    data: {
                        countryID: countryID
                    },
                    dataType: 'JSON',
                    success: function (res){
                        $("#poll-alert").css("display", "block");
                        $("#poll-alert").html(res.response);
                    },
                    error:function (err){
                        console.log(err)
                    }
                })
            }else{
                $("#poll-alert").css("display", "block");
                $("#poll-alert").html("Izaberite opciju.");
            }
        })
    })