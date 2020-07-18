// window.livewire.on("feeling", function(e, type) {
//     switch (e) {
//         case 'heart':
//             e = ' My love to you <i class="fa fa-heart" ></i>'
//             break;
//         case 'diamond':
//             e = ' Diamond for ever <i class="fa fa-gem" ></i>'
//             break;
//         case 'fire':
//             e = ' On fire babe on fire <i class="fa fa-fire" ></i>'
//             break;
//         case 'star':
//             e = ' My Star <i class="fa fa-star" ></i>'
//             break;
//         case 'like':
//             e = ' Like Me Like You <i class="fa fa-thumbs-up"></i>'
//             break;

//         default:
//             break;
//     }
//     toastr.info(e, [type])
// });

function feeling(e, type) {
    switch (e) {
        case 'heart':
            e = ' My love to you <i class="fa fa-heart" ></i>'
            break;
        case 'diamond':
            e = ' Diamond for ever <i class="fa fa-gem" ></i>'
            break;
        case 'fire':
            e = ' On fire babe on fire <i class="fa fa-fire" ></i>'
            break;
        case 'star':
            e = ' My Star <i class="fa fa-star" ></i>'
            break;
        case 'like':
            e = ' Like Me Like You <i class="fa fa-thumbs-up"></i>'
            break;

        default:
            break;
    }
    toastr.info(e, [type])
}

window.livewire.on("notifier", (type, content, name) => {
    if (content != 'feeling') {
        toastr.info(type + content, [name])
    } else {
        feeling(type, content)
    }
})

window.livewire.on("reqMatch", function(e) {
    toastr.info("Match Requested", ['Matching']);
});
window.livewire.on("Opss", function(e) {
    toastr.error(e, ['Error']);
});
window.livewire.on("success", function(e) {
    toastr.success(e, ['Done']);
    console.log(e)
});
window.livewire.on("error", function(e) {
    toastr.error(e, ['Opss']);
});
window.livewire.on("scrollDown", function(e) {
    scrollToDown(e)
});

window.livewire.on("pageRefreshSave", function(page) {
    localStorage.setItem('prevPage', page)
        // console.log(page)
})
window.addEventListener('load', function(event) {
    let get = localStorage.getItem('prevPage')
    if (get == null)
        page = 'body'
    else
        page = get == 'messages' ? 'chats' : get == 'questions' ? 'quests' : get

    window.livewire.emitTo('main', 'changeBody', page)
        // localStorage.removeItem('prevPage')
})

window.addEventListener("beforeunload", function(e) {
    console.log(e)
})

function scrollToDown(cid) {
    var div = document.querySelector("#msgs" + cid);
    div.scrollTo({
        top: div.scrollHeight,
        behavior: 'smooth'
    });
}