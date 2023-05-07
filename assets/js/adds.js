$(document).ready(function (){
    $("#insertBtn").on('click', function (e){
        e.preventDefault();

        const name = $("#name");
        const category = $("#category");
        const price = $("#price");
        const image = $("#image");
        const desc = $("#description");

        const allowedTypes = ['image/png','image/jpg','image/jpeg'];
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

    //     CHECK IMAGE
        if(!image[0].files[0]){
            image.next().html("Izaberite fotografiju.");
        }else if(!allowedTypes.includes(image[0].files[0]['type'])){
            image.next().html("Dozvoljeni formati su JPG, JPEG i PNG.");
        }
        else{
            image.next().html("");
        }

    //     CHECK DESCRIPTION
        if(desc.val().length < 1){
            desc.next().html("Unesite opis.");
        }else{
            desc.next().html("");
        }

        if(errorNum === 0){
            let data = new FormData();
            data.append("name",name.val());
            data.append("id_cat", category.val());
            data.append("price", price.val());
            data.append("imageObj", image[0].files[0]);
            data.append("description", desc.val());


            $.ajax({
                url: 'models/ads/insert.php',
                method: 'POST',
                data: data,
                contentType: false,
                processData: false,
                success: function (res){
                    console.log(res)
                },
                error: function (err){
                    console.log(err)
                }

            })
        }

    })

})