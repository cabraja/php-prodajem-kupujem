$(document).ready(function (){
//     PRATI OGLAS
    $("#followBtn").on("click", function (){
        const btn = document.getElementById("followBtn");
        const icon = document.getElementById("followIcon");
        const text = document.getElementById("followBtnText");
        let isFollowed;

        if(icon.classList.contains("fa-regular")){
            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
            text.innerHTML = "Pratite ovaj oglas";
            isFollowed = true;

        }else{
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-solid");
            text.innerHTML = "Zapratite ovaj oglas";
            isFollowed = false;
        }

        $.ajax({
            url: 'models/ads/follow.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                isFollowed:isFollowed,
                adId: btn.dataset.id
            },
            success: function (res){
                console.log(res)
            },
            error: function (err){
                console.log(err)
            }
        })
    })
})