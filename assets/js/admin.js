$(document).ready(function (){
    addUsersEventListeners();
    addAdsEventListeners();
    addCategoriesEventListeners();
})

const printUsers = (users) => {
    let div = document.getElementById("usersTable");

    div.innerHTML = "";

    users.forEach(user =>{

        let date = new Date(user.created_at);
        let dateString = `${date.getDate()}.${date.getMonth()+1}.${date.getFullYear()}`;

        div.innerHTML += `
            <tr>
                <th scope="row">${user.id}</th>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td>${user.role}</td>
                <td>${dateString}</td>
                <td><button type="button" data-id="${user.id}" class="btn btn-danger btnDeleteUser">Obriši</button></td>
            </tr>
        `;
    })

    addUsersEventListeners();
}

const printAds = (ads) => {
    let div = document.getElementById("adsTable");

    div.innerHTML = "";

    ads.forEach(ad =>{

        let date = new Date(ad.date);
        let dateString = `${date.getDate()}.${date.getMonth()+1}.${date.getFullYear()}`;

        div.innerHTML += `
            <tr>
                <th scope="row">${ad.id}</th>
                <td>${ad.ad_name}</td>
                <td>${ad.price}</td>
                <td>${dateString}</td>
                <td>${ad.category_name}</td>
                <td>${ad.username}</td>
                <td><button type="button" data-id="${ad.id}" class="btn btn-danger btnDeleteAd">Obriši</button></td>
            </tr>
        `;
    })

    addAdsEventListeners();
}
const printCategories = (cats) => {
    let div = document.getElementById("catsTable");

    div.innerHTML = "";

    cats.forEach(cat =>{

        div.innerHTML += `
            <tr>
                <th scope="row">${cat.id}</th>
                <td>${cat.category_name}</td>
                <td>${cat.adCount}</td>
                <td><button type="button" data-id="${cat.id}" class="btn btn-danger btnDeleteCat">Obriši</button></td>
            </tr>
        `;
    })

    addCategoriesEventListeners();
}

const addUsersEventListeners = () => {
    $(".btnDeleteUser").on("click", function (e){
        const userId = e.target.dataset.id;
        $("#usersAlert").css("display","none");

        if(userId){
            $.ajax({
                url: "models/admin/deleteUser.php",
                method: 'POST',
                dataType: "json",
                data: {
                    id:userId
                },
                success: function (res){
                    $("#usersAlert").css("display","block");
                    $("#usersAlert").html(res.response);
                    if(res.users){
                        printUsers(res.users);
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })
}

const addAdsEventListeners = () => {
    $(".btnDeleteAd").on("click", function (e){
        const adId = e.target.dataset.id;
        $("#adsAlert").css("display","none");

        if(adId){
            $.ajax({
                url: "models/admin/deleteAd.php",
                method: 'POST',
                dataType: "json",
                data: {
                    id:adId
                },
                success: function (res){
                    $("#adsAlert").css("display","block");
                    $("#adsAlert").html(res.response);
                    if(res.ads){
                        printAds(res.ads);
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })
}

const addCategoriesEventListeners = () =>{
    $(".btnDeleteCat").on("click", function (e){
        const catId = e.target.dataset.id;
        $("#categoryAlertAlert").css("display","none");

        if(catId){
            $.ajax({
                url: "models/admin/deleteCategory.php",
                method: 'POST',
                dataType: "json",
                data: {
                    id:catId
                },
                success: function (res){
                    $("#categoryAlert").css("display","block");
                    $("#categoryAlert").html(res.response);
                    if(res.cats){
                        printCategories(res.cats);
                    }
                },
                error: function (err){
                    console.log(err)
                }
            })
        }
    })
}