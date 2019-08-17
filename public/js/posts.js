import  * as ajax from './modules/ajax.js'


let form = document.querySelector("#form")
form.addEventListener('submit', (e) => {
    e.preventDefault()
    ajax.post(form, function (response) {
        console.log(response)
    }, function (response) {
        console.log(response)
    })

})
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {
        let url = btn.dataset.url
        ajax.get(url, function (response) {
            document.querySelector('#title').value = response.title
            document.querySelector('#content').value = response.content
            document.querySelector('#category_id').options[response.category_id-1].selected = true

            let btn = document.querySelector('#form-btn')
            btn.innerHTML = 'Mettre à jour'
            btn.disabled = true
        }, function (response) {
            console.log(response)
        })

        document.querySelector('#title').value = 'Test'
    })
})





