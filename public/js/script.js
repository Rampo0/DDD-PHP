/*
    Quora Clone
*/


// model related code
const model = $('.model_container');
const backdrop = $('.backdrop');
const body = $('body');
const avatar = $('#avatar');

const model_reply = $('.model_reply_container');
const backdrop_reply = $('.reply_backdrop');

const model_edit = $('.model_edit_container');
const backdrop_edit = $('.edit_backdrop');

function openModel(e) {
    model.fadeIn(200);
    backdrop.show();
    body.css('overflow','hidden');
}

function closeModel(e) {
    model.hide();
    backdrop.fadeOut(500);
    body.css('overflow','scroll');
}


function openModelEdit(e) {
    model_edit.fadeIn(200);
    backdrop_edit.show();
    body.css('overflow','hidden');
}

function closeModelEdit(e) {
    model_edit.hide();
    backdrop_edit.fadeOut(500);
    body.css('overflow','scroll');
}


function openModelReply(e) {
    model_reply.fadeIn(200);
    backdrop_reply.show();
    body.css('overflow','hidden');
}

function closeModelReply(e) {
    model_reply.hide();
    backdrop_reply.fadeOut(500);
    body.css('overflow','scroll');
}


function removeActiveTab(){
    $('#Home').removeClass('active');
    $('#Question').removeClass('active');
    $('#Answer').removeClass('active');
    $('#Explore').removeClass('active');
}


url = window.location.href.toString();

if(url.indexOf('question') > 0 && url.indexOf('detail') > 0) {
    removeActiveTab();
}else if(url.indexOf('question') > 0){
    removeActiveTab();
    $('#Question').addClass('active');
}else if(url.indexOf('answer') > 0) {
    removeActiveTab();
    $('#Answer').addClass('active');
}else if(url.indexOf('explore') > 0) {
    removeActiveTab();
    $('#Explore').addClass('active');
}
else {
    removeActiveTab();
    $('#Home').addClass('active');
}

avatar.on('click', () => {
    $('#logoutForm').submit()
});

$('#askQuestionBtn').on('click', () => {
    $('#addQuestionForm').submit()
});
