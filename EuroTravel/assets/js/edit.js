$( document ).ready(function() {

    $("#edit-reservation-btn").on('click', function (e){
        e.preventDefault();

        const offerID = $("#offerID");
        const userID = $("#userID");
        const people = $("#people");
        const dateID = $("#dateID");
        const id = $("#id");

        let errors = 0;

        if(offerID.val() == 0){
            offerID.next().html('Niste izabrali ponudu.');
            errors++;
        }else{
            offerID.next().html('');
        }

        if(userID.val() == 0){
            userID.next().html('Niste izabrali korisnika.');
            errors++;
        }else{
            userID.next().html('');
        }

        if(people.val() > 9 || people.val() < 1){
            people.next().html('Neispravan broj osoba.');
            errors++;
        }else{
            people.next().html('');
        }

        if(dateID.val() == 0){
            dateID.next().html('Niste izabrali datum.');
            errors++;
        }else{
            dateID.next().html('');
        }

        if(id.val() == 0){
            id.next().html('Greska.');
            errors++;
        }else{
            id.next().html('');
        }

        if(errors === 0){
            $.ajax({
                url: 'models/reservations/update.php',
                method: 'POST',
                data: {
                    offerID: offerID.val(),
                    userID : userID.val(),
                    people : people.val(),
                    dateID : dateID.val(),
                    id: id.val()
                },
                dataType: 'json',
                success: function (res){
                    $("#reservation-alert").html(res.response)
                    $("#reservation-alert").css("display", "block")
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })

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
                select.innerHTML = "";

                res.forEach(item => {
                    select.innerHTML += `
                        <option value="${item.id}">${item.date_start}</option>
                    `;
                })
            },
            error:function (err){
                console.log(err)
            }
        })
    })

//     IZMENA PONUDE
    $("#edit-offer-btn").on("click", function (e){
        e.preventDefault();

        const name = $("#offer_name");
        const countryID = $("#countryID");
        const location = $("#location");
        const image_url = $("#image_url");
        const price = $("#price");
        const length = $("#length");
        const description = $("#description");
        const id = $("#id");

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
            price.next().html('Cena mora biti veca od 0. Moramo i mi nesto da zaradimo.');
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

        if(description.val().length < 10){
            description.next().html('Opis mora imati bar 10 karaktera.');
            errors++;
        }else{
            description.next().html('');
        }

        if (errors === 0){
            $.ajax({
                url: 'models/offers/update.php',
                method: 'POST',
                data: {
                    name: name.val(),
                    countryID : countryID.val(),
                    location : location.val(),
                    image_url : image_url.val(),
                    price : price.val(),
                    length : length.val(),
                    description : description.val(),
                    id: id.val()
                },
                dataType: 'json',
                success: function (res){
                    $("#offer-alert").html(res.response)
                    $("#offer-alert").css("display", "block")
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })

//     IZMENA DRZAVE
    $("#edit-country-btn").on("click", function (e){
        e.preventDefault();

        const id = $("#id");
        const country_name = $("#country_name");
        const flag_url = $("#flag_url");

    //     REGEX
        const nameReg = /[a-zšđžćč]{3,50}/i;
        const urlReg = /^https:\/\/.{6,}$/i;

        let errors = 0;

        if(!nameReg.test(country_name.val())){
            country_name.next().html('Dozvoljena su samo slova za naziv.');
            errors++;
        }else{
            country_name.next().html('');
        }

        if(!urlReg.test(flag_url.val())){
            flag_url.next().html('Neispravan url.');
            errors++;
        }else{
            flag_url.next().html('');
        }

        if(errors === 0){
            $.ajax({
                url: 'models/countries/update.php',
                method: 'POST',
                data: {
                    country_name: country_name.val(),
                    flag_url: flag_url.val(),
                    id: id.val()
                },
                dataType: 'json',
                success: function (res){
                    $("#country-alert").html(res.response)
                    $("#country-alert").css("display", "block")
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })

//     IZMENI KORISNIKA
    $("#edit-user-btn").on("click", function (e){
        e.preventDefault();

        const username = $("#username");
        const email = $("#email");
        const phone = $("#phone");
        const roleID = $("#roleID");
        const userID = $("#id");

        // REGEX
        const usernameReg = /^[a-z][a-z0-9]{5,16}$/i;
        const emailReg = /^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i;
        const phoneReg = /^[0][6][0-9]{7,12}$/;

        let errors = 0;

        if(!usernameReg.test(username.val())){
            username.next().html('Dozvoljeni su samo brojevi i slova i morate početi slovom.');
            errors++;
        }else{
            username.next().html('');
        }

        if(!emailReg.test(email.val())){
            email.next().html('Neispravna email adrese.');
            errors++;
        }else{
            email.next().html('');
        }

        if(!phoneReg.test(phone.val())){
            phone.next().html('Telefon mora početi sa 06.');
            errors++;
        }else{
            phone.next().html('');
        }

        if(roleID.val() == 0){
            roleID.next().html('Telefon mora početi sa 06.');
            errors++;
        }else{
            roleID.next().html('');
        }

        if(errors === 0){
            $.ajax({
                url: 'models/user/edit.php',
                method: 'POST',
                data: {
                    username: username.val(),
                    email: email.val(),
                    phone: phone.val(),
                    roleID: roleID.val(),
                    userID: userID.val()
                },
                dataType: 'json',
                success: function (res){
                    console.log(res)
                    let alert = document.getElementById("user-alert");

                    alert.style.display = "block";
                    alert.innerHTML = res.response;
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })
})