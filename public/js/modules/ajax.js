let post = function (form, success, fail) {
    let xhr = new XMLHttpRequest()
    let data = new FormData(form)
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                success(JSON.parse(xhr.responseText))
            } else {
                fail(JSON.parse(xhr.responseText))
            }
        }
    }
    xhr.open('POST', form.getAttribute('action'), true)
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send(data)
}

let get = function (url, success, fail) {
    let xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                success(JSON.parse(xhr.responseText))
            } else {
                fail(JSON.parse(xhr.responseText))
            }
        }
    }
    xhr.open('GET', url, true)
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
    xhr.send()
}

export { post, get }


