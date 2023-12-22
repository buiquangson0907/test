// resize-handle
const resizeData = {
    tracking: false,
    startCursorScreenX: null,
    maxWidth: 500,
    minWidth: 60,
};

document.getElementById('resize-handle').addEventListener('mousedown', event => {
    event.preventDefault();
    event.stopPropagation();
    resizeData.startWidth = document.getElementById('sidebar').offsetWidth;
    resizeData.startCursorScreenX = event.screenX;
    resizeData.tracking = true;
});

document.addEventListener('mousemove', event => {
    if (resizeData.tracking) {
        const cursorScreenXDelta = event.screenX - resizeData.startCursorScreenX;
        let newWidth = Math.min(resizeData.startWidth + cursorScreenXDelta, resizeData.maxWidth);
        newWidth = Math.max(resizeData.minWidth, newWidth);
        document.getElementById('sidebar').style.flexBasis = newWidth + 'px';
        if (newWidth < 150) {
            document.getElementById('sidenavAccordion').classList.add("singleIcon")
        } else {
            document.getElementById('sidenavAccordion').classList.remove("singleIcon")
        }
        localStorage.setItem('newWidth', newWidth);
    }
})

document.addEventListener('mouseup', event => {
    if (resizeData.tracking) {
        resizeData.tracking = false;
    }
});

// toggle sidebar
window.addEventListener('DOMContentLoaded', event => {
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        if (screen.width >= 992) {
            if (document.body.classList.contains('sidenav-toggled')) {
                document.querySelector('.main_content').style.marginLeft = '0px';
                document.querySelector('.main_sidebar').style.transform = `translateX(0px)`;
                if(localStorage.getItem("newWidth")){
                    document.querySelector('.main_sidebar').style.flexBasis = `${localStorage.getItem("newWidth")}px`;
                }else{
                    document.querySelector('.main_sidebar').style.flexBasis = `250px`;
                }
            }else{
                var newWidth = document.getElementById('sidebar').offsetWidth;
                document.querySelector('.main_content').style.marginLeft = - newWidth + 'px';
                document.querySelector('.main_sidebar').style.transform = `translateX(-${newWidth}px)`;
            }
        }else{
            document.getElementById('sidenavAccordion').classList.remove("singleIcon");
        }
        document.body.classList.toggle('sidenav-toggled');
        localStorage.setItem('newWidth', newWidth);
    });
});

if(localStorage.getItem("newWidth")){
    document.querySelector('.main_sidebar').style.flexBasis = `${localStorage.getItem("newWidth")}px`;
    if (localStorage.getItem("newWidth") < 150) {
        document.getElementById('sidenavAccordion').classList.add("singleIcon");
    }
}else{
    document.getElementById('sidenavAccordion').classList.remove("singleIcon");
}

$(document).on('click','.singleIcon .nav-link',function (e) {
    if($(this).hasClass('collapse-active')) {
        $(this).removeClass('collapse-active');
    }else{
        $('.singleIcon .nav-link').removeClass('collapse-active');
        $(this).addClass('collapse-active');
    }
});

// sidebar active
$(function() {
    var url = window.location + "";
    var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
    path = path.replace('public/', '');
    var index = path.indexOf("?");
    if (path.indexOf("?") > -1) {
        index = path.indexOf("?");
    } else if (path.indexOf("/edit") > -1) {
        index = path.indexOf("/edit");
    }else if (path.indexOf("/create") > -1) {
        index = path.indexOf("/create");
    }
    if (index >= 0) {
        var res = path.slice(0, index).split("/");
    } else {
        var res = path.split("/");
    }
    path = res.join("/");
    $(".sb-sidenav-menu .nav-link").each(function() {
        var href = $(this).attr('href');
            if (path === href) {
                handleActiveLink(this);
                handleCollapse(this);
            }
    });

    function handleActiveLink(element) {
        $(element).addClass('active');
    }

    function handleCollapse(element) {
        var $collapse = $(element).parents('.collapse');
        $collapse.prev().addClass('active').removeClass('collapsed');
        $collapse.addClass('show');
    }
});

$(document).on('mouseenter', '.singleIcon .nav-link', function () {
    $(this).tooltip({
        html: true,
        trigger: 'hover'
    }).tooltip('show');
});
