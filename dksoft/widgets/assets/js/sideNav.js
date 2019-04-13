/**
 * hamburger
 */
var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

var hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
    forEach(hamburgers, function(hamburger) {
        hamburger.addEventListener("click", function() {
            this.classList.toggle("is-active");
        }, false);
    });
}

function registerEvents(){
    if($(document).width() > 767){
        $('.hamburger').unbind('click');
        $('.dropdown_toggle').unbind('click');
        $('.dk_sidenav .dropdown_menu .header').unbind('click');
        return;
    }

    $('.hamburger').bind('click', function () {
        $('.dk_sidenav .shadow').toggle();
        var ul = $('.dk_sidenav > ul');
        if(ul.is(':hidden')){
            ul.css({left : '-=100%'}).show().animate({left:'+=100%'},200);
            $('.dk_sidenav').css('width', '100%');
        }
        else{
            ul.animate({left:'-=100%'},200).queue(function() {
                $( this ).hide().css({left : '+=100%'}).dequeue();
            });
            $('.dk_sidenav').css('width', 'auto');
        }
    });
    $('.dropdown_toggle').bind('click', function(){
        $(this).next().toggle().css({left : '-=100%'}).animate({left:'+=100%'},200);
        return false;
    });
    $('.dk_sidenav .dropdown_menu .header').bind('click', function(){
        $(this).parent('ul').animate({left:'-=100%'},200).queue(function() {
            $( this ).hide().css({left : '+=100%'}).dequeue();
        });
    });
}

/**
 * sidenav
 */
$(function(){
    registerEvents();
});