$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#body'))
        .catch(error => {
            console.error(error);
        });

    // alert('hi');
    $('#selectAllcheckBoxes').click(function (e) {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            })
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            })
        }
    });
    $("body").prepend("<div id='load-screen'><div id='loading'></div></div>");
    $('#load-screen').delay(700).fadeOut(600, function () {
        $(this).remove();
    });
});




