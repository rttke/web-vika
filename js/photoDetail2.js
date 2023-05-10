const stars = document.querySelectorAll('.rate-star')


let flag = false
const params = (new URL(document.location)).searchParams;
const photoId = params.get("photo")
const nonratedTitle = document.getElementById('nonrated-title')
const ratedTitle = document.getElementById('rated-title')
const ratingForm = document.getElementById('ratingForm')
$.ajax({
    type: "POST",
    url: "checkRate.php",
    data: {
        photoId: photoId
    },
    cache: false,
    success: function (html) {
        if (html == '') {
            stars.forEach((item) => {
                item.addEventListener('click', function () {
                    if (!flag) {
                        stars.forEach(item => item.classList.remove('active-rate'))
                        item.classList.add('active-rate')
                        btnRate.classList.add('active')
                    }
                })
            })
            console.log(html)
        } else {
            stars.forEach((item) => {
                item.classList.remove('active-rate')
                if (item.dataset.value == html) {
                    item.classList.add('active-rate')
                }
            })
            nonratedTitle.style.display = 'none'
            btnRate.style.display = 'none'
            ratedTitle.style.display = 'block'
            flag = true
            console.log(html)
        }
    }
});

const btnRate = document.getElementById('btn-rate')
const averageRateDiv = document.getElementById('average-rate')
const numRateDiv = document.getElementById('num-rate')
btnRate.addEventListener('click', function () {
    const rateValue = document.querySelector('.active-rate').dataset.value
    const params = (new URL(document.location)).searchParams;
    const photoId = params.get("photo")

    if (!flag && btnRate.classList.contains('active')) {
        $.ajax({
            type: "POST",
            url: "submitRate.php",
            data: {
                rate: rateValue,
                photoId: photoId
            },
            dataType: 'json',
            cache: false,
            success: function (html) {
                console.log(html)
                stars.forEach((item) => {

                    item.classList.remove('active-rate')
                    if (item.dataset.value == html.rate) {
                        flag = true
                        item.classList.add('active-rate')
                        nonratedTitle.style.display = 'none'
                        btnRate.style.display = 'none'
                        ratedTitle.style.display = 'block'
                        console.log('before')

                        averageRateDiv.innerHTML = html.average_rate
                        numRateDiv.innerHTML = `${html.rate_num} оценок`
                    }
                    console.log('after')
                })
                stars.forEach((item) => {
                    item.addEventListener('click', function () {
                        return false
                    })
                })
            }
        });
    }
})


