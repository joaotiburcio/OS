
$(function(){
   
   $.get('../Controlador/listagem.php',{},function(retorno){
      var obj = eval(retorno); 
      addTarefa(obj);
   });
   
            
});

function addTarefa(obj)
{
    var i;
    for(i=0; obj.length>0; i++)
    {
        
        var data = new Date(obj[i].datacriacao);
        
    

    $(' <div class="panel panel-default" osnum= "'+obj[i].id+'">'
                        +'<div class="panel-heading" role="tab" id="headingOne">'
                        +'<a data-toggle="collapse" data-parent="#accordion" href="#dadostarefa-'+obj[i].id+'" aria-expanded="true" aria-controls="'+obj[i].id+'">'
                            +'<h4 class="panel-title os-titulo">'
                               +'<span class ="glyphicon glyphicon-eye-open olho"></span>' +obj[i].id + " - " + obj[i].titulo
                                +'<span class="glyphicon glyphicon-plus" ></span>'
                            +'</h4>'
                        +'</a>'
                        +'</div>'
                        +'<div id="dadostarefa-'+obj[i].id+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">'
                            +'<div class="panel-body">'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Solicitante</span>'
                                    +'<span class= "campo-valor">'+ obj[i].usuario+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Data da Solicitação</span>'
                                    +'<span class= "campo-valor">'+data.toLocaleString()+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Area</span>'
                                    +'<span class= "campo-valor">'+ obj[i].area+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Prazo</span>'
                                    +'<span class= "campo-valor">'+ obj[i].prazo+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Descrição</span>'
                                    +'<span class= "campo-valor">'+ obj[i].descricao+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Observação</span>'
                                    +'<span class= "campo-valor">'+ obj[i].observacao+'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Status</span>'
                                    +'<span class= "campo-valor">'
                                        +'<select class ="select-status">'
                                           +' <option value="">----</option>'
                                            +'<option value="0">Aberto</option>'
                                            +'<option value="1">Concluido</option>'
                                            +'<option value="2">Em andamento</option>'
                                            +'<option value="3">Não sei se vai</option>'
                                        +'</select>'
                                    +'</span>'
                                +'</div>'
                                +'<div>'
                                    +'<span class= "campo-rotulo">Prioridade</span>'
                                    +'<span class= "campo-valor">'
                                        +'<select class ="select-prioridade">'
                                            +'<option value =" ">---</option>'
                                            +'<option value ="0">Urgente</option>'
                                            +'<option value ="1">Importante</option>'
                                            +'<option value ="2">normal</option>'
                                        +'</select>'
                                    +'</span>'
                                +'</div>'
                            +'</div>'
                        +'</div>'
                    +'</div>').appendTo('#accordion');
                    
                    $('#dadostarefa-'+obj[i].id+' .select-status option[value="'+obj[i].status+'"]').prop('selected', true);
                    $('#dadostarefa-'+obj[i].id+' .select-prioridade option[value="'+obj[i].prioridade+'"]').prop('selected', true);
            
             $('.panel-collapse').on('shown.bs.collapse', function(){
                $ (this).parent().find('.os-titulo span')
                        .removeClass('glyphicon-plus')
                        .addClass('glyphicon-minus');
            });
            
            $('.panel-collapse').on('hidden.bs.collapse', function(){
                $(this).parent().find('.os-titulo span')
                        .removeClass('glyphicon-minus')
                        .addClass('glyphicon-plus');
            });
        }
}
