$( document ).ready(function() {

    //     DODAVANJE DATUMA U FORMU
        $("#offerID").on("change", function (e){
    
            const id = e.target.value;
    
            $.ajax({
                url: 'models/offers/getDates.php',
                method: 'GET',
                data: {
                   id: id
                },
                dataType: 'JSON',
                success: function (res){
                    let select = document.getElementById("dateID");
                    let html = "";
                    res.forEach(item => {
                        html += `
                            <option value="${item.id}">${item.date_start}</option>
                        `;
                    });
                    select.innerHTML = html;
                },
                error:function (err){
                    console.log(err)
                }
            })
        })
    
    //     PROVERA FORMA ZA DODAVANJE REZERVACIJE
        $("#add-reservation-btn").on('click', function (e){
            e.preventDefault();
    
            const offerID = $("#offerID");
            const userID = $("#userID");
            const people = $("#people");
            const dateID = $("#dateID");
    
            let errors = 0;
    
            if(offerID.val() == 0){
                offerID.next().html('Izaberite ponudu.');
                errors++;
            }else{
                offerID.next().html('');
            }
    
            if(userID.val() == 0){
                userID.next().html('Izaberite korisnika.');
                errors++;
            }else{
                userID.next().html('');
            }
    
            if(people.val() < 1 || people.val() > 9){
                people.next().html('Izaberite broj osoba.');
                errors++;
            }else{
                people.next().html('');
            }
    
            if(offerID.val() == 0){
                dateID.next().html('Izaberite prvo ponudu da bi ste vidite datume.');
                errors++;
            }else{
                dateID.next().html('');
            }
    
            if(errors === 0){
                $.ajax({
                    url: 'models/reservations/addAdmin.php',
                    method: 'POST',
                    data: {
                        offerID: offerID.val(),
                        userID: userID.val(),
                        people: people.val(),
                        dateID: dateID.val()
                    },
                    dataType: 'json',
                    success: function (res){
                        if(res.success){
                            location.reload();
                        }else{
                            $("#reservation-alert").html(res.response);
                            $("#reservation-alert").css("display", "block");
                        }
    
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    
        //     PROVERA FORMA ZA DODAVANJE PONUDE
        $("#add-offer-btn").on('click', function (e){
            e.preventDefault();
    
            const name = $("#offer_name");
            const countryID = $("#countryID");
            const location = $("#location");
            const image_url = $("#image_url");
            const price = $("#price");
            const length = $("#length");
            const date = $("#date");
            const desc = $("#description");
    
            // REGEX
            const urlReg = /^https:\/\/.{6,}$/i;
    
            let errors = 0;
    
            if(name.val().length < 3){
                name.next().html('Naziv mora imati bar 3 karaktera.');
                errors++;
            }else{
                name.next().html('');
            }
    
            if(countryID.val() == 0){
                countryID.next().html('Izaberite drzavu.');
                errors++;
            }else{
                countryID.next().html('');
            }
    
            if(location.val().length < 3){
                location.next().html('Lokacija mora imati bar 3 karaktera.');
                errors++;
            }else{
                location.next().html('');
            }
    
            if(!urlReg.test(image_url.val())){
                image_url.next().html('Neispravan url.');
                errors++;
            }else{
                image_url.next().html('');
            }
    
            if(price.val() <= 0){
                price.next().html('Cena mora biti veca od 0.');
                errors++;
            }else{
                price.next().html('');
            }
    
            if(length.val() <= 0){
                length.next().html('Broj dana mora biti veci od 0.');
                errors++;
            }else{
                length.next().html('');
            }
    
            if(!date.val()){
                date.next().html('Izaberite datum polaska.');
                errors++;
            }else{
                date.next().html('');
            }
    
            if(desc.val().length < 10){
                desc.next().html('Opis mora imati barem 10 karaktera.');
                errors++;
            }else{
                desc.next().html('');
            }
    
    
            if(errors === 0){
                $.ajax({
                    url: 'models/offers/add.php',
                    method: 'POST',
                    data: {
                        name: name.val(),
                        countryID: countryID.val(),
                        location: location.val(),
                        image_url: image_url.val(),
                        price : price.val(),
                        length: length.val(),
                        date: date.val(),
                        desc : desc.val()
                    },
                    dataType: 'json',
                    success: function (res){
                        if(res.success){
                            document.location.reload();
                        }else{
                            $("#offer-alert").html(res.response)
                            $("#offer-alert").css("display", "block")
                        }
    
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    
        // DODAJ DRZAVU
        $("#add-country-btn").on("click" ,function (e){
            e.preventDefault();
    
            const name = $("#country_name");
            const flag_url = $("#flag_url");
    
        //     REGEX
            const nameReg = /[a-zšđžćč]{3,50}/i;
            const urlReg = /^https:\/\/.{6,}$/i;
    
            let errors = 0;
    
            if(!nameReg.test(name.val())){
                name.next().html('Dozvoljena su samo slova.');
                errors++;
            }else{
                name.next().html('');
            }
    
            if(!urlReg.test(flag_url.val())){
                flag_url.next().html('Dozvoljena su samo slova.');
                errors++;
            }else{
                flag_url.next().html('');
            }
    
            if(errors === 0){
                $.ajax({
                    url: 'models/countries/add.php',
                    method: 'POST',
                    data: {
                        name: name.val(),
                        flag_url: flag_url.val()
                    },
                    dataType: 'json',
                    success: function (res){
                        if(res.success){
                            document.location.reload();
                        }else{
                            $("#country-alert").html(res.response)
                            $("#country-alert").css("display", "block")
                        }
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    
    //     DODAJ DATUM POLASKA
        $("#add-date-btn").on("click", function (e){
            e.preventDefault();
    
            const offerID = $("#offer");
            const date = $("#date");
    
            let errors = 0;
    
            if(offerID.val() == 0){
                offerID.next().html('Izaberite ponudu kojoj zelite da dodate datum.');
                errors++;
            }else{
                offerID.next().html('');
            }
    
    
            if(!date.val()){
                date.next().html('Izaberite datum.');
                errors++;
            }else{
                date.next().html('');
            }
    
            if(errors === 0){
                $.ajax({
                    url: "models/dates/add.php",
                    method: 'POST',
                    data: {
                        offerID: offerID.val(),
                        date:date.val()
                    },
                    dataType: 'json',
                    success: function (res){
                        if(res.success){
                            document.location.reload();
                        }else{
                            $("#date-alert").html(res.response)
                            $("#date-alert").css("display", "block")
                        }
                    },
                    error: function (err){
                        console.log(err)
                    }
                })
            }
        })
    })