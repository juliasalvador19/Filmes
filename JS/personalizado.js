$(document).ready(function(){
    $('a[data-confirm]').click(function(ev){
        var href = $(this).attr('href');
        if(!$('#confirm-delete').length){
            $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white"><h5 class="modal-title" id="exampleModalLabel">Deletar filme</h5><button type="button" class="close bg-danger text-white border-0" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Deseja deletar o filme?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataConfirmOk">Deletar</a></div></div></div></div>');
            }
        $('#dataConfirmOk').attr('href', href);
        $('#confirm-delete').modal({shown:true});
        return false;
    });
});