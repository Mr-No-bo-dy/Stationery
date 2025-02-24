window.onload = function () {
    let rating = document.querySelector("#rating"),
        stars = document.querySelectorAll("#star"),
        starCount,
        offset = 0
    if (rating) {
        stars.forEach(star => {
            star.classList.add("active")
            star.style.left = offset+"px"
            offset += 27
        })
        rating.oninput = function () {
            // console.log(rating.value)
            starCount = rating.value
            stars.forEach(star => {
                if (starCount > 0) {
                    star.classList.add("active")
                } else {
                    star.classList.remove("active")
                }
                starCount--
            })
        }
    }
}