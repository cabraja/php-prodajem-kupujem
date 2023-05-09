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
                    const alert = $("#adAlert");
                    alert.css("display", "block");
                    alert.html(res.response);
                },
                error: function (err){
                    const alert = $("#adAlert");
                    alert.css("display", "block");
                    alert.html(err);
                }

            })
        }

    })

    // PAGINATION
    addPaginationEventListeners();

//     FILTER
    $("#filterBtn").on('click', function (){
        const page = 0;
        const categoryId = document.getElementById("ddlCategory").value;
        const sort = $("#ddlSort").val();
        fetchAjaxCall(page,categoryId,sort);
    })

// SORT
    $("#ddlSort").on("change", function (){
        const page = 0;
        const categoryId = document.getElementById("ddlCategory").value;
        const sort = $("#ddlSort").val();
        fetchAjaxCall(page,categoryId,sort)
    })

})



// FUNCTIONS -----------------------
const printAds = (ads,page,count) =>{
    let div = document.getElementById("ads-content");

    div.innerHTML = "";

    if(ads.length){
        ads.forEach(ad => {
            let date = new Date(ad.created_at);
            let dateString = `${date.getDate()}.${date.getMonth()+1}.${date.getFullYear()}`;
            div.innerHTML += `
            <div class="col-12 col-lg-4 col-md-6 mt-3">
                <div class="card" style="100%">
                    <img src="assets/images/uploaded/small/${ad.image_name}" class="card-img-top" alt="${ad.ad_name}">
                    <div class="card-body">
                        <p class="card-text mb-0 text-secondary">Kategorija: ${ad.category_name}</p>
                        <h5 class="card-title mb-0">${ad.ad_name}</h5>
                        <p class="mb-0 mt-1 text-primary fw-bold">${ad.price} RSD</p>
                        <small class="text-secondary">Oglas postavljen: ${dateString}</small>
                        <a href="index.php?page=ad&id=${ad.id}" class="btn btn-outline-primary mt-2">Pogledaj Oglas</a>
                    </div>
                </div>
            </div>
        `;
        })
    }else{
        div.innerHTML = `
            <div class="col-12 mt-5">
            <div class="alert alert-primary" role="alert">
                Nije pronađen ni jedan oglas.
            </div>
            </div>
        `;
    }

//     PRINT PAGINATION
    let paginationDiv = document.getElementById("ads-pagination");
    let pageCount = Math.ceil(count.count/6);
    paginationDiv.innerHTML = "";

    for (let i = 0; i < pageCount; i++){
        paginationDiv.innerHTML += `
            <li style="cursor: pointer" class="page-item ads-page-link-wrap ${page == i ? 'active' : ''}"><a class="page-link ads-page-link" data-page="${i}">${i+1}</a></li>
        `;
    }

    addPaginationEventListeners();


}

const fetchAjaxCall = (page,categoryId,sort) => {

    // PRINT SPINNER
    let div = document.getElementById("ads-content");
    div.innerHTML = `
        <div class="d-flex justify-content-center my-5">
          <div class="spinner-border" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
    `;

    $.ajax({
        url: 'models/ads/fetch.php',
        method: 'GET',
        data:{
            page: page,
            categoryId:categoryId,
            sort: sort
        },
        dataType:'JSON',
        success: function (res){
            printAds(res.ads,page,res.count)
        },
        error: function (err){
            console.log(err)
        }
    })
}

const addPaginationEventListeners = () => {
    $(".ads-page-link").on("click", function (e){
        const page = e.target.dataset.page;
        const categoryId = document.getElementById("ddlCategory").value;
        const sort = $("#ddlSort").val();
        fetchAjaxCall(page,categoryId,sort);
    })
}