
let form = document.querySelector("#js-login-form")
form.addEventListener('submit', e => {
    e.preventDefault()
    let url = form.getAttribute('action')
    let data = new FormData(form)
    post(url, data)
        .then((xhr) => {
        console.log('xhr')
    })
        .catch((xhr) => {
            console.log(xhr)
        })
})