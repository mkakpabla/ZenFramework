(function () {
    let btn = document.querySelector('#btn')
    let addNewPostsForm = document.querySelector('#add-new-posts-form')
    let addBtn = document.querySelector('#add-new-posts')
    addBtn.addEventListener('click', function (e) {
        e.preventDefault()
        addBtn.style.display = 'none'
        btn.style.display = 'block'
        addNewPostsForm.style.display = 'block'
    })
    btn.addEventListener('click', function (e) {
        e.preventDefault()
        btn.style.display = 'none'
        addBtn.style.display = 'block'
        addNewPostsForm.style.display = 'none'
    })
})();







