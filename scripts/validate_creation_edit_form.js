CKEDITOR.replace( 'editor1' );

function validate_creation_edition() {
    var x = document.forms["form_create"]["article_name"].value;
    if (x === ""){
        alert("Введите корректное название");
        return false;
    }
    if (document.forms["form_create"]["article_author"].value === "") {
        alert("Введите автора");
        return false;
    }
}