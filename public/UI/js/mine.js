function displayInfo(id) {
    var div = document.querySelector("#info" + id)
    if (div.classList.contains('hidden')) {
        div.classList.add('display')
        div.classList.remove('hidden')
    }
}

function hideInfo(id) {
    var div = document.querySelector("#info" + id)
    if (div.classList.contains('display')) {
        div.classList.remove('display')
        div.classList.add('hidden')
    }
}

window.addEventListener("mousemove", (e) => {
    if (e.target.localName == 'i') {
        e.target.classList.add('animated', 'pulse')
    }
    var tag = e.target;
    tag.addEventListener("mouseleave", function(e) {
        if (tag.localName == 'i') {
            tag.classList.remove('animated', 'pulse')
        }
    });
})

var selected = 0
let usid = []

function changeSelectOption(gender) {
    var first = document.querySelector("#waistMuscles")
    var second = document.querySelector("#hairBeard")
    if (gender == 'male') {
        first.innerHTML = "Muscles Rate"
        second.innerHTML = "Beard"
    } else {
        first.innerHTML = "WaistLine"
        second.innerHTML = "Hair Type"
    }
}

function setSelected(id, uid) {
    if (usid.includes(uid)) {
        var pos = usid.indexOf(uid)
        usid.splice(pos, 1)
    } else {
        usid.push(uid)
    }
    var card = document.querySelector("#post" + id)
    if (card.classList.contains("selectev") == true) {
        card.classList.remove('selectev')
        selected -= 1
    } else {
        card.classList.add('selectev')
        selected += 1
    }
    let content = document.querySelector("#selected_item").textContent
    let sele = content + selected + '/15'
    document.querySelector("#selected_item").textContent = selected
    document.querySelector("#ids").value = usid
    let arr = document.querySelector("#ids")
        // console.log(arr)
}

function checkIds() {
    window.livewire.emitTo('semi', 'ids', usid)
}

function viewInfo(id) {
    var info = document.querySelector("#user" + id)
    if (info.style.display == 'block') {
        info.style.display = 'none'
    } else {
        info.style.display = 'block'
    }
}

function sendIds() {
    ids = usid
        // console.log(usid)
    if (ids.length >= 4) {
        let url = '/sendIds'
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector("meta[name='csrf-token']").content,
            },
            method: "POST",
            body: JSON.stringify(ids),
        }).then(res => {
            // var newWindow = window.open("", "_blank", )
            // newWindow.document.write(res.body)
            if (res.status == 200 && res.statusText == 'ok') {
                // location.replace('/home')
            }
        })
    }
}

function sendId(id) {
    if (id != 'xx') {
        const resultFeats = document.querySelector("#resultFeats")
        resultFeats.innerHTML = '';
        let url = '/updateFeats'
        fetch(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-Token": document.querySelector("meta[name='csrf-token']").content,
            },
            method: "POST",
            body: JSON.stringify(id),
        }).then(res => res.json()).then((info) => {
            // console.log(typeof info)
            var result = Object.keys(info).map(function(key) {
                return [(key), info[key]];
            })
            result.forEach((res) => {
                var el = document.createElement('small')
                    // el.setAttribute('href', '#')
                el.setAttribute('class', 'feats')
                var br = document.createElement('br')
                el.textContent = res[0] + ' : ' + res[1].slice(0, -2)
                resultFeats.appendChild(el)
                resultFeats.appendChild(br)
            })
        })
    } else {
        resultFeats.innerHTML = '';
    }
}

window.addEventListener('click', (e) => {
    let pops = document.querySelectorAll('div[data-parent="#accordionSidebar"]')
    pops.forEach((pop) => {
            pop.classList.contains('show') ? pop.classList.remove('show') : ''
        })
        // let arrows = document.querySelectorAll('a[class="nav-link collapsed"]')
})
let i = 0

function newQuestion() {
    i++
    let par = document.querySelector('#questionnary')
    let div = document.querySelector("#firstQuest")
    let n1 = div.cloneNode(true)
    n1.setAttribute('id', i + 'quest')
    n1.childNodes[1].setAttribute('href', '#' + i + 'questCollaps')
    n1.childNodes[5].setAttribute('id', i + 'questCollaps')
        // let icon = document.createElement("i")
        // icon.setAttribute('class', 'fa fa-times fa-md')
        // icon.setAttribute('onclick', `removerQuest(${i}questCollaps)`)
        // n1.childNodes[1].appendChild(icon)
        // n1.childNodes[5].classList.remove('show')
    n1.childNodes[5].children[0].children[0].children[1].children[0].setAttribute('id', 'answer' + Math.random())
    n1.childNodes[5].children[0].children[0].children[1].children[1].setAttribute('id', 'check' + Math.random())
    n1.childNodes[5].children[0].children[1].children[1].children[0].setAttribute('id', 'answer' + Math.random())
    n1.childNodes[5].children[0].children[1].children[1].children[1].setAttribute('id', 'check' + Math.random())
    n1.childNodes[5].children[0].children[2].children[1].children[0].setAttribute('id', 'answer' + Math.random())
    n1.childNodes[5].children[0].children[2].children[1].children[1].setAttribute('id', 'check' + Math.random())
    par.appendChild(n1)
}