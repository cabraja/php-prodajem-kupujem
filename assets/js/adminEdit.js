$(document).ready(function (){
    $("#editCatBtn").on("click",function (){
        const name = $("#category_name");
        const id = $("#id");

        const regex = /^(?!.*\s{2,})[A-ZČĆĐŠ\s]{3,24}$/i;

        let errorNum = 0;
        // REGEX CHECK
        if (!regex.test(name.val())) {
            errorNum++;
            name.next().html("Ime mora imati izmedju 3 i 24 karaktera. Sme sadržati samo slova i razmake.");
        } else {
            name.next().html("");
        }

        if(errorNum === 0){
            $.ajax({
                url: "models/admin/editCategory.php",
                method: "POST",
                dataType: "json",
                data: {
                    name:name.val(),
                    id: id.val()
                },
                success: function (res){
                    const alert = $("#alertCat");
                    alert.css("display", "block");
                    alert.html(res.response);
                },
                error: function (err){
                    const alert = $("#alertCat");
                    alert.css("display", "block");
                    alert.html(err.response);
                }
            })
        }

    })

//     IZMENI OGLAS
    $("#editAdBtn").on("click",function (){
        const id = $("#id");
        const name = $("#ad_name");
        const price = $("#price");
        const desc = $("#description");
        const category = $("#category");

        let errorNum = 0;

        // CHECK NAME
        if (name.val().length < 3) {
            errorNum++;
            name.next().html("Ime oglasa mora imati bar 3 karaktera.");
        } else if(name.val().length > 30) {
            errorNum++;
            name.next().html("Ime oglasa ne sme biti duže od 30 karaktera.");
        }else{
            name.next().html("");
        }

        //     CHECK CATEGORY
        if(category.val() == 0){
            errorNum++;
            category.next().html("Izaberite kategoriju.");
        }else{
            category.next().html("");
        }

        //     CHECK PRICE
        if(price.val() < 1){
            errorNum++;
            price.next().html("Cena mora biti veća od 0.");
        }else if(price.val() > 100000000){
            errorNum++;
            price.next().html("Niko ovde nema toliko novca. :(");
        }else{
            price.next().html("");
        }

        //     CHECK DESCRIPTION
        if(desc.val().length < 1){
            errorNum++;
            desc.next().html("Unesite opis.");
        }else{
            desc.next().html("");
        }

        if(errorNum === 0){
            $.ajax({
                url:"models/admin/editAd.php",
                method: "POST",
                dataType: "json",
                data:{
                    id:id.val(),
                    name: name.val(),
                    price: price.val(),
                    desc: desc.val(),
                    category: category.val()
                },
                success: function (res){
                    const alert = $("#alertAd");
                    alert.css("display", "block");
                    alert.html(res.response);
                },
                error: function (err){
                    const alert = $("#alertAd");
                    alert.css("display", "block");
                    alert.html(err.response);
                }
            })
        }
    })
})