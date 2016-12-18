function wdOnClick(wdId) {
    //alert('I\'m here.Enter. wdId :' + wdId) ;
    $.ajax({
        url: 'index.php?r=site%2Fwork-direct-get',
        data: {wdid: wdId},
        type: 'POST',
        success: function(res){
            //alert('I\'m here. success. wdId :' + wdId) ;
            $('#modal-insert').empty() ;
            $('#modal-insert').append(res) ;

//            console.log(res);
        },
        error: function(){
            alert('Error!');
        }
    });
}
