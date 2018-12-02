$(window).on('pushstate', function (event) {
    alert("push");
}); // This one pushes u to forward page through history...

window.history.replaceState(); //work exactly like pushstate bt this one replace the history instead of creating new one...

window.history.backward(); // To move backward through history, just fire this event...

window.history.forward();// To move forward through history ...

window.history.go(-1); // Go back to one page(or whatever value u passed) through history

window.history.go(1); // Go forward to one page through history..


$(window).on('popstate', function (event) {
    alert("pop");
});

