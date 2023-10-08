$(document).ready(function() {
    $("#open-reservation-modal").on('click', function (e){
        let reservationModal =
         new bootstrap.Modal(document.getElementById('reservation-modal'));
        reservationModal.show();
    })

    $("#people").on('change', function (e){
        const price = parseInt(e.target.dataset.price);
        const total = price * $("#people").val();
        $("#total-price").html(total + " €");
    })

    $("#make-reservation").on('click', function (e){
        e.preventDefault();
        $("#make-reservation-alert").css("display", "none");
        const dateID = $("#date_start").val();
        const peopleNum = $("#people").val();
        const btn = document.getElementById('make-reservation');

        let errors = 0;

        if(peopleNum < 1 || peopleNum > 9){
            errors++;
        }

        if(errors === 0){
            $.ajax({
                url: 'models/reservations/add.php',
                method: 'POST',
                data: {
                    dateID: dateID,
                    peopleNum: peopleNum,
                    offerID: btn.dataset.offerid
                },
                dataType: 'JSON',
                success: function (res){
                    $("#make-reservation-alert").html(res.response);
                    $("#make-reservation-alert").css("display", "block");
                },
                error:function (err){
                    $("#make-reservation-alert").html(res.response);
                    $("#make-reservation-alert").css("display", "block");
                }
            })
        }
    })


})